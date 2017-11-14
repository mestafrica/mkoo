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
Route::get('/', ['as' => 'login', 'uses' => 'AuthController@login']);
Route::get('/login', ['as' => 'login', 'uses' => 'AuthController@login']);
Route::post('/logout', ['as' => 'logout', 'uses' => 'AuthController@logout']);

Route::group(['prefix' => 'auth'], function(){
    Route::get('google', ['as' => 'auth.google', 'uses' => 'AuthController@redirectToProvider']);
    Route::get('google/callback', ['uses' => 'AuthController@handleProviderCallback']);
    Route::post('/login', ['as'=>'auth.login', 'uses' => 'AuthController@handleCustomLogin']);
});

Route::group(['prefix' => 'dashboard', 'middleware' => ['auth']], function () {
    Route::get('', ['as' => 'home', 'uses' => 'DashboardController@index']);
    Route::resource('meals', 'MealsController');
    Route::resource('orders', 'OrdersController');
    Route::resource('menu', 'MenuController');

    //email/password registration 
    Route::get('/users', ['as'=>'auth.users', 'uses'=> 'AuthController@users']);
    Route::get('/users/register', ['as'=> 'auth.users.create', 'uses'=> 'AuthController@register']);
    Route::post('/users/register', ['as'=> 'auth.users.store', 'uses'=> 'AuthController@store']);
});