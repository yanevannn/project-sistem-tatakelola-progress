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
            'id_periode' => 1,
            'nim' => '22002002',
            'nama' => 'John Doe',
            'email' => 'johndoe@example.com',
            'no_hp' => '081234567890',
            'kelas' => 'Web Dev',
        ]);
    }
}
