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

Route::get('/homw', function () {
    return view('welcome');
});

Route::get('/', 'HomePageController@index')->name('home.index');
Route::get('/shop', 'ShopPageController@index')->name('shop.index');
Route::get('/shop/{product}', 'ShopPageController@show')->name('shop.show');
Route::view('/product', 'partials.product');
Route::view('/cart', 'partials.cart');
Route::view('/checkout', 'checkout');
Route::view('/thankyou', 'thankyou');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
