<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Term;
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

require __DIR__ . '/auth.php';

//Page to test logs, if you enter to this route a log will be written in the logs table
Route::get("/log", function(){
    $user = Auth::user();
    Log::channel('dblogs')->debug("Action: Testing - ID: ".$user->id." User: ".$user->name);
 
    return ["result" => true];
});