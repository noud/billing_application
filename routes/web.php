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
Route::get('/company','HomeController@company');
Route::get('/settings','HomeController@settings');
Route::get('/area','HomeController@area');
Route::get('/allbill','HomeController@allbill');

// product route

Route::post('/add/product','HomeController@add_product');
Route::get('product/edit','HomeController@editproduct');
Route::post('product/update','HomeController@updateproduct');
Route::post('product/delete','HomeController@deleteproduct');

// Customer Route
Route::post('/add/customer','HomeController@add_customer');
Route::get('customer/edit','HomeController@editcustomer');
Route::post('customer/update','HomeController@updatecustomer');
Route::post('customer/delete','HomeController@deletecustomer');

Route::post('product/find','HomeController@findproduct');
Route::get('add/invoice','HomeController@addinvoice');

Route::post('/add/area','HomeController@add_area');

// bill edit

Route::get('/edit/bill/{item}','HomeController@editbill');
// Route::get('/print/{invo_detai}','HomeController@print');


// Route::get('update/invoice','HomeController@updateinvoice');

// graph
Route::get('/graph','Homecontroller@graph');
Route::get('/activity_graph','Homecontroller@activity_graph');
Route::get('/tax_graph','Homecontroller@tax_graph');
Route::get('/add/company','Homecontroller@add_company');

