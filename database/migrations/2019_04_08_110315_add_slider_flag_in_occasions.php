<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSliderFlagInOccasions extends Migration
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
        $table->Integer('slider')->default(0);
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
        $table->dropColumn('slider');
      });
    }
}
