<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddValueToSetting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES (6, 'enable_parent', '1', '2020-01-22 15:14:17', '2020-01-22 15:16:45')");
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
