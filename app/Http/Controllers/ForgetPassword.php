<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Custom\Utils;
use DB;
use Illuminate\Http\Request;
use Input;
use Mail;
use Validator;

class ForgetPassword extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		return View::make('reset_password');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create(Request $request) {
		$rules = array(
			"email" => "required|email");
		$validator = Validator::make(Input::all(), $rules);
		if ($validator->passes()) {
			$exists = DB::table('users')
				->where('email', $request->get('email'))->get();
			if ($exists) {
				$hashed = sha1(md5(sha1(md5($request->get('email'))))) . time();
				DB::table('users')
					->where('email', $request->get('email'))
					->update(array(
						'hash_email' => $hashed,
					)
					);
				error_log($hashed);
				Mail::send("mail.view", ["hash" => $hashed], function ($message) {
					global $request, $exists;
					$message->to($request->get('email'), $request->get('email'))->subject('Forget Password!');
				});
				return Utils::response(1, ["We have sent you a email check it"]);
			} else {
				return Utils::response(0, ["We didnt found this email"]);
			}
		}
		return Utils::response(0, Utils::getFormatedErrorMessages($validator->messages()));

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		//
	}
}
