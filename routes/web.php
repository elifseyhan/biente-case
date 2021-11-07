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
Route::get('/save-products', 'App\Http\Controllers\ProductsController@saveProducts');
Route::get('/send-products', 'App\Http\Controllers\ProductsController@sendProducts');
Route::get('/products-with-user', 'App\Http\Controllers\ProductsController@index');