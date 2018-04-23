<?php
namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\User;
use App\Message;
use App\Response;

use Hash;

class UserController extends Controller
{
    /**
     * @index - load the web users page
     * @param request 
     * @return (mixed) - JSON,Redirect
     */
    public function index(){
        $users=DB::table('users')->simplePaginate(10);
        return view('users')->with([
            'users'=>$users
        ]);
    }

    /**
     * @create - registers new users
     * @param request 
     * @return (mixed) - JSON,Redirect
     */
    public function create(Request $request)
    {
         //creating a validator
         $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users',
            'password' => 'required|confirmed',
            'email' => 'required|unique:users',
            'fullname' => 'nullable|string',
            'type' => 'nullable|string',
            'address' => 'nullable|string'
         ]);

        //if validation fails
         if ($validator->fails()) {
            $msg=array(
                 'status' => 'bad',
                 'error' => true,
                 'msg' => $validator->errors()->all()
             );

             //check whether request is via the web portal and display proper message
             if($request->web_access){
                return view('status')->with([
                    'message'=>json_encode($msg),
                    'back_page'=>'users'
                ]);
            }

            return $msg;
         }

        //creating a new user
         $user = new User([
             'username'=>$request->username,
             'email'=>$request->email,
             'password'=>bcrypt(($request->password)),
             'fullname'=>($request->fullname) ? $request->fullname : null,
             'type'=>(($request->type) ? $request->type : 'standard'),
             'address'=>($request->address) ? $request->address : null,
         ]);


         if($user->save()){
             $msg="{status:'ok','error':false,msg:'User successfully registered',user_id:'{$user->id}'}";
         }
         else{
             $msg="{status:'bad','error':true,msg:'User registration failed due to an internal error'}";
         }

         if($request->web_access){
             return view('status')->with([
                 'message'=>$msg,
                 'back_page'=>'users'
             ]);
         }

         return $msg; //for all api calls

    }

    /**
     * @login - authenticates users
     * @param request 
     * @return (mixed) - JSON,Redirect
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ]);

    

        if ($validator->fails()) {
            $msg=array(
                'status' => 'bad',
                'msg' => $validator->errors()->all()
            );

            if($request->web_access){
                \Session::flash('login-error',json_encode($msg));
                return back();
            }

            return $msg;
        }

        $user = User::where('username', $request->input('username'))->first();
        if($user){
            if (Hash::check($request->password,$user->password)){
                unset($user->password);
                $msg=array('status' => 'ok','msg'=>"User successfully authenticated",'user' => $user);

                if($request->web_access){
                   session(['username'=>$user->username]);
                   return redirect('dashboard');
                }

            }
            else{
                $msg=array('status' => 'bad', 'msg' => 'Invalid password');
            }
        } 
        else {
            $msg=array('status' => 'bad', 'msg' => 'User not exist');
        }

        if($request->web_access){
            \Session::flash('login-error',json_encode($msg));
            return back();
        }
        return $msg;
    }

    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'id'=>'required',
            'type'=>'required',
        ]);

        if($validator->fails()){
            $msg=array(
                'status'=>'bad',
                'error' => true,
                'msg' => $validator->errors()->all()
            );

            return view('status')->with([
                'message'=>json_encode($msg),
                'back_page'=>'users'
            ]);
        }

        $user=user::find($request->id);
        if($user){
            $count=$user->update([
                'type'=>$request->type,
            ]);

            $msg=($count>0) ? array('status'=>'ok','error' => false,'msg' =>'User successfully updated') 
                            : array('status'=>'bad','error' => true,'msg' =>'User could not be successfully update');
        }
        else{
            $msg=array('status'=>'bad','error' => true,'msg' =>'User could not be found using that ID');
        }

        return view('status')->with([
            'message'=>json_encode($msg),
            'back_page'=>'users'
        ]);
    }

    public function updatePassword(Request $request){
        $validator = Validator::make($request->all(), [
            'password'=>'required|confirmed',
            'old_password'=>'required',
        ]);

        if($validator->fails()){
            $msg=array(
                'status'=>'bad',
                'error' => true,
                'msg' => $validator->errors()->all()
            );

            return view('status')->with([
                'message'=>json_encode($msg),
                'back_page'=>'users'
            ]);
        }

        $user=user::where('username',session('username'))->first();
        
        if($user){
            if(Hash::check($request->old_password,$user->password)){
                $count=$user->update([
                    'password'=>bcrypt($request->password),
                ]);
                $msg=($count>0) ? array('status'=>'ok','error' => false,'msg' =>'Password successfully updated') 
                            : array('status'=>'bad','error' => true,'msg' =>'Password could not be successfully update');
            }
            else{
                $msg=array('status'=>'bad','error' => true,'msg' =>'Your old password could not be confirmed');
            }
           
        }
        else{
            $msg=array('status'=>'bad','error' => true,'msg' =>'User could not be found using that ID');
        }

        return view('status')->with([
            'message'=>json_encode($msg),
            'back_page'=>'dashboard'
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
                'back_page'=>'users'
            ]);
        }

        $user=User::find($request->id);
        if($user){
            $msg=($user->delete()) ? array('status'=>'ok','error' => false,'msg' =>'User successfully deleted') 
                            : array('status'=>'bad','error' => true,'msg' =>'User could not be successfully deleted');
        }
        else{
            $msg=array('status'=>'bad','error' => true,'msg' =>'User could not be found using that ID');
        }

        return view('status')->with([
            'message'=>json_encode($msg),
            'back_page'=>'users'
        ]);
    }
    
    public function downloadAPK(){
        $file=public_path().'/app.apk';
        $headers=array('Content-Type:application/apk');

        return response()->download($file,'EmergencyApp.apk',$headers);
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
