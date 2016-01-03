<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\model\Subscriptions;
use Auth;
use DB;
use Illuminate\Http\Request;
use Input;

class SubscriptionsController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		//
		$plans = DB::table('plans')
			->join('plan_descs', "plans.id", '=', 'plan_descs.plan_id')
			->where('plans.active', 1)
			->select()
			->get();

		if (sizeof($plans)) {
			return ['success' => 1, "data" => ["plans" => $plans]];
		} else {
			return ["success" => 0, "message" => "No any subscription list found"];
		}
	}

	public function details() {
		//select * from `gar_subscription` left join `gar_plans` on `gar_subscription`.plan = `gar_plans`.id where `gar_subscription`.plan = ?
		$limit = empty(Input::get('limit')) ? 5 : Input::get('limit');
		// $details = DB::table('subscription')
		// 	->where('user', Auth::user()->id)
		// 	->orderBy('id', 'desc')
		// 	->limit($limit);
		$details = DB::table('subscription')
			->join('plans', 'subscription.plan', '=', 'plans.id')
			->where('subscription.user', Auth::user()->id)
			->orderBy('subscription.id', 'desc')
			->select('subscription.id', 'subscription.start', 'subscription.end', 'subscription.amount', 'plans.plan')
			->limit($limit);

		$total = DB::table('subscription')
			->where('user', Auth::user()->id)->count();

		if (Input::get('dest')) {
			$details->where('subscription.id', '<=', Input::get('dest'));
		}

		if (!sizeof($details->get())) {
			return ["success" => 0, "message" => "No any subscriptions details found"];
		}

		return ["success" => 1, "total" => $total, "data" => $details->get()];
	}
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Request $request) {
		//
		$data = DB::table('plans')->where('id', $request->input('plan'))
			->first();
		error_log($data->amount);
		if ((Auth::user()->balance - $data->amount) > 0 || ($data->amount == 0)) {
			$exist = DB::table('subscription')
				->where('end', ">=", date("Y-m-d"))
				->where('end', "<=", date("Y-m-d", strtotime(" +30 days ")))
				->where('user', Auth::user()->id)
			// ->where('plan', $request->input('plan'))
				->first();
			if (!$exist) {
				$up = DB::table('users')->where('id', Auth::user()->id)->update(array('balance' => (Auth::user()->balance - $data->amount)));
				if ($up || ($data->amount === '0')) {
					$subs = new Subscriptions;
					$subs->start = date("Y-m-d");
					$subs->end = date("Y-m-d", strtotime(" +30 days "));
					$subs->plan = $request->input('plan');
					$subs->amount = $data->amount;
					$subs->user = Auth::user()->id;
					$subs->save();

					return ["data" => ["amount" => $data->amount], "message" => "You have successfully subsribed to this plan", "success" => 1];

				} else {

					return ["message" => "Unable to subscribe please try again", "success" => 0];
				}
			} else {
				return ["message" => "You have already subscribed to a plan for this month", "success" => 0];
			}
		} else {
			return ["message" => "Your dont have enough balance to subscribe", "success" => 0];
		}
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
}
