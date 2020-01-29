<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGreetingimgsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('greetingimgs', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title', 90);
			$table->string('path');
			$table->integer('occasion_id')->unsigned()->index('greetingimgs_occasion_id_foreign');
			$table->date('RDate');
			$table->date('EXDate');
			$table->timestamps();
			$table->integer('X')->default(150);
			$table->integer('Y')->default(330);
			$table->string('Font')->default('Fonts/29ltbukralight.ttf');
			$table->integer('FontSize')->default(24);
			$table->integer('Angle')->default(0);
			$table->integer('FirstR')->default(255);
			$table->integer('FirstG')->default(255);
			$table->integer('FirstB')->default(255);
			$table->integer('SecondR')->default(128);
			$table->integer('secondG')->default(128);
			$table->integer('secondB')->default(128);
			$table->integer('MainR')->default(0);
			$table->integer('MainG')->default(0);
			$table->integer('MainB')->default(0);
			$table->integer('DefLetLength')->default(15);
			$table->boolean('Arabic')->default(1);
			$table->integer('popular_count');
			$table->integer('featured')->default(0);
			$table->integer('snap')->default(0)->comment('0:default / 1:snap');
			$table->string('snap_link');
			$table->integer('rbt_id')->unsigned()->nullable()->index();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('greetingimgs');
	}

}
