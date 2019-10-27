<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMsisdnGreetingimgsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('msisdn_greetingimgs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('greetingimg_id')->unsigned();
            $table->integer('msisdn_id');
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
        Schema::drop('msisdn_greetingimgs');
    }
}
