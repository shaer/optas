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

Route::get('configurations/users/usergroups/roles/{id?}', 
        'Management\UserGroupController@roles')->name('showRoles');;
Route::post('configurations/users/usergroups/roles/{id?}', 
        'Management\UserGroupController@editRoles')->name('updateGroupRoles');;
Route::resource('configurations/connections','Management\ConnectionController', ['except' => [
    'create', 'edit'
]]);
Route::resource('configurations/users/usergroups','Management\UserGroupController', ['except' => [
    'create', 'edit'
]]);
Route::resource('configurations/users/roles','Management\RoleController', ['except' => [
    'create', 'edit'
]]);
Route::resource('configurations/users','Management\UserController', ['except' => [
    'create', 'edit'
]]);

Route::get('/home', 'HomeController@index');
