<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreaSeeder extends Seeder
{
    public function run(): void
    {
        // ── District IDs ──────────────────────────────────────────
        $d = [];
        $districts = DB::table('districts')->get();
        foreach ($districts as $district) {
            $d[$district->name_en] = $district->id;
        }

        $areas = [

            // ══════════════════════════════════════════════════════
            // BEIRUT
            // ══════════════════════════════════════════════════════
            ['district_id' => $d['Beirut'], 'name_en' => 'Hamra',               'name_ar' => 'الحمرا',           'type' => 'neighborhood'],
            ['district_id' => $d['Beirut'], 'name_en' => 'Achrafieh',           'name_ar' => 'الأشرفية',         'type' => 'neighborhood'],
            ['district_id' => $d['Beirut'], 'name_en' => 'Verdun',              'name_ar' => 'فردان',            'type' => 'neighborhood'],
            ['district_id' => $d['Beirut'], 'name_en' => 'Badaro',              'name_ar' => 'بدارو',            'type' => 'neighborhood'],
            ['district_id' => $d['Beirut'], 'name_en' => 'Mar Mikhael',         'name_ar' => 'مار مخايل',        'type' => 'neighborhood'],
            ['district_id' => $d['Beirut'], 'name_en' => 'Gemmayzeh',           'name_ar' => 'الجميزة',          'type' => 'neighborhood'],
            ['district_id' => $d['Beirut'], 'name_en' => 'Raouche',             'name_ar' => 'الروشة',           'type' => 'neighborhood'],
            ['district_id' => $d['Beirut'], 'name_en' => 'Sassine',             'name_ar' => 'ساسين',            'type' => 'neighborhood'],
            ['district_id' => $d['Beirut'], 'name_en' => 'Sodeco',              'name_ar' => 'سوديكو',           'type' => 'neighborhood'],
            ['district_id' => $d['Beirut'], 'name_en' => 'Tallet El Khayat',    'name_ar' => 'تلة الخياط',       'type' => 'neighborhood'],
            ['district_id' => $d['Beirut'], 'name_en' => 'Zarif',               'name_ar' => 'الظريف',           'type' => 'neighborhood'],
            ['district_id' => $d['Beirut'], 'name_en' => 'Bourj Hammoud',       'name_ar' => 'برج حمود',         'type' => 'neighborhood'],
            ['district_id' => $d['Beirut'], 'name_en' => 'Ain El Mreisseh',     'name_ar' => 'عين المريسة',      'type' => 'neighborhood'],
            ['district_id' => $d['Beirut'], 'name_en' => 'Manara',              'name_ar' => 'المنارة',          'type' => 'neighborhood'],
            ['district_id' => $d['Beirut'], 'name_en' => 'Clemenceau',          'name_ar' => 'كليمنصو',          'type' => 'neighborhood'],
            ['district_id' => $d['Beirut'], 'name_en' => 'Sanayeh',             'name_ar' => 'الصنائع',          'type' => 'neighborhood'],
            ['district_id' => $d['Beirut'], 'name_en' => 'Barbir',              'name_ar' => 'البربير',          'type' => 'neighborhood'],
            ['district_id' => $d['Beirut'], 'name_en' => 'Bachoura',            'name_ar' => 'باشورة',           'type' => 'neighborhood'],
            ['district_id' => $d['Beirut'], 'name_en' => 'Mathaf',              'name_ar' => 'المتحف',           'type' => 'neighborhood'],
            ['district_id' => $d['Beirut'], 'name_en' => 'Downtown Beirut',     'name_ar' => 'وسط بيروت',        'type' => 'neighborhood'],
            ['district_id' => $d['Beirut'], 'name_en' => 'Karantina',           'name_ar' => 'الكرنتينا',        'type' => 'neighborhood'],
            ['district_id' => $d['Beirut'], 'name_en' => 'Quarantina',          'name_ar' => 'الكرنتينا',        'type' => 'neighborhood'],
            ['district_id' => $d['Beirut'], 'name_en' => 'Dekwaneh Beirut',     'name_ar' => 'الدكوانة بيروت',   'type' => 'neighborhood'],
            ['district_id' => $d['Beirut'], 'name_en' => 'Corniche',            'name_ar' => 'الكورنيش',         'type' => 'neighborhood'],

            // ══════════════════════════════════════════════════════
            // ADDITIONAL METN AREAS
            // ══════════════════════════════════════════════════════
            ['district_id' => $d['Metn'], 'name_en' => 'Bauchrieh',          'name_ar' => 'البوشرية',       'type' => 'neighborhood'],
            ['district_id' => $d['Metn'], 'name_en' => 'Mkalles',            'name_ar' => 'مكلس',           'type' => 'neighborhood'],
            ['district_id' => $d['Metn'], 'name_en' => 'Ain Saadeh',         'name_ar' => 'عين سعادة',      'type' => 'village'],
            ['district_id' => $d['Metn'], 'name_en' => 'Roumieh',            'name_ar' => 'الرومية',        'type' => 'village'],
            ['district_id' => $d['Metn'], 'name_en' => 'Lebanese University Fanar', 'name_ar' => 'الجامعة اللبنانية الفنار', 'type' => 'neighborhood'],
            ['district_id' => $d['Metn'], 'name_en' => 'Sed El Baouchrieh',  'name_ar' => 'سد البوشرية',    'type' => 'neighborhood'],
            ['district_id' => $d['Metn'], 'name_en' => 'Horsh Tabet',        'name_ar' => 'حرش ثابت',       'type' => 'neighborhood'],
            ['district_id' => $d['Metn'], 'name_en' => 'Furn El Chebbak',    'name_ar' => 'فرن الشباك',     'type' => 'neighborhood'],
            ['district_id' => $d['Metn'], 'name_en' => 'Hazmieh Highway',    'name_ar' => 'أوتوستراد الحازمية', 'type' => 'neighborhood'],
            ['district_id' => $d['Metn'], 'name_en' => 'Mtayleb',            'name_ar' => 'مطيلب',          'type' => 'village'],

            // ══════════════════════════════════════════════════════
            // ADDITIONAL BEKAA AREAS
            // ══════════════════════════════════════════════════════
            ['district_id' => $d['Zahleh'],     'name_en' => 'Jdita',         'name_ar' => 'جدita',          'type' => 'village'],
            ['district_id' => $d['Zahleh'],     'name_en' => 'Taanayel',      'name_ar' => 'تعنايل',         'type' => 'village'],
            ['district_id' => $d['Zahleh'],     'name_en' => 'Riyaq',         'name_ar' => 'رياق',           'type' => 'city'],
            ['district_id' => $d['Zahleh'],     'name_en' => 'Terbol',        'name_ar' => 'تربل',           'type' => 'village'],
            ['district_id' => $d['West Bekaa'], 'name_en' => 'Qabb Elias',    'name_ar' => 'قب الياس',       'type' => 'village'],
            ['district_id' => $d['West Bekaa'], 'name_en' => 'Saghbine',      'name_ar' => 'صغبين',          'type' => 'village'],
            ['district_id' => $d['West Bekaa'], 'name_en' => 'Lala',          'name_ar' => 'لالا',           'type' => 'village'],
            ['district_id' => $d['Zahleh'],     'name_en' => 'Ablah',         'name_ar' => 'أبلح',           'type' => 'village'],
            ['district_id' => $d['Zahleh'],     'name_en' => 'Kherbet Qanafar','name_ar' => 'خربة قنافار',   'type' => 'village'],

            // ══════════════════════════════════════════════════════
            // ADDITIONAL BAABDA AREAS
            // ══════════════════════════════════════════════════════
            ['district_id' => $d['Baabda'], 'name_en' => 'Kfarchima',         'name_ar' => 'كفرشيما',        'type' => 'village'],
            ['district_id' => $d['Baabda'], 'name_en' => 'Furn El Hayek',     'name_ar' => 'فرن الحايك',     'type' => 'neighborhood'],
            ['district_id' => $d['Baabda'], 'name_en' => 'Elissar',           'name_ar' => 'إليسار',         'type' => 'neighborhood'],
            ['district_id' => $d['Baabda'], 'name_en' => 'Baalchmay',         'name_ar' => 'بعلشمي',         'type' => 'village'],

            // ══════════════════════════════════════════════════════
            // ADDITIONAL KESROUAN AREAS
            // ══════════════════════════════════════════════════════
            ['district_id' => $d['Kesrouan'], 'name_en' => 'Nahr El Kalb',    'name_ar' => 'نهر الكلب',      'type' => 'neighborhood'],
            ['district_id' => $d['Kesrouan'], 'name_en' => 'Tabarja',         'name_ar' => 'طبرجا',          'type' => 'village'],
            ['district_id' => $d['Kesrouan'], 'name_en' => 'Halat',           'name_ar' => 'هاليه',          'type' => 'village'],
            ['district_id' => $d['Kesrouan'], 'name_en' => 'Bouar',           'name_ar' => 'بوار',           'type' => 'village'],
            ['district_id' => $d['Kesrouan'], 'name_en' => 'Kfar Dibiane',    'name_ar' => 'كفر ذبيان',      'type' => 'village'],

            // ══════════════════════════════════════════════════════
            // ADDITIONAL CHOUF AREAS
            // ══════════════════════════════════════════════════════
            ['district_id' => $d['Chouf'], 'name_en' => 'Rechmaya',           'name_ar' => 'رشميا',          'type' => 'village'],
            ['district_id' => $d['Chouf'], 'name_en' => 'Barouk',             'name_ar' => 'بروك',           'type' => 'village'],
            ['district_id' => $d['Chouf'], 'name_en' => 'Ain Zhalta',         'name_ar' => 'عين زحلتا',      'type' => 'village'],

            // ══════════════════════════════════════════════════════
            // ADDITIONAL SOUTH AREAS
            // ══════════════════════════════════════════════════════
            ['district_id' => $d['Sidon'], 'name_en' => 'Abra',               'name_ar' => 'عبرا',           'type' => 'neighborhood'],
            ['district_id' => $d['Sidon'], 'name_en' => 'Miyeh Miyeh',        'name_ar' => 'مية ومية',       'type' => 'village'],
            ['district_id' => $d['Tyre'],  'name_en' => 'Rashidieh',          'name_ar' => 'الرشيدية',       'type' => 'neighborhood'],
            ['district_id' => $d['Tyre'],  'name_en' => 'Bazourieh',          'name_ar' => 'البازورية',      'type' => 'village'],
            // ══════════════════════════════════════════════════════
            // BAABDA
            // ══════════════════════════════════════════════════════
            ['district_id' => $d['Baabda'], 'name_en' => 'Baabda',              'name_ar' => 'بعبدا',            'type' => 'city'],
            ['district_id' => $d['Baabda'], 'name_en' => 'Hazmieh',             'name_ar' => 'الحازمية',         'type' => 'neighborhood'],
            ['district_id' => $d['Baabda'], 'name_en' => 'Hadath',              'name_ar' => 'الحدث',            'type' => 'city'],
            ['district_id' => $d['Baabda'], 'name_en' => 'Choueifat',           'name_ar' => 'الشويفات',         'type' => 'city'],
            ['district_id' => $d['Baabda'], 'name_en' => 'Khalde',              'name_ar' => 'خلدة',             'type' => 'village'],
            ['district_id' => $d['Baabda'], 'name_en' => 'Bchamoun',            'name_ar' => 'بشامون',           'type' => 'village'],
            ['district_id' => $d['Baabda'], 'name_en' => 'Aramoun',             'name_ar' => 'عرمون',            'type' => 'village'],
            ['district_id' => $d['Baabda'], 'name_en' => 'Laylaki',             'name_ar' => 'ليلكي',            'type' => 'village'],
            ['district_id' => $d['Baabda'], 'name_en' => 'Hammana',             'name_ar' => 'حمانا',            'type' => 'village'],
            ['district_id' => $d['Baabda'], 'name_en' => 'Aley Baabda',         'name_ar' => 'عاليه بعبدا',      'type' => 'village'],
            ['district_id' => $d['Baabda'], 'name_en' => 'Yarze',               'name_ar' => 'يرزة',             'type' => 'neighborhood'],
            ['district_id' => $d['Baabda'], 'name_en' => 'Biyada',              'name_ar' => 'البياضة',          'type' => 'neighborhood'],

            // ══════════════════════════════════════════════════════
            // METN
            // ══════════════════════════════════════════════════════
            ['district_id' => $d['Metn'],   'name_en' => 'Dekwaneh',            'name_ar' => 'الدكوانة',         'type' => 'neighborhood'],
            ['district_id' => $d['Metn'],   'name_en' => 'Jdeideh',             'name_ar' => 'الجديدة',          'type' => 'neighborhood'],
            ['district_id' => $d['Metn'],   'name_en' => 'Antelias',            'name_ar' => 'أنطلياس',          'type' => 'city'],
            ['district_id' => $d['Metn'],   'name_en' => 'Fanar',               'name_ar' => 'الفنار',           'type' => 'neighborhood'],
            ['district_id' => $d['Metn'],   'name_en' => 'Zalka',               'name_ar' => 'زلقا',             'type' => 'neighborhood'],
            ['district_id' => $d['Metn'],   'name_en' => 'Dora',                'name_ar' => 'الدورة',           'type' => 'neighborhood'],
            ['district_id' => $d['Metn'],   'name_en' => 'Beit Mery',           'name_ar' => 'بيت مري',          'type' => 'village'],
            ['district_id' => $d['Metn'],   'name_en' => 'Broumana',            'name_ar' => 'برمانا',           'type' => 'village'],
            ['district_id' => $d['Metn'],   'name_en' => 'Sin El Fil',          'name_ar' => 'سن الفيل',         'type' => 'neighborhood'],
            ['district_id' => $d['Metn'],   'name_en' => 'Naccache',            'name_ar' => 'النقاش',           'type' => 'neighborhood'],
            ['district_id' => $d['Metn'],   'name_en' => 'Mansourieh',          'name_ar' => 'المنصورية',        'type' => 'neighborhood'],
            ['district_id' => $d['Metn'],   'name_en' => 'Mtayleb',             'name_ar' => 'مطيلب',            'type' => 'village'],
            ['district_id' => $d['Metn'],   'name_en' => 'Baabdat',             'name_ar' => 'بعبدات',           'type' => 'village'],
            ['district_id' => $d['Metn'],   'name_en' => 'Bsalim',              'name_ar' => 'بصاليم',           'type' => 'village'],
            ['district_id' => $d['Metn'],   'name_en' => 'Jal El Dib',          'name_ar' => 'جل الديب',         'type' => 'neighborhood'],
            ['district_id' => $d['Metn'],   'name_en' => 'Sabtieh',             'name_ar' => 'السبتية',          'type' => 'neighborhood'],

            // ══════════════════════════════════════════════════════
            // KESROUAN
            // ══════════════════════════════════════════════════════
            ['district_id' => $d['Kesrouan'], 'name_en' => 'Jounieh',           'name_ar' => 'جونية',            'type' => 'city'],
            ['district_id' => $d['Kesrouan'], 'name_en' => 'Dbayeh',            'name_ar' => 'ضبية',             'type' => 'village'],
            ['district_id' => $d['Kesrouan'], 'name_en' => 'Kaslik',            'name_ar' => 'كسليك',            'type' => 'village'],
            ['district_id' => $d['Kesrouan'], 'name_en' => 'Zouk Mosbeh',       'name_ar' => 'ذوق مصبح',         'type' => 'village'],
            ['district_id' => $d['Kesrouan'], 'name_en' => 'Zouk Mikael',       'name_ar' => 'ذوق مكايل',        'type' => 'village'],
            ['district_id' => $d['Kesrouan'], 'name_en' => 'Adma',              'name_ar' => 'أدما',             'type' => 'village'],
            ['district_id' => $d['Kesrouan'], 'name_en' => 'Sarba',             'name_ar' => 'صربا',             'type' => 'village'],
            ['district_id' => $d['Kesrouan'], 'name_en' => 'Ghazir',            'name_ar' => 'غزير',             'type' => 'village'],
            ['district_id' => $d['Kesrouan'], 'name_en' => 'Ajaltoun',          'name_ar' => 'عجلتون',           'type' => 'village'],
            ['district_id' => $d['Kesrouan'], 'name_en' => 'Faraya',            'name_ar' => 'فاريا',            'type' => 'village'],
            ['district_id' => $d['Kesrouan'], 'name_en' => 'Faqra',             'name_ar' => 'فقرا',             'type' => 'village'],
            ['district_id' => $d['Kesrouan'], 'name_en' => 'Rabieh',            'name_ar' => 'رابية',            'type' => 'neighborhood'],

            // ══════════════════════════════════════════════════════
            // JBEIL
            // ══════════════════════════════════════════════════════
            ['district_id' => $d['Jbeil'],  'name_en' => 'Jbeil',               'name_ar' => 'جبيل',             'type' => 'city'],
            ['district_id' => $d['Jbeil'],  'name_en' => 'Amchit',              'name_ar' => 'عمشيت',            'type' => 'village'],
            ['district_id' => $d['Jbeil'],  'name_en' => 'Laqlouq',             'name_ar' => 'اللقلوق',          'type' => 'village'],

            // ══════════════════════════════════════════════════════
            // CHOUF
            // ══════════════════════════════════════════════════════
            ['district_id' => $d['Chouf'],  'name_en' => 'Damour',              'name_ar' => 'الدامور',          'type' => 'city'],
            ['district_id' => $d['Chouf'],  'name_en' => 'Deir El Qamar',       'name_ar' => 'دير القمر',        'type' => 'village'],
            ['district_id' => $d['Chouf'],  'name_en' => 'Beiteddine',          'name_ar' => 'بيت الدين',        'type' => 'village'],

            // ══════════════════════════════════════════════════════
            // ALEY
            // ══════════════════════════════════════════════════════
            ['district_id' => $d['Aley'],   'name_en' => 'Aley',                'name_ar' => 'عاليه',            'type' => 'city'],
            ['district_id' => $d['Aley'],   'name_en' => 'Bhamdoun',            'name_ar' => 'بحمدون',           'type' => 'village'],
            ['district_id' => $d['Aley'],   'name_en' => 'Sofar',               'name_ar' => 'صوفر',             'type' => 'village'],
            ['district_id' => $d['Aley'],   'name_en' => 'Shimlan',             'name_ar' => 'شملان',            'type' => 'village'],

            // ══════════════════════════════════════════════════════
            // TRIPOLI
            // ══════════════════════════════════════════════════════
            ['district_id' => $d['Tripoli'], 'name_en' => 'Tripoli',            'name_ar' => 'طرابلس',           'type' => 'city'],
            ['district_id' => $d['Tripoli'], 'name_en' => 'Mina',               'name_ar' => 'الميناء',          'type' => 'neighborhood'],
            ['district_id' => $d['Tripoli'], 'name_en' => 'Abu Samra',          'name_ar' => 'أبو سمرا',         'type' => 'neighborhood'],
            ['district_id' => $d['Tripoli'], 'name_en' => 'Bab El Tabbaneh',    'name_ar' => 'باب التبانة',      'type' => 'neighborhood'],
            ['district_id' => $d['Tripoli'], 'name_en' => 'Zahrieh',            'name_ar' => 'الزاهرية',         'type' => 'neighborhood'],

            // ══════════════════════════════════════════════════════
            // KOURA
            // ══════════════════════════════════════════════════════
            ['district_id' => $d['Koura'],  'name_en' => 'Amioun',              'name_ar' => 'أميون',            'type' => 'city'],
            ['district_id' => $d['Koura'],  'name_en' => 'Kousba',              'name_ar' => 'كوسبا',            'type' => 'village'],

            // ══════════════════════════════════════════════════════
            // BATROUN
            // ══════════════════════════════════════════════════════
            ['district_id' => $d['Batroun'], 'name_en' => 'Batroun',            'name_ar' => 'البترون',          'type' => 'city'],
            ['district_id' => $d['Batroun'], 'name_en' => 'Douma',              'name_ar' => 'دوما',             'type' => 'village'],

            // ══════════════════════════════════════════════════════
            // ZGHARTA
            // ══════════════════════════════════════════════════════
            ['district_id' => $d['Zgharta'], 'name_en' => 'Zgharta',            'name_ar' => 'زغرتا',            'type' => 'city'],
            ['district_id' => $d['Zgharta'], 'name_en' => 'Ehden',              'name_ar' => 'إهدن',             'type' => 'village'],

            // ══════════════════════════════════════════════════════
            // BCHARRE
            // ══════════════════════════════════════════════════════
            ['district_id' => $d['Bcharre'], 'name_en' => 'Bcharre',            'name_ar' => 'بشري',             'type' => 'city'],
            ['district_id' => $d['Bcharre'], 'name_en' => 'Qadisha Valley',     'name_ar' => 'وادي قاديشا',      'type' => 'village'],

            // ══════════════════════════════════════════════════════
            // MINIYEH-DANNIYEH
            // ══════════════════════════════════════════════════════
            ['district_id' => $d['Miniyeh-Danniyeh'], 'name_en' => 'Sir El Danniyeh', 'name_ar' => 'سير الضنية', 'type' => 'village'],

            // ══════════════════════════════════════════════════════
            // AKKAR
            // ══════════════════════════════════════════════════════
            ['district_id' => $d['Akkar'],  'name_en' => 'Halba',               'name_ar' => 'حلبا',             'type' => 'city'],
            ['district_id' => $d['Akkar'],  'name_en' => 'Qoubaiyat',           'name_ar' => 'القبيات',          'type' => 'village'],

            // ══════════════════════════════════════════════════════
            // ZAHLEH
            // ══════════════════════════════════════════════════════
            ['district_id' => $d['Zahleh'], 'name_en' => 'Zahleh',              'name_ar' => 'زحلة',             'type' => 'city'],
            ['district_id' => $d['Zahleh'], 'name_en' => 'Hazerta',             'name_ar' => 'حزرتا',            'type' => 'village'],
            ['district_id' => $d['Zahleh'], 'name_en' => 'Taalabaya',           'name_ar' => 'تعلبايا',          'type' => 'village'],
            ['district_id' => $d['Zahleh'], 'name_en' => 'Saadnayel',           'name_ar' => 'سعدنايل',          'type' => 'village'],
            ['district_id' => $d['Zahleh'], 'name_en' => 'Qaraaoun',            'name_ar' => 'القرعون',          'type' => 'village'],

            // ══════════════════════════════════════════════════════
            // WEST BEKAA
            // ══════════════════════════════════════════════════════
            ['district_id' => $d['West Bekaa'], 'name_en' => 'Chtaura',         'name_ar' => 'شتورا',            'type' => 'city'],
            ['district_id' => $d['West Bekaa'], 'name_en' => 'Bar Elias',       'name_ar' => 'بر الياس',         'type' => 'village'],
            ['district_id' => $d['West Bekaa'], 'name_en' => 'Yohmor',          'name_ar' => 'يحمر',             'type' => 'village'],
            ['district_id' => $d['West Bekaa'], 'name_en' => 'Qabb Elias',      'name_ar' => 'قب الياس',         'type' => 'village'],

            // ══════════════════════════════════════════════════════
            // RASHAYA
            // ══════════════════════════════════════════════════════
            ['district_id' => $d['Rashaya'], 'name_en' => 'Rashaya',            'name_ar' => 'راشيا',            'type' => 'city'],

            // ══════════════════════════════════════════════════════
            // BAALBEK
            // ══════════════════════════════════════════════════════
            ['district_id' => $d['Baalbek'], 'name_en' => 'Baalbek',            'name_ar' => 'بعلبك',            'type' => 'city'],
            ['district_id' => $d['Baalbek'], 'name_en' => 'Deir El Ahmar',      'name_ar' => 'دير الأحمر',       'type' => 'village'],
            ['district_id' => $d['Baalbek'], 'name_en' => 'Taalabaya Baalbek',  'name_ar' => 'تعلبايا بعلبك',   'type' => 'village'],
            ['district_id' => $d['Baalbek'], 'name_en' => 'Yammouneh',          'name_ar' => 'يمونة',            'type' => 'village'],

            // ══════════════════════════════════════════════════════
            // HERMEL
            // ══════════════════════════════════════════════════════
            ['district_id' => $d['Hermel'],  'name_en' => 'Hermel',             'name_ar' => 'الهرمل',           'type' => 'city'],

            // ══════════════════════════════════════════════════════
            // SIDON
            // ══════════════════════════════════════════════════════
            ['district_id' => $d['Sidon'],  'name_en' => 'Sidon',               'name_ar' => 'صيدا',             'type' => 'city'],
            ['district_id' => $d['Sidon'],  'name_en' => 'Sarafand',            'name_ar' => 'صرفند',            'type' => 'village'],
            ['district_id' => $d['Sidon'],  'name_en' => 'Zahrani',             'name_ar' => 'الزهراني',         'type' => 'village'],

            // ══════════════════════════════════════════════════════
            // TYRE
            // ══════════════════════════════════════════════════════
            ['district_id' => $d['Tyre'],   'name_en' => 'Tyre',                'name_ar' => 'صور',              'type' => 'city'],
            ['district_id' => $d['Tyre'],   'name_en' => 'Sour',                'name_ar' => 'صور',              'type' => 'city'],

            // ══════════════════════════════════════════════════════
            // JEZZINE
            // ══════════════════════════════════════════════════════
            ['district_id' => $d['Jezzine'], 'name_en' => 'Jezzine',            'name_ar' => 'جزين',             'type' => 'city'],

            // ══════════════════════════════════════════════════════
            // NABATIEH
            // ══════════════════════════════════════════════════════
            ['district_id' => $d['Nabatieh'], 'name_en' => 'Nabatieh',          'name_ar' => 'النبطية',          'type' => 'city'],
            ['district_id' => $d['Nabatieh'], 'name_en' => 'Kfar Roummane',     'name_ar' => 'كفررمان',          'type' => 'village'],

            // ══════════════════════════════════════════════════════
            // BINT JBEIL
            // ══════════════════════════════════════════════════════
            ['district_id' => $d['Bint Jbeil'], 'name_en' => 'Bint Jbeil',      'name_ar' => 'بنت جبيل',         'type' => 'city'],

            // ══════════════════════════════════════════════════════
            // HASBAYA
            // ══════════════════════════════════════════════════════
            ['district_id' => $d['Hasbaya'], 'name_en' => 'Hasbaya',            'name_ar' => 'حاصبيا',           'type' => 'city'],

            // ══════════════════════════════════════════════════════
            // MARJEYOUN
            // ══════════════════════════════════════════════════════
            ['district_id' => $d['Marjeyoun'], 'name_en' => 'Marjeyoun',        'name_ar' => 'مرجعيون',          'type' => 'city'],
            ['district_id' => $d['Marjeyoun'], 'name_en' => 'Khiam',            'name_ar' => 'الخيام',           'type' => 'village'],
        ];

        DB::table('areas')->insert($areas);
    }
}