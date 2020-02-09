<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaticTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('static_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('key_word');
            $table->timestamps();
        });

        \DB::statement("
            INSERT INTO `static_translations` (`id`, `key_word`, `created_at`, `updated_at`) VALUES
            (4, 'filter4you', '2019-11-19 12:25:30', '2019-11-19 12:25:30'),
            (5, 'search', '2019-11-19 12:27:50', '2019-11-19 12:27:50'),
            (6, 'mostp', '2019-11-19 12:33:15', '2019-11-19 12:33:15'),
            (7, 'likedf', '2019-11-19 12:34:04', '2019-11-19 12:34:04'),
            (8, 'mostp2', '2019-11-19 12:35:05', '2019-11-19 12:35:05'),
            (9, 'usefilter', '2019-11-19 12:39:39', '2019-11-19 12:39:39'),
            (10, 'buytone', '2019-11-19 12:40:20', '2019-11-19 12:40:20'),
            (11, 'close', '2019-11-19 12:40:45', '2019-11-19 12:40:45'),
            (12, 'todayfilter', '2019-11-19 12:43:02', '2019-11-19 12:43:02'),
            (13, 'categ', '2019-11-19 12:44:21', '2019-11-19 12:44:21'),
            (14, 'home', '2019-11-20 06:16:54', '2019-11-20 06:16:54');
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('static_translations');
    }
}
