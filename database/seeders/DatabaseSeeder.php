<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\AnggotaSeeder;
use Database\Seeders\PeriodeSeeder;
use Database\Seeders\InventarisSeeder;
use Database\Seeders\SuratMasukSeeder;
use Database\Seeders\SuratKeluarSeeder;


class DatabaseSeeder extends Seeder 
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(PeriodeSeeder::class);
        $this->call(AnggotaSeeder::class);
        $this->call(UserSeeder::class);
        // $this->call(InventarisSeeder::class);
        // $this->call(SuratMasukSeeder::class);
        // $this->call(SuratKeluarSeeder::class);
        // $this->call(KeuanganSeeder::class);
    }
}
