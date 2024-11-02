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

        SuratMasuk::create([
            'id_user' => 1,
            'id_periode' => 1,
            'nomor_surat_masuk' => '002/DPM.STIKOM/I/1',
            'pengirim' => 'DPM',
            'tanggal_surat' => '1-01-05',
            'tanggal_terima' => '1-01-06',
            'penerima' => 'Evan',
            'file' => 'file1.pdf',
            'keterangan' => 'Keterangan 2',
        ]);

        SuratMasuk::create([
            'id_user' => 1,
            'id_periode' => 1,
            'nomor_surat_masuk' => '003/DPM.STIKOM/I/1',
            'pengirim' => 'DPM',
            'tanggal_surat' => '1-01-05',
            'tanggal_terima' => '1-01-06',
            'penerima' => 'Evan',
            'file' => 'file1.pdf',
            'keterangan' => 'Keterangan 3',
        ]);

        SuratMasuk::create([
            'id_user' => 1,
            'id_periode' => 1,
            'nomor_surat_masuk' => '004/DPM.STIKOM/I/1',
            'pengirim' => 'DPM',
            'tanggal_surat' => '1-01-05',
            'tanggal_terima' => '1-01-06',
            'penerima' => 'Evan',
            'file' => 'file1.pdf',
            'keterangan' => 'Keterangan 4',
        ]);

        SuratMasuk::create([
            'id_user' => 1,
            'id_periode' => 1,
            'nomor_surat_masuk' => '005/DPM.STIKOM/I/1',
            'pengirim' => 'DPM',
            'tanggal_surat' => '1-01-05',
            'tanggal_terima' => '1-01-06',
            'penerima' => 'Evan',
            'file' => 'file1.pdf',
            'keterangan' => 'Keterangan 5',
        ]);

        SuratMasuk::create([
            'id_user' => 1,
            'id_periode' => 1,
            'nomor_surat_masuk' => '006/DPM.STIKOM/I/1',
            'pengirim' => 'DPM',
            'tanggal_surat' => '1-01-05',
            'tanggal_terima' => '1-01-06',
            'penerima' => 'Evan',
            'file' => 'file1.pdf',
            'keterangan' => 'Keterangan 6',
        ]);

        SuratMasuk::create([
            'id_user' => 1,
            'id_periode' => 1,
            'nomor_surat_masuk' => '007/DPM.STIKOM/I/1',
            'pengirim' => 'DPM',
            'tanggal_surat' => '1-01-05',
            'tanggal_terima' => '1-01-06',
            'penerima' => 'Evan',
            'file' => 'file1.pdf',
            'keterangan' => 'Keterangan 7',
        ]);

        SuratMasuk::create([
            'id_user' => 1,
            'id_periode' => 1,
            'nomor_surat_masuk' => '008/DPM.STIKOM/I/1',
            'pengirim' => 'DPM',
            'tanggal_surat' => '1-01-05',
            'tanggal_terima' => '1-01-06',
            'penerima' => 'Evan',
            'file' => 'file1.pdf',
            'keterangan' => 'Keterangan 8',
        ]);

        SuratMasuk::create([
            'id_user' => 1,
            'id_periode' => 1,
            'nomor_surat_masuk' => '009/DPM.STIKOM/I/1',
            'pengirim' => 'DPM',
            'tanggal_surat' => '1-01-05',
            'tanggal_terima' => '1-01-06',
            'penerima' => 'Evan',
            'file' => 'file1.pdf',
            'keterangan' => 'Keterangan 9',
        ]);

        SuratMasuk::create([
            'id_user' => 1,
            'id_periode' => 1,
            'nomor_surat_masuk' => '010/DPM.STIKOM/I/1',
            'pengirim' => 'DPM',
            'tanggal_surat' => '1-01-05',
            'tanggal_terima' => '1-01-06',
            'penerima' => 'Evan',
            'file' => 'file1.pdf',
            'keterangan' => 'Keterangan 10',
        ]);
    }
}
