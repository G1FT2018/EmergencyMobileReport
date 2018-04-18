<?php
namespace App\Http\Controllers;

use Illuminate\Hashing\BcryptHasher;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\User;
use App\Message;
use App\Response;


class UserController extends Controller
{

    //this function is used to register a new user
    public function create(Request $request)
    {
         //creating a validator
         $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users',
            'password' => 'required',
             'email' => 'required|unique:users'
         ]);

        // //if validation fails
         if ($validator->fails()) {
            return array(
                 'error' => true,
                 'message' => $validator->errors()->all()
             );
         }

        // //creating a new user
         $user = new User();

         //adding values to the users
         $user->username = $request->username;
         $user->email = $request->email;
         $user->password = (new BcryptHasher)->make($request->password);

         //saving the user to database
        $user->save();

         //unsetting the password so that it will not be returned
       unset($user->password);

        /*returning the registered user
        Log::info($request->all());*/
        return array('error' => false, 'user' => $request->all()); 
    }

    //function for user login
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return array(
                'error' => true,
                'message' => $validator->errors()->all()
            );
        }

        $user = User::where('username', $request->input('username'))->first();

        if (count($user)) {
            if (password_verify($request->input('password'), $user->password)) {
                unset($user->password);
                return array('error' => false, 'user' => $user);
            } else {
                return array('error' => true, 'message' => 'Invalid password');
            }
        } else {
            return array('error' => true, 'message' => 'User not exist');
        }
    }

    //getting the messages for a particular user
    public function getResponses($id)
    {
        $responses = Message::find($id)->responses;
        /*foreach ($messages as $message) {
            $message['responsecount'] = count($message->responses);
            unset($message->responses);
        }*/
        return array('error' => false, 'responses' => $responses);
    }

    public function getUsers() {
        return User::all();
    }
}

?>
