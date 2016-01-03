<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use Input;

class PaypalController extends Controller {

	public function create(Request $request) {

		//Database Connection

		// Response from Paypal

		// read the post from PayPal system and add 'cmd'
		$req = 'cmd=_notify-validate';
		foreach ($_POST as $key => $value) {
			$value = urlencode(stripslashes($value));
			$value = preg_replace('/(.*[^%^0^D])(%0A)(.*)/i', '${1}%0D%0A${3}', $value); // IPN fix
			$req .= "&$key=$value";
		}

		// assign posted variables to local variables
		$data['item_name'] = $request->input('item_name'); //$_POST['item_name'];
		$data['item_number'] = $request->input('item_number'); //$_POST['item_number'];
		$data['payment_status'] = $request->input('payment_status'); //$_POST['payment_status'];
		$data['payment_amount'] = $request->input('mc_gross'); //$_POST['mc_gross'];
		$data['payment_currency'] = $request->input('mc_currency'); //$_POST['mc_currency'];
		$data['txn_id'] = $request->input('txn_id'); //$_POST['txn_id'];
		$data['receiver_email'] = $request->input('receiver_email'); //$_POST['receiver_email'];
		$data['payer_email'] = $request->input('payer_email'); //$_POST['payer_email'];
		$data['custom'] = $request->input('custom'); //$_POST['custom'];

		// post back to PayPal system to validate
		// $header = "POST /cgi-bin/webscr HTTP/1.0\r\n";
		// $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
		// $header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
		$header = "POST /cgi-bin/webscr HTTP/1.1\r\n";
		$header .= "Host: www.sanbox.paypal.com\r\n";
		$header .= "Accept: */*\r\n";
		$header .= "Connection: Close\r\n";
		$header .= "Content-Length: " . strlen($req) . "\r\n";
		$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
		$header .= "\r\n";

		$fp = fsockopen('ssl://www.sandbox.paypal.com', 443, $errno, $errstr, 30);

		if (!$fp) {
			// HTTP ERROR

		} else {
			fputs($fp, $header . $req);
			while (!feof($fp)) {
				$res = stream_get_contents($fp, 2048);
				if (stristr($res, "VERIFIED")) {
					error_log('message');

					// Used for debugging
					// mail('user@domain.com', 'PAYPAL POST - VERIFIED RESPONSE', print_r($post, true));

					// Validate payment (Check unique txnid & correct price)
					$valid_txnid = true; //check_txnid($data['txn_id']);
					$valid_price = true; //check_price($data['payment_amount'], $data['item_number']);
					// PAYMENT VALIDATED & VERIFIED!
					if ($valid_txnid && $valid_price) {
						$user = DB::table('users')->where('email', $data['payer_email'])
							->first();
						if (!$user) {
							error_log('message');
							return 'No user found';
						}

						DB::table('transaction')->insertGetId(array(
							'id' => $user->id,
							'amount' => $data['payment_amount'],
							'created_at' => \Carbon\Carbon::now(),
							'updated_at' => \Carbon\Carbon::now(),
						));

						DB::table('users')
							->where('id', $user->id)
							->update(array(
								'balance' => $data['payment_amount'],
							));
						error_log('wrong transaction 4');
						if ($orderid) {
							// Payment has been made & successfully inserted into the Database
						} else {
							// Error inserting into DB
							// E-mail admin or alert user
							// mail('user@domain.com', 'PAYPAL POST - INSERT INTO DB WENT WRONG', print_r($data, true));
							error_log('wrong transaction 3');
						}
					} else {
						// Payment made but data has been changed
						// E-mail admin or alert user
						error_log('wrong transaction 2');
					}

				} else if (stristr($res, "INVALID")) {
					error_log('wrong transaction');
					// PAYMENT INVALID & INVESTIGATE MANUALY!
					// E-mail admin or alert user

					// Used for debugging
					//@mail("user@domain.com", "PAYPAL DEBUGGING", "Invalid Response<br />data = <pre>".print_r($post, true)."</pre>");
				} else {
					error_log($res . 'me k cha');

				}
			}
			fclose($fp);
		}
	}
}
