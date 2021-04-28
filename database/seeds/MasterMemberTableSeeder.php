<?php

use Illuminate\Database\Seeder;

class MasterMemberTableSeeder extends Seeder
{
    private function _getData()
    {
        return [
            [
                'name' => 'SILVER',
                'periode' => '3',
                'amount' => '15000',
                'author' => '1',
                'domain' => env('APP_DOMAIN'),
            ],
            [
                'name' => 'GOLD',
                'periode' => '3',
                'amount' => '35000',
                'author' => '1',
                'domain' => env('APP_DOMAIN'),
            ],
            [
                'name' => 'PLATINUM',
                'periode' => '3',
                'amount' => '50000',
                'author' => '1',
                'domain' => env('APP_DOMAIN'),
            ],
        ];
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('master_member')->insert($this->_getData());
    }
}
