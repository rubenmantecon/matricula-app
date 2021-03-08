<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Log;

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



Route::get('/test', function () {
	$data = User::all();
	return view('styletesting', ['users' => $data]);
});

// Redirect user to admin panel or user panel according to their role
Route::get('/dashboard', function () {
    if (Auth::check()) {
        if(Auth::user()->role == "admin"){
            return view('dashboardadmin');
        }
        if (Auth::user()->role == "user") {
            return view('dashboard');
        }
    }
})->middleware(['auth'])->name('dashboard');


Route::name('admin')
  ->prefix('admin')
  ->middleware(['auth', 'can:accessAdmin'])
  ->group(function () {
    Route::get('dashboard', function() {
        return view('dashboardadmin');
    });        

    Route::resource('users', 'UserController');
});

require __DIR__ . '/auth.php';


//Page to test logs, if you enter to this route a log will be written in the logs table
Route::get("/log", function(){
    $user = Auth::user();
    Log::channel('dblogs')->debug("Action: Testing - ID: ".$user->id." User: ".$user->name);
 
    return ["result" => true];
});