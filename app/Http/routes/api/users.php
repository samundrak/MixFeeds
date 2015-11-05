<?php
Route::post('/update', 'UsersController@update');
Route::get('/details', 'UsersController@info');
Route::post('/email/edit', 'UsersController@changeEmail');
Route::post('/password/edit', 'UsersController@changePassword');