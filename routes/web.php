<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Career;
use Illuminate\Support\Facades\Auth;
use Illuminate\Testing\TestResponse;
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
    return view('alumnes');
})->middleware(['auth',  'can:accessAdmin'])->name('alumnes ');

require __DIR__ . '/auth.php';

Route::get("/create", function(){
    Career::create(['term_id'=>'1', 'name' => 'test', 'code' => 'test', 'description' => 'test']);
});

Route::get("/softDelete", function(){
    // Elimina un curso con softDelete
    //Career::find(3)->delete();
    // Restaura curso eliminador que le introduzcas el id
    //Career::onlyTrashed()->find(3)->restore();
    // Restaura todos los cursos que se hayan eliminado
    //Career::query()->restore();
});

//Page to test logs, if you enter to this route a log will be written in the logs table
Route::get("/log", function(){
    $user = Auth::user();
    Log::channel('dblogs')->debug("Action: Testing - ID: ".$user->id." User: ".$user->name);
 
    return ["result" => true];
});

