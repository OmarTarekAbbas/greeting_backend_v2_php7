<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('settings')->delete();
        
        \DB::table('settings')->insert(array (
            0 => 
            array (
                'id' => 1,
                'key' => 'pagination_limit',
                'value' => '3',
                'created_at' => '2018-12-09 13:45:42',
                'updated_at' => '2018-12-09 14:01:22',
            ),
        ));
        
        
    }
}
