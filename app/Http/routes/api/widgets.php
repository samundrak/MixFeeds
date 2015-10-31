<?php
// place your route definitions here
Route::post('/create', 'WidgetsController@create');
Route::get('/get', 'WidgetsController@index');
Route::delete('/delete/{id}', 'WidgetsController@destroy');
Route::get('/get/{id}', 'WidgetsController@show');