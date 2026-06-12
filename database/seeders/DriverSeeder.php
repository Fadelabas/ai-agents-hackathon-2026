<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DriverSeeder extends Seeder
{
    public function run(): void
    {
        $password = Hash::make('password123');

        $districts = DB::table('districts')
            ->join('governorates', 'districts.governorate_id', '=', 'governorates.id')
            ->select(
                'districts.id as district_id',
                'districts.name_en as district_name',
                'governorates.name_en as gov_name'
            )
            ->orderBy('governorates.name_en')
            ->orderBy('districts.name_en')
            ->get();

        $drivers = [];

        // ── District drivers: 03100001, 03100002 ... ──────────
        foreach ($districts as $index => $district) {
            $phone = '031' . str_pad($index + 1, 5, '0', STR_PAD_LEFT);

            $drivers[] = [
                'name'        => $district->district_name . ' Demo Driver',
                'phone'       => $phone,
                'password'    => $password,
                'district_id' => $district->district_id,
                'status'      => 'available',
                'created_at'  => now(),
                'updated_at'  => now(),
            ];
        }

        // ── Governorate fallback drivers: 03900001 ... ────────
        $governorates = DB::table('governorates')->orderBy('name_en')->get();

        foreach ($governorates as $index => $gov) {
            $firstDistrict = DB::table('districts')
                ->where('governorate_id', $gov->id)
                ->orderBy('name_en')
                ->first();

            if (!$firstDistrict) continue;

            $phone = '039' . str_pad($index + 1, 5, '0', STR_PAD_LEFT);

            $drivers[] = [
                'name'        => $gov->name_en . ' Fallback Driver',
                'phone'       => $phone,
                'password'    => $password,
                'district_id' => $firstDistrict->id,
                'status'      => 'available',
                'created_at'  => now(),
                'updated_at'  => now(),
            ];
        }

        DB::table('drivers')->insert($drivers);

        // ── Print demo credentials ────────────────────────────
        $this->command->info('');
        $this->command->info('╔══════════════════════════════════════════════════════════════╗');
        $this->command->info('║           JIBLI — DEMO DRIVER CREDENTIALS                   ║');
        $this->command->info('╠══════════════════════════════════════════════════════════════╣');
        $this->command->info('║  All passwords: password123                                  ║');
        $this->command->info('╠══════════════════════════════════════════════════════════════╣');

        $keyDrivers = DB::table('drivers')
            ->join('districts', 'drivers.district_id', '=', 'districts.id')
            ->join('governorates', 'districts.governorate_id', '=', 'governorates.id')
            ->select(
                'drivers.name',
                'drivers.phone',
                'districts.name_en as district',
                'governorates.name_en as governorate'
            )
            ->orderBy('drivers.id')
            ->get();

        foreach ($keyDrivers as $d) {
            $line = sprintf(
                '║  %-30s | %-12s | %-20s ║',
                substr($d->name, 0, 30),
                $d->phone,
                substr($d->district . ' / ' . $d->governorate, 0, 20)
            );
            $this->command->info($line);
        }

        $this->command->info('╚══════════════════════════════════════════════════════════════╝');
        $this->command->info('');
    }
}