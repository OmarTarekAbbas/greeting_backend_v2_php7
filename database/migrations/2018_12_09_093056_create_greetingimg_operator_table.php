<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGreetingimgOperatorTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('greetingimg_operator', function(Blueprint $table)
        {
            $table->integer('greetingimg_id')->unsigned()->index();
            $table->integer('operator_id')->unsigned()->index();
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
        Schema::drop('greetingimg_operator');
    }

}
