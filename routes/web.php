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

// Route::get('/connections', 'Management\ConnectionController@index');
// Route::post('/connections', 'Management\ConnectionController@add')->name("addConnection");
// Route::patch('/connections/{connection}', 'Management\ConnectionController@update')->name("updateConnection");
// Route::get('/connection/{connection}', 'Management\ConnectionController@getConnection');

Route::get('/usergroups/roles/{id?}', 'Management\UserGroupController@roles');
Route::post('/usergroups/roles/{id?}', 'Management\UserGroupController@editRoles');
Route::resource('connections','Management\ConnectionController', ['except' => [
    'create', 'edit'
]]);
Route::resource('usergroups','Management\UserGroupController', ['except' => [
    'create', 'edit'
]]);
#Route::get('/usergroups/roles', 'Management\UserGroupController@allRoles');

Route::get('/home', 'HomeController@index');
