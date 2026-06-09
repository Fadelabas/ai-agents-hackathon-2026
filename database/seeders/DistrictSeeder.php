<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistrictSeeder extends Seeder
{
    public function run(): void
    {
        // Get governorate IDs
        $beirut      = DB::table('governorates')->where('name_en', 'Beirut')->value('id');
        $mountLebanon = DB::table('governorates')->where('name_en', 'Mount Lebanon')->value('id');
        $north       = DB::table('governorates')->where('name_en', 'North Lebanon')->value('id');
        $south       = DB::table('governorates')->where('name_en', 'South Lebanon')->value('id');
        $nabatieh    = DB::table('governorates')->where('name_en', 'Nabatieh')->value('id');
        $bekaa       = DB::table('governorates')->where('name_en', 'Bekaa')->value('id');
        $baalbek     = DB::table('governorates')->where('name_en', 'Baalbek-Hermel')->value('id');
        $akkar       = DB::table('governorates')->where('name_en', 'Akkar')->value('id');

        $districts = [
            // Beirut
            ['governorate_id' => $beirut,       'name_en' => 'Beirut',              'name_ar' => 'بيروت'],

            // Mount Lebanon
            ['governorate_id' => $mountLebanon, 'name_en' => 'Baabda',              'name_ar' => 'بعبدا'],
            ['governorate_id' => $mountLebanon, 'name_en' => 'Metn',                'name_ar' => 'المتن'],
            ['governorate_id' => $mountLebanon, 'name_en' => 'Kesrouan',            'name_ar' => 'كسروان'],
            ['governorate_id' => $mountLebanon, 'name_en' => 'Jbeil',               'name_ar' => 'جبيل'],
            ['governorate_id' => $mountLebanon, 'name_en' => 'Chouf',               'name_ar' => 'الشوف'],
            ['governorate_id' => $mountLebanon, 'name_en' => 'Aley',                'name_ar' => 'عاليه'],

            // North Lebanon
            ['governorate_id' => $north,        'name_en' => 'Tripoli',             'name_ar' => 'طرابلس'],
            ['governorate_id' => $north,        'name_en' => 'Koura',               'name_ar' => 'الكورة'],
            ['governorate_id' => $north,        'name_en' => 'Batroun',             'name_ar' => 'البترون'],
            ['governorate_id' => $north,        'name_en' => 'Zgharta',             'name_ar' => 'زغرتا'],
            ['governorate_id' => $north,        'name_en' => 'Bcharre',             'name_ar' => 'بشري'],
            ['governorate_id' => $north,        'name_en' => 'Miniyeh-Danniyeh',    'name_ar' => 'المنية الضنية'],

            // South Lebanon
            ['governorate_id' => $south,        'name_en' => 'Sidon',               'name_ar' => 'صيدا'],
            ['governorate_id' => $south,        'name_en' => 'Tyre',                'name_ar' => 'صور'],
            ['governorate_id' => $south,        'name_en' => 'Jezzine',             'name_ar' => 'جزين'],

            // Nabatieh
            ['governorate_id' => $nabatieh,     'name_en' => 'Nabatieh',            'name_ar' => 'النبطية'],
            ['governorate_id' => $nabatieh,     'name_en' => 'Bint Jbeil',          'name_ar' => 'بنت جبيل'],
            ['governorate_id' => $nabatieh,     'name_en' => 'Hasbaya',             'name_ar' => 'حاصبيا'],
            ['governorate_id' => $nabatieh,     'name_en' => 'Marjeyoun',           'name_ar' => 'مرجعيون'],

            // Bekaa
            ['governorate_id' => $bekaa,        'name_en' => 'Zahleh',              'name_ar' => 'زحلة'],
            ['governorate_id' => $bekaa,        'name_en' => 'West Bekaa',          'name_ar' => 'البقاع الغربي'],
            ['governorate_id' => $bekaa,        'name_en' => 'Rashaya',             'name_ar' => 'راشيا'],

            // Baalbek-Hermel
            ['governorate_id' => $baalbek,      'name_en' => 'Baalbek',             'name_ar' => 'بعلبك'],
            ['governorate_id' => $baalbek,      'name_en' => 'Hermel',              'name_ar' => 'الهرمل'],

            // Akkar
            ['governorate_id' => $akkar,        'name_en' => 'Akkar',               'name_ar' => 'عكار'],
        ];

        DB::table('districts')->insert($districts);
    }
}