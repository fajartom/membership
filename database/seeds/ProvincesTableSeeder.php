<?php

use Illuminate\Database\Seeder;

class ProvincesTableSeeder extends Seeder
{
    private function _getData()
    {
        return [
            ['id_province' => 11, 'name' => "ACEH"],
            ['id_province' => 12, 'name' => "SUMATERA UTARA"],
            ['id_province' => 13, 'name' => "SUMATERA BARAT"],
            ['id_province' => 14, 'name' => "RIAU"],
            ['id_province' => 15, 'name' => "JAMBI"],
            ['id_province' => 16, 'name' => "SUMATERA SELATAN"],
            ['id_province' => 17, 'name' => "BENGKULU"],
            ['id_province' => 18, 'name' => "LAMPUNG"],
            ['id_province' => 19, 'name' => "KEPULAUAN BANGKA BELITUNG"],
            ['id_province' => 21, 'name' => "KEPULAUAN RIAU"],
            ['id_province' => 31, 'name' => "DKI JAKARTA"],
            ['id_province' => 32, 'name' => "JAWA BARAT"],
            ['id_province' => 33, 'name' => "JAWA TENGAH"],
            ['id_province' => 34, 'name' => "DI YOGYAKARTA"],
            ['id_province' => 35, 'name' => "JAWA TIMUR"],
            ['id_province' => 36, 'name' => "BANTEN"],
            ['id_province' => 51, 'name' => "BALI"],
            ['id_province' => 52, 'name' => "NUSA TENGGARA BARAT"],
            ['id_province' => 53, 'name' => "NUSA TENGGARA TIMUR"],
            ['id_province' => 61, 'name' => "KALIMANTAN BARAT"],
            ['id_province' => 62, 'name' => "KALIMANTAN TENGAH"],
            ['id_province' => 63, 'name' => "KALIMANTAN SELATAN"],
            ['id_province' => 64, 'name' => "KALIMANTAN TIMUR"],
            ['id_province' => 65, 'name' => "KALIMANTAN UTARA"],
            ['id_province' => 71, 'name' => "SULAWESI UTARA"],
            ['id_province' => 72, 'name' => "SULAWESI TENGAH"],
            ['id_province' => 73, 'name' => "SULAWESI SELATAN"],
            ['id_province' => 74, 'name' => "SULAWESI TENGGARA"],
            ['id_province' => 75, 'name' => "GORONTALO"],
            ['id_province' => 76, 'name' => "SULAWESI BARAT"],
            ['id_province' => 81, 'name' => "MALUKU"],
            ['id_province' => 82, 'name' => "MALUKU UTARA"],
            ['id_province' => 91, 'name' => "PAPUA BARAT"],
            ['id_province' => 94, 'name' => "PAPUA"],
        ];
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('provinces')->insert($this->_getData());
        
        DB::select(DB::raw("
            SELECT SETVAL(
                '\"provinces_id_province_seq\"', 
                (SELECT MAX(id_province) FROM provinces),
                false
            )
        "));
    }
}
