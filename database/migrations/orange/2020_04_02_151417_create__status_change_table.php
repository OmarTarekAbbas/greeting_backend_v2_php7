<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatusChangeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statuschanges', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('serviceId');
            $table->string('subscContractId');
            $table->string('statusId');
            $table->string('statusChangeDesc')->nullable();
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
        Schema::dropIfExists('_status_change');
    }
}
