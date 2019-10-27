<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeRbtSmsInOperatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('operators', function (Blueprint $table) {
            $table->string('rbt_sms')->nullable()->change();
            $table->integer('close')->default(0)->change();
        });
        Schema::table('occasions', function (Blueprint $table) {
            $table->string('image')->nullable()->change();
        });
        Schema::table('greetingimgs', function (Blueprint $table) {
            $table->integer('popular_count')->default(0)->change();
            $table->string('snap_link')->nullable()->change();
        });
        Schema::table('greetingaudios', function (Blueprint $table) {
            $table->integer('popular_count')->default(0)->change();
        });
        Schema::table('generatedurls', function (Blueprint $table) {
            $table->string('url_occasion_image')->nullable()->change();
            $table->bigInteger('UID')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
