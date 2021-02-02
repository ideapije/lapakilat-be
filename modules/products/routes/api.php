<?php

// Route::get('/', 'ProductApiController@index')->name('api.products.index');  
 
Route::group(['as' => 'api.products.'], function () {
    Route::get('/', 'ProductApiController@index')->name('index');
    Route::get('/{id}', 'ProductApiController@show')->name('show');
});
