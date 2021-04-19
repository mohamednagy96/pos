<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// define('PAGINATION_COUNT',10);



Auth::routes();


    Route::get('/', 'HomeController@index')->name('home')->prefix('admin')->middleware('verified');
    route::group(['middleware'=>'auth:web','prefix'=>'admin','namespace'=>'Admin'],function(){
    Route::resource('products','ProductController');
    Route::get('/cart', 'CartController@index')->name('cart.index');
    Route::post('/cart', 'CartController@store')->name('cart.store');
    Route::post('/cart/change-qty', 'CartController@changeQty');
    Route::delete('/cart/delete', 'CartController@delete');
    Route::delete('/cart/empty', 'CartController@empty');
    Route::resource('customers','CustomerController');
    Route::resource('orders','OrderController');

    Route::get('/settings', 'SettingController@index')->name('settings.index');
    Route::post('/settings', 'SettingController@store')->name('settings.store');

});
Route::get('redirect/{service}','Admin\SocialController@redirect');
Route::get('callback/{service}','Admin\SocialController@callback');
