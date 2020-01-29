<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLikeDislikeToGreetingimgsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('greetingimgs', function (Blueprint $table) {
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
        Schema::table('greetingimgs', function (Blueprint $table) {
            $table->dropColumn('like');
            $table->dropColumn('dislike');
        });
    }
}
