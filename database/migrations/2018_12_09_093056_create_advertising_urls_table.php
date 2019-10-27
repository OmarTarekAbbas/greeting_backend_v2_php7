<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAdvertisingUrlsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('advertising_urls', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('adv_url')->nullable();
			$table->string('transaction_id');
			$table->string('msisdn', 20)->nullable();
			$table->integer('operatorId')->nullable();
			$table->string('operatorName', 20)->nullable();
			$table->boolean('status')->nullable()->comment('0=hit from adv company , 1= subscription success , 2 = subscription fail  , 3 = renew success');
			$table->timestamps();
			$table->string('publisherId_macro', 500)->nullable();
			$table->string('mobrain_token', 500)->nullable();
			$table->enum('ads_compnay_name', array('intech','headway','DF'))->default('DF');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('advertising_urls');
	}

}
