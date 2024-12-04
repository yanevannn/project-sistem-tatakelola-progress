<?php

namespace Database\Seeders;

use App\Models\SuratKeluar;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SuratKeluarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SuratKeluar::create([
            'id_user' => 1, // Ganti dengan ID user yang valid
            'id_periode' => 1, // Ganti dengan ID periode yang valid
            'nomor_surat_keluar' => '001/UKM.progress/BEM.ITBSTIKOM/I/2024',
            'tertuju' => 'BEM',
            'keterangan' => 'Adiensi Infinity',
            'tanggal_surat' => '2024-01-01',
            'tanggal_terkirim' => '2024-01-02',
            'file' => 'nofile.pdf',
        ]);

    }
}
