<?php

namespace Database\Seeders;

use App\Models\Anggota;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnggotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Anggota::create([
            'id_periode' => 3,
            'nim' => '210030300',
            'nama' => 'John Doe',
            'no_hp' => '081234567890',
            'status_keanggotaan' => 'aktif',
            'kelas' => 'Web Dev',
        ]);
        Anggota::create([
            'id_periode' => 3,
            'nim' => '210030301',
            'nama' => 'John Doe',
            'no_hp' => '081234567890',
            'status_keanggotaan' => 'aktif',
            'kelas' => 'Web Dev',
        ]);
        // Data anggota baru dengan email
        Anggota::create([
            'id_periode' => 3,
            'nim' => '210030302',
            'nama' => 'Yan Evan',
            'no_hp' => '081345678901',
            'status_keanggotaan' => 'aktif',
            'kelas' => 'Mobile Dev',
        ]);

        Anggota::create([
            'id_periode' => 3,
            'nim' => '210030303',
            'nama' => 'Wayan Munayana',
            'no_hp' => '081456789012',
            'status_keanggotaan' => 'aktif',
            'kelas' => 'Data Science',
        ]);
        
    }
}
