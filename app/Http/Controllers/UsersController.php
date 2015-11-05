<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Custom\Utils;
use Auth;
use DB;
use Hash;
use Illuminate\Http\Request;
use Input;
use Redirect;
use User;
use Validator;

class UsersController extends Controller {

	public function __constructor() {
		parent::construct();
		$this->beforeFilter('csrf', array('on' => 'post'));
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *10.1.26.1
	 * @return Response
	 */
	public function create() {
		$rules = [
			'firstname' => 'required|min:2|alpha',
			'lastname' => 'required|min:2|alpha',
			'email' => 'required|email|unique:users',
			'password' => 'required|between:8,12|alpha_num|confirmed',
			'password_confirmation' => 'required|between:8,12|alpha_num',

		];
		$validator = Validator::make(Input::all(), $rules);
		error_log($validator->passes());
		if ($validator->passes()) {
			DB::table('users')
				->insert(array(
					"firstname" => Input::get('firstname'),
					"lastname" => Input::get('lastname'),
					"email" => Input::get('email'),
					"password" => Hash::make(Input::get('password')),
					"created_at" => \Carbon\Carbon::now(),
					"updated_at" => \Carbon\Carbon::now(),
				));
			return Utils::response(1, "Register Successfully", ["path" => "/#/login"]);
		}

		return Utils::response(0, Utils::getFormatedErrorMessages($validator->messages()));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  Request  $request
	 * @return Response
	 */
	public function store(Request $request) {
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  Request  $request
	 * @param  int  $id
	 * @return Response
	 */
	public function update() {
		$validator = Validator::make(Input::all(), array(
			'firstname' => 'required|alpha|min:3',
			'lastname' => 'required|alpha|min:3',
			'email' => 'required|email',
		));
		if (!$validator->passes()) {
			return json_encode(["success" => 0, "message" => $validator->messages()->toJson()]);
		}
		$user = new User();
		$user->update(array(
			'firstname' => Input::get('firstname'),
			'lastname' => Input::get('lastname'),
			// 'email' => Input::get('email'),
		));
		return json_encode(["success" => 1, "message" => "Your profile has been updated"]);

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		//
	}

	public function info() {

		if (!Auth::check()) {
			return json_encode(array('success' => 0,
				'message' => 'No user found or you are not logged in',
			));
		}
		$user = Auth::user();
		return json_encode(array(
			'success' => 1,
			'data' => array(
				'firstname' => $user->firstname,
				'lastname' => $user->lastname,
				'email' => $user->email),
		));
	}

	public function logout() {
		Auth::logout();
		return Redirect::to('/');
	}

	public function changeEmail(Request $request) {
		$validator = Validator::make(Input::all(), array(
			"oldEmail" => "required|email",
			"newEmail" => "required|email",
			"password" => "required|min:8",
		));

		if (!$validator->passes()) {
			return ["success" => 0, "message" => Utils::getFormatedErrorMessages($validator->messages()->toJson())];
		}

		if (!Auth::attempt(["email" => $request->input('oldEmail'), "password" => $request->input('password')])) {
			return ["success" => 0, "message" => ["Invalid Authentication details"]];
		}

		if (Auth::user()->email === $request->input('oldEmail')) {
			if (DB::table('users')
				->where('id', Auth::user()->id)
				->where('email', Auth::user()->email)
				->update(array(
					"email" => $request->input('newEmail'),
					"is_verified" => 0,
				))) {
				return ["success" => 1, "message" => "Your email has been updated also please verify your new email"];
			}

		}
		return ["success" => 0, "message" => ["Invalid Authentication details"]];
	}

	public function changePassword(Request $request) {
		$validator = Validator::make(Input::all(), array(
			"oldPassword" => "required|min:8",
			"newPassword" => "required|min:8",
			"confirmPassword" => "required|min:8",
		));

		if (!$validator->passes()) {
			return ["success" => 0, "message" => Utils::getFormatedErrorMessages($validator->messages()->toJson())];
		}

		if ($request->input('newPassword') != $request->input('confirmPassword')) {
			return ["success" => 0, "message" => ["New password and confirm password didn't matched"]];
		}

		if (!Auth::attempt(["email" => Auth::user()->email, "password" => $request->input('oldPassword')])) {
			return ["success" => 0, "message" => ["Invalid Authentication details"]];
		}

		if (DB::table('users')
			->where('id', Auth::user()->id)
			->update(array(
				"password" => Hash::make($request->input('newPassword')),
			))) {
			return ["success" => 1, "message" => "Your password has been updated"];
		}

		return ["success" => 0, "message" => ["Invalid Authentication details"]];
	}
}
