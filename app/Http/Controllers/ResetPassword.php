<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Custom\Utils;
use DB;
use Hash;
use Illuminate\Http\Request;
use Redirect;
use View;

class ResetPassword extends Controller {
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
	public function verify($email) {
		$exists = DB::table('users')->where('hash_email', $email)->first();
		if ($exists) {
			DB::table('users')->where('id', $exists->id)->update(['is_verified' => 1]);
			return 'Your account has been verified. <a href="/#/login">Click Here</a> to login.';
			// return Redirect::to('/#/login');
		} else {
			return 'Sorry ! Unauthentic access ';
		}
	}

	public function create($email) {
		//

		$exists = DB::table('users')->where('hash_email', $email)->get();
		if ($exists) {
			return Redirect::to('/#/reset_password/' . $email);
		} else {
			return 'Sorry ! Unauthentic access ';
		}
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
	public function edit(Request $req) {
		//
		if (empty($req->get('hash')) && empty($req->get('password'))) {
			return Utils::response(0, ["Fields mustn't be empty"]);
		}

		$exists = DB::table('users')->where('hash_email', $req->get('hash'))->get();
		if ($exists) {
			DB::table('users')->where('hash_email', $req->get('hash'))
				->update(array(
					'password' => Hash::make($req->get('password')),
				));
			return Utils::response(1, "Password has been changed successfully");
		} else {
			return Utils::response(0, ["Email not found"]);
		}
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
