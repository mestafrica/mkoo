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
Route::get('/', ['as' => 'login', 'uses' => 'Auth\PasswordLoginController@showLoginForm']);
Route::get('login', ['as' => 'login', 'uses' => 'Auth\PasswordLoginController@showLoginForm']);
Route::post('login', ['as' => 'login', 'uses' => 'Auth\PasswordLoginController@login']);
Route::post('logout', ['as' => 'logout', 'uses' => 'Auth\PasswordLoginController@logout']);
Route::post('password/email', ['as' => 'password.email', 'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail']);
Route::get('password/reset', ['as' => 'password.request', 'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm']);
Route::post('password/reset', ['uses' => 'Auth\ResetPasswordController@reset']);
Route::get('password/reset/{token}', ['as' => 'password.reset', 'uses' => 'Auth\ResetPasswordController@showResetForm']);

Route::group(['prefix' => 'auth'], function(){
    Route::get('google', ['as' => 'auth.google', 'uses' => 'Auth\GoogleAuthController@redirectToProvider']);
    Route::get('google/callback', ['uses' => 'Auth\GoogleAuthController@handleProviderCallback']);
});

Route::group(['prefix' => 'dashboard', 'middleware' => ['auth']], function () {
    Route::get('', ['as' => 'home', 'uses' => 'DashboardController@index']);
    Route::resource('meals', 'MealsController');
    Route::resource('orders', 'OrdersController');
    Route::resource('menu', 'MenuController');
    Route::resource('users', 'UsersController');
    Route::resource('items', 'ItemsController');
});