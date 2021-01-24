<?php 

Route::get('/', 'ProductApiController@index')->name('api.products.index');   
Route::apiResource('tags', 'TagApiController', ['name' => 'api.tags']);