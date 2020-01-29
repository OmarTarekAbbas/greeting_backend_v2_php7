<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGeneratedurlsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('generatedurls', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('operator_id')->unsigned()->index('generatedurls_operator_id_foreign');
			$table->integer('occasion_id')->unsigned()->index('generatedurls_occasion_id_foreign');
			$table->boolean('img');
			$table->boolean('audio');
			$table->boolean('video');
			$table->bigInteger('UID');
			$table->text('url_occasion_text', 65535)->nullable();
			$table->string('url_occasion_image');
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
		Schema::drop('generatedurls');
	}

}
