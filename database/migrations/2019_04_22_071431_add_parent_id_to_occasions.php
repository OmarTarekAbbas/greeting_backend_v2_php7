<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddParentIdToOccasions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('occasions', function(Blueprint $table)
      {
        $table->integer('parent_id')->unsigned()->nullable()->after('image');
        $table->foreign('parent_id')->references('id')->on('occasions')->onUpdate('CASCADE')->onDelete('CASCADE');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('occasions', function(Blueprint $table)
      {
        $table->dropForeign('parent_id');
      });
    }
}
