<?php

namespace App\Http\Controllers;

use League\Csv\Reader;
use App\Models\Anggota;
use App\Models\Periode;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function index()
    {
        $maxdata = 5;
        $periode = Periode::all();
        if (request('search')) {
            $search = request('search');
            $anggota = Anggota::where('nim', 'like', '%' . $search . '%')
                ->orWhere('nama', 'like', '%' . $search . '%')
                ->paginate($maxdata)
                ->appends(['search' => $search]);
            return view('anggota.index', compact('anggota', 'periode'));
        } else {

            $anggota = Anggota::paginate($maxdata);
            return view('anggota.index', compact('anggota', 'periode'));
        }
    }

    public function create()
    {
        $periode = Periode::all();
        return view('anggota.create', compact('periode'));
    }

    public function store(Request $request)
    {
        // Validasi file yang di-upload dan inputan periode
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt',
            'periode' => 'required|exists:periode,id'
        ]);


        // Ambil ID Periode dari input form untuk dihubungkan dengan user
        $idPeriode = $request->input('periode');

        // Membaca file CSV yang diunggah
        $csv = Reader::createFromPath($request->file('csv_file')->getPathname());
        $csv->setHeaderOffset(0); // Baris pertama dianggap header


        // Iterasi setiap record dalam file CSV
        foreach ($csv as $record) {
            // Validasi setiap record dalam CSV
            $validatedData = $this->validateCsvRecord($record);

            // Buat anggota baru berdasarkan data yang divalidasi
            Anggota::create([
                'id_periode' => $idPeriode, // Hubungkan dengan periode
                'nim' => $validatedData['nim'], // NIM anggota
                'nama' => $validatedData['nama'], // Nama anggota
                'email' => $validatedData['email'], // Email anggota
                'no_hp' => $validatedData['no_hp'] ?? null, // No HP (opsional)
                'kelas' => $validatedData['kelas'], // Kelas anggota
            ]);
        }

        // Redirect dengan pesan sukses
        return redirect()->route('anggota.index')->with('success', 'Data anggota berhasil ditambahkan.');
    }

    private function validateCsvRecord(array $record)
    {
        // Menggunakan validator untuk memastikan data anggota sesuai aturan
        return validator($record, [
            'nim' => 'required|string|max:255', //maksimal 255 karakter
            'nama' => 'required|string|max:255', // Nama wajib diisi, maksimal 255 karakter
            'kelas' => 'required|string|max:100', // Kelas wajib, maksimal 100 karakter
            'email' => 'required|email|max:255', // Email wajib
            'no_hp' => 'nullable|string|max:15', // No HP opsional, maksimal 15 karakter
        ])->validate();
    }

    public function edit(string $id)
    {
        $anggota = Anggota::findOrFail($id);
        $periode = Periode::all();
        return view('anggota.edit', compact('anggota', 'periode'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nim' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'kelas' => 'required|string|max:100',
            'email' => 'required|email|max:255',
            'no_hp' => 'nullable|string|max:15'
        ], [
            'nim.required' => 'NIM wajib diisi.',
            'nim.string' => 'NIM harus berupa teks.',
            'nim.max' => 'NIM tidak boleh lebih dari 255 karakter.',

            'nama.required' => 'Nama wajib diisi.',
            'nama.string' => 'Nama harus berupa teks.',
            'nama.max' => 'Nama tidak boleh lebih dari 255 karakter.',

            'kelas.required' => 'Kelas wajib diisi.',
            'kelas.string' => 'Kelas harus berupa teks.',
            'kelas.max' => 'Kelas tidak boleh lebih dari 100 karakter.',

            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email tidak boleh lebih dari 255 karakter.',

            'no_hp.string' => 'Nomor HP harus berupa teks.',
            'no_hp.max' => 'Nomor HP tidak boleh lebih dari 15 karakter.'
        ]);

        $data = [
            'nim' => $request->nim,
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'email' => $request->email,
            'no_hp' => $request->no_hp
        ];

        $anggota = Anggota::findOrFail($id);
        $anggota->update($data);
        return redirect()->route('anggota.index')->with('success', 'Transaksi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $anggota = Anggota::findOrFail($id);
        $anggota->delete();
        return redirect()->route('anggota.index')->with('success', 'Data Anggota berhasil dihapus');
    }
}
