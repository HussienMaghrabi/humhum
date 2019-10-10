<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('apiLocale')->namespace('Api\User')->group(function ()
{
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@register');

    Route::middleware('api:apiUser')->group(function ()
    {

        Route::get('profile', 'UpdateController@index');
        Route::any('profile-update', 'UpdateController@update');


        Route::resource('orders', 'OrderController');
        Route::resource('cart', 'CartController');
        Route::resource('favorites', 'FavoriteController');
    });
});
