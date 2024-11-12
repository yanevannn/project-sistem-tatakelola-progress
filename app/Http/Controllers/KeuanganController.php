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

        return view ('keuangan.index', compact('keuangan','user','periodes', 'periode','totalPemasukan', 'totalPengeluaran', 'saldoAkhir'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('keuangan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        
    }
    public function edit2()
    {
        return view('keuangan.edit');
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
