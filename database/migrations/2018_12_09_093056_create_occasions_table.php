<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOccasionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('occasions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title', 60);
			$table->integer('category_id')->unsigned()->index('occasions_category_id_foreign');
			$table->timestamps();
			$table->string('image');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('occasions');
	}

}
