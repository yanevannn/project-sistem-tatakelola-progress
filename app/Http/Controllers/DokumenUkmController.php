<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use App\Models\DokumenUkm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DokumenUkmController extends Controller
{
    public function index()
    {
        $dokumen_ukm = DokumenUkm::paginate(10);

        return view('dokumen_ukm.index', compact('dokumen_ukm'));
    }

    public function create()
    {
        $periode = Periode::all();
        return view('dokumen_ukm.create', compact('periode'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $request->validate(
            [
                'periode' => 'required|exists:periode,id',
                'nama_ketua' => 'required|string',
                'rka' => 'required|file|mimes:pdf|max:2048',
                'adart' => 'required|file|mimes:pdf|max:2048',
            ],
            [
                'periode.required' => 'Silakan pilih periode terlebih dahulu.',
                'periode.exists' => 'Periode yang dipilih tidak ditemukan dalam data kami.',
                'nama_ketua.required' => 'Nama ketua harus diisi. Mohon masukkan nama ketua.',
                'nama_ketua.string' => 'Nama ketua harus berupa teks yang valid.',
                'rka.required' => 'File RKA wajib diunggah. Mohon unggah file RKA Anda.',
                'rka.file' => 'File RKA yang diunggah tidak valid. Pastikan Anda mengunggah file yang benar.',
                'rka.mimes' => 'Format file RKA tidak didukung. Harap unggah file dalam format pdf!',
                'rka.max' => 'Ukuran file RKA terlalu besar. Maksimum ukuran file adalah 2MB.',
                'adart.required' => 'File AD/ART wajib diunggah. Mohon unggah file AD/ART Anda.',
                'adart.file' => 'File AD/ART yang diunggah tidak valid. Pastikan Anda mengunggah file yang benar.',
                'adart.mimes' => 'Format file AD/ART tidak didukung. Harap unggah file dalam format pdf!.',
                'adart.max' => 'Ukuran file AD/ART terlalu besar. Maksimum ukuran file adalah 2MB.',
            ]
        );

        if ($request->hasFile('rka')) {
            $originalRkaName = $request->file('rka')->getClientOriginalName();
            $rkaNameWithoutExtension = pathinfo($originalRkaName, PATHINFO_FILENAME);
            $formattedRkaName = str_replace(' ', '_', $rkaNameWithoutExtension);
            $rkaFileName = 'rka-' . $formattedRkaName . '-' . uniqid() . '.' . $request->file('rka')->extension();
            $request->file('rka')->move(public_path('dokumen/ukm/rka/'), $rkaFileName);
        }

        if ($request->hasFile('adart')) {
            $originalAdartName = $request->file('adart')->getClientOriginalName();
            $adartNameWithoutExtension = pathinfo($originalAdartName, PATHINFO_FILENAME);
            $formattedAdartName = str_replace(' ', '_', $adartNameWithoutExtension);
            $adartFileName = 'adart-' . $formattedAdartName . '-' . uniqid() . '.' . $request->file('adart')->extension();
            $request->file('adart')->move(public_path('dokumen/ukm/adart/'), $adartFileName);
        }

        $data = [
            'id_user' => $user->id,
            'id_periode' => $request->periode,
            'nama_ketua' => $request->nama_ketua,
            'rka' => $rkaFileName,
            'adart' => $adartFileName
        ];

        // dd($data);
        DokumenUkm::create($data);

        return redirect()->route('dokumen_ukm.index')->with('success', 'Dokumen UKM berhasil ditambahkan!');
    }

    public function view(Request $request)
    {
        $id = $request->id;
        $type = $request->type;

        // Validasi input ID dan jenis dokumen
        $dokumen = DokumenUkm::findOrFail($id); // Pastikan dokumen ada
        if (!in_array($type, ['rka', 'adart'])) {
            return abort(404, 'Jenis dokumen tidak valid.');
        }

        $fileName = ($type === 'rka') ? $dokumen->rka : $dokumen->adart;
        $absolutePath = public_path("dokumen/ukm/{$type}/{$fileName}");
        $filePath = asset("dokumen/ukm/{$type}/{$fileName}");

        if (!file_exists($absolutePath)) {
            abort(404, 'File dokumen tidak ditemukan.');
        }

        return view('dokumen_ukm.view', [
            'filePath' => $filePath,
            'type' => strtoupper($type),
            'periode' => $dokumen->periode->tahun,
        ]);
    }

    public function edit(string $id)
    {
        $dokumen_ukm = DokumenUkm::findOrFail($id);
        $periode = Periode::all();
        return view('dokumen_ukm.edit', compact('id', 'dokumen_ukm', 'periode'));
    }

    public function update(Request $request, string $id)
    {
        $user = Auth::user();

        $request->validate([
            'periode' => 'required|exists:periode,id',
            'nama_ketua' => 'required|string',
            'rka' => 'nullable|file|mimes:pdf|max:2048',
            'adart' => 'nullable|file|mimes:pdf|max:2048',
        ],
        [
            'periode.required' => 'Periode wajib dipilih.',
            'periode.exists' => 'Periode yang dipilih tidak valid.',
            'nama_ketua.required' => 'Nama ketua wajib diisi.',
            'nama_ketua.string' => 'Nama ketua harus berupa teks.',
            'rka.nullable' => 'File RKA bersifat opsional, tetapi jika diunggah, pastikan formatnya benar.',
            'rka.mimes' => 'File RKA harus dalam format PDF!',
            'rka.max' => 'Ukuran file RKA tidak boleh lebih dari 2MB.',
            'adart.nullable' => 'File ADART bersifat opsional, tetapi jika diunggah, pastikan formatnya benar.',
            'adart.mimes' => 'File ADART harus dalam format PDF!.',
            'adart.max' => 'Ukuran file ADART tidak boleh lebih dari 2MB.',
        ]);

        $dokume_ukm = DokumenUkm::findOrfail($id);
        $dokumen_rka = $dokume_ukm->rka;
        $dokumen_adart = $dokume_ukm->adart;

        /// Periksa apakah ada file RKA baru
        if ($request->hasFile('rka')) {
            // Ambil nama asli file RKA yang diunggah
            $originalNameRka = $request->file('rka')->getClientOriginalName();
            $namenoextensionRka = pathinfo($originalNameRka, PATHINFO_FILENAME);
            // Format nama file RKA (ganti spasi dengan underscore)
            $formattedNamaRka = str_replace(' ', '_', $namenoextensionRka);
            // Buat nama file RKA unik dengan format yang diinginkan
            $fileNameRka = 'rka-' . $formattedNamaRka . '-' . uniqid() . '.' . $request->file('rka')->extension();
            // Pindahkan file RKA baru
            $request->file('rka')->move(public_path('dokumen/ukm/rka/'), $fileNameRka);
            // Hapus file RKA lama jika ada
            if ($dokumen_rka && file_exists(public_path('dokumen/ukm/rka/' . $dokumen_rka))) {
                unlink(public_path('dokumen/ukm/rka/' . $dokumen_rka));
            }
            // Perbarui nama file RKA
            $dokumen_rka = $fileNameRka;
        }

        // Periksa apakah ada file ADART baru
        if ($request->hasFile('adart')) {
            // Ambil nama asli file ADART yang diunggah
            $originalNameAdart = $request->file('adart')->getClientOriginalName();
            $namenoextensionAdart = pathinfo($originalNameAdart, PATHINFO_FILENAME);

            // Format nama file ADART (ganti spasi dengan underscore)
            $formattedNamaAdart = str_replace(' ', '_', $namenoextensionAdart);

            // Buat nama file ADART unik dengan format yang diinginkan
            $fileNameAdart = 'adart-' . $formattedNamaAdart . '-' . uniqid() . '.' . $request->file('adart')->extension();

            // Pindahkan file ADART baru
            $request->file('adart')->move(public_path('dokumen/ukm/adart/'), $fileNameAdart);

            // Hapus file ADART lama jika ada
            if ($dokumen_adart && file_exists(public_path('dokumen/ukm/adart/' . $dokumen_adart))) {
                unlink(public_path('dokumen/ukm/adart/' . $dokumen_adart));
            }
            // Perbarui nama file ADART
            $dokumen_adart = $fileNameAdart;
        }

        $dokume_ukm -> update (
            [
                'id_user' => $user->id,
                'id_periode' => $request->periode,
                'nama_ketua' => $request->nama_ketua,
                'rka' => $dokumen_rka,
                'adart' => $dokumen_adart
            ]
        );

        return redirect()->route('dokumen_ukm.index')->with('success', 'Data UKM berhasil diperbarui!');
    }
}
