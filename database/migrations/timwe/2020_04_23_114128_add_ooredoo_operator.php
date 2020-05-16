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
      \DB::statement("INSERT INTO `countries` (`id`, `title`, `created_at`, `updated_at`) VALUES
      (6, 'qautar', '2020-04-22 13:56:08', '2020-04-22 13:56:08');");
      \DB::statement("INSERT INTO `operators` (`id`, `name`, `operator_image`, `created_at`, `updated_at`, `code`, `country_id`) VALUES
      (12, 'ooredoo', 'uploads/operators/5ea0694c3210a.png', '2020-04-22 13:57:00', '2020-04-22 13:57:00', 12121, 6);");
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
