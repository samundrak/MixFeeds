<?php

use App\model\Plans;
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
		$plans = new Plans();

		$plans->plan = 'simple';
		$plans->amount = 10;
		$plans->active = 1;
		$plans->creator = 1;
		$plans->validate = date("y-m-d");
		$plans->save();

		$plans = new Plans();
		$plans->plan = 'medium';
		$plans->amount = '20';
		$plans->active = 1;
		$plans->creator = 1;
		$plans->validate = date("y-m-d");
		$plans->save();

		$plans = new Plans();
		$plans->plan = 'super';
		$plans->amount = '30';
		$plans->active = 1;
		$plans->creator = 1;
		$plans->validate = date("y-m-d");
		$plans->save();

		Model::reguard();
	}
}
