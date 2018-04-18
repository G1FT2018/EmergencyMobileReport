<?php
namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Message;
use App\User;
use App\Station;
use App\Coordinate;


class MessageController extends Controller
{

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

    public function create(Request $request){

         $validator = Validator::make($request->all(), [
            'emergency' => 'required',
            'user_id' => 'required|exists:users,id',
            'latitude' => 'required',
            'longitude' => 'required'
        ]);

        if($validator->fails()){
            return array(
                'error' => true,
                'message' => $validator->errors()->all()
            );
        }

        $user  = User::find($request['user_id']);
        //Devise an algorithm for getting the closest station to the user
        
        //For now  just get the first station
        $station = Station::all()->first();

        $message = new Message;
        $message->content = $request['emergency'];
        $message->user()->associate($user);
        $message->station()->associate($station);
        $message->save();

        $coordinate = new Coordinate;
        $coordinate->latitude = $request['latitude'];
        $coordinate->longitude = $request['longitude'];
        $coordinate->message()->associate($message);
        $coordinate->save();

        return array(
                'error' => false,
                'message' => $message
            );
    }

}
