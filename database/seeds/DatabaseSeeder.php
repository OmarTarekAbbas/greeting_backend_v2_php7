<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call(UserTableSeeder::class);

        Model::reguard();        
       $this->call('CountriesTableSeeder');  
       $this->call('CategoriesTableSeeder');
       $this->call('OperatorsTableSeeder');
       $this->call('OccasionsTableSeeder');
       $this->call('CprovidersTableSeeder');
       $this->call('GreetingaudiosTableSeeder');
       $this->call('RbtCodesTableSeeder');
       $this->call('GeneratedurlsTableSeeder');
       $this->call('GreetingimgsTableSeeder');
       $this->call('MigrationsTableSeeder');
       $this->call('PasswordResetsTableSeeder');
       $this->call('ProcessedimgsTableSeeder');
       $this->call('ProcessedvidsTableSeeder');
       $this->call('UsersTableSeeder');
    $this->call('SettingsTableSeeder');
    }
}
