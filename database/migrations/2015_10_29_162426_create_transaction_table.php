<?php

use Illuminate\Database\Migrations\Migration;

class CreateTransactionTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		//
		if (Schema::hasTable('transaction')) {
			return;
		}

		Schema::create('transaction', function ($table) {
			$table->increments('id');
			$table->integer('user');
			$table->double('amount')->default('0.0');
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
		Schema::drop('transaction');
	}
}
