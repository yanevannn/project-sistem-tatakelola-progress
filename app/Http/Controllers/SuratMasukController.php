<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SuratMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $maxdata = 5;
        if (request('search')) {
            $suratmasuk = SuratMasuk::where('nomor_surat_masuk', 'like', '%' . request('search') . '%')->paginate($maxdata)->appends(['search' => request('search')]);
            return view('surat_masuk.index', compact('suratmasuk'));
        } else {
            $suratmasuk = SuratMasuk::paginate($maxdata);
            return view('surat_masuk.index', compact('suratmasuk'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $periode = Periode::all();
        return view('surat_masuk.create', compact('periode'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $user = auth()->user();
        $user = Auth::user();


        $request->validate(
            [
                'periode' => 'required|exists:periode,id',
                'no_surat_masuk' => 'required|unique:surat_masuk,nomor_surat_masuk|string|max:255',
                'penerima' => 'required|string|max:255',
                'pengirim' => 'required|string|max:255',
                'tanggal_masuk' => 'required|date',
                'tanggal_kegiatan' => 'required|date',
                'keterangan' => 'required|string',
                'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048'
            ],
            [
                'periode.required' => 'Periode wajib dipilih.', // Pesan kesalahan jika periode tidak diisi
                'periode.exists' => 'Periode yang dipilih tidak valid.', // Pesan kesalahan jika periode tidak ada di database
                'no_surat_masuk.required' => 'Nomor surat wajib diisi.', // Pesan kesalahan jika nomor surat tidak diisi
                'no_surat_masuk.unique' => 'Nomor surat sudah ada.', // Pesan kesalahan jika nomor surat sudah ada di database
                'penerima.required' => 'Penerima wajib diisi.', // Pesan kesalahan jika penerima tidak diisi
                'pengirim.required' => 'Pengirim wajib diisi.', // Pesan kesalahan jika pengirim tidak diisi
                'tanggal_masuk.required' => 'Tanggal masuk wajib diisi.', // Pesan kesalahan jika tanggal masuk tidak diisi
                'tanggal_masuk.date' => 'Tanggal masuk harus dalam format tanggal yang valid.', // Pesan kesalahan jika tanggal masuk tidak valid
                'tanggal_kegiatan.required' => 'Tanggal kegiatan wajib diisi.', // Pesan kesalahan jika tanggal kegiatan tidak diisi
                'tanggal_kegiatan.date' => 'Tanggal kegiatan harus dalam format tanggal yang valid.', // Pesan kesalahan jika tanggal kegiatan tidak valid
                'keterangan.required' => 'Keterangan wajib diisi.', // Pesan kesalahan jika keterangan tidak diisi
                'file.file' => 'File harus berupa file yang valid.', // Pesan kesalahan jika file tidak valid
                'file.mimes' => 'File harus berupa format pdf, doc, atau docx.', // Pesan kesalahan jika file bukan jenis yang ditentukan
                'file.max' => 'Ukuran file maksimal 2MB.' // Pesan kesalahan jika ukuran file lebih dari 2MB
            ]
        );

        if (!empty($request->file)) {
            $originalName = $request->file('file')->getClientOriginalName();
            $namenoextension = pathinfo($originalName, PATHINFO_FILENAME);

            $formattedNama = str_replace(' ', '_', $namenoextension);
            $fileName = 'suratmasuk-' . $formattedNama . '-' . uniqid() . '.' . $request->file->extension();
            $request->file->move(public_path('dokumen/suratmasuk/'), $fileName);
        } else {
            $fileName = 'nosuratmasuk.pdf';
        }

        // dd($request->all());
        SuratMasuk::create([
            'id_user' => $user->id,
            'id_periode' => $request->periode,
            'nomor_surat_masuk' => $request->no_surat_masuk,
            'penerima' => $request->penerima,
            'pengirim' => $request->pengirim,
            'tanggal_terima' => $request->tanggal_masuk,
            'tanggal_surat' => $request->tanggal_kegiatan,
            'keterangan' => $request->keterangan,
            'file' => $fileName
        ]);


        return redirect()->route('suratmasuk.index');
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
        $suratmasuk = SuratMasuk::findOrfail($id);
        $periode = Periode::all();
        return view('surat_masuk.edit', compact('suratmasuk', 'periode'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = Auth::user();
        $suratmasuk = SuratMasuk::findOrFail($id);
        $fileLama = $suratmasuk->file;

        // Validasi Input
        $request->validate([
            'periode' => 'required|exists:periode,id',
            'no_surat_masuk' => 'required|string|max:255|unique:surat_masuk,nomor_surat_masuk,' . $id,
            'penerima' => 'required|string|max:255',
            'pengirim' => 'required|string|max:255',
            'tanggal_terima' => 'required|date',
            'tanggal_surat' => 'required|date',
            'keterangan' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048'
        ], [
            'periode.required' => 'Periode wajib dipilih.',
            'periode.exists' => 'Periode yang dipilih tidak valid.',
            'no_surat_masuk.required' => 'Nomor surat wajib diisi.',
            'no_surat_masuk.unique' => 'Nomor surat sudah ada.',
            'penerima.required' => 'Penerima wajib diisi.',
            'pengirim.required' => 'Pengirim wajib diisi.',
            'tanggal_terima.required' => 'Tanggal masuk wajib diisi.',
            'tanggal_terima.date' => 'Tanggal masuk harus berupa format tanggal yang valid.',
            'tanggal_surat.required' => 'Tanggal kegiatan wajib diisi.',
            'tanggal_surat.date' => 'Tanggal kegiatan harus berupa format tanggal yang valid.',
            'keterangan.required' => 'Keterangan wajib diisi.',
            'file.file' => 'File harus berupa file yang valid.',
            'file.mimes' => 'File harus berupa format pdf, doc, atau docx.',
            'file.max' => 'Ukuran file maksimal 2MB.'
        ]);

        // Proses File
        if ($request->hasFile('file')) {
            $originalName = $request->file('file')->getClientOriginalName();
            $fileWithoutExtension = pathinfo($originalName, PATHINFO_FILENAME);
            $safeFileName = str_replace(' ', '_', $fileWithoutExtension);
            $fileName = 'suratmasuk-' . $safeFileName . '-' . uniqid() . '.' . $request->file->extension();

            // Simpan file baru
            $request->file->move(public_path('dokumen/suratmasuk/'), $fileName);

            // Hapus file lama jika ada
            if ($fileLama && file_exists(public_path('dokumen/suratmasuk/' . $fileLama))) {
                unlink(public_path('dokumen/suratmasuk/' . $fileLama));
            }
        } else {
            // Jika tidak ada file baru, gunakan file lama
            $fileName = $fileLama;
        }

        // Update Data
        $suratmasuk->update([
            'id_user' => $user->id,
            'id_periode' => $request->periode,
            'nomor_surat_masuk' => $request->no_surat_masuk,
            'penerima' => $request->penerima,
            'pengirim' => $request->pengirim,
            'tanggal_surat' => $request->tanggal_surat,
            'tanggal_terima' => $request->tanggal_terima,
            'keterangan' => $request->keterangan,
            'file' => $fileName
        ]);

        // Redirect atau Response
        return redirect()->route('suratmasuk.index')->with('success', 'Data surat masuk berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
