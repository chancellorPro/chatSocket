<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

Route::auth();
Route::get('/home', 'HomeController@index');

Route::get('/', 'ChatController@index');
Route::post('/', 'ChatController@store');
Route::get('/chat', ['as' => 'chat', 'uses' => 'ChatController@index']);
Route::post('/chat', ['as' => 'chat', 'uses' => 'ChatController@store']);

Route::get('/userban/{user_id}', ['as' => 'userban', 'uses' => 'ChatController@userban']);
Route::get('/unban/{user_id}', ['as' => 'userban', 'uses' => 'ChatController@unban']);
//$router->resource('/chat', 'ChatController');
