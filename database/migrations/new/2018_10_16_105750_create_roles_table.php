<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRolesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('roles', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('Title', 20);
			$table->boolean('approved');
			$table->timestamps();
		});
		\DB::statement("INSERT INTO `roles` (`id`, `Title`, `approved`, `created_at`, `updated_at`) VALUES (1, 'Admin', '1', '2020-01-22 15:14:17', '2020-01-22 15:16:45')");
		\DB::statement("INSERT INTO `roles` (`id`, `Title`, `approved`, `created_at`, `updated_at`) VALUES (2, 'User', '1', '2020-01-22 15:14:17', '2020-01-22 15:16:45')");

	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('roles');
	}

}
