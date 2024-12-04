<?php

namespace Database\Seeders;

use App\Models\Inventaris;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class InventarisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Inventaris::create([
            'id_user' => 1,
            'gambar' => 'nophoto.jpg',
            'nama_barang' => 'Laptop',
            'jumlah' => 10,
            'satuan' => 'unit',
            'sumber_pengadaan' => 'Pengadaan Kantor',
            'keterangan' => 'Barang baru, digunakan untuk staf IT',
            'kondisi' => 'baik',
        ]);
        
    }
}
