<?php

namespace App\Http\Controllers;

use App\Models\User;
use League\Csv\Reader;
use App\Models\Periode;
use App\Mail\WelcomeEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $user = Auth::user();
        return view('dashboard', compact('user'));
    }

    public function indexPengurus()
    {
        $periode = Periode::all();
        $pengurus = User::all();
        return view('pengurus.index', compact('pengurus', 'periode'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $periode = Periode::all();
        return view('pengurus.create', compact('periode'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'periode' => 'required|exists:periodes,id', // Periode harus dipilih dan valid di tabel 'periodes'
            'csv_file' => 'required|file|mimes:csv,txt' // File harus berupa CSV atau TXT
        ]);

        // Ambil ID Periode dari input form untuk dihubungkan dengan user
        $idPeriode = $request->input('periode');

        // Membaca file CSV yang diunggah
        $csv = Reader::createFromPath($request->file('csv_file')->getPathname());
        $csv->setHeaderOffset(0); // Mengatur baris pertama CSV sebagai header

        // Mengubah iterasi CSV menjadi array untuk debugging
        //$data = iterator_to_array($csv);
        // // Debug seluruh isi data dari CSV
        // dd([
        //     'csv_data' => $data,
        //     'form_input' => $request->all(),
        //     'id_periode' => $idPeriode,
        // ]);



        // Iterasi setiap record dalam file CSV
        foreach ($csv as $record) {
            // Validasi minimal pada data dalam CSV
            $validatedData = $this->validateCsvRecord($record);
            // dd($validatedData); // Melihat data setelah divalidasi

            // Generate plain password (You should decide how to handle plain passwords)
            $plainPassword = $validatedData['password']; // Store plain password temporarily


            // Membuat user baru dengan data yang sudah tervalidasi
            $user = User::create([
                'id_periode' => $idPeriode, // Hubungkan user dengan periode yang dipilih
                'nim' => $validatedData['nim'], // NIM pengguna
                'nama' => $validatedData['nama'], // Nama pengguna
                'role' => $validatedData['jabatan'], // Jabatan/Role di organisasi
                'jenis_kelamin' => $validatedData['jenis_kelamin'], // Jenis kelamin pengguna
                'email' => $validatedData['email'], // Email pengguna
                'no_hp' => $validatedData['no_hp'], // Nomor HP (opsional)
                'alamat' => $validatedData['alamat'], // Alamat (opsional)
                'password' => Hash::make($validatedData['password']), // Hash password untuk keamanan
            ]);

            // Mengirimkan email sambutan ke pengguna baru
            Mail::to($user->email)->send(new WelcomeEmail($user, $plainPassword));
        }

        // Redirect kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->route('user.index')->with('success', 'Data berhasil disimpan.');
    }

    /**
     * Validasi minimal pada record CSV.
     * 
     * @param array $record
     * @return array Data yang sudah tervalidasi
     */
    private function validateCsvRecord(array $record)
    {
        // Menggunakan validator untuk memastikan data sesuai aturan
        return validator($record, [
            'nim' => 'required|string|max:255', // NIM wajib diisi, maksimal 255 karakter
            'nama' => 'required|string|max:255', // Nama wajib diisi, maksimal 255 karakter
            'jabatan' => 'required|in:Ketua,Bendahara,Sekretaris,Divisi I,Divisi II,Divisi III', // Role harus sesuai daftar
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan', // Jenis kelamin harus salah satu dari opsi
            'email' => 'required|email|max:255', // Email wajib diisi dan valid
            'no_hp' => 'nullable|string|max:15', // No HP opsional, maksimal 15 karakter
            'alamat' => 'nullable|string', // Alamat opsional
            'password' => 'required|string|min:8', // Password wajib, minimal 8 karakter
        ])->validate();
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
