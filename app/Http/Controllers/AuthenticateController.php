<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Redirect;
use Validator;

class AuthenticateController extends Controller {
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
	 *
	 * @return Response
	 */
	public function create() {
		//
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
	public function update(Request $request, $id) {
		//
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

	public function authenticate(Request $request) {
		$rules = array(
			'email' => 'required|email', // make sure the email is an actual email
			'password' => 'required|alphaNum|min:3', // password can only be alphanumeric and has to be greater than 3 characters
		);

		$validator = Validator::make($request->all(), $rules);

// if the validator fails, redirect back to the form
		if ($validator->fails()) {
			return Redirect::to('/views/home/partials/login')
				->withErrors($validator) // send back all errors to the login form
				->withInput($request->except('password')); // send back the input (not the password) so that we can repopulate the form
		} else {

			// create our user data for the authentication
			$userdata = array(
				'email' => $request->input('email'),
				'password' => $request->input('password'),
			);

			// attempt to do the login
			if (Auth::attempt($userdata)) {

				// validation successful!
				// redirect them to the secure section or whatever
				// return Redirect::to('secure');
				// for now we'll just echo success (even though echoing in a controller is bad)
				return Redirect::to('/dashboard/home')
					->with('message', 'You are logged in');
			} else {

				// validation not successful, send back to form
				return Redirect::to('/#/login');

			}

		}
	}
}
