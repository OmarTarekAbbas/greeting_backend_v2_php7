<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForginKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        \DB::statement('ALTER TABLE occasions ENGINE=INNODB;');
        \DB::statement('ALTER TABLE categories ENGINE=INNODB;');
        Schema::table('occasions', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('categories')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('parent_id')->references('id')->on('occasions')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
        Schema::table('greetingimgs', function (Blueprint $table) {
            $table->foreign('occasion_id')->references('id')->on('occasions')->onUpdate('CASCADE')->onDelete('CASCADE');
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
