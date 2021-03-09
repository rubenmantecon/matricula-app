<?php

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
	return response()->json([
		[
			'id' => 'Comes from the callback',
			'name' => 'Bobby McFerrins',
			'email' => 'marvin@whatsgoingon.gaye'
		], [
			'id' => 'The second one',
			'name' => 'Billy Butcha',
			'email' => 'Fakin cant'
		]
	]);
});

Route::post('/test', function (Request $request) {
	return response()->json('You POSTed this: ');
});
