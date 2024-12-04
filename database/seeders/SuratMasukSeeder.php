<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SuratMasuk;


class SuratMasukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SuratMasuk::create([
            'id_user' => 1, // Pastikan ID ini sesuai dengan ID user yang ada di tabel users
            'id_periode' => 1, // Pastikan ID ini sesuai dengan ID periode yang ada di tabel periode
            'nomor_surat_masuk' => '001/DPM.STIKOM/I/1',
            'pengirim' => 'DPM',
            'tanggal_surat' => '2024-01-01',
            'tanggal_terima' => '2024-01-02',
            'penerima' => 'Evan',
            'file' => 'file1.pdf', 
            'keterangan' => 'Keterangan 1',
        ]);
    }
}
