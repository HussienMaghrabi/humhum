<?php

use Illuminate\Http\Request;

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

Route::middleware('apiLocale')->namespace('Api')->group(function () {

    Route::post('social-login', 'AuthController@social');
    Route::post('email-verification', 'AuthController@email');
    Route::post('phone-verification', 'AuthController@phone');
    Route::post('reset-password', 'AuthController@resetPassword');
    Route::post('change-password', 'AuthController@changePassword');


    Route::resource('home', 'HomeController');
    Route::resource('banners', 'BannerController');
    Route::resource('question', 'QuestionController');
    Route::resource('settings', 'SettingController');
    Route::resource('categories', 'CategoryController');
    Route::resource('subcategories', 'SubCategoryController');
    Route::resource('subsubcategories', 'SubSubCategoryController');
    Route::resource('complaints', 'ComplaintController');
    Route::resource('contacts', 'ContactController');
    Route::resource('products', 'ProductController');
    Route::resource('products-view', 'ProductViewController');
    Route::resource('products-sell', 'ProductSellController');
    Route::resource('offer', 'OfferController');
    Route::resource('cites', 'CityController');
    Route::resource('regions', 'RegionController');
    Route::resource('stores', 'StoreController');
    Route::resource('suggestions', 'SuggestionController');

});