<?php

use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('countries')->delete();
        
        \DB::table('countries')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Egypt',
                'created_at' => '2015-09-08 14:28:15',
                'updated_at' => '2015-09-08 14:28:15',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Algeria',
                'created_at' => '2015-09-09 07:59:43',
                'updated_at' => '2015-09-09 07:59:43',
            ),
            2 => 
            array (
                'id' => 5,
                'name' => 'Kuwait',
                'created_at' => '2015-09-13 15:01:32',
                'updated_at' => '2015-09-13 15:01:32',
            ),
            3 => 
            array (
                'id' => 6,
                'name' => 'Austria',
                'created_at' => '2015-09-14 08:08:25',
                'updated_at' => '2015-09-14 08:08:25',
            ),
            4 => 
            array (
                'id' => 7,
                'name' => 'Bahrain',
                'created_at' => '2015-09-14 08:08:41',
                'updated_at' => '2015-09-14 08:08:41',
            ),
            5 => 
            array (
                'id' => 9,
                'name' => 'Saudi Arabia',
                'created_at' => '2015-09-14 09:26:20',
                'updated_at' => '2015-09-14 09:26:20',
            ),
            6 => 
            array (
                'id' => 10,
                'name' => 'Yemen',
                'created_at' => '2015-09-14 11:37:35',
                'updated_at' => '2015-09-14 11:37:35',
            ),
            7 => 
            array (
                'id' => 11,
                'name' => 'Jordan',
                'created_at' => '2015-09-14 12:58:15',
                'updated_at' => '2015-09-14 12:58:15',
            ),
            8 => 
            array (
                'id' => 12,
                'name' => 'Sudan',
                'created_at' => '2015-09-14 12:58:22',
                'updated_at' => '2015-09-14 12:58:22',
            ),
        ));
        
        
    }
}
