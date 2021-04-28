<?php

use Illuminate\Database\Seeder;

class BenefitTableSeeder extends Seeder
{
    private function _getData()
    {
        return [
            [
                'benefit' => 'EXCLUSIVE VIDEO',
                'author' => 1,
                'domain' => env('APP_DOMAIN'),
                'lang' => 'en',
            ],
            [
                'benefit' => 'EXCLUSIVE PHOTO',
                'author' => 1,
                'domain' => env('APP_DOMAIN'),
                'lang' => 'en',
            ],
            [
                'benefit' => 'MEET AND GREET',
                'author' => 1,
                'domain' => env('APP_DOMAIN'),
                'lang' => 'en',
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
        DB::table('benefit')->insert($this->_getData());
    }
}
