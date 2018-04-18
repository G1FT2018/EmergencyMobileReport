<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;


define('USERNAME','giftngomano');
define('PASSWORD','12345678');
class Authenticate
{
           public function handle($request, Closure $next)
           {
//getting values from headers
//if the user is authenticated accepting the request
    if($request->header('PHP_AUTH_USER') == USERNAME && $request->header('PHP_AUTH_PW') == PASSWORD){
        return $next($request);

//else displaying an unauthorized message
}else{
        $content = array();
        $content['error'] = true;
        $content['message'] = 'Unauthorized Request';
        return response()->json($content, 401);
    }

   }

 }
/*
class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
  /*  public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            return redirect('/home');
        }

        return $next($request);
    }
}

*/
