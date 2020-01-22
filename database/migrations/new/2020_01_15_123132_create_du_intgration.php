<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDuIntgration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('du_integration', function (Blueprint $table) {
            //
          // $uuid = DB::raw('select UUID()');
            $table->increments('id', true);
            $table->string('url', 400);
            $table->uuid('trxid');
            $table->string('uid',20);  // msisdn
            $table->string('serviceid',20);
            $table->string('plan',10);
            $table->string('price',10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('du_integration', function (Blueprint $table) {
            //
        });
    }
}
