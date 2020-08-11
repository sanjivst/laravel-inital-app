<?php


Route::group(['prefix'=>'admin','middleware' => ['web', 'auth','checkScope:Admin']], function () {

    Route::resource('subscribers', 'Access\Subscriber\SubscriberController')->except([
        'create', 'store'
    ]);
    Route::resource('messages', 'Access\Subscriber\MessageController');
    Route::resource('comments', 'Access\Subscriber\CommentController');
});

Route::get('contact_us', 'Access\Subscriber\SubscriberController@contact_us');

Route::post('subscribe-me', 'Access\Subscriber\SubscriberController@subscribeMe')->middleware('web')->name('subscribe');
Route::post('contact-us-store', 'Access\Subscriber\SubscriberController@contact_us_store')->middleware('web');
Route::post('add-comment', 'Access\Subscriber\CommentController@addComment')->middleware('web');

