<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $idnStates = [
            "AC" => 'Nanggroe Aceh Darussalam',
            "SU" => 'Sumatra Utara',
            "SB" => 'Sumatra Barat',
            "RI" => 'Riau',
            "KR" => 'Kepulauan Riau',
            "JK" => 'DKI Jakarta',
            "JB" => 'Jawa Barat',
        ];
        $countries = [
            ['code' => 'sgp', 'name' => 'Singapore', 'states' => null],
            ['code' => 'mys', 'name' => 'Malaysia', 'states' => null],
            ['code' => 'idn', 'name' => 'Indonesia', 'states' => json_encode($idnStates)],
            ['code' => 'jpn', 'name' => 'Japan', 'states' => null],
        ];
        Country::insert($countries);
    }
}
