<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('categories')->delete();
        
        \DB::table('categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => 'Islamic',
                'created_at' => '2015-09-08 14:28:39',
                'updated_at' => '2015-09-14 09:27:45',
            ),
            1 => 
            array (
                'id' => 2,
                'title' => 'Entertainment',
                'created_at' => '2015-09-08 14:46:39',
                'updated_at' => '2015-09-14 09:28:22',
            ),
            2 => 
            array (
                'id' => 3,
                'title' => 'Poems',
                'created_at' => '2015-09-09 12:02:46',
                'updated_at' => '2015-09-14 09:28:58',
            ),
            3 => 
            array (
                'id' => 5,
                'title' => 'National Day',
                'created_at' => '2015-09-16 13:50:46',
                'updated_at' => '2015-09-16 13:50:46',
            ),
            4 => 
            array (
                'id' => 7,
                'title' => 'test category',
                'created_at' => '2016-02-21 12:32:04',
                'updated_at' => '2016-02-21 12:32:04',
            ),
        ));
        
        
    }
}
