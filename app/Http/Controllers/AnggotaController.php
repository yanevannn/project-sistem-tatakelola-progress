<?php

namespace App\Http\Controllers;

use League\Csv\Reader;
use App\Models\Anggota;
use App\Models\Periode;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $maxdata = 5 ;
        $periode = Periode::all();
        if(request('search')){
            $anggota = Anggota::where('nama','like','%'.request('search').'%')->paginate($maxdata)->appends(['search' => request('search')]);
            return view('anggota.index', compact('inventaris','periode'));
        } else {

            $anggota = Anggota::paginate($maxdata);
            return view('anggota.index', compact('anggota','periode'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        $periode = Periode::all();
        return view('anggota.create', compact('periode'));
    }

    /**
     * Store a newly created resource in storage.
     */
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
        $anggota = Anggota::findOrFail($id);
        $periode = Periode::all();
        return view('anggota.edit', compact('anggota','periode'));
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
