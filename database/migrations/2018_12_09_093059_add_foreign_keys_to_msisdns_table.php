<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToMsisdnsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('msisdns', function(Blueprint $table)
		{
			$table->foreign('ads_ur_id', 'msisdns_ibfk_1')->references('id')->on('advertising_urls')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('ooredoo_notify_id', 'msisdns_ibfk_2')->references('id')->on('notify')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('msisdns', function(Blueprint $table)
		{
			$table->dropForeign('msisdns_ibfk_1');
			$table->dropForeign('msisdns_ibfk_2');
		});
	}

}
