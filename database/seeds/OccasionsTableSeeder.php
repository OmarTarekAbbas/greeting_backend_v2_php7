<?php

use Illuminate\Database\Seeder;

class OccasionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('occasions')->delete();

        \DB::table('occasions')->insert(array (
            0 =>
            array (
                'id' => 5,
                'title' => 'المولد النبوى الشريف',
                'category_id' => 1,
                'created_at' => '2015-09-10 07:13:20',
                'updated_at' => '2018-08-14 14:46:10',
                'image' => 'Greetings/Occasion/1534257970.PNG',
                'occasion_EXDate' => '2018-08-14',
                'occasion_EXDate' => '2018-09-14',
            ),
            1 =>
            array (
                'id' => 6,
                'title' => 'عيد الاضحى',
                'category_id' => 1,
                'created_at' => '2015-09-13 20:14:03',
                'updated_at' => '2015-09-14 09:29:42',
                'image' => '',
                'occasion_EXDate' => '2018-08-14',
                'occasion_EXDate' => '2018-09-14',
            ),
            2 =>
            array (
                'id' => 7,
                'title' => 'الإسراء والمعراج',
                'category_id' => 1,
                'created_at' => '2015-09-10 10:21:34',
                'updated_at' => '2015-09-14 09:30:29',
                'image' => '',
                'occasion_EXDate' => '2018-08-14',
                'occasion_EXDate' => '2018-09-14',
            ),
            3 =>
            array (
                'id' => 8,
                'title' => 'وظيفة جديدة',
                'category_id' => 2,
                'created_at' => '2015-09-10 10:21:50',
                'updated_at' => '2015-09-14 09:33:48',
                'occasion_EXDate' => '2018-08-14',
                'occasion_EXDate' => '2018-09-14',
            ),
            4 =>
            array (
                'id' => 12,
                'title' => 'الحج',
                'category_id' => 1,
                'created_at' => '2015-09-13 15:28:47',
                'updated_at' => '2015-09-14 11:14:52',
                'occasion_EXDate' => '2018-08-14',
                'occasion_EXDate' => '2018-09-14',
            ),
            5 =>
            array (
                'id' => 18,
                'title' => 'العيد الوطني ',
                'category_id' => 5,
                'created_at' => '2015-09-16 13:51:05',
                'updated_at' => '2015-09-16 13:51:05',
                'image' => '','occasion_EXDate' => '2018-08-14',
                'occasion_EXDate' => '2018-09-14',
            ),
            6 =>
            array (
                'id' => 19,
                'title' => 'هلا فبراير',
                'category_id' => 2,
                'created_at' => '2015-09-16 13:51:19',
                'updated_at' => '2015-09-16 13:51:19',
                'image' => '',
                'occasion_EXDate' => '2018-08-14',
                'occasion_EXDate' => '2018-09-14',
            ),
            7 =>
            array (
                'id' => 20,
                'title' => 'قرقيعان',
                'category_id' => 2,
                'created_at' => '2015-09-16 13:51:30',
                'updated_at' => '2015-09-16 13:51:30',
                'image' => '',
                'occasion_EXDate' => '2018-08-14',
                'occasion_EXDate' => '2018-09-14',
            ),
            8 =>
            array (
                'id' => 21,
                'title' => 'عيد ميلاد',
                'category_id' => 2,
                'created_at' => '2015-09-16 13:51:53',
                'updated_at' => '2015-09-16 13:51:53',
                'image' => '',
                'occasion_EXDate' => '2018-08-14',
                'occasion_EXDate' => '2018-09-14',
            ),
            9 =>
            array (
                'id' => 22,
                'title' => 'العزاء',
                'category_id' => 1,
                'created_at' => '2015-09-16 14:35:59',
                'updated_at' => '2015-09-16 14:35:59',
                'image' => '',
                'occasion_EXDate' => '2018-08-14',
                'occasion_EXDate' => '2018-09-14',
            ),
            10 =>
            array (
                'id' => 24,
                'title' => 'أذكار الأذان',
                'category_id' => 1,
                'created_at' => '2015-09-16 14:37:16',
                'updated_at' => '2015-09-16 14:37:16',
                'image' => '',
                'occasion_EXDate' => '2018-08-14',
                'occasion_EXDate' => '2018-09-14',
            ),
            11 =>
            array (
                'id' => 25,
                'title' => 'أذكار الخلاء',
                'category_id' => 1,
                'created_at' => '2015-09-16 14:37:37',
                'updated_at' => '2015-09-16 14:37:37',
                'image' => '',
                'occasion_EXDate' => '2018-08-14',
                'occasion_EXDate' => '2018-09-14',
            ),
            12 =>
            array (
                'id' => 26,
                'title' => 'أذكار المسلم',
                'category_id' => 1,
                'created_at' => '2015-09-16 14:38:00',
                'updated_at' => '2015-09-16 14:38:00',
                'image' => '',
                'occasion_EXDate' => '2018-08-14',
                'occasion_EXDate' => '2018-09-14',
            ),
            13 =>
            array (
                'id' => 27,
                'title' => 'أذكار الطعام',
                'category_id' => 1,
                'created_at' => '2015-09-16 14:38:26',
                'updated_at' => '2015-09-16 14:38:26',
                'image' => '',
                'occasion_EXDate' => '2018-08-14',
                'occasion_EXDate' => '2018-09-14',
            ),
            14 =>
            array (
                'id' => 28,
                'title' => 'اذكار الاستيقاظ',
                'category_id' => 1,
                'created_at' => '2015-09-16 14:39:15',
                'updated_at' => '2015-09-16 14:39:15',
                'image' => '',
                'occasion_EXDate' => '2018-08-14',
                'occasion_EXDate' => '2018-09-14',
            ),
            15 =>
            array (
                'id' => 29,
                'title' => 'رمضان',
                'category_id' => 1,
                'created_at' => '2015-09-16 14:41:25',
                'updated_at' => '2015-09-16 14:41:25',
                'image' => '',
                'occasion_EXDate' => '2018-08-14',
                'occasion_EXDate' => '2018-09-14',
            ),
            16 =>
            array (
                'id' => 30,
                'title' => 'مولود جديد',
                'category_id' => 2,
                'created_at' => '2015-09-16 15:30:55',
                'updated_at' => '2015-09-16 15:30:55',
                'image' => '',
                'occasion_EXDate' => '2018-08-14',
                'occasion_EXDate' => '2018-09-14',
            ),
            17 =>
            array (
                'id' => 31,
                'title' => 'رأس السنه الهجريه',
                'category_id' => 1,
                'created_at' => '2015-09-16 15:37:41',
                'updated_at' => '2015-09-16 15:37:41',
                'image' => '',
                'occasion_EXDate' => '2018-08-14',
                'occasion_EXDate' => '2018-09-14',
            ),
            18 =>
            array (
                'id' => 32,
                'title' => 'أذكار الصباح والمساء',
                'category_id' => 1,
                'created_at' => '2015-09-16 15:50:57',
                'updated_at' => '2015-09-16 15:50:57',
                'image' => '',
                'occasion_EXDate' => '2018-08-14',
                'occasion_EXDate' => '2018-09-14',
            ),
            19 =>
            array (
                'id' => 33,
                'title' => 'أذكار الصلاة',
                'category_id' => 1,
                'created_at' => '2015-09-16 15:55:27',
                'updated_at' => '2015-09-16 15:55:27',
                'image' => '',
                'occasion_EXDate' => '2018-08-14',
                'occasion_EXDate' => '2018-09-14',
            ),
            20 =>
            array (
                'id' => 37,
                'title' => 'عيد الزواج',
                'category_id' => 2,
                'created_at' => '2015-09-16 16:31:43',
                'updated_at' => '2015-09-16 16:31:43',
                'image' => '',
                'occasion_EXDate' => '2018-08-14',
                'occasion_EXDate' => '2018-09-14',
            ),
            21 =>
            array (
                'id' => 38,
                'title' => 'عيد الفطر',
                'category_id' => 1,
                'created_at' => '2015-09-16 16:41:37',
                'updated_at' => '2015-09-16 16:41:37',
                'image' => '',
                'occasion_EXDate' => '2018-08-14',
                'occasion_EXDate' => '2018-09-14',
            ),
            22 =>
            array (
                'id' => 39,
                'title' => 'العيد',
                'category_id' => 1,
                'created_at' => '2015-09-17 13:55:16',
                'updated_at' => '2015-09-17 13:55:16',
                'image' => '',
                'occasion_EXDate' => '2018-08-14',
                'occasion_EXDate' => '2018-09-14',
            ),
            23 =>
            array (
                'id' => 40,
                'title' => 'بطاقات العائلة',
                'category_id' => 2,
                'created_at' => '2015-09-22 18:46:32',
                'updated_at' => '2015-09-23 15:22:38',
                'image' => '',
                'occasion_EXDate' => '2018-08-14',
                'occasion_EXDate' => '2018-09-14',
            ),
            24 =>
            array (
                'id' => 41,
                'title' => 'ذكرى سنوية',
                'category_id' => 2,
                'created_at' => '2015-11-17 10:04:22',
                'updated_at' => '2015-11-17 10:04:22',
                'image' => '',
                'occasion_EXDate' => '2018-08-14',
                'occasion_EXDate' => '2018-09-14',
            ),
            25 =>
            array (
                'id' => 42,
                'title' => 'تهنئة',
                'category_id' => 2,
                'created_at' => '2015-11-22 08:57:28',
                'updated_at' => '2015-11-22 08:57:28',
                'image' => '',
                'occasion_EXDate' => '2018-08-14',
                'occasion_EXDate' => '2018-09-14',
            ),
            26 =>
            array (
                'id' => 43,
                'title' => 'اصدقاء',
                'category_id' => 2,
                'created_at' => '2015-11-22 08:58:35',
                'updated_at' => '2015-11-22 08:58:35',
                'image' => '',
                'occasion_EXDate' => '2018-08-14',
                'occasion_EXDate' => '2018-09-14',
            ),
            27 =>
            array (
                'id' => 44,
                'title' => 'عام جديد',
                'category_id' => 2,
                'created_at' => '2015-11-22 09:00:55',
                'updated_at' => '2015-11-22 09:00:55',
                'image' => '',
                'occasion_EXDate' => '2018-08-14',
                'occasion_EXDate' => '2018-09-14',
            ),
            28 =>
            array (
                'id' => 46,
                'title' => 'test occasion1',
                'category_id' => 7,
                'created_at' => '2016-02-21 12:32:49',
                'updated_at' => '2016-02-22 14:47:40',
                'image' => '',
                'occasion_EXDate' => '2018-08-14',
                'occasion_EXDate' => '2018-09-14',
            ),
            29 =>
            array (
                'id' => 47,
                'title' => 'test occasion2',
                'category_id' => 7,
                'created_at' => '2016-02-22 14:47:53',
                'updated_at' => '2016-02-22 14:47:53',
                'image' => '',
                'occasion_EXDate' => '2018-08-14',
                'occasion_EXDate' => '2018-09-14',
            ),
            30 =>
            array (
                'id' => 48,
                'title' => 'test 1',
                'category_id' => 1,
                'created_at' => '2018-08-14 14:24:22',
                'updated_at' => '2018-08-14 14:42:58',
                'image' => 'Greetings/Occasion/1534257778.png',
                'occasion_EXDate' => '2018-08-14',
                'occasion_EXDate' => '2018-09-14',
            ),
            31 =>
            array (
                'id' => 49,
                'title' => 'deja vu',
                'category_id' => 3,
                'created_at' => '2018-08-14 14:44:02',
                'updated_at' => '2018-08-14 14:44:02',
                'image' => 'Greetings/Occasion/1534257842.jpg',
                'occasion_EXDate' => '2018-08-14',
                'occasion_EXDate' => '2018-09-14',
            ),
        ));


    }
}
