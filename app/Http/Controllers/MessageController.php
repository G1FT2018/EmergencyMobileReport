<?php
namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Message;
use App\User;
use App\Station;
use App\Coordinate;


class MessageController extends Controller
{
    /**
     * @brief - loads web access page for messages
     */
    public function index(){  
        $messages=\App\Message::simplePaginate(15); 
        return view('messages')->with([
            'messages'=> $messages
        ]);
    }

    /**
     * @bried - receives client messsage alert 
     * @param $request
     */
    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'emergency' => 'required',
            'user_id' => 'required|exists:users,id',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric'
        ]);

        if($validator->fails()){
            $msg=array(
                'status'=>'bad',
                'error' => true,
                'msg' => $validator->errors()->all()
            );

            return $msg;
        }

        //creating a new emergency message
        $message = new Message([
            'emergency'=>$request->emergency,
        ]);

        $user  = User::find($request->user_id);
        //Devise an algorithm for getting the closest station to the user
        
        //For now  just get the first station
        $station = Station::all()->first();

        $message->user()->associate($user);
        $message->station()->associate($station);
        if(!$message->save()){
            return array('status'=>'bad','error'=>true,'msg'=>'Could not add Message:internal Error');
        }

        $coordinate = new Coordinate([
            'latitude'=>$request->latitude,
            'longitude'=>$request->longitude
        ]);
        $coordinate->message()->associate($message);

        if(!$coordinate->save()){
            return array('status'=>'bad','error'=>true,'msg'=>'Could not add Coordinates:internal Error');
        }

        return "{status:'ok','error':false,msg:'Message successfully submitted,help is on its way.'}"; //for all api calls
    }

    public function realTime($upperBound){
           $newAlerts=Message::getNew($upperBound);
           //get user,station and coordinate details for this user
           foreach($newAlerts as $alert){
               $alert->username=$alert->user;
               $alert->station=$alert->station;
               $alert->coordinates=$alert->coordinates;
           }
           if(count($newAlerts)!=0){
               $upperBound=$newAlerts[0]->id;
                $response=array(
                    'newAlerts'=>$newAlerts,
                    'upperBound'=>$upperBound
                );
           }
           else{
                $response=array(
                    'newAlerts'=>array(),
                    'upperBound'=>$upperBound
                );
           } 

           return json_encode($response);
    }
    public function getAll(){
        $messages = Message::all();

        foreach($messages as $message){
            $message['responsecount'] = count($message->responses);
            unset($message->responses);
        }

        return array('error'=>false, 'messages'=>$messages);
    }


   public function getMessage($id) {
      $message = Message::findOrFail($id);
      return ['error'=>false, 'message' => $message];
    }  


    public function getByStation($station_id){
        try{
            $messages = Station::findOrFail($station_id)->messages;

            foreach($messages as $message){
                $question['responsecount'] = count($message->responses);
                unset($message->responses);
            }

            return array('error'=>false, 'messages'=>$messages);
        }catch(ModelNotFoundException $e){
            return array('error'=>true, 'message'=>'Invalid Station ID');
        }
    } 


    public function getMessageCoordinates($id)
    {
        $message = Message::findOrFail($id);
        return ['error'=>false, 'coordinates' => $message->coordinates];
    }

 

}
