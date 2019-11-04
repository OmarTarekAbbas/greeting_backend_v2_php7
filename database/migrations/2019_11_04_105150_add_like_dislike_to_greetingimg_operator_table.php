<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLikeDislikeToGreetingimgOperatorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('greetingimg_operator', function (Blueprint $table) {
            $table->integer('like')->after('popular_count');
            $table->integer('dislike')->after('popular_count');
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
            $table->dropColumn('like');
            $table->dropColumn('dislike');
        });
    }
}
