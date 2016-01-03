<?php

use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		//
		if (Schema::hasTable('subscription')) {
			return;
		}

		Schema::create('subscription', function ($table) {
			$table->increments('id');
			$table->date('start');
			$table->date('end');
			$table->string('plan');
			$table->double('amount');
			$table->integer('user');
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
