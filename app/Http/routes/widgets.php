<?php
Route::get('/api/widgets/get', 'WidgetsController@index');
Route::delete('/api/widgets/delete/{id}', 'WidgetsController@destroy');