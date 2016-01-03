<?php

use Illuminate\Database\Migrations\Migration;

class CreatePlansTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		//
		if (Schema::hasTable('plans')) {
			return;
		}

		Schema::create('plans', function ($table) {
			$table->increments('id');
			$table->string('plan');
			$table->double('amount');
			$table->boolean('active');
			$table->integer('creator');
			$table->date('validate');
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
