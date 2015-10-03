<?php

/*www
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
 
Route::get('/', function () {
    return view('home.index');
});
 
Route::get('/views/home/partials/{part?}',function($part = 'home'){
	return view('home.partials.'.$part);
});

Router::post('/contact/me',function(){
	// print_r($_POST);
	return 'hey';
});