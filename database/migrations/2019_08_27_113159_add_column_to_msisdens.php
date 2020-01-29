<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToMsisdens extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('msisdns', function (Blueprint $table) {
            $table->tinyInteger('plan_id')->comment('1= Postpaid , 2 = Prepaid  , 3 = Data/blacklisted/Non viva numbers');
            $table->date('subscribe_date') ;
            $table->date('renew_date') ;
            $table->enum('type', array('wifi','HE','SMS'))->default('wifi')->comment('wifi= wifi , HE = Header enriched,SMS = SMS');
            $table->string('validityDays',10)->nullable() ;
            $table->string('plan',10)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('msisdns', function (Blueprint $table) {
            $table->dropColumn('plan_id');
            $table->dropColumn('subscribe_date');
            $table->dropColumn('renew_date');
            $table->dropColumn('type');
            $table->dropColumn('validityDays');
            $table->dropColumn('plan');
        });
    }
}
