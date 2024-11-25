<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Periode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DataPengurusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi file yang di-upload
    $request->validate([
        'csv_file' => 'required|mimes:csv,txt|max:2048',
    ], [
        'csv_file.required' => 'File CSV wajib di-upload.',
        'csv_file.mimes' => 'File harus berupa CSV.',
        'csv_file.max' => 'Ukuran file maksimal 2MB.',
    ]);

    // Ambil file CSV yang di-upload
    $file = $request->file('csv_file');

    // Baca file CSV
    $data = array_map('str_getcsv', file($file));

    // Hapus baris pertama jika itu adalah header CSV
    array_shift($data);

    // Menyimpan data ke dalam database
    foreach ($data as $row) {
        $validator = Validator::make([
            'nim' => $row[0],
            'nama' => $row[1],
            'email' => $row[2],
            'password' => $row[3],
            'jenis_kelamin' => $row[4],
            'jabatan' => $row[5] ?? null,
            'no_hp' => $row[6] ?? null,
            'alamat' => $row[7] ?? null,
            'role' => $row[8] ?? 'Pengurus',
        ], [
            'nim' => 'required|string|unique:users,nim',
            'nama' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'jabatan' => 'nullable|string',
            'no_hp' => 'nullable|string',
            'alamat' => 'nullable|string',
            'role' => 'required|in:PengurusInti,Pengurus',
        ]);

        if ($validator->fails()) {
            // Log error jika diperlukan atau lanjutkan ke baris berikutnya
            continue;
        }

        // Simpan data user ke dalam database
        User::create([
            'nim' => $row[0],
            'nama' => $row[1],
            'email' => $row[2],
            'password' => Hash::make($row[3]), // Hash password
            'jenis_kelamin' => $row[4],
            'jabatan' => $row[5] ?? null,
            'no_hp' => $row[6] ?? null,
            'alamat' => $row[7] ?? null,
            'role' => $row[8] ?? 'Pengurus',
        ]);
    }

    return redirect()->route('users.index')->with('success', 'Users berhasil diimport.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
