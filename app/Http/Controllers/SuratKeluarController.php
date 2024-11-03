<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use App\Models\SuratKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuratKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $maxdata = 5;
        if (request('search')) {
            $suratkeluar = SuratKeluar::where('nomor_surat_keluar', 'like', '%' . request('search') . '%')->paginate($maxdata)->appends(['search' => request('search')]);
            return view('surat_keluar.index', compact('suratkeluar'));
        } else {
            $suratkeluar = SuratKeluar::paginate($maxdata);
            return view('surat_keluar.index', compact('suratkeluar'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $periode = Periode::all();
        return view('surat_keluar.create', compact('periode'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        // dd($user, $request->all());

        $request->validate(
            [
                'periode' => 'required|exists:periodes,id', // ID periode harus ada di tabel periodes
                'nomor_surat_keluar' => 'required|string|unique:surat_keluar,nomor_surat_keluar', // Nomor surat harus unik
                'tertuju' => 'required|string', // Tertuju harus diisi
                'keterangan' => 'nullable|string', // Keterangan opsional
                'tanggal_surat' => 'required|date', // Tanggal surat harus valid
                'tanggal_terkirim' => 'required|date|after_or_equal:tanggal_surat', // Tanggal terkirim harus setelah atau sama dengan tanggal surat
                'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048', // File dapat kosong, harus berformat pdf, doc, atau docx, dan maksimal 2MB
            ],
            [
                'periode.required' => 'ID periode harus diisi.',
                'periode.exists' => 'ID periode tidak valid.',
                'nomor_surat_keluar.required' => 'Nomor surat keluar harus diisi.',
                'nomor_surat_keluar.unique' => 'Nomor surat keluar sudah ada.',
                'tertuju.required' => 'Tertuju harus diisi.',
                'tertuju.string' => 'Tertuju harus berupa string.',
                'keterangan.string' => 'Keterangan harus berupa string.',
                'tanggal_surat.required' => 'Tanggal surat harus diisi.',
                'tanggal_surat.date' => 'Tanggal surat harus berupa tanggal yang valid.',
                'tanggal_terkirim.required' => 'Tanggal terkirim harus diisi.',
                'tanggal_terkirim.date' => 'Tanggal terkirim harus berupa tanggal yang valid.',
                'tanggal_terkirim.after_or_equal' => 'Tanggal terkirim harus sama atau setelah tanggal surat.',
                'file.file' => 'File harus berupa file yang valid.', // Pesan kesalahan jika file tidak valid
                'file.mimes' => 'File harus berupa format pdf, doc, atau docx.', // Pesan kesalahan jika file bukan jenis yang ditentukan
                'file.max' => 'Ukuran file maksimal 2MB.' // Pesan kesalahan jika ukuran file lebih dari 2MB
            ]
        );


        if (!empty($request->file)) {
            $originalName = $request->file('file')->getClientOriginalName();
            $namenoextension = pathinfo($originalName, PATHINFO_FILENAME);

            $formattedNama = str_replace(' ', '_', $namenoextension);
            $fileName = 'suratkeluar-' . $formattedNama . '-' . uniqid() . '.' . $request->file->extension();
            $request->file->move(public_path('dokumen/suratkeluar/'), $fileName);
        } else {
            $fileName = 'nosuratkeluar.pdf';
        }
        // dd($request->all());

        SuratKeluar::create([
            'id_user' => $user->id,
            'id_periode' => $request->periode,
            'nomor_surat_keluar' => $request->nomor_surat_keluar,
            'tertuju' => $request->tertuju,
            'keterangan' => $request->keterangan,
            'tanggal_surat' => $request->tanggal_surat,
            'tanggal_terkirim' => $request->tanggal_terkirim,
            'file' => $fileName,
        ]);

        return redirect()->route('suratkeluar.index');
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
