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


Auth::routes();

Route::get('/', 'HomeController@index');

Route::get('/connections', 'Management\ConnectionController@index');
Route::post('/connections', 'Management\ConnectionController@add')->name("addConnection");
Route::patch('/connections', 'Management\ConnectionController@update')->name("updateConnection");

Route::get('/home', 'HomeController@index');
