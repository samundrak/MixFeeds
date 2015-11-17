
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
Route::post('/expresscheckout', 'PaypalController@create');
Route::get('/topup/done', 'PaypalController@done');
Route::get('/topup/failed', 'PaypalController@failed');

function fbpp($string) {
	return explode("/", "$string")[3];
}