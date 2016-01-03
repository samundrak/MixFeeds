<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Custom\Utils;
use Auth;
use DB;
// use Auth;
use Illuminate\Http\Request;
use Validator;

// use View;

class AdminController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		//
		$users = DB::table('users')->select('firstname', 'lastname', 'email', 'balance', 'created_at', 'is_verified', 'is_admin', 'id')->get();
		return $users;
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
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
		$data = DB::table('plans')
			->join('plan_descs', 'plans.id', '=', 'plan_descs.plan_id')
			->where('plans.id', $id)
			->get();
		return ["success" => 1, "data" => $data];
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

	public function action(Request $request) {
		$rules = [
			"action" => "required",
			"id" => "required",
		];

		$validator = Validator::make($request->all(), $rules);
		if ($validator->passes()) {
			$action = $request->get('action');
			$id = $request->get('id');
			if ($action === 'Delete User') {
				DB::table('users')
					->where('id', $id)
					->update(["is_verified" => "3"]);
			} else if ($action === 'Make Admin') {
				DB::table('users')
					->where('id', $id)
					->update(["is_admin" => "1"]);
			} else if ($action === 'Verify User') {
				DB::table('users')
					->where('id', $id)
					->update(["is_verified" => "1"]);
			} else if ($action === 'Unverify User') {
				DB::table('users')
					->where('id', $id)
					->update(["is_verified" => "0"]);
			} else if ($action === 'Block User') {
				DB::table('users')
					->where('id', $id)
					->update(["is_verified" => "2"]);
			} else if ($action === 'Remove Admin') {
				DB::table('users')
					->where('id', $id)
					->update(["is_admin" => "0"]);
			}
			return ["success" => 1, "message" => "Action has been taken"];
		} else {
			return Utils::response(0, Utils::getFormatedErrorMessages($validator->messages()));
		}
	}

	public function indexSubscriptions(Request $request) {
		$data = DB::table('plans')
			->join('plan_descs', 'plans.id', '=', 'plan_descs.plan_id')
			->get();
		$most = DB::select(DB::raw("SELECT `plan`, COUNT(`plan`) AS planCount
									FROM `gar_subscription`
									GROUP BY `plan`
									ORDER BY COUNT(`plan`) DESC"));
		if (sizeof($data) > 0) {
			if (sizeof($most) > 0) {
				$mostUsedPlan = DB::table('plans')->where('id', $most[0]->plan)->first();
				$mostUsedPlan->total = $most[0]->planCount;
				return ["success" => 1, "data" => ["plans" => $data, "stats" => $mostUsedPlan]];
			}
			return ["success" => 1, "data" => ["plans" => $data, "stats" => []]];
		} else {
			return ["success" => 0, "message" => ["No any Subscriptions plans found"]];
		}
	}

	public function createSubscriptions(Request $request) {

	}

	public function subscriptionAction(Request $request) {
		if (empty($request->input('id'))) {
			return Utils::response(0, 'Some field missing');
		}

		$id = $request->input('id');
		$action = $request->input('action');
		$data = DB::table('plans')
			->where('id', $request->input('id'))
			->update([
				"active" => $request->input('action'),
			]);
		return Utils::response(1, "Action has been taken");
	}

	public function editSubscription($id, Request $request) {
		$rules = [
			"name" => "required",
			"pages" => "required",
			"points" => "required",
			"price" => "required",
			"settings" => "required",
			"widgets" => "required",
		];

		$validator = Validator::make($request->all(), $rules);
		if (!$validator->passes()) {
			return Utils::response(0, Utils::getFormatedErrorMessages($validator->messages()));
		}

		DB::table('plans')
			->where('id', $id)
			->update([
				"amount" => $request->input('price'),
				"plan" => $request->input('name'),
				"active" => '0',
				"creator" => Auth::user()->id,
				"validate" => '2015-11-03',
			]);

		// if (empty($id)) {
		// return Utils::response(0, "Sorry unable to create widgets");
		// }
		error_log($id);
		DB::table('plan_descs')
			->where('plan_id', $id)
			->update([
				"points" => json_encode($request->input('points')),
				"widgets" => $request->input('widgets'),
				"pages" => $request->input('pages'),
				"settings" => json_encode($request->input('settings')),
				"plan_id" => $id,
			]);
		return ["success" => 0, "message" => "Subscription plan has been updated"];
	}
	public function subscriptionCreate(Request $request) {
		$rules = [
			"name" => "required",
			"pages" => "required",
			"points" => "required",
			"price" => "required",
			"settings" => "required",
			"widgets" => "required",
		];

		$validator = Validator::make($request->all(), $rules);
		if (!$validator->passes()) {
			return Utils::response(0, Utils::getFormatedErrorMessages($validator->messages()));
		}

		$id = DB::table('plans')
			->insertGetId([
				"amount" => $request->input('price'),
				"plan" => $request->input('name'),
				"active" => '0',
				"creator" => Auth::user()->id,
				"validate" => '2015-11-03',
			]);

		if (empty($id)) {
			return Utils::response(0, "Sorry unable to create widgets");
		}

		DB::table('plan_descs')
			->insert([
				"points" => json_encode($request->input('points')),
				"widgets" => $request->input('widgets'),
				"pages" => $request->input('pages'),
				"settings" => json_encode($request->input('settings')),
				"plan_id" => $id,
			]);
		return ["success" => 0, "message" => "Subscription plan has been created"];
	}
}
