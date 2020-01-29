<?php

use Illuminate\Database\Seeder;

class MigrationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('migrations')->delete();
        
        \DB::table('migrations')->insert(array (
            0 => 
            array (
                'migration' => '2014_10_12_000000_create_users_table',
                'batch' => 1,
            ),
            1 => 
            array (
                'migration' => '2014_10_12_100000_create_password_resets_table',
                'batch' => 1,
            ),
            2 => 
            array (
                'migration' => '2015_08_18_111124_countries',
                'batch' => 1,
            ),
            3 => 
            array (
                'migration' => '2015_08_18_111143_operators',
                'batch' => 1,
            ),
            4 => 
            array (
                'migration' => '2015_08_18_111212_categories',
                'batch' => 1,
            ),
            5 => 
            array (
                'migration' => '2015_08_18_111313_occasions',
                'batch' => 1,
            ),
            6 => 
            array (
                'migration' => '2015_08_18_111355_greetingimgs',
                'batch' => 1,
            ),
            7 => 
            array (
                'migration' => '2015_08_18_111408_create_cproviders_table',
                'batch' => 1,
            ),
            8 => 
            array (
                'migration' => '2015_08_18_111409_greetingaudios',
                'batch' => 1,
            ),
            9 => 
            array (
                'migration' => '2015_08_24_153022_add_gsettings_to_greetingimgs',
                'batch' => 1,
            ),
            10 => 
            array (
                'migration' => '2015_08_27_161605_create_processedimgs_table',
                'batch' => 1,
            ),
            11 => 
            array (
                'migration' => '2015_08_30_122908_create_processedvids_table',
                'batch' => 1,
            ),
            12 => 
            array (
                'migration' => '2015_08_31_093050_create_generatedurls_table',
                'batch' => 1,
            ),
            13 => 
            array (
                'migration' => '2014_10_12_000000_create_users_table',
                'batch' => 1,
            ),
            14 => 
            array (
                'migration' => '2014_10_12_100000_create_password_resets_table',
                'batch' => 1,
            ),
            15 => 
            array (
                'migration' => '2015_08_18_111124_countries',
                'batch' => 1,
            ),
            16 => 
            array (
                'migration' => '2015_08_18_111143_operators',
                'batch' => 1,
            ),
            17 => 
            array (
                'migration' => '2015_08_18_111212_categories',
                'batch' => 1,
            ),
            18 => 
            array (
                'migration' => '2015_08_18_111313_occasions',
                'batch' => 1,
            ),
            19 => 
            array (
                'migration' => '2015_08_18_111355_greetingimgs',
                'batch' => 1,
            ),
            20 => 
            array (
                'migration' => '2015_08_18_111408_create_cproviders_table',
                'batch' => 1,
            ),
            21 => 
            array (
                'migration' => '2015_08_18_111409_greetingaudios',
                'batch' => 1,
            ),
            22 => 
            array (
                'migration' => '2015_08_24_153022_add_gsettings_to_greetingimgs',
                'batch' => 1,
            ),
            23 => 
            array (
                'migration' => '2015_08_27_161605_create_processedimgs_table',
                'batch' => 1,
            ),
            24 => 
            array (
                'migration' => '2015_08_30_122908_create_processedvids_table',
                'batch' => 1,
            ),
            25 => 
            array (
                'migration' => '2015_08_31_093050_create_generatedurls_table',
                'batch' => 1,
            ),
            26 => 
            array (
                'migration' => '2018_06_06_091539_AddColumnsToGeneratedurlsTable',
                'batch' => 2,
            ),
            27 => 
            array (
                'migration' => '2018_08_14_103900_add_flag_to_audio_table',
                'batch' => 3,
            ),
            28 => 
            array (
                'migration' => '2018_08_14_110039_add_flag_to_operators_table',
                'batch' => 3,
            ),
            29 => 
            array (
                'migration' => '2018_08_14_110645_add_flag_to_images_table',
                'batch' => 3,
            ),
            30 => 
            array (
                'migration' => '2018_08_14_110903_create_rbt_codes_table',
                'batch' => 3,
            ),
            31 => 
            array (
                'migration' => '2018_08_14_141520_add_image_to_occasion',
                'batch' => 4,
            ),
        ));
        
        
    }
}
