<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Input;
use Redirect;
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
			$user = new User();
			$user->firstname = Input::get('firstname');
			$user->lastname = Input::get('lastname');
			$user->email = Input::get('email');
			$user->password = Hash::make(Input::get('password'));
			$user->save();
			return Redirect::to('/#/login')
				->with('message', 'Thankyou for creating new account please signin');
		}

		return Redirect::to('/views/home/partials/register')->
			with('message', 'Something went wrong')
			->withErrors($validator)
			->withInput();
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
			'email' => Input::get('email'),
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
}
