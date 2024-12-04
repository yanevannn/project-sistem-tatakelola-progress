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
        $periode->update(
            [
                'tahun' => $request->periode,
                'status' => $request->status,
            ],
            [
                'periode.required' => 'Periode wajib diisi.',
                'periode.string' => 'Periode harus berupa teks.',

                'status.required' => 'Status wajib dipilih.',
                'status.in' => 'Status hanya bisa "aktif" atau "non-aktif".',
            ]
        );

        return redirect()->route('periode.index')->with('success', 'Data periode berhasil diperbarui!');
    }


    public function destroy($id)
    {
        $periode = Periode::findOrFail($id);
        $periode->delete();
        return redirect()->route('periode.index')->with('success', 'Periode berhasil dihapus');
    }
}
