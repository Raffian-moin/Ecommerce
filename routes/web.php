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

Route::get('/des', function () {
    Cart::destroy();
});

Route::get('/destroy', function () {
    Cart::instance('saveForLater')->destroy();
});

Route::get('/', 'HomePageController@index')->name('home.index');
Route::get('/shop', 'ShopPageController@index')->name('shop.index');
Route::get('/shop/{product}', 'ShopPageController@show')->name('shop.show');
Route::get('/cart', 'CartPageController@index')->name('cart.index');
Route::post('/cart', 'CartPageController@store')->name('cart.store');
Route::delete('/cart/{product}', 'CartPageController@destroy')->name('cart.delete');
Route::post('/cart/saveForLater/{product}', 'CartPageController@saveForLater')->name('cart.saveForLater');
Route::delete('/saveForLater/{product}', 'saveForLaterPageController@destroy')->name('saveForLater.delete');
Route::post('/saveForLater/switchToCart/{product}', 'saveForLaterPageController@switchToCart')->name('saveForLater.switchToCart');


/*Route::view('/product', 'partials.product');
Route::view('/cart', 'partials.cart');
Route::view('/checkout', 'checkout');
Route::view('/thankyou', 'thankyou');
*/
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
