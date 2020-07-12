<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypeToNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mobily_notifications', function (Blueprint $table) {
            $table->string('type', 20);
        });
        Schema::table('mobily_subscribers', function(Blueprint $table)
        {
            $table->foreign('notificationId','mobily_subs_ibfk_1')->references('id')->on('mobily_notifications')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
        Schema::table('mobily_unsubscribers', function(Blueprint $table)
        {
            $table->foreign('notificationId','mmobily_unsubscribers_ibfk_1')->references('id')->on('mobily_notifications')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notifications', function (Blueprint $table) {
            //
        });
    }
}
