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

use App\Task;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('tasks');
});

Route::group(['prefix' => 'api'], function () {
	Route::get('/tasks', function () {
		$tasks = Task::get();
		return response()->json($tasks);
	});

	Route::post('/tasks', function (Request $request) {
		$validator = Validator::make($request->all(), [
			'name' => 'required | max:255',
		]);

		if ($validator->fails()) {
			return response()->json($validator->messages(),400);
		}

		$task = new Task();
		$task->name = $request->name;
		$task->save();

		return response()->json($task);
	});
});
