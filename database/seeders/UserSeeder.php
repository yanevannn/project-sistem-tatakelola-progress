<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'id_periode' => 1, // Contoh periode ID
                'nim' => '210030393',
                'nama' => 'Wayan Evan Ada Munayana',
                'role' => 'Ketua',
                'jenis_kelamin' => 'Laki-laki',
                'email' => 'pengurusinti@mail.com',
                'no_hp' => '08123456789',
                'alamat' => 'Jl. Contoh No. 1, Kota Jakarta',
                'password' => Hash::make('12345678'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_periode' => 1, // Contoh periode ID
                'nim' => '210030390',
                'nama' => 'Made Evan Ada Munayana',
                'role' => 'Divisi I',
                'jenis_kelamin' => 'Laki-laki',
                'email' => 'pengurus@mail.com',
                'no_hp' => '08123456789',
                'alamat' => 'Jl. Contoh No. 1, Kota Jakarta',
                'password' => Hash::make('12345678'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
