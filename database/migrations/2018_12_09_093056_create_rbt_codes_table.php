<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRbtCodesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('rbt_codes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('audio_id')->unsigned()->index('rbt_codes_audio_id_foreign');
			$table->integer('operator_id')->unsigned()->index('rbt_codes_operator_id_foreign');
			$table->string('code');
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
		Schema::drop('rbt_codes');
	}

}
