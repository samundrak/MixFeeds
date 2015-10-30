<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		if (!Schema::hasTable('users')) {

			Schema::create('users', function (Blueprint $table) {
				$table->increments('id');
				$table->string('firstname');
				$table->string('lastname');
				$table->string('email')->unique();
				$table->string('password', 60);
				$table->rememberToken();
				$table->boolean('is_admin')->default(0);
				$table->double('balance')->default(0.0);
				$table->boolean('is_active')->default(0);
				$table->timestamps();
			});
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('users');
	}
}
