<?php

namespace Database\Seeders;

use App\Models\Keuangan;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KeuanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Keuangan::create([
            'id_user' => 1,
            'id_periode' => 1,
            'tanggal' => Carbon::create(2023, 1, 1),
            'keterangan' => 'Iuran Bulanan',
            'pemasukan' => 100000,
            'pengeluaran' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Keuangan::create([
            'id_user' => 1,
            'id_periode' => 1,
            'tanggal' => Carbon::create(2023, 1, 17),
            'keterangan' => 'Pembelian Materai',
            'pemasukan' => 0,
            'pengeluaran' => 10000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
