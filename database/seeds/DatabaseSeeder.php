<?php

use App\Model\Subscriptions;
use App\Model\Transactions;
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

		// $widgets = new Widgets;
		// $widgets->creator = 3;
		// $widgets->widget_name = uniqid();
		// $widgets->page_name = " ['ncell', 'airtel', 'vodafone', 'lux']";
		// $widgets->domain = "http://www.facebook.com";
		// $widgets->save();

		$transaction = new Transactions;
		$transaction->user = Auth::user()->id;
		$transaction->amount = 100;
		$transaction->save();

		$subscribe = new Subscriptions;
		$subscribe->start = date();
		$subscribe->end = date() + 30;
		$subscribe->plan = 'simple';
		$subscribe->amount = 10;
		$subscribe->user = Auth::user()->id;
		$subscribe->save();
		Model::reguard();
	}
}
