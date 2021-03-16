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
Route::get('/test',function (Request $request){
	$data = Term::all();
	return response()->json($data);
});

Route::post('/test', function(Request $request) {
	
	return response()->json($request);
});

Route::get('/admin/dashboard/cursos', function (Request $request) {
	return response()->json(
		Career::all()
		);
});

Route::get('/admin/dashboard/cicles', function (Request $request) {
	return response()->json(
		Term::all());
});

Route::post('/admin/dashboard/cursos', function (Request $request) {
	$action= $request->action;
	$message="invalid action";
    if($action=='delete'){
            $dataArray=$request->result;

    	    $id=(int)$dataArray[0]["id"];
    	    $name=$dataArray[1]["name"];
    	    
			return route('confirmacionCursoSD', ['id' => $id,'name' => $name, 'page' => 'cursos']);

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

Route::post('/admin/dashboard/cicles', function (Request $request) {
	$action= $request->action;
	$message="invalid action";
	//var_dump($request->id);
        //TODO: change the key array
    //$dataArray=json_decode($request->array,true);
    if($action=='delete'){
    		$dataArray=$request->result;

    	    $id=(int)$dataArray[0]["id"];
    	    $name=$dataArray[1]["name"];
    	    
			return route('confirmacionCicleSD', ['id' => $id,'name' => $name, 'page' => 'cicles']);
    }else if($action=='create'){
    		$createArray=$request->result;
    	    $start=$createArray[0]["start"];
    	    $end=$createArray[1]["end"];
    	    $name=$createArray[2]["name"];
			$description=$createArray[3]["description"];

    		Term::create([
                'start'=>$start,
				'end'=>$end,
				'name'=>$name,
                'description'=>$description
            ]);
    }
    else if($action=='update'){
    	    $dataArray=$request->result;
    	    $id=(int)$dataArray[0]["id"];
    	    $start=$dataArray[1]["start"];
    	    $end=$dataArray[2]["end"];
    	    $name=$dataArray[3]["name"];
			$description=$dataArray[4]["description"];
    	  
			Term::where('id',$id)->update(['start' => $start]);
    		Term::where('id',$id)->update(['end' => $end]);
    		Term::where('id',$id)->update(['name' => $name]);
    		Term::where('id',$id)->update(['description' => $description]);
			
            $message="Register updated succesfully";

    }
	return response()->json($message);

});

Route::post('/admin/dashboard/cursos/confirmacionSD', function (Request $request) {
    //var_dump($request->id);
    Career::find((int)$request->id)->delete();
    

});
Route::post('/admin/dashboard/cicles/confirmacionSD', function (Request $request) {
    //var_dump($request->id);
    Term::find((int)$request->id)->delete();
    

});