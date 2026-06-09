<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GovernorateSeeder extends Seeder
{
    public function run(): void
    {
        $governorates = [
            ['name_en' => 'Beirut',          'name_ar' => 'بيروت'],
            ['name_en' => 'Mount Lebanon',   'name_ar' => 'جبل لبنان'],
            ['name_en' => 'North Lebanon',   'name_ar' => 'لبنان الشمالي'],
            ['name_en' => 'South Lebanon',   'name_ar' => 'لبنان الجنوبي'],
            ['name_en' => 'Nabatieh',        'name_ar' => 'النبطية'],
            ['name_en' => 'Bekaa',           'name_ar' => 'البقاع'],
            ['name_en' => 'Baalbek-Hermel',  'name_ar' => 'بعلبك الهرمل'],
            ['name_en' => 'Akkar',           'name_ar' => 'عكار'],
        ];

        DB::table('governorates')->insert($governorates);
    }
}