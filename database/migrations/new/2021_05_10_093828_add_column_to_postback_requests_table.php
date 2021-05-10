<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToPostbackRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('postback_requests', function (Blueprint $table) {
            $table->string("operator_id")->nullable();
            $table->string("click_id")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('postback_requests', function (Blueprint $table) {
          $table->dropColum("operator_id");
          $table->dropColum("click_id");
        });
    }
}
