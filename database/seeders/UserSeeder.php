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
                'nim' => '12345678',
                'nama' => 'John Doe',
                'jabatan' => 'Ketua',
                'jenis_kelamin' => 'Laki-laki',
                'email' => 'johndoe@example.com',
                'no_hp' => '081234567890',
                'alamat' => 'Jl. Merdeka No.1, Jakarta',
                'password' => Hash::make('password123'),
                'role' => 'PengurusInti',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nim' => '87654321',
                'nama' => 'Jane Smith',
                'jabatan' => 'Sekretaris',
                'jenis_kelamin' => 'Perempuan',
                'email' => 'janesmith@example.com',
                'no_hp' => '081298765432',
                'alamat' => 'Jl. Sudirman No.45, Bandung',
                'password' => Hash::make('password123'),
                'role' => 'Pengurus',
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

    }
}
