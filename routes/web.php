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

Route::get('/', 'PagesController@welcome');
Route::post('/market', 'PagesController@market');
Route::get('/about', 'PagesController@about');
Route::get('/privacy', 'PagesController@privacy');
Route::get('/faqs', 'PagesController@faqs');

Route::get('/tradesatoshi', 'TradesatoshiController@getMarketHistory');
Route::get('/cryptopia', 'CryptopiaController@getMarketHistory');
