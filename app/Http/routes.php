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


Route::get('/', function () {
    return view('tasks');
});

Route::group(['prefix' => 'api'], function () {
	Route::get('/', function () {
		return response()->json('hi');
	});

	Route::get('tasks', 'TaskController@index');
	Route::post('tasks', 'TaskController@store');
	Route::get('tasks/{id}', 'TaskController@show');
	Route::put('tasks/{id}', 'TaskController@update');

});
