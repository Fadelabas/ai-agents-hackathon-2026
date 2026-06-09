<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DriverSeeder extends Seeder
{
    public function run(): void
    {
        // ── District ID lookup ────────────────────────────────────
        $d = [];
        foreach (DB::table('districts')->get() as $district) {
            $d[$district->name_en] = $district->id;
        }

        $password = Hash::make('password123');

        $drivers = [

            // ══════════════════════════════════════════════════════
            // METN DISTRICT — Heavy coverage (Hackathon region)
            // ══════════════════════════════════════════════════════
            [
                'name'        => 'Ahmad Khalil',
                'phone'       => '03100001',
                'password'    => $password,
                'district_id' => $d['Metn'],
                'status'      => 'available',
            ],
            [
                'name'        => 'Georges Khoury',
                'phone'       => '03100002',
                'password'    => $password,
                'district_id' => $d['Metn'],
                'status'      => 'available',
            ],
            [
                'name'        => 'Elie Nassar',
                'phone'       => '03100003',
                'password'    => $password,
                'district_id' => $d['Metn'],
                'status'      => 'available',
            ],
            [
                'name'        => 'Tony Frem',
                'phone'       => '03100004',
                'password'    => $password,
                'district_id' => $d['Metn'],
                'status'      => 'available',
            ],
            [
                'name'        => 'Charbel Abi Nader',
                'phone'       => '03100005',
                'password'    => $password,
                'district_id' => $d['Metn'],
                'status'      => 'available',
            ],
            [
                'name'        => 'Rami Sleiman',
                'phone'       => '03100006',
                'password'    => $password,
                'district_id' => $d['Metn'],
                'status'      => 'busy',
            ],
            [
                'name'        => 'Fadi Gemayel',
                'phone'       => '03100007',
                'password'    => $password,
                'district_id' => $d['Metn'],
                'status'      => 'available',
            ],
            [
                'name'        => 'Maroun Bou Khalil',
                'phone'       => '03100008',
                'password'    => $password,
                'district_id' => $d['Metn'],
                'status'      => 'available',
            ],
            [
                'name'        => 'Joe Haddad',
                'phone'       => '03100009',
                'password'    => $password,
                'district_id' => $d['Metn'],
                'status'      => 'offline',
            ],
            [
                'name'        => 'Pierre Karam',
                'phone'       => '03100010',
                'password'    => $password,
                'district_id' => $d['Metn'],
                'status'      => 'available',
            ],

            // ══════════════════════════════════════════════════════
            // BAABDA DISTRICT
            // ══════════════════════════════════════════════════════
            [
                'name'        => 'Sara Haddad',
                'phone'       => '03200001',
                'password'    => $password,
                'district_id' => $d['Baabda'],
                'status'      => 'available',
            ],
            [
                'name'        => 'Hassan Mroueh',
                'phone'       => '03200002',
                'password'    => $password,
                'district_id' => $d['Baabda'],
                'status'      => 'available',
            ],
            [
                'name'        => 'Ali Fakhouri',
                'phone'       => '03200003',
                'password'    => $password,
                'district_id' => $d['Baabda'],
                'status'      => 'available',
            ],
            [
                'name'        => 'Nadia Saad',
                'phone'       => '03200004',
                'password'    => $password,
                'district_id' => $d['Baabda'],
                'status'      => 'available',
            ],
            [
                'name'        => 'Jihad Barakat',
                'phone'       => '03200005',
                'password'    => $password,
                'district_id' => $d['Baabda'],
                'status'      => 'busy',
            ],
            [
                'name'        => 'Rawad Chamoun',
                'phone'       => '03200006',
                'password'    => $password,
                'district_id' => $d['Baabda'],
                'status'      => 'available',
            ],

            // ══════════════════════════════════════════════════════
            // BEIRUT DISTRICT
            // ══════════════════════════════════════════════════════
            [
                'name'        => 'Omar Hamdan',
                'phone'       => '03300001',
                'password'    => $password,
                'district_id' => $d['Beirut'],
                'status'      => 'available',
            ],
            [
                'name'        => 'Lara Tabbara',
                'phone'       => '03300002',
                'password'    => $password,
                'district_id' => $d['Beirut'],
                'status'      => 'available',
            ],
            [
                'name'        => 'Walid Itani',
                'phone'       => '03300003',
                'password'    => $password,
                'district_id' => $d['Beirut'],
                'status'      => 'available',
            ],
            [
                'name'        => 'Maya Jaber',
                'phone'       => '03300004',
                'password'    => $password,
                'district_id' => $d['Beirut'],
                'status'      => 'available',
            ],
            [
                'name'        => 'Tarek Zeidan',
                'phone'       => '03300005',
                'password'    => $password,
                'district_id' => $d['Beirut'],
                'status'      => 'busy',
            ],
            [
                'name'        => 'Nadine Khoury',
                'phone'       => '03300006',
                'password'    => $password,
                'district_id' => $d['Beirut'],
                'status'      => 'available',
            ],

            // ══════════════════════════════════════════════════════
            // KESROUAN DISTRICT
            // ══════════════════════════════════════════════════════
            [
                'name'        => 'Ziad Abi Fadel',
                'phone'       => '03400001',
                'password'    => $password,
                'district_id' => $d['Kesrouan'],
                'status'      => 'available',
            ],
            [
                'name'        => 'Celine Abou Jaoude',
                'phone'       => '03400002',
                'password'    => $password,
                'district_id' => $d['Kesrouan'],
                'status'      => 'available',
            ],
            [
                'name'        => 'Rabih Khoury',
                'phone'       => '03400003',
                'password'    => $password,
                'district_id' => $d['Kesrouan'],
                'status'      => 'available',
            ],
            [
                'name'        => 'Mireille Hakim',
                'phone'       => '03400004',
                'password'    => $password,
                'district_id' => $d['Kesrouan'],
                'status'      => 'offline',
            ],

            // ══════════════════════════════════════════════════════
            // JBEIL DISTRICT
            // ══════════════════════════════════════════════════════
            [
                'name'        => 'Elias Khoury Jbeil',
                'phone'       => '03500001',
                'password'    => $password,
                'district_id' => $d['Jbeil'],
                'status'      => 'available',
            ],
            [
                'name'        => 'Rita Awad',
                'phone'       => '03500002',
                'password'    => $password,
                'district_id' => $d['Jbeil'],
                'status'      => 'available',
            ],

            // ══════════════════════════════════════════════════════
            // CHOUF DISTRICT
            // ══════════════════════════════════════════════════════
            [
                'name'        => 'Walid Jumblatt Jr',
                'phone'       => '03600001',
                'password'    => $password,
                'district_id' => $d['Chouf'],
                'status'      => 'available',
            ],
            [
                'name'        => 'Rola Arslan',
                'phone'       => '03600002',
                'password'    => $password,
                'district_id' => $d['Chouf'],
                'status'      => 'available',
            ],

            // ══════════════════════════════════════════════════════
            // ALEY DISTRICT
            // ══════════════════════════════════════════════════════
            [
                'name'        => 'Samer Talhouk',
                'phone'       => '03700001',
                'password'    => $password,
                'district_id' => $d['Aley'],
                'status'      => 'available',
            ],
            [
                'name'        => 'Carla Abi Nader',
                'phone'       => '03700002',
                'password'    => $password,
                'district_id' => $d['Aley'],
                'status'      => 'available',
            ],

            // ══════════════════════════════════════════════════════
            // ZAHLEH DISTRICT — Heavy coverage
            // ══════════════════════════════════════════════════════
            [
                'name'        => 'Karim Nassar',
                'phone'       => '03800001',
                'password'    => $password,
                'district_id' => $d['Zahleh'],
                'status'      => 'available',
            ],
            [
                'name'        => 'Michel Tawk',
                'phone'       => '03800002',
                'password'    => $password,
                'district_id' => $d['Zahleh'],
                'status'      => 'available',
            ],
            [
                'name'        => 'Joelle Lahoud',
                'phone'       => '03800003',
                'password'    => $password,
                'district_id' => $d['Zahleh'],
                'status'      => 'available',
            ],
            [
                'name'        => 'Fares Abou Khalil',
                'phone'       => '03800004',
                'password'    => $password,
                'district_id' => $d['Zahleh'],
                'status'      => 'available',
            ],
            [
                'name'        => 'Roula Mrad',
                'phone'       => '03800005',
                'password'    => $password,
                'district_id' => $d['Zahleh'],
                'status'      => 'busy',
            ],
            [
                'name'        => 'Imad Hbeish',
                'phone'       => '03800006',
                'password'    => $password,
                'district_id' => $d['Zahleh'],
                'status'      => 'available',
            ],

            // ══════════════════════════════════════════════════════
            // WEST BEKAA DISTRICT
            // ══════════════════════════════════════════════════════
            [
                'name'        => 'Hussein Zeaiter',
                'phone'       => '03900001',
                'password'    => $password,
                'district_id' => $d['West Bekaa'],
                'status'      => 'available',
            ],
            [
                'name'        => 'Rania Houmani',
                'phone'       => '03900002',
                'password'    => $password,
                'district_id' => $d['West Bekaa'],
                'status'      => 'available',
            ],
            [
                'name'        => 'Bassem Saad',
                'phone'       => '03900003',
                'password'    => $password,
                'district_id' => $d['West Bekaa'],
                'status'      => 'available',
            ],

            // ══════════════════════════════════════════════════════
            // BAALBEK DISTRICT
            // ══════════════════════════════════════════════════════
            [
                'name'        => 'Ali Hassan',
                'phone'       => '04100001',
                'password'    => $password,
                'district_id' => $d['Baalbek'],
                'status'      => 'available',
            ],
            [
                'name'        => 'Mohammad Berri',
                'phone'       => '04100002',
                'password'    => $password,
                'district_id' => $d['Baalbek'],
                'status'      => 'available',
            ],
            [
                'name'        => 'Fatima Hamdan',
                'phone'       => '04100003',
                'password'    => $password,
                'district_id' => $d['Baalbek'],
                'status'      => 'offline',
            ],

            // ══════════════════════════════════════════════════════
            // HERMEL DISTRICT
            // ══════════════════════════════════════════════════════
            [
                'name'        => 'Kassem Noureddine',
                'phone'       => '04200001',
                'password'    => $password,
                'district_id' => $d['Hermel'],
                'status'      => 'available',
            ],

            // ══════════════════════════════════════════════════════
            // TRIPOLI DISTRICT
            // ══════════════════════════════════════════════════════
            [
                'name'        => 'Khaled Mawlawi',
                'phone'       => '06100001',
                'password'    => $password,
                'district_id' => $d['Tripoli'],
                'status'      => 'available',
            ],
            [
                'name'        => 'Dina Mikati',
                'phone'       => '06100002',
                'password'    => $password,
                'district_id' => $d['Tripoli'],
                'status'      => 'available',
            ],
            [
                'name'        => 'Samir Karami',
                'phone'       => '06100003',
                'password'    => $password,
                'district_id' => $d['Tripoli'],
                'status'      => 'available',
            ],

            // ══════════════════════════════════════════════════════
            // KOURA DISTRICT
            // ══════════════════════════════════════════════════════
            [
                'name'        => 'Nabil Doueihy',
                'phone'       => '06200001',
                'password'    => $password,
                'district_id' => $d['Koura'],
                'status'      => 'available',
            ],

            // ══════════════════════════════════════════════════════
            // BATROUN DISTRICT
            // ══════════════════════════════════════════════════════
            [
                'name'        => 'Wissam Gemayel',
                'phone'       => '06300001',
                'password'    => $password,
                'district_id' => $d['Batroun'],
                'status'      => 'available',
            ],
            [
                'name'        => 'Joelle Khoury',
                'phone'       => '06300002',
                'password'    => $password,
                'district_id' => $d['Batroun'],
                'status'      => 'available',
            ],

            // ══════════════════════════════════════════════════════
            // ZGHARTA DISTRICT
            // ══════════════════════════════════════════════════════
            [
                'name'        => 'Sleiman Frangieh Jr',
                'phone'       => '06400001',
                'password'    => $password,
                'district_id' => $d['Zgharta'],
                'status'      => 'available',
            ],

            // ══════════════════════════════════════════════════════
            // BCHARRE DISTRICT
            // ══════════════════════════════════════════════════════
            [
                'name'        => 'Boutros Geagea',
                'phone'       => '06500001',
                'password'    => $password,
                'district_id' => $d['Bcharre'],
                'status'      => 'available',
            ],

            // ══════════════════════════════════════════════════════
            // AKKAR DISTRICT
            // ══════════════════════════════════════════════════════
            [
                'name'        => 'Ahmad Majzoub',
                'phone'       => '06600001',
                'password'    => $password,
                'district_id' => $d['Akkar'],
                'status'      => 'available',
            ],

            // ══════════════════════════════════════════════════════
            // SIDON DISTRICT
            // ══════════════════════════════════════════════════════
            [
                'name'        => 'Bahaa Hariri',
                'phone'       => '07100001',
                'password'    => $password,
                'district_id' => $d['Sidon'],
                'status'      => 'available',
            ],
            [
                'name'        => 'Dima Zeidan',
                'phone'       => '07100002',
                'password'    => $password,
                'district_id' => $d['Sidon'],
                'status'      => 'available',
            ],

            // ══════════════════════════════════════════════════════
            // TYRE DISTRICT
            // ══════════════════════════════════════════════════════
            [
                'name'        => 'Kassem Khalil',
                'phone'       => '07200001',
                'password'    => $password,
                'district_id' => $d['Tyre'],
                'status'      => 'available',
            ],
            [
                'name'        => 'Leila Osseiran',
                'phone'       => '07200002',
                'password'    => $password,
                'district_id' => $d['Tyre'],
                'status'      => 'available',
            ],

            // ══════════════════════════════════════════════════════
            // JEZZINE DISTRICT
            // ══════════════════════════════════════════════════════
            [
                'name'        => 'Sami Abou Zeid',
                'phone'       => '07300001',
                'password'    => $password,
                'district_id' => $d['Jezzine'],
                'status'      => 'available',
            ],

            // ══════════════════════════════════════════════════════
            // NABATIEH DISTRICT
            // ══════════════════════════════════════════════════════
            [
                'name'        => 'Ali Shamseddine',
                'phone'       => '07400001',
                'password'    => $password,
                'district_id' => $d['Nabatieh'],
                'status'      => 'available',
            ],
            [
                'name'        => 'Hana Bazzi',
                'phone'       => '07400002',
                'password'    => $password,
                'district_id' => $d['Nabatieh'],
                'status'      => 'available',
            ],

            // ══════════════════════════════════════════════════════
            // BINT JBEIL DISTRICT
            // ══════════════════════════════════════════════════════
            [
                'name'        => 'Mohammad Raad',
                'phone'       => '07500001',
                'password'    => $password,
                'district_id' => $d['Bint Jbeil'],
                'status'      => 'available',
            ],

            // ══════════════════════════════════════════════════════
            // MARJEYOUN DISTRICT
            // ══════════════════════════════════════════════════════
            [
                'name'        => 'Nabil Haddad',
                'phone'       => '07600001',
                'password'    => $password,
                'district_id' => $d['Marjeyoun'],
                'status'      => 'available',
            ],

            // ══════════════════════════════════════════════════════
            // HASBAYA DISTRICT
            // ══════════════════════════════════════════════════════
            [
                'name'        => 'Wael Arslan',
                'phone'       => '07700001',
                'password'    => $password,
                'district_id' => $d['Hasbaya'],
                'status'      => 'available',
            ],

            // ══════════════════════════════════════════════════════
            // RASHAYA DISTRICT
            // ══════════════════════════════════════════════════════
            [
                'name'        => 'Ramzi Jumblatt',
                'phone'       => '08100001',
                'password'    => $password,
                'district_id' => $d['Rashaya'],
                'status'      => 'available',
            ],

            // ══════════════════════════════════════════════════════
            // MINIYEH-DANNIYEH DISTRICT
            // ══════════════════════════════════════════════════════
            [
                'name'        => 'Ahmad Safadi',
                'phone'       => '06700001',
                'password'    => $password,
                'district_id' => $d['Miniyeh-Danniyeh'],
                'status'      => 'available',
            ],
        ];

        // Add timestamps
        $now = now();
        foreach ($drivers as &$driver) {
            $driver['created_at'] = $now;
            $driver['updated_at'] = $now;
        }

        DB::table('drivers')->insert($drivers);
    }
}