<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

// $app->get('/', function () use ($app) {
//     return $app->version();
// });

Route::get('/',function(){
	return view('index');
});
Route::get('dashboard',function(){
	return view('dashboard')->with([
		'alerts'=>\App\Message::unresponded()
	]);
});



//Auth && user routes
Route::get('login',function(){
	return view('login');
});
Route::get('users', 'UserController@index');
Route::post('users/update', 'UserController@update');
Route::post('users/delete', 'UserController@delete');
Route::post('users/update-password', 'UserController@updatePassword');
Route::post('register','UserController@create');
Route::post('login', 'UserController@login');
Route::get('logout',function(){
	session(['username'=>null]);
	return redirect('login');
});
Route::get('create-default-user','UserController@create');

/**
 * Station routes
 */
Route::get('stations', 'StationController@index');
Route::post('stations/create','StationController@create');
Route::post('stations/update','StationController@update');
Route::post('stations/delete','StationController@delete');

/**
 * Message Routes
 */
Route::get('messages','MessageController@index');
Route::post('messages/post','MessageController@create');
Route::post('messages/post','MessageController@create');
Route::get('messages/view/{id}','MessageController@view');


/**
 * Emergency Unit routes
 */
Route::get('emergency-unit','ResponseController@emergencyWatch');
Route::get('emergency-listen/{upperBound}','MessageController@realTime');
Route::get('map-view/{lat}/{long}',function($lat,$long){
	return view('map-view')->with([
		'lat'=>$lat,
		'long'=>$long
	]);
});

Route::get('reports',function(){
	return view('status')->with([
		'message'=>'feature under development',
		'back_page'=>'dashboard'
	]);
});

Route::get('download-apk','UserController@downloadAPK');

