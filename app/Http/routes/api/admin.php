<?php
Route::get('/users', 'AdminController@index');
Route::post('/action', 'AdminController@action');

Route::get('/subscriptions', 'AdminController@indexSubscriptions');
Route::post('/subscriptions/action', 'AdminController@subscriptionAction');
Route::post('/subscriptions/add', 'AdminController@subscriptionCreate');
Route::get('/subscriptions/{id}', 'AdminController@show');
Route::post('/subscriptions/edit/{id}', 'AdminController@editSubscription');