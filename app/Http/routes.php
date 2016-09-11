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
	Route::get('/admin', ['as' => 'admin.index', 'uses' => 'Admin\AdminController@index']);
	Route::get('/index-admin', ['as' => 'auth.index-admin', 'uses' => 'Admin\AdminController@indexAdmin']);

	Route::get('auth-google/{auth?}', ['as' => 'auth-google', 'uses' => 'Admin\AssistenceController@getGoogleLogin']);
	Route::resource('assistence', 'Admin\AssistenceController');
	
	Route::get('assistences/logout-google', ['as' => 'logout-google', 'uses' => 'Admin\AssistenceController@getGoogleLogout']);

	Route::resource('type-product', 'App\TypeProductController');
	Route::resource('brands-attended', 'App\BrandsAttendedController');

	//Rotas para Assistencia request
	Route::resource('assistence-request', 'Admin\AssistenceRequestController', ['except' => ['create', 'store']]);
});

Route::resource('search-assistence', 'App\AssistenceController', ['except' => ['create', 'store', 'update', 'edit', 'destroy']]);

Route::get('/assistence-solicitation', ['as' => 'assistence-solicitation.create', 'uses' => 'App\AssistenceRequestController@create']);
Route::post('/assistence-solicitation', ['as' => 'assistence-solicitation.store', 'uses' => 'App\AssistenceRequestController@store']);

Route::get('/index', ['as' => 'index', 'uses' => 'Auth\AuthController@index']);
Route::get('/', ['as' => 'index', 'uses' => 'Auth\AuthController@index']);


//Authentication 
Route::get('/login', ['as' => 'auth.login', 'uses' => 'Auth\AuthController@login']);
Route::post('/login', ['as' => 'auth.authenticate', 'uses' => 'Auth\AuthController@authenticate']);

Route::get('/logout', ['as' => 'auth.logout', 'uses' => 'Auth\AuthController@logout']);
