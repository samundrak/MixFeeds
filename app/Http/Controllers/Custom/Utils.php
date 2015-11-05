<?php

namespace App\Http\Controllers\Custom;

use App\Http\Controllers\Controller;

class Utils extends Controller {
	//

	public static function getFormatedErrorMessages($data) {
		try {
			$data = json_decode($data, true);
			$messages = [];
			foreach ($data as $key => $value) {
				foreach ($value as $key => $value) {
					$messages[] = $value;
				}
			}
			return $messages;
		} catch (Exception $e) {
			return ["Server Error please try later"];
		}
	}

	public static function response($type, $message = null, $data = null) {
		$arr = ["success" => $type];
		if ($data != null) {
			$arr['data'] = $data;
		}
		if ($message != null) {
			$arr['message'] = $type === 0 ? is_array($message) ? $message : [$message] : $message;
		}
		return $arr;
	}
}
