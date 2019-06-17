<?php

Route::post('/register', 'AuthController@register');
Route::post('/login', 'AuthController@login');
Route::post('/logout', 'AuthController@logout');

Route::middleware('auth')->group(static function () {
    Route::apiResource('books', 'BookController');
    Route::prefix('books/{book}')->group(static function () {
        Route::put('archive', 'BookController@archive')->name('books.archive');
        Route::put('unarchive', 'BookController@unarchive')->name('books.unarchive');
    });
});
