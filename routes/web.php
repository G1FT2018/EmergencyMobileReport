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

/**
 * To be removed
 */

 
/*Route::get('messages', 'MessageController@getAll');
Route::post('submit', 'ResponseController@submit');
Route::post('create-message', 'MessageController@create');


Route::get('messages/{message_id}/response', 'ResponseController@getResponseByMessage');


Route::get('messages/{message_id}/coordinates', 'MessageController@getMessageCoordinates');

Route::get('messages/{station_id}', 'MessageController@getByStation');
*/
//Route::post('submitmessage', 'MessageController@submit');

//Route::get('messages/{message_id}', 'MessageController@getMessage'); //used by station

/***
 * The first parameter 'createuser' it is the url address
 * So to call this we will use the URL as BASE URL + createuser
 *
 * The second parameter is [email protected]
 * it means we are calling create function which is inside UserController
 *
 * Using the same for all routes
 ***/
//Route::post('createuser', '[email protected]');
// $app->post('submitresponse', '[email protected]');
// $app->post('userlogin', '[email protected]');
// $app->post('createstation', '[email protected]');
// $app->get('stations', '[email protected]');
// $app->get('getmymessages/{user_id}', '[email protected]');
// $app->get('messages', '[email protected]');
// $app->get('messages/{station_id}', '[email protected]');
