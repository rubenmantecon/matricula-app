<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Career;

class CareerData extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function ajaxRequestPost(Request $request)
    {

        $action= $request->action;
        //TODO: change the key array
        $dataArray=$request->array;

        if ($action=='create') {  
            DB::table('careers')->insert([
                'term_id'=>$dataArray['term_id'],
                'name'=>$dataArray['name'],
                'code'=>$dataArray['code'],
                'description'=>$dataArray['description'],
                'soft_delete'=>1;
            ]);

            return response()->json(
                [
                    'succes'=> true,
                    'message'=>'Data inserted succesfully';
                ]
            )

        }else if($action=='update'){
            DB::table('users')->where('id',$dataArray['id'])->update([
                'term_id'=>$dataArray['term_id'],
                'name'=>$dataArray['name'],
                'code'=>$dataArray['code'],
                'description'=>$dataArray['description'],
                'soft_delete'=>1;

            ]);
            return response()->json(
                [
                    'succes'=> true,
                    'message'=>'Data updated succesfully';
                ]
            )

        }else if($action=='delete'){
            DB::find($action->)->delete();

        }
        
    }

}
