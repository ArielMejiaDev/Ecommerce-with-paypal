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

Route::resource('checkout', 'CheckoutController');

Route::get('/status', 'StatusController@index')->name('status');

// Route::get('status', function () {
//     return redirect()->route('home')->with('status', 'successful payment');
// })->name('status');
