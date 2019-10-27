<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPopularCountToGreetingimgOperatorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('greetingimg_operator', function (Blueprint $table)
        {
            $table->Increments('id');
            $table->integer('popular_count')->after('operator_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('greetingimg_operator', function (Blueprint $table) {
            //
        });
    }
}
