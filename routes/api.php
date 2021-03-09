<?php

use App\Models\User;
use App\Models\Career;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
	return $request->user();
});

//Two routes for mockup
Route::get('/test', function (Request $request) {
	$data = User::all();
	return response()->json($data);
});

Route::post('/test', function (Request $request) {

	return response()->json('You POSTed this: ');
});
