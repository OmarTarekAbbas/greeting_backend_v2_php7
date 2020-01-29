<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProcessedimgsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('processedimgs', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('greetingimg_id')->unsigned()->index('processedimgs_greetingimg_id_foreign');
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
		Schema::drop('processedimgs');
	}

}
