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

Route::get('/', function () {
    return redirect(route('web.home', [App::getLocale()]));
});




Route::prefix('{lang}')->namespace('Website')->name('web.')->middleware('locale')->group(function () {

    Route::get('/', 'HomeController@index')->name('home');

    Route::get('auth', 'AuthController@index')->name('auth');
    Route::post('auth', 'AuthController@login')->name('auths');
    Route::post('register', 'AuthController@register')->name('register');


    Route::resource('cart', 'CartController');
    Route::post('addToCart', 'CartController@store')->name('addToCart');
    Route::get('increaseCartQuantity/{id}', 'CartController@increase')->name('increaseQuantity');
    Route::get('decreaseCartQuantity/{id}', 'CartController@decrease')->name('decreaseQuantity');
    Route::get('deleteCartItem/{id}', 'CartController@delete')->name('deleteCartItem');

    Route::resource('payment', 'PaymentController');
    Route::resource('categories', 'CategoryController');
    Route::resource('subcategories', 'SubCategoryController');
    Route::resource('subsubcategories', 'SubSubCategoryController');
    Route::resource('confirm-address', 'CityController');
    Route::resource('contacts', 'ContactController');
    Route::resource('orders', 'OrderController');
    Route::resource('policies', 'PolicyController');
    Route::resource('terms', 'TermsController');
    Route::resource('questions', 'QuestionController');
    Route::resource('sales', 'SaleController');

    Route::get('products/{id}/details', 'ProductController@details')->name('products.details');
    Route::resource('products', 'ProductController');
    Route::get('products/{id}/{type}', 'ProductController@show')->name('product.show');




    Route::resource('favourites', 'FavouriteController');


});