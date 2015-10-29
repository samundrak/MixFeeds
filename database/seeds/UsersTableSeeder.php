<?php

class UsersTableSeeder extends Seeder {
	public function run() {
		$user = new User;
		$user->firstname = "Samundra";
		$user->lastname = "kc";
		$user->email = "samundrak@yahoo.com";
		$user->password = Hash::make('br0adlink');
		$user->save();
	}
}