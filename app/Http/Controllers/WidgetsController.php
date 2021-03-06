<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
// use App\Http\Controllers\Custom\Utils;
use Auth;
use DB;
use Illuminate\Http\Request;
use Input;
use Validator;
use View;

class WidgetsController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		//
		$limit = empty(Input::get('limit')) ? 5 : Input::get('limit');
		$widgets = DB::table('widgets')
			->where('creator', Auth::user()->id)
			->orderBy('id', 'desc')
			->limit($limit);

		$total = DB::table('widgets')
			->where('creator', Auth::user()->id)->count();

		if (Input::get('dest')) {
			$widgets->where('id', '<=', Input::get('dest'));
		}

		if (!sizeof($widgets->get())) {
			return ["success" => 0, "message" => "No any widgets found"];
		}

		return ["success" => 1, "total" => $total, "data" => $widgets->get()];
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Request $request) {
		//
		error_log($request->input('widget_i'));
		$validator = [
			"widget_name" => "required|min:2|alpha_num",
			"pages" => "required",
			"display" => "required",
			"size" => "required",
			// "show_friends_face" => "required",
			"show_small_header" => "required",
			"hide_cover_photo" => "required",
			"domain" => 'required|url',
			"state" => 'required',
		];
		$validator = Validator::make(Input::all(), $validator);

		if ($validator->fails()) {
			return json_encode(["success" => 0, "message" => $validator->messages()->toJson()]);
		}

		$settings = json_encode(array(
			"size" => json_encode($request->input('size')),
			"show_friends_face" => $request->input('show_friends_face'),
			"show_small_header" => $request->input('show_small_header'),
			"hide_cover_photo" => $request->input('hide_cover_photo'),
			"display" => json_encode($request->input('display')),
		));
		// error_log(json_encode($request->input('pages')));
		$vals = array(
			'creator' => Auth::user()->id,
			'widget_name' => $request->input('widget_name'),
			'pages' => json_encode($request->input('pages')),
			'domain' => $request->input('domain'),
			"settings" => $settings,
			"created_at" => \Carbon\Carbon::now(),
			"updated_at" => \Carbon\Carbon::now(),

		);
		$requestedPages = (count($vals['pages']));
		if ($request->input('state') === 'widgets.create') {

			$exist = DB::table('subscription')
				->where('end', ">=", date("Y-m-d"))
				->where('end', "<=", date("Y-m-d", strtotime(" +30 days ")))
				->where('user', Auth::user()->id)
			// ->where('plan', $request->input('plan'))
				->first();

			if (!$exist) {
				return json_encode(["success" => 0, "message" => ["You have n't subscribed to any packaged till."]]);
			}
			$plan = $exist->plan;
			$restrict = DB::table('plan_descs')
				->where('plan_id', $plan)
				->first();
			$limitWidgets = (int) $restrict->widgets;

			$totalWidgets = (int) DB::table('widgets')
				->where('creator', Auth::user()->id)
				->count();

			if ($requestedPages >= $restrict->pages) {
				return json_encode(["success" => 0, "message" => "You are n't allowed to add more then " . $requestedPages . " pages"]);
			}
			if ($totalWidgets >= $limitWidgets) {
				return json_encode(["success" => 0, "message" => "You can't create more widgets"]);
			}
			$vals['token'] = md5(time() . Auth::user()->id);
			$id = DB::table('widgets')
				->insertGetId($vals);

			if ($id) {
				return json_encode(["success" => 1, "message" => "New widget has been created successfully"]);
			}
		} else if ($request->input('state') === 'widgets.edit') {
			// error_log($request->input('widget_id'));
			if (!empty($request->input('widget_id'))) {
				unset($vals['created_at']);
				$update = DB::table('widgets')
					->where('id', $request->input('widget_id'))
					->where('creator', Auth::user()->id)
					->update($vals);

				error_log($update);
				return json_encode(["success" => 1, "message" => "Widget has been updated successfully"]);
			}
		}

		return json_encode(["success" => 0, "message" => "There was error saving data"]);

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  Request  $equest
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
		$data = DB::table('widgets')->where('id', $id)->first();
		if (sizeof($data) < 1) {
			return ["success" => 0, "message" => "No any widgets founds"];
		}

		return ["success" => 1, "data" => $data];
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
		$del = DB::table('widgets')->where('id', $id)->delete();
		error_log($del);
		if ($del == 1) {
			return ["success" => 1, "message" => "Widget has been deleted successfully"];
		}
		return ["success" => 0, "message" => "Unable to delete"];

	}

	public function widget($token) {
		$data = DB::table('widgets')->where('token', '=', $token)->first();
		if (!$data) {
			return 'Sorry No widgets found!';
		}

		$data->settings = json_decode($data->settings);
		$data->pages = json_decode($data->pages);
		$data->settings->size = json_decode($data->settings->size);
		$data->settings->display = json_decode($data->settings->display);
		$subscription = DB::table('subscription')
			->where('end', ">=", date("Y-m-d"))
			->where('end', "<=", date("Y-m-d", strtotime(" +30 days ")))
			->where('user', $data->creator)
		// ->where('plan', $request->input('plan'))
			->first();

		if (!$subscription) {
			return 'This Widgets Subscription period has been finished';
		}

		$data->subscription = $subscription;
		return View::make('widgets.index', ['data' => $data]);
	}
}
