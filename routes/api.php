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
	$message="invalid action";
        //TODO: change the key array
    //$dataArray=json_decode($request->array,true);
    if($action=='delete'){

            Career::find($request->id)->delete();
            $message="Register deleted succesfully";

    }else if($action=='create'){
    		$createArray=$request->result;
    	    $id=(int)$createArray[0]["id"];
    	    $name=$createArray[1]["name"];
    	    $code=$createArray[2]["code"];
    	    $desc=$createArray[3]["description"];

    		Career::create([
                'term_id'=>1,
                'name'=>$name,
                'code'=>$code,
                'description'=>$description,
               
            ]);
            

    }
    else if($action=='update'){
    	    $dataArray=$request->result;
    	    $id=(int)$dataArray[0]["id"];
    	    $name=$dataArray[1]["name"];
    	    $code=$dataArray[2]["code"];
    	    $desc=$dataArray[3]["description"];
    	  
    		Career::where('id',$id)->update(['name' => $name]);
    		Career::where('id',$id)->update(['code' => $code]);
    		Career::where('id',$id)->update(['description' => $desc]);
			
            $message="Register updated succesfully";

    }
	return response()->json($message);

});