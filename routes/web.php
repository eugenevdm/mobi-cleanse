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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::post('/upload','FileController@upload');

Route::resource('/phone_numbers','PhoneNumbersController');

Route::post('/phone_numbers', 'PhoneNumbersController@test');

Route::get('/check/{number}', 'PhoneNumbersController@api');

Route::get('/download', 'PhoneNumbersController@download');