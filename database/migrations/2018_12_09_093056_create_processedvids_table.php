<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProcessedvidsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('processedvids', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('processedimg_id')->unsigned()->index('processedvids_processedimg_id_foreign');
			$table->string('path')->nullable();
			$table->bigInteger('FID')->default(0);
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('processedvids');
	}

}
