<?php

use Illuminate\Database\Migrations\Migration;

class CreatePlanDescTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		//
		if (Schema::hasTable('plan-desc')) {
			return;
		}

		Schema::create('plan-desc', function ($table) {
			$table->increments('id');
			$table->string('points');
			$table->integer('widgets')->default(1);
			$table->integer('pages')->default(8);
			$table->string('settings');
			$table->integer('plan_id');
			$table->timestamps();

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		//
	}
}
