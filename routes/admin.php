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

Route::get('/admin', function () {
    return redirect('/ar/dashboard');
});

Route::get('admin/signin', 'Dashboard\LoginController@index')->name('admin.login');
Route::post('admin/signin', 'Dashboard\LoginController@login')->name('admin.login');

Route::prefix('{lang}/dashboard')->namespace('Dashboard')->name('admin.')->middleware(['admin:admin', 'locale'])->group(function () {

    Route::get('/', 'HomeController@index')->name('home');
    Route::post('logout', 'LoginController@logout')->name('logout');

    Route::delete('admins/multiDelete', 'AdminController@multiDelete')->name('admins.multiDelete');
    Route::any('admins/search', 'AdminController@search')->name('admins.search');
    Route::resource('admins', 'AdminController');

    Route::delete('banners/multiDelete', 'BannerController@multiDelete')->name('banners.multiDelete');
    Route::resource('banners', 'BannerController');

    Route::delete('contacts/multiDelete', 'ContactController@multiDelete')->name('contacts.multiDelete');
    Route::any('contacts/search', 'ContactController@search')->name('contacts.search');
    Route::resource('contacts', 'ContactController');

    Route::delete('complaints/multiDelete', 'ComplaintController@multiDelete')->name('complaints.multiDelete');
    Route::any('complaints/search', 'ComplaintController@search')->name('complaints.search');
    Route::resource('complaints', 'ComplaintController');

    Route::delete('categories/multiDelete', 'CategoryController@multiDelete')->name('categories.multiDelete');
    Route::any('categories/search', 'CategoryController@search')->name('categories.search');
    Route::resource('categories', 'CategoryController');

    Route::delete('cities/multiDelete', 'CityController@multiDelete')->name('cities.multiDelete');
    Route::any('cities/search', 'CityController@search')->name('cities.search');
    Route::resource('cities', 'CityController');

    Route::resource('notifications', 'NotificationController');

    Route::delete('offers/multiDelete', 'OfferController@multiDelete')->name('offers.multiDelete');
    Route::any('offers/search', 'OfferController@search')->name('offers.search');
    Route::get('offers/ajax', 'OfferController@ajax')->name('offers.ajax');
    Route::get('offers/ok', 'OfferController@ok')->name('offers.ok');
    Route::get('offers/up', 'OfferController@up')->name('offers.up');
    Route::resource('offers', 'OfferController');

    Route::delete('orders/multiDelete', 'OrderController@multiDelete')->name('orders.multiDelete');
    Route::any('orders/search', 'OrderController@search')->name('orders.search');
    Route::resource('orders', 'OrderController');

    Route::delete('product/multiDelete', 'ProductController@multiDelete')->name('product.multiDelete');
    Route::any('product/search', 'ProductController@search')->name('product.search');
    Route::resource('product', 'ProductController');

    Route::delete('requestProducts/multiDelete', 'RequestProductController@multiDelete')->name('requestProducts.multiDelete');
    Route::any('requestProducts/search', 'RequestProductController@search')->name('requestProducts.search');
    Route::resource('requestProducts', 'RequestProductController');

    Route::prefix('{product}')->group(function ()
    {
        Route::delete('productImages/multiDelete', 'ProductImageController@multiDelete')->name('productImages.multiDelete');
        Route::resource('productImages', 'ProductImageController');
    });

    Route::delete('questions/multiDelete', 'QuestionController@multiDelete')->name('questions.multiDelete');
    Route::any('questions/search', 'QuestionController@search')->name('questions.search');
    Route::resource('questions', 'QuestionController');

    Route::delete('users/multiDelete', 'UserController@multiDelete')->name('users.multiDelete');
    Route::any('users/search', 'UserController@search')->name('users.search');
    Route::resource('users', 'UserController');


    Route::delete('subcategories/multiDelete', 'SubCategoryController@multiDelete')->name('subcategories.multiDelete');
    Route::any('subcategories/search', 'SubCategoryController@search')->name('subcategories.search');
    Route::resource('subcategories', 'SubCategoryController');

    Route::delete('sub2categories/multiDelete', 'SubSubCategoryController@multiDelete')->name('sub2categories.multiDelete');
    Route::any('sub2categories/search', 'SubSubCategoryController@search')->name('sub2categories.search');
    Route::get('sub2categories/ajax', 'SubSubCategoryController@ajax')->name('sub2categories.ajax');
    Route::resource('sub2categories', 'SubSubCategoryController');

    Route::delete('status/multiDelete', 'StatusController@multiDelete')->name('status.multiDelete');
    Route::any('status/search', 'StatusController@search')->name('status.search');
    Route::resource('status', 'StatusController');

    Route::resource('settings', 'SettingController');

    Route::delete('vendors/multiDelete', 'VendorController@multiDelete')->name('vendors.multiDelete');
    Route::any('vendors/search', 'VendorController@search')->name('vendors.search');
    Route::resource('vendors', 'VendorController');



















});
