<?php

use Illuminate\Database\Migrations\Migration;

class CreateWidgetsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		if (Schema::hasTable('widgets')) {
			return;
		}
		Schema::create('widgets', function ($table) {
			$table->increments('id');
			$table->integer('creator');
			$table->string('widget_name');
			$table->string('page_name');
			$table->string('domain');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('widgets');
	}
}
