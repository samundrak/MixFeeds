<?php
Route::group(["prefix" => "/widgets"], function () {
	require_once 'widgets.php';
});
Route::group(["prefix" => "/user"], function () {
	require_once 'users.php';
});