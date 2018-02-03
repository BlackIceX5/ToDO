<?php

use App\todo;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Main View
	Route::get('/', 'IndexController@index');

// ADD TODO (AJAX URL)
	Route::post('addTodo','indexController@storePost');

// DELETE TODO
	Route::delete('delete/{todo}', function(\App\todo $todo) {
	
		$todo->delete();
		return redirect('/');
	
	})->name('deleteTodo');

// Perform the TODO (AJAX URL)
	Route::post('chStateTodo','indexController@statePost');
	
// Edit TODO (AJAX URL)
	Route::post('editTodo','indexController@editPost');