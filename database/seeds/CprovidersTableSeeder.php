<?php

use Illuminate\Database\Seeder;

class CprovidersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('cproviders')->delete();
        
        \DB::table('cproviders')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'الشيخ مشاري العفاسي',
                'created_at' => '2015-09-08 14:30:57',
                'updated_at' => '2015-09-14 10:52:51',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'الشاعر حامد زيد ',
                'created_at' => '2015-09-09 08:04:00',
                'updated_at' => '2015-09-14 10:53:10',
            ),
            2 => 
            array (
                'id' => 5,
                'name' => 'قرقيعان',
                'created_at' => '2015-09-16 17:19:20',
                'updated_at' => '2015-09-16 17:19:20',
            ),
            3 => 
            array (
                'id' => 7,
                'name' => 'provider test',
                'created_at' => '2016-02-22 09:48:23',
                'updated_at' => '2016-02-22 10:39:50',
            ),
        ));
        
        
    }
}
