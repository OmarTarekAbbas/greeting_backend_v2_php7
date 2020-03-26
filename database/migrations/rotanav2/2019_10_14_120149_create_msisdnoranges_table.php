<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMsisdnorangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('msisdnoranges', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('msisdn', 20);
            $table->integer('contract_id')->nullable();
            $table->string('operatorCode', 10)->nullable();
			$table->boolean('final_status')->nullable()->comment('0=not active  , 1 active ');
			$table->string('pincode', 10)->nullable();
            $table->string('status', 30)->nullable()->comment('active,inactive');
            $table->enum('subscribe_type', array('MB', 'HE'))->default('MB')->comment('MB= Mobile Box , HE = Header enriched');
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
        Schema::dropIfExists('msisdnoranges');
    }
}
