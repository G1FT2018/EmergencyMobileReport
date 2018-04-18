<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Station;

class StationController extends Controller
{

 public function create(Request $request){

 $validator = Validator::make($request->all(), [
            'name'=>'required|unique:stations'
        ]);

        if($validator->fails()){
            return array(
                'error' => true,
                'message' => $validator->errors()->all()
            );
        }

        $station = new Station;
        $station->name = $request->input('name');
        $station->save();
 
        return array('error'=>false, 'station'=>$station);
 }

}
