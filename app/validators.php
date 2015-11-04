<?php
/* app/validators.php  */
Validator::extend('alpha_spaces', function ($attribute, $value) {
	return preg_match('/^[\pL\s]+$/u', $value);
});
/*
 * add the validators.php file in start/global.php: require app_path().'/validators.php'
 * and use it as usual:  $rules = array('name' => 'required|alpha_spaces',);
 */