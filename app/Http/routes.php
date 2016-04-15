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



// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::post('auth/logout', 'Auth\AuthController@postLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');
Route::get('/', 'IndexController@getIndex');
Route::get('posterorders', 'IndexController@getPosterOrders');
Route::get('yourroutes', 'IndexController@getYourRoutes');
Route::get('yourorders', 'IndexController@getDriverOrders');
Route::get('users', 'IndexController@getUsers');
Route::get('routs', 'IndexController@getRoutes');
Route::get('about', 'IndexController@getAbout');

Route::post('placeOrder','IndexController@postPlaceOrder');
Route::post('cancelOrder','IndexController@postCancelOrder');
Route::post('ModifyYourRoute','IndexController@postModifyDriverRoutes');
Route::post('DeleteYourRoute','IndexController@postDeleteDriverRoutes');
Route::post('AddRoute','IndexController@postAddDriverRoutes');
Route::post('RejectOrder','IndexController@postRejectOrder');
Route::post('StartOrder','IndexController@postStartOrder');
Route::post('EndOrder','IndexController@postEndOrder');
Route::post('ModifyUser','IndexController@postAdminModifyUser');
Route::post('DeleteUser','IndexController@postDeleteUser');
Route::post('CreateUser','IndexController@postAdminAddUser');
Route::post('ModifyRoute','IndexController@postAdminModifyRoute');
Route::post('DeleteRoute','IndexController@postAdminDeleteRoute');
Route::post('CreateRoute','IndexController@postAddRoute');

