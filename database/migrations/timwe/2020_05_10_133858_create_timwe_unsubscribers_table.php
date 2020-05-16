<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimweUnsubscribersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timwe_unsubscribers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('msisdn');
            $table->string('serviceId');
            $table->string('requestId');
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
        Schema::dropIfExists('timwe_unsubscribers');
    }
}
