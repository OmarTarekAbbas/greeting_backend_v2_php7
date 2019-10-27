<?php

use Illuminate\Database\Seeder;

class PasswordResetsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('password_resets')->delete();
        
        \DB::table('password_resets')->insert(array (
            0 => 
            array (
                'email' => 'hany@ivas.mobi',
                'token' => '915d75509b5b3c69e194d5831f5739407b05172e164ce7ed45ed9bcad5328c9f',
                'created_at' => '2015-09-16 16:11:54',
            ),
            1 => 
            array (
                'email' => 'emad@ivas.mobi',
                'token' => '75c4d298e303d0f6ff445930627c7701abe8853c2f306debc52dcc4df3346ce9',
                'created_at' => '2016-02-22 15:36:34',
            ),
        ));
        
        
    }
}
