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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify'=>true]);


    Route::get('/', 'HomeController@index')->name('home')->prefix('admin')->middleware('verified');
    route::group(['middleware'=>'auth:web','prefix'=>'admin','namespace'=>'Admin'],function(){
    Route::resource('products','ProductController');
    Route::resource('customers','CustomerController');

});
Route::get('redirect/{service}','Admin\SocialController@redirect');
Route::get('callback/{service}','Admin\SocialController@callback');
