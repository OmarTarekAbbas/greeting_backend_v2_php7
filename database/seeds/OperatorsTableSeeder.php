<?php

use Illuminate\Database\Seeder;

class OperatorsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('operators')->delete();
        
        \DB::table('operators')->insert(array (
            0 => 
            array (
                'id' => 8,
                'name' => 'Zain',
                'country_id' => 5,
                'created_at' => '2015-09-13 13:02:08',
                'updated_at' => '2015-09-14 09:25:20',
                'rbt_sms' => '',
            ),
            1 => 
            array (
                'id' => 12,
                'name' => 'Ooredoo',
                'country_id' => 5,
                'created_at' => '2015-09-14 09:25:11',
                'updated_at' => '2015-09-14 09:25:11',
                'rbt_sms' => '',
            ),
            2 => 
            array (
                'id' => 13,
                'name' => 'Viva',
                'country_id' => 5,
                'created_at' => '2015-09-14 09:25:31',
                'updated_at' => '2015-09-14 09:25:31',
                'rbt_sms' => '',
            ),
            3 => 
            array (
                'id' => 14,
                'name' => 'Mobily',
                'country_id' => 9,
                'created_at' => '2015-09-14 09:45:02',
                'updated_at' => '2015-09-14 09:45:02',
                'rbt_sms' => '',
            ),
            4 => 
            array (
                'id' => 15,
                'name' => 'STC',
                'country_id' => 9,
                'created_at' => '2015-09-14 09:45:32',
                'updated_at' => '2015-09-14 09:45:32',
                'rbt_sms' => '',
            ),
            5 => 
            array (
                'id' => 16,
                'name' => 'Zain',
                'country_id' => 9,
                'created_at' => '2015-09-14 09:45:55',
                'updated_at' => '2015-09-14 09:45:55',
                'rbt_sms' => '',
            ),
            6 => 
            array (
                'id' => 17,
                'name' => 'Etisalat',
                'country_id' => 1,
                'created_at' => '2015-09-14 10:14:18',
                'updated_at' => '2015-09-14 10:14:18',
                'rbt_sms' => '',
            ),
            7 => 
            array (
                'id' => 18,
                'name' => 'yemen oper',
                'country_id' => 10,
                'created_at' => '2015-09-14 11:37:58',
                'updated_at' => '2015-09-14 11:38:13',
                'rbt_sms' => '',
            ),
            8 => 
            array (
                'id' => 19,
                'name' => 'Zain',
                'country_id' => 11,
                'created_at' => '2015-09-14 12:58:40',
                'updated_at' => '2015-09-14 12:59:09',
                'rbt_sms' => '',
            ),
            9 => 
            array (
                'id' => 20,
                'name' => 'Umniah',
                'country_id' => 11,
                'created_at' => '2015-09-14 12:59:25',
                'updated_at' => '2015-09-14 12:59:25',
                'rbt_sms' => '',
            ),
            10 => 
            array (
                'id' => 21,
                'name' => 'Orange',
                'country_id' => 11,
                'created_at' => '2015-09-14 12:59:45',
                'updated_at' => '2015-09-14 12:59:45',
                'rbt_sms' => '',
            ),
            11 => 
            array (
                'id' => 22,
                'name' => 'Zain',
                'country_id' => 12,
                'created_at' => '2015-09-14 12:59:59',
                'updated_at' => '2015-09-14 12:59:59',
                'rbt_sms' => '',
            ),
            12 => 
            array (
                'id' => 23,
                'name' => 'sarah',
                'country_id' => 2,
                'created_at' => '2018-08-14 14:02:29',
                'updated_at' => '2018-08-14 14:11:02',
                'rbt_sms' => '111',
            ),
        ));
        
        
    }
}
