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

Route::get('configurations/users/usergroups/roles/{id?}', 
        'Management\UserGroupController@roles')->name('showRoles')
        ->middleware(['auth', 'hasrole:view_assigned_roles_to_usergroups']);
Route::post('configurations/users/usergroups/roles/{id?}', 
        'Management\UserGroupController@editRoles')->name('updateGroupRoles')
        ->middleware(['auth', 'hasrole:assign_roles_to_usergroups']);

Route::get('/jobs/manage', 'JobController@manage')->middleware(['auth', 'hasrole:add_jobs']);

Route::group(['middleware' => ['auth', 'hasrole']], function() {
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
    
    Route::resource('jobs','JobController', ['except' => [
        'create', 'edit'
    ]]);
});




Route::group(['prefix' => 'app/jobs'], function () {
    Route::get('list_jobs.html', function () {
        return View::make('jobs.list');
    });
    
    Route::get('add_form.html', function () {
        return View::make('jobs.add_form');
    });
    
    Route::get('actions/database.html', function () {
        return View::make('jobs.actions.database');
    });
    
    Route::get('partials/actions.html', function () {
        return View::make('jobs.forms.actions');
    });

    Route::get('partials/scheduler.html', function () {
        return View::make('jobs.forms.scheduler');
    });
});


Route::get('/home', 'HomeController@index');
Route::get('/dbtest', 'HomeController@dbtest');
