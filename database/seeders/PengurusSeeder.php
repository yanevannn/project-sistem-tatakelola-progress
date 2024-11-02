<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PengurusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('penguruses')->insert([
            [
                'nim' => '123456789',
                'nama' => 'Komang made danen',
                'email' => 'pengurusinti@example.com',
                'jabatan' => 'Ketua',
                'jenis_kelamin' => 'Laki-laki',
                'alamat' => 'Jl. Example No. 1',
                'no_hp' => '081234567890',
                'status' => 'Aktif',
                'password' => Hash::make('password123'),
                'role' => 'Pengurus Inti',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nim' => '987654321',
                'nama' => 'Nyoman made danen',
                'email' => 'pengurus@example.com',
                'jabatan' => 'Sekretaris',
                'jenis_kelamin' => 'Perempuan',
                'alamat' => 'Jl. Example No. 2',
                'no_hp' => '089876543210',
                'status' => 'Aktif',
                'password' => Hash::make('password456'),
                'role' => 'Pengurus',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nim' => '567891234',
                'nama' => 'made n made danen',
                'email' => 'pengurusbendahara@example.com',
                'jabatan' => 'Bendahara',
                'jenis_kelamin' => 'Laki-laki',
                'alamat' => 'Jl. Example No. 3',
                'no_hp' => '081298765432',
                'status' => 'Aktif',
                'password' => Hash::make('password789'),
                'role' => 'Pengurus',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
