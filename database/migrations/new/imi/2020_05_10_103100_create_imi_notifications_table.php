<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImiNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imi_notifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('link');
            $table->string('msisdn');
            $table->string('svcid');
            $table->string('channel');
            $table->string('action');
            $table->string('status');
            $table->timestamp('Nextrenewaldate');
            $table->string('TransactionID');
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
        Schema::dropIfExists('imi_notifications');
    }
}
