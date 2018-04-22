<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Station;

class StationController extends Controller
{

    public function index(){
        $stations=DB::table('stations')->simplePaginate(12);
        return view('stations')->with([
            'stations'=>$stations
        ]);
    }
    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'name'=>'required|unique:stations',
            'phone'=>'required|string',
            'location'=>'required|string',
        ]);

        if($validator->fails()){
            $msg=array(
                'status'=>'bad',
                'error' => true,
                'msg' => $validator->errors()->all()
            );

            return view('status')->with([
                'message'=>json_encode($msg),
                'back_page'=>'stations'
            ]);
        }

        $station = new Station([
            'name'=>$request->name,
            'phone'=>$request->phone,
            'location'=>$request->location
        ]);
       
        if($station->save()){
            $msg=array(
                'status'=>'ok',
                'error' => false,
                'msg' =>'Station successfully added'
            );
        }
        else{
            $msg=array(
                'status'=>'bad',
                'error' =>true,
                'msg' =>'Station could not be successfully added'
            );
        }

        return view('status')->with([
            'message'=>json_encode($msg),
            'back_page'=>'stations'
        ]);
    }

    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'id'=>'required',
            'name'=>'required',
            'phone'=>'required|string',
            'location'=>'required|string',
        ]);

        if($validator->fails()){
            $msg=array(
                'status'=>'bad',
                'error' => true,
                'msg' => $validator->errors()->all()
            );

            return view('status')->with([
                'message'=>json_encode($msg),
                'back_page'=>'stations'
            ]);
        }

        $station=Station::find($request->id);
        if($station){
            $count=$station->update([
                'name'=>$request->name,
                'phone'=>$request->phone,
                'location'=>$request->location
            ]);

            $msg=($count>0) ? array('status'=>'ok','error' => false,'msg' =>'Station successfully updated') 
                            : array('status'=>'bad','error' => true,'msg' =>'Station could not be successfully update');
        }
        else{
            $msg=array('status'=>'bad','error' => true,'msg' =>'Station could not be found using that ID');
        }

        return view('status')->with([
            'message'=>json_encode($msg),
            'back_page'=>'stations'
        ]);
    }

    public function delete(Request $request){
        $validator = Validator::make($request->all(), [
            'id'=>'required',
        ]);

        if($validator->fails()){
            $msg=array(
                'status'=>'bad',
                'error' => true,
                'msg' => $validator->errors()->all()
            );

            return view('status')->with([
                'message'=>json_encode($msg),
                'back_page'=>'stations'
            ]);
        }

        $station=Station::find($request->id);
        if($station){
            $msg=($station->delete()) ? array('status'=>'ok','error' => false,'msg' =>'Station successfully deleted') 
                            : array('status'=>'bad','error' => true,'msg' =>'Station could not be successfully deleted');
        }
        else{
            $msg=array('status'=>'bad','error' => true,'msg' =>'Station could not be found using that ID');
        }

        return view('status')->with([
            'message'=>json_encode($msg),
            'back_page'=>'stations'
        ]);
    }
}
