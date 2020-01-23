<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNullValueToGreetingimgs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('occasions', function (Blueprint $table) {
            $table->integer('category_id')->nullable()->unsigned()->change();
            $table->integer('parent_id')->nullable()->unsigned()->change();
        });
        Schema::table('greetingimgs', function (Blueprint $table) {
            $table->integer('occasion_id')->nullable()->unsigned()->change();
        });
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
