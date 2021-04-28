<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    private function _getSeeder()
    {
        return [
            PermissionTableSeeder::class,
            UsersTableSeeder::class,
            MasterMemberTableSeeder::class,
            BenefitTableSeeder::class,
            ProvincesTableSeeder::class,
            RegenciesTableSeeder::class,
        ];
    }

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Artisan::call('passport:install');
        
        foreach ($this->_getSeeder() as $seeder)
            $this->call($seeder);
    }
}
