<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimWesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tim_wes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('api_request')->nullable();
            $table->longText('payload')->nullable();
            $table->longText('response')->nullable();
            $table->longText('header')->nullable();
            $table->string('type')->nullable();
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
        Schema::dropIfExists('tim_wes');
    }
}
