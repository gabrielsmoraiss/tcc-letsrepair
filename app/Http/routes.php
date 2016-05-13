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

//Route::get('/', function () { return view('index'); });

Route::group(['middleware' => 'admin.auth'], function () {
    //Pessoas
    //Route::resource('users', 'UserController');

	//index
    Route::get('/logout', ['as' => 'admin.logout', 'uses' => 'AdminController@logout']);
	Route::get('/', ['as' => 'index', 'uses' => 'AdminController@index']);
});

//Login Admin
Route::group(['as' => 'admin.'], function () {
    Route::get('/login', ['as' => 'login', 'uses' => 'AdminController@login']);
    Route::post('/login', ['as' => 'authenticate', 'uses' => 'AdminController@authenticate']);
});
