<?php
Route::post('/update', 'UsersController@update');
Route::get('/details', 'UsersController@info');
Route::post('/email/edit', 'UsersController@changeEmail');
Route::post('/password/edit', 'UsersController@changePassword');
Route::post('/forget_password', 'ForgetPassword@create');
Route::post('/reset_password', 'ResetPassword@edit');