<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Career;
use App\Models\Term;


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
Route::get('test',function (Request $request){
	$data = Term::all();
	return response()->json($data);
});

Route::post('test', function(Request $request) {
	if ($request['action'] == 'testing') {
		return response()->json('All good my man');
	} else {
		return response()->json('Not looking good, amigo');
	}
});

Route::get('/admin/dashboard/cursos', function (Request $request) {
	return response()->json(
		Career::all()
		);
});

Route::post('/admin/dashboard/cursos', function (Request $request) {
	$action= $request->action;
	$message="invalid action";
	//var_dump($request->id);
        //TODO: change the key array
    //$dataArray=json_decode($request->array,true);
    if($action=='delete'){
    		var_dump($request->id);
            Career::find($request->id)->delete();
            $message="Register deleted succesfully";

    }else if($action=='create'){
    		$createArray=$request->result;
    	    
    	    $name=$createArray[0]["name"];
    	    $code=$createArray[1]["code"];
    	    
    	    $desc=$createArray[2]["description"];

    		Career::create([
                'term_id'=>1,
                'name'=>$name,
                'code'=>$code,
                'description'=>$desc,
               
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