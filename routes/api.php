<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Career;

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
	return response()->json(
		Career::all()
		);
});

Route::post('/test', function (Request $request) {
	$action= $request->action;
        //TODO: change the key array
    //$dataArray=json_decode($request->array,true);
	if($action=='delete'){
			print_Career::find($request->id));
            Career::find($request->id)->delete();

    }
	return response()->json('You POSTed this: ');

});
