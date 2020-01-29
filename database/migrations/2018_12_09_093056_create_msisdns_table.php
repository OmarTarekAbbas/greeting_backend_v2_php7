<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMsisdnsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('msisdns', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('msisdn', 20);
			$table->integer('operator_id')->comment('8=zain , 50 ooredo , 51= viva');
			$table->integer('ooredoo_notify_id')->unsigned()->nullable()->index('ooredoo_notify_id_3');
			$table->integer('ads_ur_id')->unsigned()->nullable()->index('ads_ur_id');
			$table->string('transaction_id', 500)->nullable();
			$table->enum('ad_company', array('headway','intech','DF'))->nullable();
			$table->boolean('final_status')->nullable()->comment('0=not active  , 1 active ');
			$table->timestamps();
			$table->string('pincode', 10)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('msisdns');
	}

}
