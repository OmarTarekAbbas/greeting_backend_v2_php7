<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddShortCodeAndRtlToLanguage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('languages', function($table) {
            $table->string('short_code');
            $table->boolean('rtl');
        });
        
        \DB::statement("
            INSERT INTO `languages` (`id`, `title`, `created_at`, `updated_at`, `short_code`, `rtl`) VALUES
            (1, 'English', '2019-11-05 19:34:13', '2019-11-05 19:34:13', 'en', 0),
            (2, 'Arabic', '2019-11-05 19:34:23', '2019-11-05 19:34:23', 'ar', 1);
        ");

        \DB::statement("
        INSERT INTO `static_bodies` (`id`, `language_id`, `static_translation_id`, `body`, `created_at`, `updated_at`) VALUES
            (1,1,4, 'Filters for you', '2019-11-19 12:25:30', '2019-11-19 12:25:30'),
            (2,2,4, 'فلاتر لك', '2019-11-19 12:25:30', '2019-11-19 12:25:30'),
            (3,1,5, 'Search', '2019-11-19 12:27:50', '2019-11-19 12:27:50'),
            (4,2,5, 'بحث', '2019-11-19 12:27:50', '2019-11-19 12:27:50'),
            (5,1,6, 'Most popular', '2019-11-19 12:33:15', '2019-11-19 12:33:15'),
            (6,2,6, 'الاكثر شيوعا', '2019-11-19 12:33:15', '2019-11-19 12:33:15'),
            (7,1,7, 'Liked Filters', '2019-11-19 12:34:04', '2019-11-19 12:34:04'),
            (8,2,7, 'فلاتر اعجبتك', '2019-11-19 12:34:04', '2019-11-19 12:34:04'),
            (9,1,8, 'Most Popular 2', '2019-11-19 12:35:05', '2019-11-19 12:35:05'),
            (10,2,8, 'الاكثر شيوعا 2', '2019-11-19 12:35:05', '2019-11-19 12:35:05'),
            (11,1,9, 'Use Filter', '2019-11-19 12:39:39', '2019-11-19 12:39:39'),
            (12,2,9, 'اسنخدم الفلتر', '2019-11-19 12:39:39', '2019-11-19 12:39:39'),
            (13,1,10, 'Buy Tone', '2019-11-19 12:40:20', '2019-11-19 12:40:20'),
            (14,2,10, 'شراء النغمة', '2019-11-19 12:40:20', '2019-11-19 12:40:20'),
            (15,1,11, 'Close', '2019-11-19 12:40:45', '2019-11-19 12:40:45'),
            (16,2,11, 'الرجوع', '2019-11-19 12:40:45', '2019-11-19 12:40:45'),
            (17,1,12, 'Today Filter', '2019-11-19 12:43:02', '2019-11-19 12:43:02'),
            (18,2,12, 'فلترات اليوم', '2019-11-19 12:43:02', '2019-11-19 12:43:02'),
            (19,1,13, 'Categories', '2019-11-19 12:44:21', '2019-11-19 12:44:21'),
            (20,2,13, 'فئات', '2019-11-19 12:44:21', '2019-11-19 12:44:21'),
            (21,1,14, 'Flatter', '2019-11-20 06:16:54', '2019-11-20 06:16:54'),
            (22,2,14, 'فلاتر', '2019-11-20 06:16:54', '2019-11-20 06:16:54');
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('languages', function($table) {
            $table->dropColumn(['short_code']);
            $table->dropColumn(['rtl']);
        });
    }
}