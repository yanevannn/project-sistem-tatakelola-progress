<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Periode;
use Illuminate\Http\Request;
use App\Models\PrestasiAnggota;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PrestasiAnggotaController extends Controller
{
    public function index()
    {
        $maxdata = 10;
        $periode = Periode::all();
        $prestasi = PrestasiAnggota::paginate(10);
        $anggota = Anggota::all();

        return view('prestasi_anggota.index', compact('periode', 'prestasi', 'anggota'));
    }

    public function create(Request $request)
    {
        return view('prestasi_anggota.create');
    }

    public function searchAnggota(Request $request)
    {
        if ($request->ajax()) {
            $search = $request->get('search');
            $anggota = Anggota::with('periode')
                ->where('nama', 'like', "%{$search}%")
                ->orWhere('nim', 'like', "%{$search}%")
                ->get();

            return response()->json($anggota);
        }
    }


    public function store(Request $request)
    {
       $request->validate([
            'id_anggota' => 'required|exists:anggota,id',
            'nama_prestasi' => 'required|string|max:255',
            'tingkat' => 'required|in:lokal,nasional,internasional',
            'tahun_prestasi' => 'required|digits:4|integer|before_or_equal:' . date('Y'),
            'keterangan' => 'nullable|string|max:1000',
            'file' => 'required|file|mimes:jpeg,png,jpg|max:2048',
        ], [
            'id_anggota.required' => 'Anggota harus dipilih.',
            'id_anggota.exists' => 'Anggota yang dipilih tidak ditemukan di database.',
            'nama_prestasi.required' => 'Nama prestasi harus diisi.',
            'nama_prestasi.string' => 'Nama prestasi harus berupa teks.',
            'nama_prestasi.max' => 'Nama prestasi maksimal 255 karakter.',
            'tingkat.required' => 'Tingkat prestasi harus dipilih.',
            'tingkat.in' => 'Tingkat prestasi harus salah satu dari: lokal, nasional, atau internasional.',
            'tahun_prestasi.required' => 'Tahun prestasi harus diisi.',
            'tahun_prestasi.digits' => 'Tahun prestasi harus terdiri dari 4 digit.',
            'tahun_prestasi.integer' => 'Tahun prestasi harus berupa angka.',
            'tahun_prestasi.before_or_equal' => 'Tahun prestasi tidak boleh lebih dari tahun ini.',
            'keterangan.string' => 'Keterangan harus berupa teks.',
            'keterangan.max' => 'Keterangan maksimal 1000 karakter.',
            'file.required' => 'Gambar harus diisi.',
            'file.file' => 'File harus berupa file.',
            'file.mimes' => 'File harus bertipe jpeg, png, jpg, atau pdf.',
            'file.max' => 'Ukuran file tidak boleh lebih dari 2MB.',
        ]);

        if ($request->hasFile('file')) {
            $originalFileName = $request->file('file')->getClientOriginalName();
            $fileNameWithoutExtension = pathinfo($originalFileName, PATHINFO_FILENAME);
            $formattedFileName = str_replace(' ', '_', $fileNameWithoutExtension);
            $fileFinalName = 'prestasi-' . $formattedFileName . '-' . uniqid() . '.' . $request->file('file')->getClientOriginalExtension();
            $request->file('file')->move(public_path('dokumen/prestasi_anggota/'), $fileFinalName);
        }
        $data = [
            'id_anggota' => $request->id_anggota,
            'nama_prestasi' => $request->nama_prestasi,
            'tingkat' => $request->tingkat,
            'tahun_prestasi' => $request->tahun_prestasi,
            'keterangan' => $request->keterangan,
            'file' => $fileFinalName,
        ];
        
        PrestasiAnggota::create($data);
        
        return redirect()->route('prestasi_anggota.index')->with('success', 'Data berhasil ditambahkan.');
    }
}
