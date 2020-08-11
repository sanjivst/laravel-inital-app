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

Route::group(['middleware' => ['web', 'auth','checkScope:Admin'], 'prefix' => 'admin', 'namespace' => 'Access\Page'], function()
{
    Route::resource('pages', 'PageController');
    
});
Route::group(['namespace' => 'Access\Page'], function() 
{
    Route::get('{url}/page', 'PageController@display');
});
