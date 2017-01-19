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
    return view('welcome');
});

Route::get('users/ids', 'UserController@ids');
Route::resource('users', 'UserController', ['only' => ['index', 'store', 'update', 'destroy', 'show', 'ids']]);

Route::get('priorities/ids', 'PriorityController@ids');
Route::resource('priorities', 'PriorityController', ['only' => ['index', 'store', 'update', 'destroy', 'show', 'ids']]);

Route::resource('tasks', 'TaskController', ['only' => ['index', 'store', 'update', 'destroy', 'show']]);


