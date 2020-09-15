<?php

Route::group(['middleware'=>['web','auth','checkScope:Admin'],'namespace'=>'Access\Theme','prefix'=>'admin'],function () {
    Route::resource('themes', 'ThemeController');
    Route::post('theme/activate/{name}', 'ThemeController@activate');
});


Route::group(['namespace'=>'Access\Theme','middleware'=>'web'],function () {
    Route::get('/', 'PublicController@home');

    // Route::post('find','PublicController@find');

	// Route::get('/detail/{slug}','PublicController@singlePost');
   	Route::get('/{page}','PublicController@page');
});
