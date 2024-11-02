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

        Inventaris::create([
            'id_user' => 1, 
            'gambar' => 'nophoto.jpg',
            'nama_barang' => 'Proyektor',
            'jumlah' => 5,
            'satuan' => 'unit',
            'sumber_pengadaan' => 'Donasi',
            'keterangan' => 'Digunakan untuk ruang rapat',
            'kondisi' => 'baik',
        ]);

        Inventaris::create([
            'id_user' => 1,
            'gambar' => 'nophoto.jpg',
            'nama_barang' => 'Meja Kerja',
            'jumlah' => 20,
            'satuan' => 'unit',
            'sumber_pengadaan' => 'Pengadaan Internal',
            'keterangan' => 'Meja untuk karyawan',
            'kondisi' => 'perbaikan',
        ]);
        Inventaris::create([
            'id_user' => 1,
            'gambar' => 'nophoto.jpg',
            'nama_barang' => 'Meja Kerja',
            'jumlah' => 20,
            'satuan' => 'unit',
            'sumber_pengadaan' => 'Pengadaan Internal',
            'keterangan' => 'Meja untuk karyawan',
            'kondisi' => 'perbaikan',
        ]);
        Inventaris::create([
            'id_user' => 1,
            'gambar' => 'nophoto.jpg',
            'nama_barang' => 'Meja Kerja',
            'jumlah' => 20,
            'satuan' => 'unit',
            'sumber_pengadaan' => 'Pengadaan Internal',
            'keterangan' => 'Meja untuk karyawan',
            'kondisi' => 'perbaikan',
        ]);
        Inventaris::create([
            'id_user' => 1,
            'gambar' => 'nophoto.jpg',
            'nama_barang' => 'Meja Kerja',
            'jumlah' => 20,
            'satuan' => 'unit',
            'sumber_pengadaan' => 'Pengadaan Internal',
            'keterangan' => 'Meja untuk karyawan',
            'kondisi' => 'perbaikan',
        ]);
        Inventaris::create([
            'id_user' => 1,
            'gambar' => 'nophoto.jpg',
            'nama_barang' => 'Meja Kerja',
            'jumlah' => 20,
            'satuan' => 'unit',
            'sumber_pengadaan' => 'Pengadaan Internal',
            'keterangan' => 'Meja untuk karyawan',
            'kondisi' => 'perbaikan',
        ]);
        Inventaris::create([
            'id_user' => 1,
            'gambar' => 'nophoto.jpg',
            'nama_barang' => 'Meja Kerja',
            'jumlah' => 20,
            'satuan' => 'unit',
            'sumber_pengadaan' => 'Pengadaan Internal',
            'keterangan' => 'Meja untuk karyawan',
            'kondisi' => 'perbaikan',
        ]);
        Inventaris::create([
            'id_user' => 1,
            'gambar' => 'nophoto.jpg',
            'nama_barang' => 'Meja Kerja',
            'jumlah' => 20,
            'satuan' => 'unit',
            'sumber_pengadaan' => 'Pengadaan Internal',
            'keterangan' => 'Meja untuk karyawan',
            'kondisi' => 'perbaikan',
        ]);
        Inventaris::create([
            'id_user' => 1,
            'gambar' => 'nophoto.jpg',
            'nama_barang' => 'Meja Kerja',
            'jumlah' => 20,
            'satuan' => 'unit',
            'sumber_pengadaan' => 'Pengadaan Internal',
            'keterangan' => 'Meja untuk karyawan',
            'kondisi' => 'perbaikan',
        ]);
        
    }
}
