<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostbackRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postback_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->text('req');
            $table->text('response');
            $table->string('msisdn',191);
            $table->integer('notification_id');
            $table->integer('status')->default('0')->comment('1 = success /0 = failed');
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
        Schema::dropIfExists('postback_requests');
    }
}
