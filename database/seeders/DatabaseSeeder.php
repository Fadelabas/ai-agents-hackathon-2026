<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            GovernorateSeeder::class,
            DistrictSeeder::class,
            AreaSeeder::class,
            AreaAliasSeeder::class,
            DeliveryPriceSeeder::class,
            DriverSeeder::class,
        ]);
    }
}
