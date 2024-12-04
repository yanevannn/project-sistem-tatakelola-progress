<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeriodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('periode')->insert([
            [
                'tahun' => '2023/2024',
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
