<?php

use Illuminate\Database\Seeder;

class RbtCodesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('rbt_codes')->delete();
        
        \DB::table('rbt_codes')->insert(array (
            0 => 
            array (
                'id' => 3,
                'audio_id' => 8,
                'operator_id' => 8,
                'code' => '1333',
                'created_at' => '2018-08-15 11:03:33',
                'updated_at' => '2018-08-15 12:20:54',
            ),
            1 => 
            array (
                'id' => 4,
                'audio_id' => 8,
                'operator_id' => 13,
                'code' => '5656',
                'created_at' => '2018-08-15 11:03:33',
                'updated_at' => '2018-08-15 12:21:04',
            ),
            2 => 
            array (
                'id' => 5,
                'audio_id' => 8,
                'operator_id' => 19,
                'code' => '86784',
                'created_at' => '2018-08-15 11:03:33',
                'updated_at' => '2018-08-15 11:03:33',
            ),
            3 => 
            array (
                'id' => 12,
                'audio_id' => 8,
                'operator_id' => 17,
                'code' => '1234',
                'created_at' => '2018-08-15 12:18:25',
                'updated_at' => '2018-08-15 12:18:25',
            ),
            4 => 
            array (
                'id' => 13,
                'audio_id' => 83,
                'operator_id' => 14,
                'code' => '5644',
                'created_at' => '2018-08-15 13:30:01',
                'updated_at' => '2018-08-15 13:30:01',
            ),
        ));
        
        
    }
}
