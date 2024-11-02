<?php

namespace Database\Seeders;

use App\Models\SuratMasuk;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\PeriodeSeeder;
use Database\Seeders\PengurusSeeder;
use Database\Seeders\InventarisSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\SuratMasukSeeder;

class DatabaseSeeder extends Seeder 
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call(PengurusSeeder::class);
        $this->call(PeriodeSeeder::class);
        $this->call(InventarisSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(SuratMasukSeeder::class);
        
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
