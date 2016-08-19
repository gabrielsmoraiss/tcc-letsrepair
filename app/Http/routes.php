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
Route::group(['middleware' => 'auth'], function () {
    //Route::resource('users', 'UserController');

	//index
	Route::get('/admin', ['as' => 'admin.index', 'uses' => 'AdminController@index']);
	Route::get('/index-admin', ['as' => 'admin.index-admin', 'uses' => 'AdminController@indexAdmin']);
	//Route::get('/assistence', ['as' => 'admin.assistence', 'uses' => 'App\AssistenceController@index']);
	Route::get('auth-google/{auth?}', ['as' => 'auth-google', 'uses' => 'App\AssistenceController@getGoogleLogin']);
	Route::resource('assistence', 'App\AssistenceController');
	
	Route::get('assistences/logout-google', ['as' => 'logout-google', 'uses' => 'App\AssistenceController@getGoogleLogout']);

	Route::resource('type-product', 'App\TypeProductController');
	Route::resource('brands-attended', 'App\BrandsAttendedController');

});

Route::get('/', ['as' => 'index', 'uses' => 'Auth\AuthController@index']);


//Authentication 
Route::get('/login', ['as' => 'auth.login', 'uses' => 'Auth\AuthController@login']);
Route::post('/login', ['as' => 'auth.authenticate', 'uses' => 'Auth\AuthController@authenticate']);

Route::get('/logout', ['as' => 'auth.logout', 'uses' => 'Auth\AuthController@logout']);
