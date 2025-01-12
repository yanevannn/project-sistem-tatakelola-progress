<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SuratMasukController extends Controller
{
    public function index(Request $request)
    {
            // Ambil periode dari request atau gunakan periode user yang login
            $selectedPeriode = $request->input('periode', auth()->user()->id_periode);
            // Ambil data surat masuk berdasarkan periode yang dipilih
            $suratmasuk = SuratMasuk::where('id_periode', $selectedPeriode)->get();

            $periode = Periode::all();
            return view('surat_masuk.index', compact('suratmasuk', 'periode'));
    }


    public function create()
    {
        $periode = Periode::all();
        return view('surat_masuk.create', compact('periode'));
    }

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
                'periode.required' => 'Periode wajib dipilih.',
                'periode.exists' => 'Periode yang dipilih tidak valid.',
                'no_surat_masuk.required' => 'Nomor surat wajib diisi.',
                'no_surat_masuk.unique' => 'Nomor surat sudah ada.',
                'penerima.required' => 'Penerima wajib diisi.',
                'pengirim.required' => 'Pengirim wajib diisi.',
                'tanggal_masuk.required' => 'Tanggal masuk wajib diisi.',
                'tanggal_masuk.date' => 'Tanggal masuk harus dalam format tanggal yang valid.',
                'tanggal_kegiatan.required' => 'Tanggal kegiatan wajib diisi.',
                'tanggal_kegiatan.date' => 'Tanggal kegiatan harus dalam format tanggal yang valid.',
                'keterangan.required' => 'Keterangan wajib diisi.',
                'file.file' => 'File harus berupa file yang valid.',
                'file.mimes' => 'File harus berupa format pdf, doc, atau docx.',
                'file.max' => 'Ukuran file maksimal 2MB.'
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

        return redirect()->route('suratmasuk.index')->with('success', 'Data surat masuk berhasil ditambahkan!');
    }

   
    public function edit(string $id)
    {
        $suratmasuk = SuratMasuk::findOrfail($id);
        $periode = Periode::all();
        return view('surat_masuk.edit', compact('suratmasuk', 'periode'));
    }

    public function update(Request $request, string $id)
    {
        $user = Auth::user();
        $suratmasuk = SuratMasuk::findOrFail($id);
        $fileLama = $suratmasuk->file;

        $request->validate(
            [
                'id_periode' => 'required|exists:periode,id',
                'nomor_surat_masuk' => 'required|unique:surat_masuk,nomor_surat_masuk,' . $id . '|string|max:255',
                'nomor_surat_masuk' => 'required||string|max:255',
                'penerima' => 'required|string|max:255',
                'pengirim' => 'required|string|max:255',
                'tanggal_terima' => 'required|date',
                'tanggal_surat' => 'required|date',
                'keterangan' => 'required|string',
                'file' => 'nullable|file|mimes:pdf,doc,docx|max:2048'
            ],
            [
                'id_periode.required' => 'Periode wajib dipilih.',
                'id_periode.exists' => 'Periode yang dipilih tidak valid.',
                'nomor_surat_masuk.required' => 'Nomor surat masuk wajib diisi.',
                'nomor_surat_masuk.unique' => 'Nomor surat masuk sudah ada.',
                'nomor_surat_masuk.string' => 'Nomor surat masuk harus berupa teks.',
                'nomor_surat_masuk.max' => 'Nomor surat masuk maksimal 255 karakter.',
                'penerima.required' => 'Penerima wajib diisi.',
                'penerima.string' => 'Penerima harus berupa teks.',
                'penerima.max' => 'Penerima maksimal 255 karakter.',
                'pengirim.required' => 'Pengirim wajib diisi.',
                'pengirim.string' => 'Pengirim harus berupa teks.',
                'pengirim.max' => 'Pengirim maksimal 255 karakter.',
                'tanggal_terima.required' => 'Tanggal terima wajib diisi.',
                'tanggal_terima.date' => 'Tanggal terima harus berupa tanggal yang valid.',
                'tanggal_surat.required' => 'Tanggal surat wajib diisi.',
                'tanggal_surat.date' => 'Tanggal surat harus berupa tanggal yang valid.',
                'keterangan.required' => 'Keterangan wajib diisi.',
                'keterangan.string' => 'Keterangan harus berupa teks.',
                'file.file' => 'File harus berupa file yang valid.',
                'file.mimes' => 'File harus berupa format pdf, doc, atau docx.',
                'file.max' => 'Ukuran file maksimal 2MB.'
            ]            
        );
        

        if ($request->hasFile('file')) {
            $originalName = $request->file('file')->getClientOriginalName();
            $namenoextension = pathinfo($originalName, PATHINFO_FILENAME);

            $formattedNama = str_replace(' ', '_', $namenoextension);
            $fileName = 'suratmasuk-' . $formattedNama . '-' . uniqid() . '.' . $request->file->extension();
            //Pindahkan file baru
            $request->file->move(public_path('dokumen/suratmasuk/'), $fileName);

            // Hapus file lama jika ada
            if ($fileLama && file_exists(public_path('dokumen/suratmasuk/' . $fileLama))) {
                unlink(public_path('dokumen/suratmasuk/' . $fileLama));
            }
        } else {
            $fileName = $fileLama;
        }

        $suratmasuk->update([
            'id_user' => $user->id,
            'id_periode' => $request->id_periode,
            'nomor_surat_masuk' => $request->nomor_surat_masuk,
            'penerima' => $request->penerima,
            'pengirim' => $request->pengirim,
            'tanggal_surat' => $request->tanggal_surat,
            'tanggal_terima' => $request->tanggal_terima,
            'keterangan' => $request->keterangan,
            'file' => $fileName
        ]);

        return redirect()->route('suratmasuk.index')->with('success', 'Data surat masuk berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        //
    }
}
