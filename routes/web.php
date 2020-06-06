<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes([
    'register' =>false
]);

Route::get('/home', 'HomeController@index')->name('home');



Route::get('/home', 'HomeController@index')->middleware('auth');
Route::any('/stocks','HomeController@stocks');
Route::get('/customer','HomeController@customer');
Route::get('/bill','HomeController@bill');

// product route

Route::post('/add/product','HomeController@add_product');
Route::get('product/edit','HomeController@editproduct');
Route::post('product/update','HomeController@updateproduct');
Route::post('product/delete','HomeController@deleteproduct');
