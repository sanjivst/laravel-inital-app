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


Route::group(
    ['middleware' => ['web', 'auth', 'checkScope:Admin'], 'prefix' => 'admin', 'namespace' => 'Access\User'], function()
{
    Route::resource('users', 'UserController');
    Route::resource('scopes', 'ScopeController');
});

Route::group(
    ['middleware' => ['web'], 'namespace' => 'Access\User'], function()
{
    Route::resource('guests', 'GuestController');  
    Route::post('password-change/{id}', 'GuestController@changePassword');  
});