
<?php

// require_once __DIR__ . '/vendor/autoload.php';

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

require_once 'routes/index.php';
Route::get('/reset_password/{params}', 'ResetPassword@create');
Route::get('/verify/{params}', 'ResetPassword@verify');
function fbpp($string, $img = false) {
	$name = explode("/", "$string")[3];
	if ($img) {
		return $name;
	}
	return str_replace(".", "_", $name);
}

function getWidthHeight($data, $props) {
	if (property_exists($data, 'responsive')) {
		if ($data->responsive === '1') {
			return '1';
		}
	}
	if ($props === 'width') {
		if (property_exists($data, $props)) {
			return $data->width === '0' ? '' : $data->width;
		}
	} else if ($props === 'height') {
		if (property_exists($data, $props)) {
			return $data->height === '0' ? '' : $data->height;
		}
	}
	return '';
}