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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::resource('cart', 'CartController');

Route::resource('checkout', 'CheckoutController');

Route::post('pay', 'PaymentController@store')->name('pay');

Route::get('/status', 'StatusController@index')->name('status');
