<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVidLinkToGreetingimg extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('greetingimgs', function (Blueprint $table) {
            $table->string('vid_path')->nullable()->after('path');
            $table->string('vid_type')->nullable()->after('path');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('greetingimgs', function (Blueprint $table) {
            $table->dropColumn('vid_path');
            $table->dropColumn('vid_type');
        });
    }
}
