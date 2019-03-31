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

Route::get('/', 'ProductController@products');
Route::get('/product/detail/{id}', 'ProductController@detail');

/* route cart */
Route::get('/cart', 'CartController@carts');
Route::get('/cart/add/{product_id}', 'CartController@add');
Route::post('/cart/update', 'CartController@update');
Route::get('/cart/clear', 'CartController@clear');
Route::get('/cart/checkout', 'CartController@checkout');
Route::get('/cart/remove/{product_id}', 'CartController@remove');