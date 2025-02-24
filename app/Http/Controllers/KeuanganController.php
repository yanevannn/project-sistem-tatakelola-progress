<?php

namespace App\Http\Controllers;

use App\Models\Keuangan;
use App\Models\Periode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $periodes = Periode::all();
        $periode = $request->input('periode', $user->id_periode);
        $query = Keuangan::query();
        if ($periode) {
            $query->where('id_periode', $periode);
        }

        $keuangan = $query->orderBy('tanggal', 'asc')->get();

        // Hitung total pemasukan, pengeluaran, dan saldo akhir
        $totalPemasukan = $keuangan->sum('pemasukan');
        $totalPengeluaran = $keuangan->sum('pengeluaran');
        $saldoAkhir = $totalPemasukan - $totalPengeluaran;

        return view('keuangan.index', compact('keuangan', 'user', 'periodes', 'periode', 'totalPemasukan', 'totalPengeluaran', 'saldoAkhir'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $periode = Periode::all();
        return view('keuangan.create', compact('periode'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'periode' => 'required',
            'tanggal' => 'required|date',
            'jumlah_transaksi' => 'required|numeric|min:1',
            'keterangan' => 'required|string'
        ], [
            'periode.required' => 'Periode Wajib Diisi.',
            'tanggal.required' => 'Tanggal Wajib Diisi',
            'jumlah_transaksi.required' => 'Transaksi Wajib Diisi',
            'jumlah_transaksi.numeric' => 'Inputan harus berupa angka',
            'jumlah_transaksi.min' => 'Jumlah transaksi tidak boleh 0.',
            'keterangan.required' => 'wajib mengisi keterangan transaksi',
            'keterangan.string' => 'keterangan wajib beruka huruf'
        ]);
        $jenistransaksi = $request->jenistransaksi;

        $data = [
            'id_user' => $user->id,
            'id_periode' => $request->periode,
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
        ];

        if ($jenistransaksi === 'pemasukan') {
            $data['pemasukan'] = $request->jumlah_transaksi;
        } else {
            $data['pengeluaran'] = $request->jumlah_transaksi;
        }

        Keuangan::create($data);

        return redirect()->route('keuangan.index')->with('success', 'Transaksi berhasil disimpan!');
    }

    public function edit(string $id)
    {
        $keuangan = Keuangan::findOrFail($id);
        $periode = Periode::all();
        // dd($keuangan, $periode);
        return view('keuangan.edit', compact('keuangan', 'periode'));
    }

    public function update(Request $request, string $id)
    {
        $user = Auth::user();
        $request->validate([
            'periode' => 'required',
            'tanggal' => 'required|date',
            'jumlah_transaksi' => 'required|numeric|min:1',
            'keterangan' => 'required|string'
        ], [
            'periode.required' => 'Periode Wajib Diisi.',
            'tanggal.required' => 'Tanggal Wajib Diisi',
            'jumlah_transaksi.required' => 'Transaksi Wajib Diisi',
            'jumlah_transaksi.numeric' => 'Inputan harus berupa angka',
            'jumlah_transaksi.min' => 'Jumlah transaksi tidak boleh 0.',
            'keterangan.required' => 'wajib mengisi keterangan transaksi',
            'keterangan.string' => 'keterangan wajib beruka huruf'
        ]);

        $keuangan = Keuangan::find($id);

        $jenistransaksi = $request->jenistransaksi;

        $data = [
            'id_user' => $user->id,
            'id_periode' => $request->periode,
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
        ];


        if ($jenistransaksi === 'pemasukan') {
            $data['pemasukan'] = $request->jumlah_transaksi;
            $data['pengeluaran'] = 0;  // Set pengeluaran menjadi 0 jika jenis transaksi adalah pemasukan
        } else {
            $data['pengeluaran'] = $request->jumlah_transaksi;
            $data['pemasukan'] = 0;  // Set pemasukan menjadi 0 jika jenis transaksi adalah pengeluaran
        }

        $keuangan->update($data);
        return redirect()->route('keuangan.index')->with('success', 'Transaksi berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        //
    }
}
