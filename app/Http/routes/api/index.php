<?php
Route::group(["prefix" => "/widgets"], function () {
	require_once 'widgets.php';
});
Route::group(["prefix" => "/user"], function () {
	require_once 'users.php';
});
Route::group(["prefix" => "/subscribe"], function () {
	require_once 'subscriptions.php';
});
Route::group(["prefix" => "/admin"], function () {
	require_once ('admin.php');
});