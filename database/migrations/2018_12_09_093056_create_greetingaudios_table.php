<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGreetingaudiosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('greetingaudios', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title', 90);
			$table->string('path');
			$table->integer('occasion_id')->unsigned()->index('greetingaudios_occasion_id_foreign');
			$table->integer('cprovider_id')->unsigned()->index('greetingaudios_cprovider_id_foreign');
			$table->date('RDate');
			$table->date('EXDate');
			$table->timestamps();
			$table->integer('notification');
			$table->integer('rbt');
			$table->integer('popular_count');
			$table->integer('featured')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('greetingaudios');
	}

}
