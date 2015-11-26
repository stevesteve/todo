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

Route::filter('cache.fetch', function ($route, $request) {
	$key = $request->url();
	if (Cache::has($key)) return Cache::get($key);
});
Route::filter('cache.put', function ($route, $request, $response) {
	$key = $request->url();
	if (!Cache::has($key)) Cache::put($key, $response->getContent(), 60);
});


Route::get('/', function () {
    return view('tasks');
})->before('cache.fetch')->after('cache.put');

Route::group(['prefix' => 'api'], function () {
	Route::get('/', function () {
		return response()->json('hi');
	});

	Route::get('tasks', 'TaskController@index');
	Route::post('tasks', 'TaskController@store');
	Route::get('tasks/{id}', 'TaskController@show');
	Route::put('tasks/{id}', 'TaskController@update');
	Route::delete('tasks/{id}', 'TaskController@destroy');

	Route::get('lists', 'ListController@index');
	Route::post('lists', 'ListController@store');
	Route::get('lists/{id}', 'ListController@show');
	Route::delete('lists/{id}', 'ListController@destroy');

});
