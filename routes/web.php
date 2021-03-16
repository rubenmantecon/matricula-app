<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Term;
use App\Models\User;
use App\Models\Career;
use Illuminate\Support\Facades\Auth;
use Illuminate\Testing\TestResponse;
use App\Imports\TermsImport;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;

//use Log;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	return view('welcome');
});


Route::get('/styletest', function () {
	$data = Career::all();
	return view('styletesting', ['careers' => $data]);
});


// Redirect user to admin panel or user panel according to their role
Route::get('/dashboard', function () {
    if (Auth::check()) {
        if(Auth::user()->role == "admin"){
            return redirect('/admin/dashboard');
        }
        if (Auth::user()->role == "user") {
            return view('dashboard');
        }
    }
})->middleware(['auth'])->name('dashboard');

Route::get('/admin', function () {
    return redirect('/admin/dashboard');
})->middleware(['auth',  'can:accessAdmin'])->name('dashboard');

Route::get('/admin/dashboard', function () {
    return view('dashboardadmin');
})->middleware(['auth',  'can:accessAdmin'])->name('dashboard');

Route::get('/admin/dashboard/cursos', function () {
    $data = Career::all();
    return view('cursos', ['careers' => $data]);
    
})->middleware(['auth',  'can:accessAdmin'])->name('cursos');

Route::get('/admin/dashboard/alumnes', function () {
    $data = User::paginate(20);
    return view('alumnes', ['alumnes' => $data]);
})->middleware(['auth',  'can:accessAdmin'])->name('alumnes');



Route::get('/admin/dashboard/cicles', function () {
    $data = Term::all();
    return view('cicles', ['terms' => $data]);
})->middleware(['auth',  'can:accessAdmin'])->name('cicles');

Route::get('/admin/dashboard/cicles/import', function () {
    $data = Term::all();
    return view('importCicles', ['terms' => $data]);
    
})->middleware(['auth',  'can:accessAdmin'])->name('importCicles');

Route::post('/admin/dashboard/cicles', function (Request $request) {
    //$data = Term::all();

    $existingTerms=array();
    $termsData=array();


    $data=Excel::toArray(new TermsImport, $request->file('file'));
    foreach ($data[0] as $term) {
        if (!in_array($term[1],$existingTerms)) {
            $arrayTerm=array("code"=>$term[0], "name"=>$term[1], "desc"=>"Hores: ".$term[3], "iniDate"=>$term[4],"endDate"=>$term[5]);
            array_push($existingTerms, $term[1]);
            array_push($termsData, $arrayTerm );
        }
    }

    //var_dump($existingTerms);
    return $termsData;
    
    
})->middleware(['auth',  'can:accessAdmin'])->name('cicles');

Route::post('/admin/dashboard/cicles/import', function (Request $request) {
    if ($request->ajax()) {
        foreach ($request->result as $term) {
            
            $name=$term['name'];
            //Realised that code isnt in the terms table, TODO: ask if we have to do something with it else remove from importCicles and web.
            //$code=$term['code'];       
            $desc=$term['desc'];
            $iniDate=$term['iniDate'];
            $endDate=$term['endDate'];

            Term::create([
                'term_id'=>1,
                'start'=>$iniDate,
                'end'=>$endDate,
                'name'=>$name,
                'description'=>$desc,
                'active'=>1,
               
            ]);
        }
        
    }else{

        return view('importCicles');

    }
})->middleware(['auth',  'can:accessAdmin'])->name('importCicles');


require __DIR__ . '/auth.php';

//Page to test logs, if you enter to this route a log will be written in the logs table
Route::get("/log", function(){
    $user = Auth::user();
    Log::channel('dblogs')->debug("Action: Testing - ID: ".$user->id." User: ".$user->name);
 
    return ["result" => true];
});


Route::get('/admin/dashboard/cursos/confirmacionSD', function () {
    return view('confirmacionSD');
    
})->middleware(['auth',  'can:accessAdmin'])->name('confirmacionCursoSD');

Route::get('/admin/dashboard/cicles/confirmacionSD', function () {
    return view('confirmacionSD');
    
})->middleware(['auth',  'can:accessAdmin'])->name('confirmacionCicleSD');

Route::post('/admin/dashboard/alumnes', function (Request $request) {
    //$data = Term::all();

    $existingAlumnes=array();
    $alumnesData=array();
    $cont=0;

    $data=Excel::toArray(new UsersImport, $request->file('file'));
    foreach ($data[0] as $alumne) {
        if ($cont!=0) {
           $nameAlumne= $alumne[4]." ".$alumne[5]." ".$alumne[6];

            if (!in_array($nameAlumne,$existingAlumnes)) {
                $arrayAlumne=array("name"=>$nameAlumne, "email"=>$alumne[40]);
                array_push($existingAlumnes, $nameAlumne);
                array_push($alumnesData, $arrayAlumne );
            }
        }
        $cont ++;

        
    }

    return $alumnesData;
    
    
})->middleware(['auth',  'can:accessAdmin'])->name('alumnes');

Route::get('/admin/dashboard/alumnes/import', function () {
    
    return view('importAlumnes');
    
})->middleware(['auth',  'can:accessAdmin'])->name('importAlumnes');


Route::post('/admin/dashboard/alumnes/import', function (Request $request) {
    if ($request->ajax()) {
        foreach ($request->result as $alumne) {
            
            $name=$alumne['name'];
            $email=$alumne['email'];

            User::create([
                
                'name'=>$name,
                'email'=>$email,
                'password'=>Hash::make("user"),
                'role'=>"user",
               
            ]);
        }
        
    }else{

        return view('importAlumnes');

    }
})->middleware(['auth',  'can:accessAdmin'])->name('importAlumnes');

