<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPaginationSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('settings')->insert(
            array(
                array(
                    'key' => 'pagination_limit',
                    'value' => '13',
                ),array(
                    'key' => 'only_favorites',
                    'value' => '0',
                ),array(
                    'key' => 'pagination_slider',
                    'value' => '6',
                )
            )
        );
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
