<?php
Route::post('/api/user/update', 'UsersController@update');
Route::get('/api/user/details', 'UsersController@info');
Route::post('auth/login', 'AuthenticateController@authenticate');
Route::post('auth/register', 'UsersController@create');
Route::get('/logout', 'UsersController@logout');