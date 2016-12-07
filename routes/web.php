<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'HomeController@index');

Auth::routes();

//User features
Route::group(['namespace' => 'Web', 'middleware' => 'auth'], function () {
    Route::resource('users', 'UsersController', ['only'=> [
        'show', 'update', 'edit',
    ]]);
});
