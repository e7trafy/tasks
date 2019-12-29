<?php

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


Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/', 'TaskController@index')->name('tasks.index');
    Route::post('complete/{task}', 'TaskController@complete')->name('task.complete');
    Route::post('store', 'TaskController@store')->name('task.store');



    //Route::resource('/', 'TaskController');
    Route::get('users/search', 'UsersController@search')->name('users.search');
});
