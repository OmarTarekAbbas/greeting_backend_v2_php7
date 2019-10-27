<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForginKeyToMsisdnFreetingimgs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('msisdn_greetingimgs', function(Blueprint $table)
      {
        $table->foreign('greetingimg_id','msisdn_greetingimgs_ibfk_1')->references('id')->on('greetingimgs')->onUpdate('CASCADE')->onDelete('CASCADE');
        $table->foreign('msisdn_id','msisdn_greetingimgs_ibfk_2')->references('id')->on('msisdns')->onUpdate('CASCADE')->onDelete('CASCADE');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('msisdn_greetingimgs', function(Blueprint $table)
      {
        $table->dropForeign('msisdn_greetingimgs_ibfk_1');
        $table->dropForeign('msisdn_greetingimgs_ibfk_2');
      });
    }
}
