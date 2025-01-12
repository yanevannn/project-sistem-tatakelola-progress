<?php

namespace App\Http\Controllers;

use App\Models\User;
use League\Csv\Reader;
use App\Models\Anggota;
use App\Models\Periode;
use App\Mail\WelcomeEmail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $selectedPeriode = $request->input('periode', auth()->user()->id_periode);

        $periode = Periode::all();

        // Urutan berdasarkan Role MYSQL
        // $pengurus = User::where('id_periode', $selectedPeriode)
        //     ->orderByRaw("FIELD(role, 'Ketua', 'Wakil Ketua', 'Bendahara', 'Sekretaris', 'Divisi I', 'Divisi II', 'Divisi III')")
        //     ->get();

        // Menggunakan PGsql karena tidak mendukung FIELD()
        $pengurus = User::where('id_periode', $selectedPeriode)
            ->orderByRaw("
            CASE role
                WHEN 'Ketua' THEN 1
                WHEN 'Wakil Ketua' THEN 2
                WHEN 'Bendahara' THEN 3
                WHEN 'Sekretaris' THEN 4
                WHEN 'Divisi I' THEN 5
                WHEN 'Divisi II' THEN 6
                WHEN 'Divisi III' THEN 7
                ELSE 8
            END
        ")->get();


        return view('pengurus.index', compact('pengurus', 'periode', 'selectedPeriode'));
    }


    public function create()
    {
        $periode = Periode::all();
        return view('pengurus.create', compact('periode'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'periode' => 'required|exists:periode,id',
            'csv_file' => 'required|file|mimes:csv,txt|max:10240' // Maksimal 10MB'
        ], [
            'periode.required' => 'Periode wajib dipilih.',
            'periode.exists' => 'Periode yang dipilih tidak valid.',
            'csv_file.required' => 'File CSV atau TXT wajib diunggah.',
            'csv_file.file' => 'File yang diunggah harus berupa file.',
            'csv_file.mimes' => 'File harus berupa format CSV atau TXT.',
            'csv_file.max' => 'Ukuran file terlalu besar. Maksimal 10MB.'
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
            // $plainPassword = $validatedData['password']; // Store plain password 
            
            // Generate random password
            $plainPassword = Str::random(10);


            // Membuat user baru dengan data yang sudah tervalidasi
            $user = User::create([
                'id_periode' => $idPeriode, // Hubungkan user dengan periode yang dipilih
                'id_anggota' => $validatedData['id_anggota'], // NIM pengguna
                'role' => $validatedData['role'], // Jabatan/Role di organisasi
                'email' => $validatedData['email'], // Jabatan/Role di organisasi
                'password' => Hash::make($plainPassword), // Hash password untuk keamanan
            ]);

            // Mengirimkan email sambutan ke pengguna baru
            Mail::to($user->email)->send(new WelcomeEmail($user, $plainPassword));
        }

        // Redirect kembali ke halaman sebelumnya dengan pesan sukses
        return redirect()->route('user.index')->with('success', 'Data berhasil disimpan.');
    }

    /**
     * Validasi minimal pada record CSV.
     * @param array $record
     * @return array Data yang sudah tervalidasi
     */
    // private function validateCsvRecord(array $record)
    // {
    //     // Menggunakan validator untuk memastikan data sesuai aturan
    //     return validator($record, [
    //         'nim' => 'required|string|max:255', // NIM wajib diisi, maksimal 255 karakter
    //         'role' => 'required|in:Ketua,Wakil Ketua,Bendahara,Sekretaris,Divisi I,Divisi II,Divisi III', // Role harus sesuai daftar
    //         'email' => 'required|email|max:255', // Email wajib diisi dan valid
    //     ])->validate();
    // }

    private function validateCsvRecord(array $record)
{
    // Validasi data dasar
    $validatedData = validator($record, [
        'nim' => 'required|string|max:255', // NIM wajib diisi, maksimal 255 karakter
        'role' => 'required|in:Ketua,Wakil Ketua,Bendahara,Sekretaris,Divisi I,Divisi II,Divisi III', // Role harus sesuai daftar
        'email' => 'required|email|max:255', // Email wajib diisi dan valid
    ])->validate();

    // Cek apakah NIM ada di tabel anggota
    $anggota = Anggota::where('nim', $validatedData['nim'])->first();

    if (!$anggota) {
        throw \Illuminate\Validation\ValidationException::withMessages([
            'nim' => "NIM {$validatedData['nim']} tidak ditemukan di tabel anggota.",
        ]);
    }

    // Tambahkan ID anggota ke data yang divalidasi
    $validatedData['id_anggota'] = $anggota->id;

    return $validatedData;
}


    public function edit(string $id)
    {
        $pengurus = User::findOrFail($id);
        $periode = Periode::all();

        return view('pengurus.edit', compact('pengurus', 'periode'));
    }


    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'nim' => 'required|string|max:255',
                'nama' => 'required|string|max:255',
                'role' => 'required|in:Ketua,Wakil Ketua,Bendahara,Sekretaris,Divisi I,Divisi II,Divisi III',
                'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
                'no_hp' => 'nullable|string|max:15',
                'alamat' => 'nullable|string',
            ],
            [
                'nim.required' => 'NIM wajib diisi.',
                'nim.string' => 'NIM harus berupa teks.',
                'nim.max' => 'NIM tidak boleh lebih dari 255 karakter.',

                'nama.required' => 'Nama wajib diisi.',
                'nama.string' => 'Nama harus berupa teks.',
                'nama.max' => 'Nama tidak boleh lebih dari 255 karakter.',

                'jabatan.required' => 'Jabatan wajib dipilih.',
                'jabatan.in' => 'Jabatan yang dipilih tidak valid.',

                'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
                'jenis_kelamin.in' => 'Jenis kelamin harus Laki-laki atau Perempuan.',

            ]
        );
        // dd($request);
        $pengurus = User::findOrFail($id);

        $pengurus->update([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'role' => $request->role,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat

        ]);

        return redirect()->route('user.index')->with('updated', 'Data Pengurus Berhasil Diperbarui!');
    }


    public function destroy(string $id)
    {
        //
    }
}
