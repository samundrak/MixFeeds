<?php

use App\user;
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
		$user = new User;
		$user->firstname = "Samundra";
		$user->lastname = "kc";
		$user->email = "samundrak@yahoo.com";
		$user->password = Hash::make('br0adlink');
		$user->save();
		Model::reguard();
	}
}
