<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotifyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('notify', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('complete_url', 300);
			$table->string('action', 10);
			$table->string('msisdn', 20);
			$table->string('status', 4);
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
		Schema::drop('notify');
	}

}
