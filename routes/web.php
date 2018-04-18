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
	return view('welcome');
});

Route::post('register','UserController@create');
Route::post('login', 'UserController@login');

Route::get('users', 'UserController@getUsers');
Route::post('create-message', 'MessageController@create');

Route::get('messages', 'MessageController@getAll');
Route::post('submit', 'ResponseController@submit');


Route::get('messages/{message_id}/response', 'ResponseController@getResponseByMessage');


Route::get('messages/{message_id}/coordinates', 'MessageController@getMessageCoordinates');

Route::get('messages/{station_id}', 'MessageController@getByStation');

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
