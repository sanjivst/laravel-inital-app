<?php


Route::group(['middleware' => ['web', 'auth','checkScope:Admin'], 'prefix' => 'admin', 'namespace' => 'Access\Media'],function () {
    Route::resource('media', 'MediaController');
    Route::resource('galleries', 'GalleryController');

    Route::resource('albums', 'AlbumController');

    Route::get('gallery_media_create', 'GalleryController@gallery_media_create');
    Route::post('gallery_media_upload', 'GalleryController@gallery_media_upload');

    Route::get('gallery_media_modify/{id}', 'GalleryController@gallery_media_modify');
});
