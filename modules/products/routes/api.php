<?php

// Route::get('/', 'ProductApiController@index')->name('api.products.index');  
 
Route::group(['as' => 'api.products.'], function () {
    Route::get('/', 'ProductApiController@index')->name('index');
    Route::get('/{id}', 'ProductApiController@show')->name('show');
    Route::post('/', 'ProductApiController@store')->name('store');
    Route::post('/{id}', 'ProductApiController@update')->name('update');
    Route::delete('/{id}', 'ProductApiController@destroy')->name('destroy');
});
