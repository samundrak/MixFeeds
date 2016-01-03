<?php
Route::post('/create', 'SubscriptionsController@create');
Route::get('/plans', 'SubscriptionsController@index');
Route::get('/details', 'SubscriptionsController@details');