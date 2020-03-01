<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateForeignOnGreetingimg extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement("SET FOREIGN_KEY_CHECKS=0;");
        Schema::table('greetingimgs', function(Blueprint $table) {
            $table->foreign('occasion_id')->references('id')->on('occasions')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
        \DB::statement("SET FOREIGN_KEY_CHECKS=1;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
