<?php

Route::group(["prefix" => "/api"], function () {
	require_once 'api/index.php';
});
require_once 'views.php';
require_once 'fb.php';
Route::post('auth/login', 'AuthenticateController@authenticate');
Route::post('auth/register', 'UsersController@create');
Route::get('/logout', 'UsersController@logout');