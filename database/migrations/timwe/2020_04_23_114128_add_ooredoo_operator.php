<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOoredooOperator extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      \DB::statement("INSERT INTO `countries` (`id`, `name`, `created_at`, `updated_at`) VALUES
      (16, 'qatar', '2020-04-22 13:56:08', '2020-04-22 13:56:08');");
      \DB::statement("INSERT INTO `operators` (`id`, `name`, `created_at`, `updated_at`, `country_id`) VALUES
      (32, 'ooredoo', '2020-04-22 13:57:00', '2020-04-22 13:57:00', 16);");
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
