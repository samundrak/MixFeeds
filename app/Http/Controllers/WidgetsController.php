<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Auth;
use DB;
use Illuminate\Http\Request;
use Input;

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
		$del = DB::table('widgets')->where('id', $id)->delete();
		error_log($del);
		if ($del == 1) {
			return ["success" => 1, "message" => "Widget has been deleted successfully"];
		}
		return ["success" => 0, "message" => "Unable to delete"];

	}
}
