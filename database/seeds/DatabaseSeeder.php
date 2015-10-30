<?php

use App\model\Widgets;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		Model::unguard();
		// $user = new User;
		// $user->firstname = "Samundra";
		// $user->lastname = "kc";
		// $user->email = "samundrak@yahoo.com";
		// $user->password = Hash::make('br0adlink');
		// $user->save();

		$widgets = new Widgets;
		$widgets->creator = 3;
		$widgets->widget_name = uniqid();
		$widgets->page_name = " ['ncell', 'airtel', 'vodafone', 'lux']";
		$widgets->domain = "http://www.facebook.com";
		$widgets->save();

		Model::reguard();
	}
}
