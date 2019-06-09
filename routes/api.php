<?php

Route::post('/register', 'AuthController@register');
Route::post('/login', 'AuthController@login');
Route::post('/logout', 'AuthController@logout');

Route::middleware('auth')->group(static function () {
    Route::apiResource('books', 'BookController');
});
