<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeliveryPriceSeeder extends Seeder
{
    public function run(): void
    {
        // ── Lookup helpers ────────────────────────────────────────
        $gov = [];
        foreach (DB::table('governorates')->get() as $g) {
            $gov[$g->name_en] = $g->id;
        }

        $dis = [];
        foreach (DB::table('districts')->get() as $d) {
            $dis[$d->name_en] = $d->id;
        }

        $are = [];
        foreach (DB::table('areas')->get() as $a) {
            $are[$a->name_en] = $a->id;
        }

        $prices = [

            // ══════════════════════════════════════════════════════
            // DEFAULT FALLBACK — always exists, never returns null
            // ══════════════════════════════════════════════════════
            [
                'area_id'        => null,
                'district_id'    => null,
                'governorate_id' => null,
                'price'          => 5.00,
                'pricing_level'  => 'default',
            ],

            // ══════════════════════════════════════════════════════
            // GOVERNORATE LEVEL PRICES
            // ══════════════════════════════════════════════════════
            [
                'area_id'        => null,
                'district_id'    => null,
                'governorate_id' => $gov['Beirut'],
                'price'          => 2.00,
                'pricing_level'  => 'governorate',
            ],
            [
                'area_id'        => null,
                'district_id'    => null,
                'governorate_id' => $gov['Mount Lebanon'],
                'price'          => 3.00,
                'pricing_level'  => 'governorate',
            ],
            [
                'area_id'        => null,
                'district_id'    => null,
                'governorate_id' => $gov['North Lebanon'],
                'price'          => 5.00,
                'pricing_level'  => 'governorate',
            ],
            [
                'area_id'        => null,
                'district_id'    => null,
                'governorate_id' => $gov['South Lebanon'],
                'price'          => 5.00,
                'pricing_level'  => 'governorate',
            ],
            [
                'area_id'        => null,
                'district_id'    => null,
                'governorate_id' => $gov['Nabatieh'],
                'price'          => 5.00,
                'pricing_level'  => 'governorate',
            ],
            [
                'area_id'        => null,
                'district_id'    => null,
                'governorate_id' => $gov['Bekaa'],
                'price'          => 6.00,
                'pricing_level'  => 'governorate',
            ],
            [
                'area_id'        => null,
                'district_id'    => null,
                'governorate_id' => $gov['Baalbek-Hermel'],
                'price'          => 8.00,
                'pricing_level'  => 'governorate',
            ],
            [
                'area_id'        => null,
                'district_id'    => null,
                'governorate_id' => $gov['Akkar'],
                'price'          => 7.00,
                'pricing_level'  => 'governorate',
            ],

            // ══════════════════════════════════════════════════════
            // DISTRICT LEVEL PRICES
            // ══════════════════════════════════════════════════════

            // Beirut
            [
                'area_id'        => null,
                'district_id'    => $dis['Beirut'],
                'governorate_id' => null,
                'price'          => 2.00,
                'pricing_level'  => 'district',
            ],

            // Mount Lebanon districts
            [
                'area_id'        => null,
                'district_id'    => $dis['Baabda'],
                'governorate_id' => null,
                'price'          => 3.00,
                'pricing_level'  => 'district',
            ],
            [
                'area_id'        => null,
                'district_id'    => $dis['Metn'],
                'governorate_id' => null,
                'price'          => 3.00,
                'pricing_level'  => 'district',
            ],
            [
                'area_id'        => null,
                'district_id'    => $dis['Kesrouan'],
                'governorate_id' => null,
                'price'          => 4.00,
                'pricing_level'  => 'district',
            ],
            [
                'area_id'        => null,
                'district_id'    => $dis['Jbeil'],
                'governorate_id' => null,
                'price'          => 4.50,
                'pricing_level'  => 'district',
            ],
            [
                'area_id'        => null,
                'district_id'    => $dis['Chouf'],
                'governorate_id' => null,
                'price'          => 4.00,
                'pricing_level'  => 'district',
            ],
            [
                'area_id'        => null,
                'district_id'    => $dis['Aley'],
                'governorate_id' => null,
                'price'          => 3.50,
                'pricing_level'  => 'district',
            ],

            // North Lebanon districts
            [
                'area_id'        => null,
                'district_id'    => $dis['Tripoli'],
                'governorate_id' => null,
                'price'          => 5.00,
                'pricing_level'  => 'district',
            ],
            [
                'area_id'        => null,
                'district_id'    => $dis['Koura'],
                'governorate_id' => null,
                'price'          => 5.50,
                'pricing_level'  => 'district',
            ],
            [
                'area_id'        => null,
                'district_id'    => $dis['Batroun'],
                'governorate_id' => null,
                'price'          => 5.50,
                'pricing_level'  => 'district',
            ],
            [
                'area_id'        => null,
                'district_id'    => $dis['Zgharta'],
                'governorate_id' => null,
                'price'          => 5.50,
                'pricing_level'  => 'district',
            ],
            [
                'area_id'        => null,
                'district_id'    => $dis['Bcharre'],
                'governorate_id' => null,
                'price'          => 6.00,
                'pricing_level'  => 'district',
            ],
            [
                'area_id'        => null,
                'district_id'    => $dis['Miniyeh-Danniyeh'],
                'governorate_id' => null,
                'price'          => 6.00,
                'pricing_level'  => 'district',
            ],

            // South Lebanon districts
            [
                'area_id'        => null,
                'district_id'    => $dis['Sidon'],
                'governorate_id' => null,
                'price'          => 5.00,
                'pricing_level'  => 'district',
            ],
            [
                'area_id'        => null,
                'district_id'    => $dis['Tyre'],
                'governorate_id' => null,
                'price'          => 6.00,
                'pricing_level'  => 'district',
            ],
            [
                'area_id'        => null,
                'district_id'    => $dis['Jezzine'],
                'governorate_id' => null,
                'price'          => 5.50,
                'pricing_level'  => 'district',
            ],

            // Nabatieh districts
            [
                'area_id'        => null,
                'district_id'    => $dis['Nabatieh'],
                'governorate_id' => null,
                'price'          => 5.00,
                'pricing_level'  => 'district',
            ],
            [
                'area_id'        => null,
                'district_id'    => $dis['Bint Jbeil'],
                'governorate_id' => null,
                'price'          => 6.00,
                'pricing_level'  => 'district',
            ],
            [
                'area_id'        => null,
                'district_id'    => $dis['Hasbaya'],
                'governorate_id' => null,
                'price'          => 6.00,
                'pricing_level'  => 'district',
            ],
            [
                'area_id'        => null,
                'district_id'    => $dis['Marjeyoun'],
                'governorate_id' => null,
                'price'          => 6.00,
                'pricing_level'  => 'district',
            ],

            // Bekaa districts
            [
                'area_id'        => null,
                'district_id'    => $dis['Zahleh'],
                'governorate_id' => null,
                'price'          => 5.00,
                'pricing_level'  => 'district',
            ],
            [
                'area_id'        => null,
                'district_id'    => $dis['West Bekaa'],
                'governorate_id' => null,
                'price'          => 6.00,
                'pricing_level'  => 'district',
            ],
            [
                'area_id'        => null,
                'district_id'    => $dis['Rashaya'],
                'governorate_id' => null,
                'price'          => 6.50,
                'pricing_level'  => 'district',
            ],

            // Baalbek-Hermel districts
            [
                'area_id'        => null,
                'district_id'    => $dis['Baalbek'],
                'governorate_id' => null,
                'price'          => 7.00,
                'pricing_level'  => 'district',
            ],
            [
                'area_id'        => null,
                'district_id'    => $dis['Hermel'],
                'governorate_id' => null,
                'price'          => 8.00,
                'pricing_level'  => 'district',
            ],

            // Akkar
            [
                'area_id'        => null,
                'district_id'    => $dis['Akkar'],
                'governorate_id' => null,
                'price'          => 7.00,
                'pricing_level'  => 'district',
            ],

            // ══════════════════════════════════════════════════════
            // AREA LEVEL PRICES (specific overrides)
            // ══════════════════════════════════════════════════════

            // Beirut neighborhoods — cheaper within city
            [
                'area_id'        => $are['Hamra'],
                'district_id'    => null,
                'governorate_id' => null,
                'price'          => 1.50,
                'pricing_level'  => 'area',
            ],
            [
                'area_id'        => $are['Achrafieh'],
                'district_id'    => null,
                'governorate_id' => null,
                'price'          => 1.50,
                'pricing_level'  => 'area',
            ],
            [
                'area_id'        => $are['Verdun'],
                'district_id'    => null,
                'governorate_id' => null,
                'price'          => 1.50,
                'pricing_level'  => 'area',
            ],
            [
                'area_id'        => $are['Badaro'],
                'district_id'    => null,
                'governorate_id' => null,
                'price'          => 1.50,
                'pricing_level'  => 'area',
            ],
            [
                'area_id'        => $are['Gemmayzeh'],
                'district_id'    => null,
                'governorate_id' => null,
                'price'          => 1.50,
                'pricing_level'  => 'area',
            ],
            [
                'area_id'        => $are['Downtown Beirut'],
                'district_id'    => null,
                'governorate_id' => null,
                'price'          => 1.50,
                'pricing_level'  => 'area',
            ],

            // Key Baabda areas
            [
                'area_id'        => $are['Hazmieh'],
                'district_id'    => null,
                'governorate_id' => null,
                'price'          => 2.50,
                'pricing_level'  => 'area',
            ],
            [
                'area_id'        => $are['Hadath'],
                'district_id'    => null,
                'governorate_id' => null,
                'price'          => 2.50,
                'pricing_level'  => 'area',
            ],
            [
                'area_id'        => $are['Khalde'],
                'district_id'    => null,
                'governorate_id' => null,
                'price'          => 3.00,
                'pricing_level'  => 'area',
            ],

            // Key Metn areas
            [
                'area_id'        => $are['Dekwaneh'],
                'district_id'    => null,
                'governorate_id' => null,
                'price'          => 2.50,
                'pricing_level'  => 'area',
            ],
            [
                'area_id'        => $are['Jdeideh'],
                'district_id'    => null,
                'governorate_id' => null,
                'price'          => 2.50,
                'pricing_level'  => 'area',
            ],
            [
                'area_id'        => $are['Antelias'],
                'district_id'    => null,
                'governorate_id' => null,
                'price'          => 2.50,
                'pricing_level'  => 'area',
            ],
            [
                'area_id'        => $are['Sin El Fil'],
                'district_id'    => null,
                'governorate_id' => null,
                'price'          => 2.00,
                'pricing_level'  => 'area',
            ],
            [
                'area_id'        => $are['Dora'],
                'district_id'    => null,
                'governorate_id' => null,
                'price'          => 2.00,
                'pricing_level'  => 'area',
            ],
            [
                'area_id'        => $are['Zalka'],
                'district_id'    => null,
                'governorate_id' => null,
                'price'          => 2.50,
                'pricing_level'  => 'area',
            ],
            [
                'area_id'        => $are['Fanar'],
                'district_id'    => null,
                'governorate_id' => null,
                'price'          => 2.50,
                'pricing_level'  => 'area',
            ],
            [
                'area_id'        => $are['Bourj Hammoud'],
                'district_id'    => null,
                'governorate_id' => null,
                'price'          => 2.00,
                'pricing_level'  => 'area',
            ],
            [
                'area_id'        => $are['Bauchrieh'],
                'district_id'    => null,
                'governorate_id' => null,
                'price'          => 2.50,
                'pricing_level'  => 'area',
            ],
            [
                'area_id'        => $are['Mkalles'],
                'district_id'    => null,
                'governorate_id' => null,
                'price'          => 2.50,
                'pricing_level'  => 'area',
            ],
            [
                'area_id'        => $are['Ain Saadeh'],
                'district_id'    => null,
                'governorate_id' => null,
                'price'          => 3.00,
                'pricing_level'  => 'area',
            ],
            [
                'area_id'        => $are['Roumieh'],
                'district_id'    => null,
                'governorate_id' => null,
                'price'          => 3.00,
                'pricing_level'  => 'area',
            ],
            [
                'area_id'        => $are['Mansourieh'],
                'district_id'    => null,
                'governorate_id' => null,
                'price'          => 3.00,
                'pricing_level'  => 'area',
            ],
            [
                'area_id'        => $are['Jal El Dib'],
                'district_id'    => null,
                'governorate_id' => null,
                'price'          => 2.50,
                'pricing_level'  => 'area',
            ],

            // Kesrouan areas
            [
                'area_id'        => $are['Jounieh'],
                'district_id'    => null,
                'governorate_id' => null,
                'price'          => 3.50,
                'pricing_level'  => 'area',
            ],
            [
                'area_id'        => $are['Dbayeh'],
                'district_id'    => null,
                'governorate_id' => null,
                'price'          => 3.00,
                'pricing_level'  => 'area',
            ],
            [
                'area_id'        => $are['Kaslik'],
                'district_id'    => null,
                'governorate_id' => null,
                'price'          => 3.50,
                'pricing_level'  => 'area',
            ],

            // Bekaa key areas
            [
                'area_id'        => $are['Zahleh'],
                'district_id'    => null,
                'governorate_id' => null,
                'price'          => 4.50,
                'pricing_level'  => 'area',
            ],
            [
                'area_id'        => $are['Hazerta'],
                'district_id'    => null,
                'governorate_id' => null,
                'price'          => 5.00,
                'pricing_level'  => 'area',
            ],
            [
                'area_id'        => $are['Chtaura'],
                'district_id'    => null,
                'governorate_id' => null,
                'price'          => 5.00,
                'pricing_level'  => 'area',
            ],
            [
                'area_id'        => $are['Bar Elias'],
                'district_id'    => null,
                'governorate_id' => null,
                'price'          => 5.50,
                'pricing_level'  => 'area',
            ],
            [
                'area_id'        => $are['Baalbek'],
                'district_id'    => null,
                'governorate_id' => null,
                'price'          => 7.00,
                'pricing_level'  => 'area',
            ],
        ];

        DB::table('delivery_prices')->insert($prices);
    }
}