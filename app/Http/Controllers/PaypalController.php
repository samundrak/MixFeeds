<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class PaypalController extends Controller {

	public function create() {

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
		$data['item_name'] = $_POST['item_name'];
		$data['item_number'] = $_POST['item_number'];
		$data['payment_status'] = $_POST['payment_status'];
		$data['payment_amount'] = $_POST['mc_gross'];
		$data['payment_currency'] = $_POST['mc_currency'];
		$data['txn_id'] = $_POST['txn_id'];
		$data['receiver_email'] = $_POST['receiver_email'];
		$data['payer_email'] = $_POST['payer_email'];
		$data['custom'] = $_POST['custom'];

		// post back to PayPal system to validate
		$header = "POST /cgi-bin/webscr HTTP/1.0\r\n";
		$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
		$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";

		$fp = fsockopen('ssl://www.sandbox.paypal.com', 443, $errno, $errstr, 30);

		if (!$fp) {
			// HTTP ERROR

		} else {
			fputs($fp, $header . $req);
			while (!feof($fp)) {
				$res = fgets($fp, 1024);
				if (strcmp($res, "VERIFIED") == 0) {

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
							return 'No user found';
						}

						DB::table('transaction')->insertGetId(array(
							'id' => $user->id,
							'amount' => $data['payment_amount'],
							'created_at' => \Carbon\Carbon::now(),
							'updated_at' => \Carbon\Carbon::now(),
						));

						if ($orderid) {
							// Payment has been made & successfully inserted into the Database
						} else {
							// Error inserting into DB
							// E-mail admin or alert user
							// mail('user@domain.com', 'PAYPAL POST - INSERT INTO DB WENT WRONG', print_r($data, true));
						}
					} else {
						// Payment made but data has been changed
						// E-mail admin or alert user
					}

				} else if (strcmp($res, "INVALID") == 0) {

					// PAYMENT INVALID & INVESTIGATE MANUALY!
					// E-mail admin or alert user

					// Used for debugging
					//@mail("user@domain.com", "PAYPAL DEBUGGING", "Invalid Response<br />data = <pre>".print_r($post, true)."</pre>");
				}
			}
			fclose($fp);
		}
	}
}
