<?php

use App\model\PlanDesc;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		$points = [
			// "User can create only 1 widget",
			// "Max 8 Facebook Pages embedded",
			// "Logo for MultiEmbed.com displayed (100x40px), that links back to www.multiembed.com",
			"Can display random", "Can display facebook page with latest post first",
			"Can set widget with or choose responsive ",
			"Can set height ",
			"Can show friends face ",
			"Can set small header ",
			"Can hide cover photo",
			"Can create up to 20 widgets",
			"Max 40 Facebook Pages for each widget",
			"No logo or ad for MultiEmbed",
		];
		Model::unguard();

		$planDesc = new PlanDesc;
		$planDesc->points = json_encode($points);
		$planDesc->widgets = 20;
		$planDesc->pages = 40;
		$planDesc->settings = json_encode(["size" => true, "display" => ["random" => true, "latest" => true, "friends_face" => true, "small_header" => true, "hide_cover_photo" => true]]);
		$planDesc->plan_id = 4;
		$planDesc->save();

		Model::reguard();
	}
}
