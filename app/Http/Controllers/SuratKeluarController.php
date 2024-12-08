<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use App\Models\SuratKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuratKeluarController extends Controller
{
    public function index()
    {
        $maxdata = 10;
        if (request('search')) {
            $suratkeluar = SuratKeluar::where('nomor_surat_keluar', 'like', '%' . request('search') . '%')->paginate($maxdata)->appends(['search' => request('search')]);
            return view('surat_keluar.index', compact('suratkeluar'));
        } else {
            $suratkeluar = SuratKeluar::paginate($maxdata);
            return view('surat_keluar.index', compact('suratkeluar'));
        }
    }

    public function create()
    {
        $periode = Periode::all();
        return view('surat_keluar.create', compact('periode'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        // dd($user, $request->all());

        $request->validate(
            [
                'periode' => 'required|exists:periode,id',
                'nomor_surat_keluar' => 'required|string|unique:surat_keluar,nomor_surat_keluar',
                'tertuju' => 'required|string',
                'keterangan' => 'nullable|string',
                'tanggal_surat' => 'required|date',
                'tanggal_terkirim' => 'required|date|after_or_equal:tanggal_surat',
                'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
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
                'file.file' => 'File harus berupa file yang valid.',
                'file.mimes' => 'File harus berupa format pdf, doc, atau docx.',
                'file.max' => 'Ukuran file maksimal 2MB.'
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

            return redirect()->route('suratkeluar.index')->with('success', 'Data Surat Kasuk berhasil ditambahkan!');
    }
    

    public function edit(string $id)
    {
        $suratkeluar = SuratKeluar::findOrFail($id);
        $periode = Periode::all();
        return view('surat_keluar.edit', compact('id', 'suratkeluar', 'periode'));
    }

    public function update(Request $request, string $id)
    {
        $user = Auth::user();

        $request->validate(
            [
                'periode' => 'required|exists:periode,id', 
                'nomor_surat_keluar' => 'required|string|unique:surat_masuk,nomor_surat_masuk,' . $id,
                'tertuju' => 'required|string', 
                'keterangan' => 'nullable|string', 
                'tanggal_surat' => 'required|date', 
                'tanggal_terkirim' => 'required|date|after_or_equal:tanggal_surat',
                'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048', 
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
                'file.file' => 'File harus berupa file yang valid.',
                'file.mimes' => 'File harus berupa format pdf, doc, atau docx.', 
                'file.max' => 'Ukuran file maksimal 2MB.' 
            ]
        );
        

        $suratkeluar = SuratKeluar::findOrFail($id);
        $fileLama = $suratkeluar->file;


        if ($request->hasFile('file')) {
            $originalName = $request->file('file')->getClientOriginalName();
            $namenoextension = pathinfo($originalName, PATHINFO_FILENAME);

            $formattedNama = str_replace(' ', '_', $namenoextension);
            $fileName = 'suratkeluar-' . $formattedNama . '-' . uniqid() . '.' . $request->file->extension();
            //Pindahkan file baru
            $request->file->move(public_path('dokumen/suratkeluar/'), $fileName);

            // Hapus file lama jika ada
            if ($fileLama && file_exists(public_path('dokumen/suratkeluar/' . $fileLama))) {
                unlink(public_path('dokumen/suratkeluar/' . $fileLama));
            }
            // dd($user, $request->all());
        } else {
            $fileName = $fileLama;
        }

        $suratkeluar->update(
            [
                'id_user' => $user->id,
                'id_periode' => $request->periode,
                'nomor_surat_keluar' => $request->nomor_surat_keluar,
                'tertuju' => $request->tertuju,
                'keterangan' => $request->keterangan,
                'tanggal_surat' => $request->tanggal_surat,
                'tanggal_terkirim' => $request->tanggal_terkirim,
                'file' => $fileName,
            ]
        );

        return redirect()->route('suratkeluar.index')->with('updated', 'Data Surat Keluar berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        //
    }
}
