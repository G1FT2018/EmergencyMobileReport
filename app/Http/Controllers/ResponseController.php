<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Response;
use App\Message;

class ResponseController extends Controller
{

    public function emergencyWatch(){
        $alerts=\App\Message::unresponded();
        return view('emergency-unit')->with([
            'alerts'=>$alerts
        ]);
    }
    public function submit(Request $request){

        $validator = Validator::make($request->all(), [
            'response'=>'required',
            'user_id'=>'required',
            'message_id'=>'required'
        ]);

        if($validator->fails()){
            return array(
                'error' => true,
                'message' => $validator->errors()->all()
            );
        }

        $response = new Response;
        $response->response = $request['response'];
        $response->message_id = $request->input('message_id');
        $response->user_id = $request->input('user_id');
        $response->save();

        return array('error'=>false, 'response'=>$response);
    }

    //getting the messages for a particular user
    public function getResponseByMessage($id)
    {
        $response = Message::find($id)->response;
        /*foreach ($messages as $message) {
            $message['responsecount'] = count($message->responses);
            unset($message->responses);
        }*/
        return array('error' => false, 'response' => $response);
    }
}
