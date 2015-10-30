<?php
Route::get('/', function () {
	return view('home.index');
});

Route::get('/views/{home}/partials/{part}', function ($home = 'home', $part = 'home') {
	return view($home . '.partials.' . $part);
});

Route::get('dashboard/home', function ($home = 'home', $part = 'home') {
	if (!Auth::check()) {
		return Redirect::to('/#/login');
	}

	return view('dashboard.partials.home');
});
