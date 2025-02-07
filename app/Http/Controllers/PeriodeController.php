<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use Illuminate\Http\Request;

class PeriodeController extends Controller
{
    public function index()
    {
        $periode = Periode::all();
        return view('periode.index', compact('periode'));
    }


    public function store(Request $request)
    {
        $request->validate(
            [
                'periode' => 'required|string|unique:periode,tahun',
                'status' => 'required|in:aktif,non-aktif',
            ],
            [
                'periode.required' => 'Periode wajib diisi.',
                'periode.unique' => 'Periode sudah ada, silakan pilih periode yang berbeda.',
                'status.required' => 'Status wajib dipilih.',
                'status.in' => 'Status hanya boleh memilih antara "aktif" atau "non-aktif".',
            ]
        );

        // Jika status yang dipilih adalah "aktif", ubah semua periode lain menjadi "non-aktif"
        if ($request->status === 'aktif') {
            Periode::where('status', 'aktif')->update(['status' => 'non-aktif']);
        }

        // Simpan periode baru
        Periode::create([
            'tahun' => $request->periode,
            'status' => $request->status,
        ]);

        return redirect()->route('periode.index')->with('success', 'Periode berhasil ditambahkan');
    }


    public function edit(string $id)
    {
        $periode = Periode::findOrFail($id); // Mengambil periode berdasarkan ID
        return view('periode.edit', compact('periode')); // Mengirim data periode ke view
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'periode' => 'required|string',
            'status' => 'required|in:aktif,non-aktif',
        ]);

        $periode = Periode::findOrFail($id);
        // Cek jika status akan diubah menjadi "non-aktif" tetapi tidak ada periode lain yang aktif
        if ($request->status === 'non-aktif') {
            $periodeLainAktif = Periode::where('status', 'aktif')->where('id', '!=', $id)->exists();

            if (!$periodeLainAktif) {
                return redirect()->route('periode.index')->with('error', 'Harus ada setidaknya satu periode yang aktif!');
            }
        }

        // Jika status baru adalah "aktif", maka nonaktifkan periode lain
        if ($request->status === 'aktif') {
            Periode::where('status', 'aktif')
                ->where('id', '!=', $id) // Hindari menonaktifkan periode yang sedang diupdate
                ->update(['status' => 'non-aktif']);
        }
        // Update periode yang dipilih
        $periode->update([
            'tahun' => $request->periode,
            'status' => $request->status,
        ]);

        return redirect()->route('periode.index')->with('success', 'Data periode berhasil diperbarui!');
    }


    public function destroy($id)
    {
        try {
            $periode = Periode::findOrFail($id);
            $periode->delete();

            return redirect()->route('periode.index')->with('success', 'Periode berhasil dihapus.');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == "23000") {
                return redirect()->route('periode.index')->with('error', 'Data tidak dapat dihapus karena masih digunakan.');
            }
            return redirect()->route('periode.index')->with('error', 'Terjadi kesalahan saat menghapus data.');
        }
    }
}
