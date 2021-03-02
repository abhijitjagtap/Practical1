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


Route::get('/', 'OrderSystemController@index');
Route::get('/order/getmodal', 'OrderSystemController@getmodal');
Route::post('/order/updateItem', 'OrderSystemController@updateItem');
Route::resource('order', 'OrderSystemController');
