<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameMONotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('m_o_notifications', 'mobily_notifications');
        Schema::dropIfExists('opt_in_notifications');
        Schema::dropIfExists('optout_notifications');
        Schema::dropIfExists('renewal_notifications');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
