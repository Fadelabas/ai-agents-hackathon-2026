<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreaAliasSeeder extends Seeder
{
    public function run(): void
    {
        // Build area lookup map: name_en => id
        $a = [];
        $areas = DB::table('areas')->get();
        foreach ($areas as $area) {
            $a[$area->name_en] = $area->id;
        }

        $aliases = [

            // ══════════════════════════════════════════════════════
            // BEIRUT NEIGHBORHOODS
            // ══════════════════════════════════════════════════════

            // Hamra
            ['area_id' => $a['Hamra'], 'alias' => 'Hamra',           'language_type' => 'english'],
            ['area_id' => $a['Hamra'], 'alias' => 'hamra',           'language_type' => 'english'],
            ['area_id' => $a['Hamra'], 'alias' => 'HAMRA',           'language_type' => 'english'],
            ['area_id' => $a['Hamra'], 'alias' => 'الحمرا',          'language_type' => 'arabic'],
            ['area_id' => $a['Hamra'], 'alias' => 'حمرا',            'language_type' => 'arabic'],
            ['area_id' => $a['Hamra'], 'alias' => 'l7amra',          'language_type' => 'franco'],
            ['area_id' => $a['Hamra'], 'alias' => 'el hamra',        'language_type' => 'franco'],
            ['area_id' => $a['Hamra'], 'alias' => 'hamra street',    'language_type' => 'english'],
            ['area_id' => $a['Hamra'], 'alias' => 'el 7amra',        'language_type' => 'franco'],

            // Achrafieh
            ['area_id' => $a['Achrafieh'], 'alias' => 'Achrafieh',    'language_type' => 'english'],
            ['area_id' => $a['Achrafieh'], 'alias' => 'achrafieh',    'language_type' => 'english'],
            ['area_id' => $a['Achrafieh'], 'alias' => 'Ashrafieh',    'language_type' => 'english'],
            ['area_id' => $a['Achrafieh'], 'alias' => 'ashrafieh',    'language_type' => 'english'],
            ['area_id' => $a['Achrafieh'], 'alias' => 'الأشرفية',     'language_type' => 'arabic'],
            ['area_id' => $a['Achrafieh'], 'alias' => 'أشرفية',       'language_type' => 'arabic'],
            ['area_id' => $a['Achrafieh'], 'alias' => '2achrafieh',   'language_type' => 'franco'],
            ['area_id' => $a['Achrafieh'], 'alias' => 'acrafieh',     'language_type' => 'typo'],
            ['area_id' => $a['Achrafieh'], 'alias' => 'ashrafiye',    'language_type' => 'typo'],
            ['area_id' => $a['Achrafieh'], 'alias' => 'achrafiyeh',   'language_type' => 'typo'],

            // Verdun
            ['area_id' => $a['Verdun'], 'alias' => 'Verdun',          'language_type' => 'english'],
            ['area_id' => $a['Verdun'], 'alias' => 'verdun',          'language_type' => 'english'],
            ['area_id' => $a['Verdun'], 'alias' => 'فردان',           'language_type' => 'arabic'],
            ['area_id' => $a['Verdun'], 'alias' => 'vardon',          'language_type' => 'typo'],
            ['area_id' => $a['Verdun'], 'alias' => 'verdon',          'language_type' => 'typo'],

            // Badaro
            ['area_id' => $a['Badaro'], 'alias' => 'Badaro',          'language_type' => 'english'],
            ['area_id' => $a['Badaro'], 'alias' => 'badaro',          'language_type' => 'english'],
            ['area_id' => $a['Badaro'], 'alias' => 'بدارو',           'language_type' => 'arabic'],
            ['area_id' => $a['Badaro'], 'alias' => 'badaaro',         'language_type' => 'typo'],
            ['area_id' => $a['Badaro'], 'alias' => 'badarro',         'language_type' => 'typo'],

            // Mar Mikhael
            ['area_id' => $a['Mar Mikhael'], 'alias' => 'Mar Mikhael',    'language_type' => 'english'],
            ['area_id' => $a['Mar Mikhael'], 'alias' => 'mar mikhael',    'language_type' => 'english'],
            ['area_id' => $a['Mar Mikhael'], 'alias' => 'Mar Mikael',     'language_type' => 'english'],
            ['area_id' => $a['Mar Mikhael'], 'alias' => 'مار مخايل',      'language_type' => 'arabic'],
            ['area_id' => $a['Mar Mikhael'], 'alias' => 'mar m',           'language_type' => 'franco'],
            ['area_id' => $a['Mar Mikhael'], 'alias' => 'mar mkhayel',     'language_type' => 'franco'],
            ['area_id' => $a['Mar Mikhael'], 'alias' => 'mar mkhael',      'language_type' => 'typo'],

            // Gemmayzeh
            ['area_id' => $a['Gemmayzeh'], 'alias' => 'Gemmayzeh',    'language_type' => 'english'],
            ['area_id' => $a['Gemmayzeh'], 'alias' => 'gemmayzeh',    'language_type' => 'english'],
            ['area_id' => $a['Gemmayzeh'], 'alias' => 'Gemmayze',     'language_type' => 'english'],
            ['area_id' => $a['Gemmayzeh'], 'alias' => 'الجميزة',      'language_type' => 'arabic'],
            ['area_id' => $a['Gemmayzeh'], 'alias' => 'jmayze',       'language_type' => 'franco'],
            ['area_id' => $a['Gemmayzeh'], 'alias' => 'jmayzeh',      'language_type' => 'franco'],
            ['area_id' => $a['Gemmayzeh'], 'alias' => 'gemayze',      'language_type' => 'typo'],
            ['area_id' => $a['Gemmayzeh'], 'alias' => 'gemayzeh',     'language_type' => 'typo'],

            // Raouche
            ['area_id' => $a['Raouche'], 'alias' => 'Raouche',        'language_type' => 'english'],
            ['area_id' => $a['Raouche'], 'alias' => 'raouche',        'language_type' => 'english'],
            ['area_id' => $a['Raouche'], 'alias' => 'الروشة',         'language_type' => 'arabic'],
            ['area_id' => $a['Raouche'], 'alias' => 'rawche',         'language_type' => 'franco'],
            ['area_id' => $a['Raouche'], 'alias' => 'raouchi',        'language_type' => 'typo'],
            ['area_id' => $a['Raouche'], 'alias' => 'rawshi',         'language_type' => 'franco'],

            // Downtown Beirut
            ['area_id' => $a['Downtown Beirut'], 'alias' => 'Downtown Beirut',  'language_type' => 'english'],
            ['area_id' => $a['Downtown Beirut'], 'alias' => 'downtown beirut',  'language_type' => 'english'],
            ['area_id' => $a['Downtown Beirut'], 'alias' => 'Downtown',         'language_type' => 'english'],
            ['area_id' => $a['Downtown Beirut'], 'alias' => 'وسط بيروت',        'language_type' => 'arabic'],
            ['area_id' => $a['Downtown Beirut'], 'alias' => 'wsat beirut',      'language_type' => 'franco'],
            ['area_id' => $a['Downtown Beirut'], 'alias' => 'solidere',         'language_type' => 'english'],
            ['area_id' => $a['Downtown Beirut'], 'alias' => 'Solidere',         'language_type' => 'english'],
            ['area_id' => $a['Downtown Beirut'], 'alias' => 'city center',      'language_type' => 'english'],

            // Bourj Hammoud
            ['area_id' => $a['Bourj Hammoud'], 'alias' => 'Bourj Hammoud',  'language_type' => 'english'],
            ['area_id' => $a['Bourj Hammoud'], 'alias' => 'bourj hammoud',  'language_type' => 'english'],
            ['area_id' => $a['Bourj Hammoud'], 'alias' => 'برج حمود',       'language_type' => 'arabic'],
            ['area_id' => $a['Bourj Hammoud'], 'alias' => 'burj hammoud',   'language_type' => 'franco'],
            ['area_id' => $a['Bourj Hammoud'], 'alias' => 'borj hammoud',   'language_type' => 'typo'],
            ['area_id' => $a['Bourj Hammoud'], 'alias' => 'bh',             'language_type' => 'franco'],

            // Corniche
            ['area_id' => $a['Corniche'], 'alias' => 'Corniche',       'language_type' => 'english'],
            ['area_id' => $a['Corniche'], 'alias' => 'corniche',       'language_type' => 'english'],
            ['area_id' => $a['Corniche'], 'alias' => 'الكورنيش',      'language_type' => 'arabic'],
            ['area_id' => $a['Corniche'], 'alias' => 'el corniche',    'language_type' => 'franco'],
            ['area_id' => $a['Corniche'], 'alias' => 'cornish',        'language_type' => 'typo'],

            // Zarif
            ['area_id' => $a['Zarif'], 'alias' => 'Zarif',            'language_type' => 'english'],
            ['area_id' => $a['Zarif'], 'alias' => 'zarif',            'language_type' => 'english'],
            ['area_id' => $a['Zarif'], 'alias' => 'الظريف',           'language_type' => 'arabic'],
            ['area_id' => $a['Zarif'], 'alias' => 'el zarif',         'language_type' => 'franco'],
            ['area_id' => $a['Zarif'], 'alias' => 'zareef',           'language_type' => 'typo'],
            // ══════════════════════════════════════════════════════
            // ADDITIONAL METN ALIASES
            // ══════════════════════════════════════════════════════

            // Bauchrieh
            ['area_id' => $a['Bauchrieh'], 'alias' => 'Bauchrieh',        'language_type' => 'english'],
            ['area_id' => $a['Bauchrieh'], 'alias' => 'bauchrieh',        'language_type' => 'english'],
            ['area_id' => $a['Bauchrieh'], 'alias' => 'البوشرية',         'language_type' => 'arabic'],
            ['area_id' => $a['Bauchrieh'], 'alias' => 'bouchrieh',        'language_type' => 'typo'],
            ['area_id' => $a['Bauchrieh'], 'alias' => 'bushrieh',         'language_type' => 'typo'],
            ['area_id' => $a['Bauchrieh'], 'alias' => 'el bouchrieh',     'language_type' => 'franco'],
            ['area_id' => $a['Bauchrieh'], 'alias' => 'bshriye',          'language_type' => 'franco'],
            ['area_id' => $a['Bauchrieh'], 'alias' => 'bouchrie',         'language_type' => 'typo'],

            // Mkalles
            ['area_id' => $a['Mkalles'], 'alias' => 'Mkalles',            'language_type' => 'english'],
            ['area_id' => $a['Mkalles'], 'alias' => 'mkalles',            'language_type' => 'english'],
            ['area_id' => $a['Mkalles'], 'alias' => 'مكلس',               'language_type' => 'arabic'],
            ['area_id' => $a['Mkalles'], 'alias' => 'mkelles',            'language_type' => 'typo'],
            ['area_id' => $a['Mkalles'], 'alias' => 'mkallis',            'language_type' => 'typo'],
            ['area_id' => $a['Mkalles'], 'alias' => 'mkellis',            'language_type' => 'typo'],
            ['area_id' => $a['Mkalles'], 'alias' => 'mkales',             'language_type' => 'franco'],

            // Ain Saadeh
            ['area_id' => $a['Ain Saadeh'], 'alias' => 'Ain Saadeh',      'language_type' => 'english'],
            ['area_id' => $a['Ain Saadeh'], 'alias' => 'ain saadeh',      'language_type' => 'english'],
            ['area_id' => $a['Ain Saadeh'], 'alias' => 'عين سعادة',       'language_type' => 'arabic'],
            ['area_id' => $a['Ain Saadeh'], 'alias' => '3ain saadeh',     'language_type' => 'franco'],
            ['area_id' => $a['Ain Saadeh'], 'alias' => 'ain sa3deh',      'language_type' => 'franco'],
            ['area_id' => $a['Ain Saadeh'], 'alias' => 'ain saade',       'language_type' => 'typo'],
            ['area_id' => $a['Ain Saadeh'], 'alias' => 'ain saadi',       'language_type' => 'typo'],
            ['area_id' => $a['Ain Saadeh'], 'alias' => '3in saadeh',      'language_type' => 'franco'],

            // Roumieh
            ['area_id' => $a['Roumieh'], 'alias' => 'Roumieh',            'language_type' => 'english'],
            ['area_id' => $a['Roumieh'], 'alias' => 'roumieh',            'language_type' => 'english'],
            ['area_id' => $a['Roumieh'], 'alias' => 'الرومية',            'language_type' => 'arabic'],
            ['area_id' => $a['Roumieh'], 'alias' => 'رومية',              'language_type' => 'arabic'],
            ['area_id' => $a['Roumieh'], 'alias' => 'rumiye',             'language_type' => 'franco'],
            ['area_id' => $a['Roumieh'], 'alias' => 'roumiye',            'language_type' => 'franco'],
            ['area_id' => $a['Roumieh'], 'alias' => 'rumiyeh',            'language_type' => 'typo'],
            ['area_id' => $a['Roumieh'], 'alias' => 'romieh',             'language_type' => 'typo'],
            ['area_id' => $a['Roumieh'], 'alias' => 'romiyeh',            'language_type' => 'typo'],

            // Lebanese University Fanar
            ['area_id' => $a['Lebanese University Fanar'], 'alias' => 'Lebanese University Fanar',  'language_type' => 'english'],
            ['area_id' => $a['Lebanese University Fanar'], 'alias' => 'lebanese university fanar',  'language_type' => 'english'],
            ['area_id' => $a['Lebanese University Fanar'], 'alias' => 'الجامعة اللبنانية الفنار',   'language_type' => 'arabic'],
            ['area_id' => $a['Lebanese University Fanar'], 'alias' => 'jami3a lubnaniyye fanar',    'language_type' => 'franco'],
            ['area_id' => $a['Lebanese University Fanar'], 'alias' => 'lau fanar',                  'language_type' => 'english'],
            ['area_id' => $a['Lebanese University Fanar'], 'alias' => 'ul fanar',                   'language_type' => 'english'],
            ['area_id' => $a['Lebanese University Fanar'], 'alias' => 'university fanar',           'language_type' => 'english'],
            ['area_id' => $a['Lebanese University Fanar'], 'alias' => 'jami3a fanar',               'language_type' => 'franco'],

            // Sed El Baouchrieh
            ['area_id' => $a['Sed El Baouchrieh'], 'alias' => 'Sed El Baouchrieh',   'language_type' => 'english'],
            ['area_id' => $a['Sed El Baouchrieh'], 'alias' => 'sed el baouchrieh',   'language_type' => 'english'],
            ['area_id' => $a['Sed El Baouchrieh'], 'alias' => 'سد البوشرية',         'language_type' => 'arabic'],
            ['area_id' => $a['Sed El Baouchrieh'], 'alias' => 'sed bouchrieh',       'language_type' => 'franco'],
            ['area_id' => $a['Sed El Baouchrieh'], 'alias' => 'el sed',              'language_type' => 'franco'],
            ['area_id' => $a['Sed El Baouchrieh'], 'alias' => 'sed',                 'language_type' => 'franco'],

            // Furn El Chebbak
            ['area_id' => $a['Furn El Chebbak'], 'alias' => 'Furn El Chebbak',   'language_type' => 'english'],
            ['area_id' => $a['Furn El Chebbak'], 'alias' => 'furn el chebbak',   'language_type' => 'english'],
            ['area_id' => $a['Furn El Chebbak'], 'alias' => 'فرن الشباك',        'language_type' => 'arabic'],
            ['area_id' => $a['Furn El Chebbak'], 'alias' => 'forn el chebbak',   'language_type' => 'franco'],
            ['area_id' => $a['Furn El Chebbak'], 'alias' => 'furn chebbak',      'language_type' => 'franco'],
            ['area_id' => $a['Furn El Chebbak'], 'alias' => 'furn el shebak',    'language_type' => 'typo'],
            ['area_id' => $a['Furn El Chebbak'], 'alias' => 'forn chebak',       'language_type' => 'typo'],

            // Horsh Tabet
            ['area_id' => $a['Horsh Tabet'], 'alias' => 'Horsh Tabet',       'language_type' => 'english'],
            ['area_id' => $a['Horsh Tabet'], 'alias' => 'horsh tabet',       'language_type' => 'english'],
            ['area_id' => $a['Horsh Tabet'], 'alias' => 'حرش ثابت',          'language_type' => 'arabic'],
            ['area_id' => $a['Horsh Tabet'], 'alias' => 'horsh tabet metn',  'language_type' => 'english'],
            ['area_id' => $a['Horsh Tabet'], 'alias' => 'horche tabet',      'language_type' => 'typo'],

            // Kfarchima
            ['area_id' => $a['Kfarchima'], 'alias' => 'Kfarchima',           'language_type' => 'english'],
            ['area_id' => $a['Kfarchima'], 'alias' => 'kfarchima',           'language_type' => 'english'],
            ['area_id' => $a['Kfarchima'], 'alias' => 'كفرشيما',             'language_type' => 'arabic'],
            ['area_id' => $a['Kfarchima'], 'alias' => 'kfarshima',           'language_type' => 'typo'],
            ['area_id' => $a['Kfarchima'], 'alias' => 'kfar chima',          'language_type' => 'typo'],
            ['area_id' => $a['Kfarchima'], 'alias' => 'kfarsheema',          'language_type' => 'typo'],
            ['area_id' => $a['Kfarchima'], 'alias' => 'kfar shima',          'language_type' => 'franco'],

            // Elissar
            ['area_id' => $a['Elissar'], 'alias' => 'Elissar',               'language_type' => 'english'],
            ['area_id' => $a['Elissar'], 'alias' => 'elissar',               'language_type' => 'english'],
            ['area_id' => $a['Elissar'], 'alias' => 'إليسار',                'language_type' => 'arabic'],
            ['area_id' => $a['Elissar'], 'alias' => 'elysar',                'language_type' => 'typo'],
            ['area_id' => $a['Elissar'], 'alias' => 'elyssar',               'language_type' => 'typo'],

            // ══════════════════════════════════════════════════════
            // ADDITIONAL BEKAA ALIASES
            // ══════════════════════════════════════════════════════

            // Taanayel
            ['area_id' => $a['Taanayel'], 'alias' => 'Taanayel',             'language_type' => 'english'],
            ['area_id' => $a['Taanayel'], 'alias' => 'taanayel',             'language_type' => 'english'],
            ['area_id' => $a['Taanayel'], 'alias' => 'تعنايل',               'language_type' => 'arabic'],
            ['area_id' => $a['Taanayel'], 'alias' => 'ta3nayel',             'language_type' => 'franco'],
            ['area_id' => $a['Taanayel'], 'alias' => 'tanayel',              'language_type' => 'typo'],
            ['area_id' => $a['Taanayel'], 'alias' => 'taanayil',             'language_type' => 'typo'],
            ['area_id' => $a['Taanayel'], 'alias' => 'ta3nayyel',            'language_type' => 'franco'],

            // Riyaq
            ['area_id' => $a['Riyaq'], 'alias' => 'Riyaq',                   'language_type' => 'english'],
            ['area_id' => $a['Riyaq'], 'alias' => 'riyaq',                   'language_type' => 'english'],
            ['area_id' => $a['Riyaq'], 'alias' => 'رياق',                    'language_type' => 'arabic'],
            ['area_id' => $a['Riyaq'], 'alias' => 'Rayak',                   'language_type' => 'english'],
            ['area_id' => $a['Riyaq'], 'alias' => 'rayak',                   'language_type' => 'english'],
            ['area_id' => $a['Riyaq'], 'alias' => 'riyak',                   'language_type' => 'typo'],
            ['area_id' => $a['Riyaq'], 'alias' => 'rayyak',                  'language_type' => 'typo'],

            // Terbol
            ['area_id' => $a['Terbol'], 'alias' => 'Terbol',                 'language_type' => 'english'],
            ['area_id' => $a['Terbol'], 'alias' => 'terbol',                 'language_type' => 'english'],
            ['area_id' => $a['Terbol'], 'alias' => 'تربل',                   'language_type' => 'arabic'],
            ['area_id' => $a['Terbol'], 'alias' => 'tarbol',                 'language_type' => 'typo'],
            ['area_id' => $a['Terbol'], 'alias' => 'terbul',                 'language_type' => 'typo'],
            ['area_id' => $a['Terbol'], 'alias' => 'terbal',                 'language_type' => 'typo'],

            // Jdita
            ['area_id' => $a['Jdita'], 'alias' => 'Jdita',                   'language_type' => 'english'],
            ['area_id' => $a['Jdita'], 'alias' => 'jdita',                   'language_type' => 'english'],
            ['area_id' => $a['Jdita'], 'alias' => 'جديتا',                   'language_type' => 'arabic'],
            ['area_id' => $a['Jdita'], 'alias' => 'jdeita',                  'language_type' => 'typo'],
            ['area_id' => $a['Jdita'], 'alias' => 'jdayta',                  'language_type' => 'typo'],
            ['area_id' => $a['Jdita'], 'alias' => 'jdaita',                  'language_type' => 'franco'],

            // Qabb Elias
            ['area_id' => $a['Qabb Elias'], 'alias' => 'Qabb Elias',         'language_type' => 'english'],
            ['area_id' => $a['Qabb Elias'], 'alias' => 'qabb elias',         'language_type' => 'english'],
            ['area_id' => $a['Qabb Elias'], 'alias' => 'قب الياس',           'language_type' => 'arabic'],
            ['area_id' => $a['Qabb Elias'], 'alias' => 'qab elias',          'language_type' => 'typo'],
            ['area_id' => $a['Qabb Elias'], 'alias' => 'ab elias',           'language_type' => 'typo'],
            ['area_id' => $a['Qabb Elias'], 'alias' => 'qabb ilyas',         'language_type' => 'franco'],
            ['area_id' => $a['Qabb Elias'], 'alias' => 'kabb elias',         'language_type' => 'typo'],

            // Taalabaya (Zahleh)
            ['area_id' => $a['Taalabaya'], 'alias' => 'Taalabaya',           'language_type' => 'english'],
            ['area_id' => $a['Taalabaya'], 'alias' => 'taalabaya',           'language_type' => 'english'],
            ['area_id' => $a['Taalabaya'], 'alias' => 'تعلبايا',             'language_type' => 'arabic'],
            ['area_id' => $a['Taalabaya'], 'alias' => 'ta3labaya',           'language_type' => 'franco'],
            ['area_id' => $a['Taalabaya'], 'alias' => 'talabaya',            'language_type' => 'typo'],
            ['area_id' => $a['Taalabaya'], 'alias' => 'taalabaia',           'language_type' => 'typo'],
            ['area_id' => $a['Taalabaya'], 'alias' => 'ta3labaia',           'language_type' => 'franco'],

            // Ablah
            ['area_id' => $a['Ablah'], 'alias' => 'Ablah',                   'language_type' => 'english'],
            ['area_id' => $a['Ablah'], 'alias' => 'ablah',                   'language_type' => 'english'],
            ['area_id' => $a['Ablah'], 'alias' => 'أبلح',                    'language_type' => 'arabic'],
            ['area_id' => $a['Ablah'], 'alias' => 'abla',                    'language_type' => 'typo'],
            ['area_id' => $a['Ablah'], 'alias' => 'ableh',                   'language_type' => 'typo'],

            // ══════════════════════════════════════════════════════
            // STRONGER ALIASES FOR EXISTING KEY AREAS
            // ══════════════════════════════════════════════════════

            // Extra Fanar aliases
            ['area_id' => $a['Fanar'], 'alias' => 'el fanar metn',           'language_type' => 'english'],
            ['area_id' => $a['Fanar'], 'alias' => 'fanar metn',              'language_type' => 'english'],
            ['area_id' => $a['Fanar'], 'alias' => 'الفنار المتن',            'language_type' => 'arabic'],
            ['area_id' => $a['Fanar'], 'alias' => 'fnar metn',               'language_type' => 'franco'],
            ['area_id' => $a['Fanar'], 'alias' => 'fannar',                  'language_type' => 'typo'],

            // Extra Dekwaneh aliases
            ['area_id' => $a['Dekwaneh'], 'alias' => 'dkwaneh',              'language_type' => 'franco'],
            ['area_id' => $a['Dekwaneh'], 'alias' => 'el dkwaneh',           'language_type' => 'franco'],
            ['area_id' => $a['Dekwaneh'], 'alias' => 'dekouwen',             'language_type' => 'typo'],
            ['area_id' => $a['Dekwaneh'], 'alias' => 'دكوانة',               'language_type' => 'arabic'],

            // Extra Jdeideh aliases
            ['area_id' => $a['Jdeideh'], 'alias' => 'el jdeideh',            'language_type' => 'franco'],
            ['area_id' => $a['Jdeideh'], 'alias' => 'jdeideh metn',          'language_type' => 'english'],
            ['area_id' => $a['Jdeideh'], 'alias' => 'جديدة المتن',           'language_type' => 'arabic'],
            ['area_id' => $a['Jdeideh'], 'alias' => 'jdide metn',            'language_type' => 'franco'],

            // Extra Sin El Fil aliases
            ['area_id' => $a['Sin El Fil'], 'alias' => 'sin l fil',          'language_type' => 'franco'],
            ['area_id' => $a['Sin El Fil'], 'alias' => 'sen el fil',         'language_type' => 'typo'],
            ['area_id' => $a['Sin El Fil'], 'alias' => 'sin fil',            'language_type' => 'typo'],
            ['area_id' => $a['Sin El Fil'], 'alias' => 'sinn fil',           'language_type' => 'typo'],

            // Extra Mansourieh aliases
            ['area_id' => $a['Mansourieh'], 'alias' => 'mansourieh metn',    'language_type' => 'english'],
            ['area_id' => $a['Mansourieh'], 'alias' => 'el mansourieh',      'language_type' => 'franco'],
            ['area_id' => $a['Mansourieh'], 'alias' => 'منصورية المتن',      'language_type' => 'arabic'],
            ['area_id' => $a['Mansourieh'], 'alias' => 'mansuriyye',         'language_type' => 'franco'],

            // Extra Zalka aliases
            ['area_id' => $a['Zalka'], 'alias' => 'zalka metn',              'language_type' => 'english'],
            ['area_id' => $a['Zalka'], 'alias' => 'el zalka',                'language_type' => 'franco'],
            ['area_id' => $a['Zalka'], 'alias' => 'zalqa metn',              'language_type' => 'franco'],

            // Extra Antelias aliases
            ['area_id' => $a['Antelias'], 'alias' => 'antelias metn',        'language_type' => 'english'],
            ['area_id' => $a['Antelias'], 'alias' => 'antlias metn',         'language_type' => 'typo'],
            ['area_id' => $a['Antelias'], 'alias' => 'أنطلياس المتن',        'language_type' => 'arabic'],

            // Extra Hazmieh aliases
            ['area_id' => $a['Hazmieh'], 'alias' => 'hazmieh baabda',        'language_type' => 'english'],
            ['area_id' => $a['Hazmieh'], 'alias' => 'حازمية بعبدا',          'language_type' => 'arabic'],
            ['area_id' => $a['Hazmieh'], 'alias' => '7azmiye baabda',        'language_type' => 'franco'],
            ['area_id' => $a['Hazmieh'], 'alias' => 'hezmieh',               'language_type' => 'typo'],
            ['area_id' => $a['Hazmieh'], 'alias' => 'hizmieh',               'language_type' => 'typo'],

            // Extra Zahle aliases
            ['area_id' => $a['Zahleh'], 'alias' => 'zahle bekaa',            'language_type' => 'english'],
            ['area_id' => $a['Zahleh'], 'alias' => 'زحلة البقاع',            'language_type' => 'arabic'],
            ['area_id' => $a['Zahleh'], 'alias' => 'za7le',                  'language_type' => 'franco'],
            ['area_id' => $a['Zahleh'], 'alias' => 'zahlie',                 'language_type' => 'typo'],

            // Extra Baalbek aliases
            ['area_id' => $a['Baalbek'], 'alias' => 'baalbek city',          'language_type' => 'english'],
            ['area_id' => $a['Baalbek'], 'alias' => 'بعلبك المدينة',         'language_type' => 'arabic'],
            ['area_id' => $a['Baalbek'], 'alias' => 'ba3lbek',               'language_type' => 'franco'],
            ['area_id' => $a['Baalbek'], 'alias' => 'b3albak',               'language_type' => 'franco'],
            ['area_id' => $a['Baalbek'], 'alias' => 'balebek',               'language_type' => 'typo'],

            // Extra Chtaura aliases
            ['area_id' => $a['Chtaura'], 'alias' => 'chtaura bekaa',         'language_type' => 'english'],
            ['area_id' => $a['Chtaura'], 'alias' => 'شتورا البقاع',          'language_type' => 'arabic'],
            ['area_id' => $a['Chtaura'], 'alias' => 'shtoura',               'language_type' => 'typo'],
            ['area_id' => $a['Chtaura'], 'alias' => 'shtora',                'language_type' => 'typo'],

            // Extra Bar Elias aliases
            ['area_id' => $a['Bar Elias'], 'alias' => 'bar elias bekaa',     'language_type' => 'english'],
            ['area_id' => $a['Bar Elias'], 'alias' => 'بر الياس البقاع',     'language_type' => 'arabic'],
            ['area_id' => $a['Bar Elias'], 'alias' => 'bar elyass',          'language_type' => 'typo'],
            ['area_id' => $a['Bar Elias'], 'alias' => 'bar 2lyas',           'language_type' => 'franco'],

            // Extra Saadnayel aliases (already in areas table from before)
            ['area_id' => $a['Saadnayel'], 'alias' => 'saadnayel bekaa',     'language_type' => 'english'],
            ['area_id' => $a['Saadnayel'], 'alias' => 'سعدنايل البقاع',      'language_type' => 'arabic'],
            ['area_id' => $a['Saadnayel'], 'alias' => 'sadnayl',             'language_type' => 'typo'],
            ['area_id' => $a['Saadnayel'], 'alias' => 'sa3dnayil',           'language_type' => 'franco'],

            // Extra Dora aliases
            ['area_id' => $a['Dora'], 'alias' => 'dora beirut',              'language_type' => 'english'],
            ['area_id' => $a['Dora'], 'alias' => 'dawra beirut',             'language_type' => 'franco'],
            ['area_id' => $a['Dora'], 'alias' => 'الدورة بيروت',             'language_type' => 'arabic'],
            ['area_id' => $a['Dora'], 'alias' => 'dawre',                    'language_type' => 'franco'],

            // Extra Bourj Hammoud aliases
            ['area_id' => $a['Bourj Hammoud'], 'alias' => 'bourj hammoud metn', 'language_type' => 'english'],
            ['area_id' => $a['Bourj Hammoud'], 'alias' => 'برج حمود المتن',     'language_type' => 'arabic'],
            ['area_id' => $a['Bourj Hammoud'], 'alias' => 'borj 7ammoud',        'language_type' => 'franco'],
            ['area_id' => $a['Bourj Hammoud'], 'alias' => 'burj 7ammoud',        'language_type' => 'franco'],
            // Sanayeh
            ['area_id' => $a['Sanayeh'], 'alias' => 'Sanayeh',        'language_type' => 'english'],
            ['area_id' => $a['Sanayeh'], 'alias' => 'sanayeh',        'language_type' => 'english'],
            ['area_id' => $a['Sanayeh'], 'alias' => 'الصنائع',        'language_type' => 'arabic'],
            ['area_id' => $a['Sanayeh'], 'alias' => 'snaye',          'language_type' => 'franco'],
            ['area_id' => $a['Sanayeh'], 'alias' => 'sanayi',         'language_type' => 'typo'],

            // Tallet El Khayat
            ['area_id' => $a['Tallet El Khayat'], 'alias' => 'Tallet El Khayat',  'language_type' => 'english'],
            ['area_id' => $a['Tallet El Khayat'], 'alias' => 'tallet el khayat',  'language_type' => 'english'],
            ['area_id' => $a['Tallet El Khayat'], 'alias' => 'تلة الخياط',        'language_type' => 'arabic'],
            ['area_id' => $a['Tallet El Khayat'], 'alias' => 'tallet',            'language_type' => 'franco'],
            ['area_id' => $a['Tallet El Khayat'], 'alias' => 'tallet el 5ayat',   'language_type' => 'franco'],
            ['area_id' => $a['Tallet El Khayat'], 'alias' => 'tallit el khayat',  'language_type' => 'typo'],

            // Sodeco
            ['area_id' => $a['Sodeco'], 'alias' => 'Sodeco',          'language_type' => 'english'],
            ['area_id' => $a['Sodeco'], 'alias' => 'sodeco',          'language_type' => 'english'],
            ['area_id' => $a['Sodeco'], 'alias' => 'سوديكو',          'language_type' => 'arabic'],
            ['area_id' => $a['Sodeco'], 'alias' => 'sodiko',          'language_type' => 'typo'],

            // Sassine
            ['area_id' => $a['Sassine'], 'alias' => 'Sassine',        'language_type' => 'english'],
            ['area_id' => $a['Sassine'], 'alias' => 'sassine',        'language_type' => 'english'],
            ['area_id' => $a['Sassine'], 'alias' => 'ساسين',          'language_type' => 'arabic'],
            ['area_id' => $a['Sassine'], 'alias' => 'sasin',          'language_type' => 'typo'],
            ['area_id' => $a['Sassine'], 'alias' => 'place sassine',  'language_type' => 'english'],

            // ══════════════════════════════════════════════════════
            // BAABDA DISTRICT
            // ══════════════════════════════════════════════════════

            // Hazmieh
            ['area_id' => $a['Hazmieh'], 'alias' => 'Hazmieh',        'language_type' => 'english'],
            ['area_id' => $a['Hazmieh'], 'alias' => 'hazmieh',        'language_type' => 'english'],
            ['area_id' => $a['Hazmieh'], 'alias' => 'الحازمية',       'language_type' => 'arabic'],
            ['area_id' => $a['Hazmieh'], 'alias' => 'حازمية',         'language_type' => 'arabic'],
            ['area_id' => $a['Hazmieh'], 'alias' => '7azmiye',        'language_type' => 'franco'],
            ['area_id' => $a['Hazmieh'], 'alias' => '7azmieh',        'language_type' => 'franco'],
            ['area_id' => $a['Hazmieh'], 'alias' => 'Hzmiye',         'language_type' => 'typo'],
            ['area_id' => $a['Hazmieh'], 'alias' => 'hazmiye',        'language_type' => 'typo'],
            ['area_id' => $a['Hazmieh'], 'alias' => 'hazmihe',        'language_type' => 'typo'],
            ['area_id' => $a['Hazmieh'], 'alias' => 'hazmiyeh',       'language_type' => 'typo'],

            // Hadath
            ['area_id' => $a['Hadath'], 'alias' => 'Hadath',          'language_type' => 'english'],
            ['area_id' => $a['Hadath'], 'alias' => 'hadath',          'language_type' => 'english'],
            ['area_id' => $a['Hadath'], 'alias' => 'الحدث',           'language_type' => 'arabic'],
            ['area_id' => $a['Hadath'], 'alias' => 'el hadath',       'language_type' => 'franco'],
            ['area_id' => $a['Hadath'], 'alias' => 'hdath',           'language_type' => 'typo'],
            ['area_id' => $a['Hadath'], 'alias' => 'hadat',           'language_type' => 'typo'],

            // Choueifat
            ['area_id' => $a['Choueifat'], 'alias' => 'Choueifat',    'language_type' => 'english'],
            ['area_id' => $a['Choueifat'], 'alias' => 'choueifat',    'language_type' => 'english'],
            ['area_id' => $a['Choueifat'], 'alias' => 'الشويفات',     'language_type' => 'arabic'],
            ['area_id' => $a['Choueifat'], 'alias' => 'chweifat',     'language_type' => 'franco'],
            ['area_id' => $a['Choueifat'], 'alias' => 'shweifat',     'language_type' => 'franco'],
            ['area_id' => $a['Choueifat'], 'alias' => 'chouifat',     'language_type' => 'typo'],
            ['area_id' => $a['Choueifat'], 'alias' => 'chweifet',     'language_type' => 'typo'],

            // Khalde
            ['area_id' => $a['Khalde'], 'alias' => 'Khalde',          'language_type' => 'english'],
            ['area_id' => $a['Khalde'], 'alias' => 'khalde',          'language_type' => 'english'],
            ['area_id' => $a['Khalde'], 'alias' => 'خلدة',            'language_type' => 'arabic'],
            ['area_id' => $a['Khalde'], 'alias' => '5alde',           'language_type' => 'franco'],
            ['area_id' => $a['Khalde'], 'alias' => 'khaldeh',         'language_type' => 'typo'],
            ['area_id' => $a['Khalde'], 'alias' => 'xalde',           'language_type' => 'typo'],

            // Baabda
            ['area_id' => $a['Baabda'], 'alias' => 'Baabda',          'language_type' => 'english'],
            ['area_id' => $a['Baabda'], 'alias' => 'baabda',          'language_type' => 'english'],
            ['area_id' => $a['Baabda'], 'alias' => 'بعبدا',           'language_type' => 'arabic'],
            ['area_id' => $a['Baabda'], 'alias' => 'ba3bda',          'language_type' => 'franco'],
            ['area_id' => $a['Baabda'], 'alias' => 'babda',           'language_type' => 'typo'],

            // Yarze
            ['area_id' => $a['Yarze'], 'alias' => 'Yarze',            'language_type' => 'english'],
            ['area_id' => $a['Yarze'], 'alias' => 'yarze',            'language_type' => 'english'],
            ['area_id' => $a['Yarze'], 'alias' => 'يرزة',             'language_type' => 'arabic'],
            ['area_id' => $a['Yarze'], 'alias' => 'yarzi',            'language_type' => 'typo'],

            // Bchamoun
            ['area_id' => $a['Bchamoun'], 'alias' => 'Bchamoun',      'language_type' => 'english'],
            ['area_id' => $a['Bchamoun'], 'alias' => 'bchamoun',      'language_type' => 'english'],
            ['area_id' => $a['Bchamoun'], 'alias' => 'بشامون',        'language_type' => 'arabic'],
            ['area_id' => $a['Bchamoun'], 'alias' => 'bshamoun',      'language_type' => 'typo'],

            // ══════════════════════════════════════════════════════
            // METN DISTRICT
            // ══════════════════════════════════════════════════════

            // Dekwaneh
            ['area_id' => $a['Dekwaneh'], 'alias' => 'Dekwaneh',      'language_type' => 'english'],
            ['area_id' => $a['Dekwaneh'], 'alias' => 'dekwaneh',      'language_type' => 'english'],
            ['area_id' => $a['Dekwaneh'], 'alias' => 'الدكوانة',      'language_type' => 'arabic'],
            ['area_id' => $a['Dekwaneh'], 'alias' => 'dkwene',        'language_type' => 'franco'],
            ['area_id' => $a['Dekwaneh'], 'alias' => 'dkwaneh',       'language_type' => 'franco'],
            ['area_id' => $a['Dekwaneh'], 'alias' => 'dekouane',      'language_type' => 'typo'],
            ['area_id' => $a['Dekwaneh'], 'alias' => 'dekouan',       'language_type' => 'typo'],

            // Jdeideh
            ['area_id' => $a['Jdeideh'], 'alias' => 'Jdeideh',        'language_type' => 'english'],
            ['area_id' => $a['Jdeideh'], 'alias' => 'jdeideh',        'language_type' => 'english'],
            ['area_id' => $a['Jdeideh'], 'alias' => 'الجديدة',        'language_type' => 'arabic'],
            ['area_id' => $a['Jdeideh'], 'alias' => 'jdide',          'language_type' => 'franco'],
            ['area_id' => $a['Jdeideh'], 'alias' => 'jdaydeh',        'language_type' => 'typo'],
            ['area_id' => $a['Jdeideh'], 'alias' => 'jedeideh',       'language_type' => 'typo'],

            // Antelias
            ['area_id' => $a['Antelias'], 'alias' => 'Antelias',      'language_type' => 'english'],
            ['area_id' => $a['Antelias'], 'alias' => 'antelias',      'language_type' => 'english'],
            ['area_id' => $a['Antelias'], 'alias' => 'أنطلياس',       'language_type' => 'arabic'],
            ['area_id' => $a['Antelias'], 'alias' => 'antlias',       'language_type' => 'franco'],
            ['area_id' => $a['Antelias'], 'alias' => 'Antilyas',      'language_type' => 'typo'],
            ['area_id' => $a['Antelias'], 'alias' => 'antilyas',      'language_type' => 'typo'],
            ['area_id' => $a['Antelias'], 'alias' => '3ntlyas',       'language_type' => 'franco'],

            // Fanar
            ['area_id' => $a['Fanar'], 'alias' => 'Fanar',            'language_type' => 'english'],
            ['area_id' => $a['Fanar'], 'alias' => 'fanar',            'language_type' => 'english'],
            ['area_id' => $a['Fanar'], 'alias' => 'الفنار',           'language_type' => 'arabic'],
            ['area_id' => $a['Fanar'], 'alias' => 'el fanar',         'language_type' => 'franco'],
            ['area_id' => $a['Fanar'], 'alias' => 'fnar',             'language_type' => 'typo'],

            // Zalka
            ['area_id' => $a['Zalka'], 'alias' => 'Zalka',            'language_type' => 'english'],
            ['area_id' => $a['Zalka'], 'alias' => 'zalka',            'language_type' => 'english'],
            ['area_id' => $a['Zalka'], 'alias' => 'زلقا',             'language_type' => 'arabic'],
            ['area_id' => $a['Zalka'], 'alias' => 'zalqa',            'language_type' => 'franco'],
            ['area_id' => $a['Zalka'], 'alias' => 'zlka',             'language_type' => 'typo'],

            // Dora
            ['area_id' => $a['Dora'], 'alias' => 'Dora',              'language_type' => 'english'],
            ['area_id' => $a['Dora'], 'alias' => 'dora',              'language_type' => 'english'],
            ['area_id' => $a['Dora'], 'alias' => 'الدورة',            'language_type' => 'arabic'],
            ['area_id' => $a['Dora'], 'alias' => 'el dora',           'language_type' => 'franco'],
            ['area_id' => $a['Dora'], 'alias' => 'dawra',             'language_type' => 'franco'],
            ['area_id' => $a['Dora'], 'alias' => 'el dawra',          'language_type' => 'franco'],
            ['area_id' => $a['Dora'], 'alias' => 'dora highway',      'language_type' => 'english'],

            // Sin El Fil
            ['area_id' => $a['Sin El Fil'], 'alias' => 'Sin El Fil',  'language_type' => 'english'],
            ['area_id' => $a['Sin El Fil'], 'alias' => 'sin el fil',  'language_type' => 'english'],
            ['area_id' => $a['Sin El Fil'], 'alias' => 'سن الفيل',    'language_type' => 'arabic'],
            ['area_id' => $a['Sin El Fil'], 'alias' => 'sin l fil',   'language_type' => 'franco'],
            ['area_id' => $a['Sin El Fil'], 'alias' => 'sinn el fil', 'language_type' => 'typo'],
            ['area_id' => $a['Sin El Fil'], 'alias' => 'sin fil',     'language_type' => 'typo'],

            // Beit Mery
            ['area_id' => $a['Beit Mery'], 'alias' => 'Beit Mery',    'language_type' => 'english'],
            ['area_id' => $a['Beit Mery'], 'alias' => 'beit mery',    'language_type' => 'english'],
            ['area_id' => $a['Beit Mery'], 'alias' => 'بيت مري',      'language_type' => 'arabic'],
            ['area_id' => $a['Beit Mery'], 'alias' => 'bet meri',     'language_type' => 'franco'],
            ['area_id' => $a['Beit Mery'], 'alias' => 'beit meri',    'language_type' => 'typo'],

            // Broumana
            ['area_id' => $a['Broumana'], 'alias' => 'Broumana',      'language_type' => 'english'],
            ['area_id' => $a['Broumana'], 'alias' => 'broumana',      'language_type' => 'english'],
            ['area_id' => $a['Broumana'], 'alias' => 'برمانا',        'language_type' => 'arabic'],
            ['area_id' => $a['Broumana'], 'alias' => 'brummana',      'language_type' => 'typo'],
            ['area_id' => $a['Broumana'], 'alias' => 'brumana',       'language_type' => 'typo'],

            // Naccache
            ['area_id' => $a['Naccache'], 'alias' => 'Naccache',      'language_type' => 'english'],
            ['area_id' => $a['Naccache'], 'alias' => 'naccache',      'language_type' => 'english'],
            ['area_id' => $a['Naccache'], 'alias' => 'النقاش',        'language_type' => 'arabic'],
            ['area_id' => $a['Naccache'], 'alias' => 'nkache',        'language_type' => 'franco'],
            ['area_id' => $a['Naccache'], 'alias' => 'nakache',       'language_type' => 'typo'],

            // Jal El Dib
            ['area_id' => $a['Jal El Dib'], 'alias' => 'Jal El Dib',  'language_type' => 'english'],
            ['area_id' => $a['Jal El Dib'], 'alias' => 'jal el dib',  'language_type' => 'english'],
            ['area_id' => $a['Jal El Dib'], 'alias' => 'جل الديب',    'language_type' => 'arabic'],
            ['area_id' => $a['Jal El Dib'], 'alias' => 'jal dib',     'language_type' => 'franco'],
            ['area_id' => $a['Jal El Dib'], 'alias' => 'jel el dib',  'language_type' => 'typo'],

            // Mansourieh
            ['area_id' => $a['Mansourieh'], 'alias' => 'Mansourieh',  'language_type' => 'english'],
            ['area_id' => $a['Mansourieh'], 'alias' => 'mansourieh',  'language_type' => 'english'],
            ['area_id' => $a['Mansourieh'], 'alias' => 'المنصورية',   'language_type' => 'arabic'],
            ['area_id' => $a['Mansourieh'], 'alias' => 'mansuriye',   'language_type' => 'franco'],
            ['area_id' => $a['Mansourieh'], 'alias' => 'mansouriyeh', 'language_type' => 'typo'],

            // Bsalim
            ['area_id' => $a['Bsalim'], 'alias' => 'Bsalim',          'language_type' => 'english'],
            ['area_id' => $a['Bsalim'], 'alias' => 'bsalim',          'language_type' => 'english'],
            ['area_id' => $a['Bsalim'], 'alias' => 'بصاليم',          'language_type' => 'arabic'],
            ['area_id' => $a['Bsalim'], 'alias' => 'bsaleem',         'language_type' => 'typo'],

            // ══════════════════════════════════════════════════════
            // KESROUAN DISTRICT
            // ══════════════════════════════════════════════════════

            // Jounieh
            ['area_id' => $a['Jounieh'], 'alias' => 'Jounieh',        'language_type' => 'english'],
            ['area_id' => $a['Jounieh'], 'alias' => 'jounieh',        'language_type' => 'english'],
            ['area_id' => $a['Jounieh'], 'alias' => 'جونية',          'language_type' => 'arabic'],
            ['area_id' => $a['Jounieh'], 'alias' => 'Juniyeh',        'language_type' => 'typo'],
            ['area_id' => $a['Jounieh'], 'alias' => 'juniye',         'language_type' => 'typo'],
            ['area_id' => $a['Jounieh'], 'alias' => 'junieh',         'language_type' => 'typo'],
            ['area_id' => $a['Jounieh'], 'alias' => 'jouniye',        'language_type' => 'franco'],

            // Dbayeh
            ['area_id' => $a['Dbayeh'], 'alias' => 'Dbayeh',          'language_type' => 'english'],
            ['area_id' => $a['Dbayeh'], 'alias' => 'dbayeh',          'language_type' => 'english'],
            ['area_id' => $a['Dbayeh'], 'alias' => 'ضبية',            'language_type' => 'arabic'],
            ['area_id' => $a['Dbayeh'], 'alias' => 'dbayyeh',         'language_type' => 'typo'],
            ['area_id' => $a['Dbayeh'], 'alias' => 'dbaye',           'language_type' => 'franco'],

            // Kaslik
            ['area_id' => $a['Kaslik'], 'alias' => 'Kaslik',          'language_type' => 'english'],
            ['area_id' => $a['Kaslik'], 'alias' => 'kaslik',          'language_type' => 'english'],
            ['area_id' => $a['Kaslik'], 'alias' => 'كسليك',           'language_type' => 'arabic'],
            ['area_id' => $a['Kaslik'], 'alias' => 'kaslek',          'language_type' => 'typo'],

            // Zouk Mosbeh
            ['area_id' => $a['Zouk Mosbeh'], 'alias' => 'Zouk Mosbeh',    'language_type' => 'english'],
            ['area_id' => $a['Zouk Mosbeh'], 'alias' => 'zouk mosbeh',    'language_type' => 'english'],
            ['area_id' => $a['Zouk Mosbeh'], 'alias' => 'ذوق مصبح',       'language_type' => 'arabic'],
            ['area_id' => $a['Zouk Mosbeh'], 'alias' => 'zouk',           'language_type' => 'franco'],
            ['area_id' => $a['Zouk Mosbeh'], 'alias' => 'zouk mosbah',    'language_type' => 'typo'],
            ['area_id' => $a['Zouk Mosbeh'], 'alias' => 'zouk msbeh',     'language_type' => 'typo'],

            // Rabieh
            ['area_id' => $a['Rabieh'], 'alias' => 'Rabieh',          'language_type' => 'english'],
            ['area_id' => $a['Rabieh'], 'alias' => 'rabieh',          'language_type' => 'english'],
            ['area_id' => $a['Rabieh'], 'alias' => 'رابية',           'language_type' => 'arabic'],
            ['area_id' => $a['Rabieh'], 'alias' => 'rabiye',          'language_type' => 'franco'],
            ['area_id' => $a['Rabieh'], 'alias' => 'rabiyeh',         'language_type' => 'typo'],

            // Faraya
            ['area_id' => $a['Faraya'], 'alias' => 'Faraya',          'language_type' => 'english'],
            ['area_id' => $a['Faraya'], 'alias' => 'faraya',          'language_type' => 'english'],
            ['area_id' => $a['Faraya'], 'alias' => 'فاريا',           'language_type' => 'arabic'],
            ['area_id' => $a['Faraya'], 'alias' => 'faraia',          'language_type' => 'typo'],

            // ══════════════════════════════════════════════════════
            // ALEY DISTRICT
            // ══════════════════════════════════════════════════════

            // Aley
            ['area_id' => $a['Aley'], 'alias' => 'Aley',              'language_type' => 'english'],
            ['area_id' => $a['Aley'], 'alias' => 'aley',              'language_type' => 'english'],
            ['area_id' => $a['Aley'], 'alias' => 'عاليه',             'language_type' => 'arabic'],
            ['area_id' => $a['Aley'], 'alias' => '3aley',             'language_type' => 'franco'],
            ['area_id' => $a['Aley'], 'alias' => 'alley',             'language_type' => 'typo'],
            ['area_id' => $a['Aley'], 'alias' => 'ali',               'language_type' => 'typo'],

            // Bhamdoun
            ['area_id' => $a['Bhamdoun'], 'alias' => 'Bhamdoun',      'language_type' => 'english'],
            ['area_id' => $a['Bhamdoun'], 'alias' => 'bhamdoun',      'language_type' => 'english'],
            ['area_id' => $a['Bhamdoun'], 'alias' => 'بحمدون',        'language_type' => 'arabic'],
            ['area_id' => $a['Bhamdoun'], 'alias' => 'bhamdun',       'language_type' => 'typo'],
            ['area_id' => $a['Bhamdoun'], 'alias' => 'bamdoun',       'language_type' => 'typo'],

            // Sofar
            ['area_id' => $a['Sofar'], 'alias' => 'Sofar',            'language_type' => 'english'],
            ['area_id' => $a['Sofar'], 'alias' => 'sofar',            'language_type' => 'english'],
            ['area_id' => $a['Sofar'], 'alias' => 'صوفر',             'language_type' => 'arabic'],
            ['area_id' => $a['Sofar'], 'alias' => 'soufar',           'language_type' => 'typo'],

            // ══════════════════════════════════════════════════════
            // TRIPOLI / NORTH
            // ══════════════════════════════════════════════════════

            // Tripoli
            ['area_id' => $a['Tripoli'], 'alias' => 'Tripoli',        'language_type' => 'english'],
            ['area_id' => $a['Tripoli'], 'alias' => 'tripoli',        'language_type' => 'english'],
            ['area_id' => $a['Tripoli'], 'alias' => 'طرابلس',         'language_type' => 'arabic'],
            ['area_id' => $a['Tripoli'], 'alias' => 'trablus',        'language_type' => 'franco'],
            ['area_id' => $a['Tripoli'], 'alias' => 'trablous',       'language_type' => 'franco'],
            ['area_id' => $a['Tripoli'], 'alias' => 'trablos',        'language_type' => 'typo'],
            ['area_id' => $a['Tripoli'], 'alias' => 'trpoli',         'language_type' => 'typo'],

            // Mina
            ['area_id' => $a['Mina'], 'alias' => 'Mina',              'language_type' => 'english'],
            ['area_id' => $a['Mina'], 'alias' => 'mina',              'language_type' => 'english'],
            ['area_id' => $a['Mina'], 'alias' => 'الميناء',           'language_type' => 'arabic'],
            ['area_id' => $a['Mina'], 'alias' => 'el mina',           'language_type' => 'franco'],
            ['area_id' => $a['Mina'], 'alias' => 'mena',              'language_type' => 'typo'],

            // Batroun
            ['area_id' => $a['Batroun'], 'alias' => 'Batroun',        'language_type' => 'english'],
            ['area_id' => $a['Batroun'], 'alias' => 'batroun',        'language_type' => 'english'],
            ['area_id' => $a['Batroun'], 'alias' => 'البترون',        'language_type' => 'arabic'],
            ['area_id' => $a['Batroun'], 'alias' => 'batrun',         'language_type' => 'franco'],
            ['area_id' => $a['Batroun'], 'alias' => 'batroon',        'language_type' => 'typo'],

            // Jbeil
            ['area_id' => $a['Jbeil'], 'alias' => 'Jbeil',            'language_type' => 'english'],
            ['area_id' => $a['Jbeil'], 'alias' => 'jbeil',            'language_type' => 'english'],
            ['area_id' => $a['Jbeil'], 'alias' => 'جبيل',             'language_type' => 'arabic'],
            ['area_id' => $a['Jbeil'], 'alias' => 'Byblos',           'language_type' => 'english'],
            ['area_id' => $a['Jbeil'], 'alias' => 'byblos',           'language_type' => 'english'],
            ['area_id' => $a['Jbeil'], 'alias' => 'jbail',            'language_type' => 'typo'],

            // Zgharta
            ['area_id' => $a['Zgharta'], 'alias' => 'Zgharta',        'language_type' => 'english'],
            ['area_id' => $a['Zgharta'], 'alias' => 'zgharta',        'language_type' => 'english'],
            ['area_id' => $a['Zgharta'], 'alias' => 'زغرتا',          'language_type' => 'arabic'],
            ['area_id' => $a['Zgharta'], 'alias' => 'zgharte',        'language_type' => 'typo'],

            // Bcharre
            ['area_id' => $a['Bcharre'], 'alias' => 'Bcharre',        'language_type' => 'english'],
            ['area_id' => $a['Bcharre'], 'alias' => 'bcharre',        'language_type' => 'english'],
            ['area_id' => $a['Bcharre'], 'alias' => 'بشري',           'language_type' => 'arabic'],
            ['area_id' => $a['Bcharre'], 'alias' => 'bsharri',        'language_type' => 'franco'],
            ['area_id' => $a['Bcharre'], 'alias' => 'bshari',         'language_type' => 'typo'],

            // Halba
            ['area_id' => $a['Halba'], 'alias' => 'Halba',            'language_type' => 'english'],
            ['area_id' => $a['Halba'], 'alias' => 'halba',            'language_type' => 'english'],
            ['area_id' => $a['Halba'], 'alias' => 'حلبا',             'language_type' => 'arabic'],
            ['area_id' => $a['Halba'], 'alias' => 'helba',            'language_type' => 'typo'],

            // ══════════════════════════════════════════════════════
            // BEKAA REGION
            // ══════════════════════════════════════════════════════

            // Zahleh
            ['area_id' => $a['Zahleh'], 'alias' => 'Zahleh',          'language_type' => 'english'],
            ['area_id' => $a['Zahleh'], 'alias' => 'zahleh',          'language_type' => 'english'],
            ['area_id' => $a['Zahleh'], 'alias' => 'زحلة',            'language_type' => 'arabic'],
            ['area_id' => $a['Zahleh'], 'alias' => 'Zahle',           'language_type' => 'english'],
            ['area_id' => $a['Zahleh'], 'alias' => 'zahle',           'language_type' => 'english'],
            ['area_id' => $a['Zahleh'], 'alias' => 'za7leh',          'language_type' => 'franco'],
            ['area_id' => $a['Zahleh'], 'alias' => 'zahli',           'language_type' => 'typo'],
            ['area_id' => $a['Zahleh'], 'alias' => 'zahlee',          'language_type' => 'typo'],

            // Hazerta
            ['area_id' => $a['Hazerta'], 'alias' => 'Hazerta',        'language_type' => 'english'],
            ['area_id' => $a['Hazerta'], 'alias' => 'hazerta',        'language_type' => 'english'],
            ['area_id' => $a['Hazerta'], 'alias' => 'حزرتا',          'language_type' => 'arabic'],
            ['area_id' => $a['Hazerta'], 'alias' => 'حزرتة',          'language_type' => 'arabic'],
            ['area_id' => $a['Hazerta'], 'alias' => '7azerta',        'language_type' => 'franco'],
            ['area_id' => $a['Hazerta'], 'alias' => 'hzerta',         'language_type' => 'typo'],
            ['area_id' => $a['Hazerta'], 'alias' => 'hazzerta',       'language_type' => 'typo'],
            ['area_id' => $a['Hazerta'], 'alias' => 'hazirta',        'language_type' => 'typo'],
            ['area_id' => $a['Hazerta'], 'alias' => 'hazirte',        'language_type' => 'typo'],

            // Chtaura
            ['area_id' => $a['Chtaura'], 'alias' => 'Chtaura',        'language_type' => 'english'],
            ['area_id' => $a['Chtaura'], 'alias' => 'chtaura',        'language_type' => 'english'],
            ['area_id' => $a['Chtaura'], 'alias' => 'شتورا',          'language_type' => 'arabic'],
            ['area_id' => $a['Chtaura'], 'alias' => 'shtaura',        'language_type' => 'franco'],
            ['area_id' => $a['Chtaura'], 'alias' => 'chtora',         'language_type' => 'typo'],
            ['area_id' => $a['Chtaura'], 'alias' => 'chtoura',        'language_type' => 'typo'],

            // Bar Elias
            ['area_id' => $a['Bar Elias'], 'alias' => 'Bar Elias',    'language_type' => 'english'],
            ['area_id' => $a['Bar Elias'], 'alias' => 'bar elias',    'language_type' => 'english'],
            ['area_id' => $a['Bar Elias'], 'alias' => 'بر الياس',     'language_type' => 'arabic'],
            ['area_id' => $a['Bar Elias'], 'alias' => 'bar ilyas',    'language_type' => 'franco'],
            ['area_id' => $a['Bar Elias'], 'alias' => 'bar elie',     'language_type' => 'typo'],

            // Baalbek
            ['area_id' => $a['Baalbek'], 'alias' => 'Baalbek',        'language_type' => 'english'],
            ['area_id' => $a['Baalbek'], 'alias' => 'baalbek',        'language_type' => 'english'],
            ['area_id' => $a['Baalbek'], 'alias' => 'بعلبك',          'language_type' => 'arabic'],
            ['area_id' => $a['Baalbek'], 'alias' => 'ba3labak',       'language_type' => 'franco'],
            ['area_id' => $a['Baalbek'], 'alias' => 'balbak',         'language_type' => 'typo'],
            ['area_id' => $a['Baalbek'], 'alias' => 'baalbak',        'language_type' => 'typo'],

            // Hermel
            ['area_id' => $a['Hermel'], 'alias' => 'Hermel',          'language_type' => 'english'],
            ['area_id' => $a['Hermel'], 'alias' => 'hermel',          'language_type' => 'english'],
            ['area_id' => $a['Hermel'], 'alias' => 'الهرمل',          'language_type' => 'arabic'],
            ['area_id' => $a['Hermel'], 'alias' => 'el hermel',       'language_type' => 'franco'],
            ['area_id' => $a['Hermel'], 'alias' => 'hirmel',          'language_type' => 'typo'],

            // Saadnayel
            ['area_id' => $a['Saadnayel'], 'alias' => 'Saadnayel',    'language_type' => 'english'],
            ['area_id' => $a['Saadnayel'], 'alias' => 'saadnayel',    'language_type' => 'english'],
            ['area_id' => $a['Saadnayel'], 'alias' => 'سعدنايل',      'language_type' => 'arabic'],
            ['area_id' => $a['Saadnayel'], 'alias' => 'sadnayel',     'language_type' => 'typo'],
            ['area_id' => $a['Saadnayel'], 'alias' => 'sa3dnayel',    'language_type' => 'franco'],

            // ══════════════════════════════════════════════════════
            // SOUTH LEBANON
            // ══════════════════════════════════════════════════════

            // Sidon
            ['area_id' => $a['Sidon'], 'alias' => 'Sidon',            'language_type' => 'english'],
            ['area_id' => $a['Sidon'], 'alias' => 'sidon',            'language_type' => 'english'],
            ['area_id' => $a['Sidon'], 'alias' => 'صيدا',             'language_type' => 'arabic'],
            ['area_id' => $a['Sidon'], 'alias' => 'Saida',            'language_type' => 'english'],
            ['area_id' => $a['Sidon'], 'alias' => 'saida',            'language_type' => 'english'],
            ['area_id' => $a['Sidon'], 'alias' => 'sayda',            'language_type' => 'franco'],
            ['area_id' => $a['Sidon'], 'alias' => 'seida',            'language_type' => 'typo'],

            // Tyre
            ['area_id' => $a['Tyre'], 'alias' => 'Tyre',              'language_type' => 'english'],
            ['area_id' => $a['Tyre'], 'alias' => 'tyre',              'language_type' => 'english'],
            ['area_id' => $a['Tyre'], 'alias' => 'صور',               'language_type' => 'arabic'],
            ['area_id' => $a['Tyre'], 'alias' => 'Sour',              'language_type' => 'english'],
            ['area_id' => $a['Tyre'], 'alias' => 'sour',              'language_type' => 'english'],
            ['area_id' => $a['Tyre'], 'alias' => 'sur',               'language_type' => 'franco'],
            ['area_id' => $a['Tyre'], 'alias' => 'tire',              'language_type' => 'typo'],

            // Nabatieh
            ['area_id' => $a['Nabatieh'], 'alias' => 'Nabatieh',      'language_type' => 'english'],
            ['area_id' => $a['Nabatieh'], 'alias' => 'nabatieh',      'language_type' => 'english'],
            ['area_id' => $a['Nabatieh'], 'alias' => 'النبطية',       'language_type' => 'arabic'],
            ['area_id' => $a['Nabatieh'], 'alias' => 'nabatiye',      'language_type' => 'franco'],
            ['area_id' => $a['Nabatieh'], 'alias' => 'nabatiyeh',     'language_type' => 'typo'],
            ['area_id' => $a['Nabatieh'], 'alias' => 'nbatiye',       'language_type' => 'typo'],

            // Bint Jbeil
            ['area_id' => $a['Bint Jbeil'], 'alias' => 'Bint Jbeil',  'language_type' => 'english'],
            ['area_id' => $a['Bint Jbeil'], 'alias' => 'bint jbeil',  'language_type' => 'english'],
            ['area_id' => $a['Bint Jbeil'], 'alias' => 'بنت جبيل',    'language_type' => 'arabic'],
            ['area_id' => $a['Bint Jbeil'], 'alias' => 'bent jbeil',  'language_type' => 'franco'],
            ['area_id' => $a['Bint Jbeil'], 'alias' => 'bint jbail',  'language_type' => 'typo'],

            // Marjeyoun
            ['area_id' => $a['Marjeyoun'], 'alias' => 'Marjeyoun',    'language_type' => 'english'],
            ['area_id' => $a['Marjeyoun'], 'alias' => 'marjeyoun',    'language_type' => 'english'],
            ['area_id' => $a['Marjeyoun'], 'alias' => 'مرجعيون',      'language_type' => 'arabic'],
            ['area_id' => $a['Marjeyoun'], 'alias' => 'marjayoun',    'language_type' => 'typo'],
            ['area_id' => $a['Marjeyoun'], 'alias' => 'marjeyon',     'language_type' => 'typo'],

            // Jezzine
            ['area_id' => $a['Jezzine'], 'alias' => 'Jezzine',        'language_type' => 'english'],
            ['area_id' => $a['Jezzine'], 'alias' => 'jezzine',        'language_type' => 'english'],
            ['area_id' => $a['Jezzine'], 'alias' => 'جزين',           'language_type' => 'arabic'],
            ['area_id' => $a['Jezzine'], 'alias' => 'jezine',         'language_type' => 'typo'],
            ['area_id' => $a['Jezzine'], 'alias' => 'jzine',          'language_type' => 'typo'],
        ];

        DB::table('area_aliases')->insert($aliases);
    }
}