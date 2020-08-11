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

Route::group(['prefix'=>'admin','middleware' => ['web', 'auth','checkScope:Admin']], function () {
    Route::resource('setup', 'Access\Setting\SetupController');

});
