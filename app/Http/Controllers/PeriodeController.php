<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use Illuminate\Http\Request;

class PeriodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $periode= Periode::all();
        return view('periode.index', compact('periode'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('periode'); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'periode' => 'required|string',
            'status' => 'required|in:aktif,non-aktif',
        ]);

        Periode::create([
            'tahun' => $request->periode,
            'status' => $request->status,
        ]);

        return redirect()->route('periode.index')->with('success', 'Periode berhasil ditambahkan');
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
        $periode = Periode::findOrFail($id); // Ambil data periode berdasarkan ID
        return view('periode.edit', compact('periode')); // Kirim data ke view
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'periode' => 'required|string',
            'status' => 'required|in:aktif,non-aktif',
        ]);
    
        $periode = Periode::findOrFail($id);
        $periode->update([
            'tahun' => $request->periode,
            'status' => $request->status,
        ]);
    
        return redirect()->route('periode.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $periode = Periode::findOrFail($id);
        $periode->delete();
        return redirect()->route('periode.index')->with('success', 'Periode berhasil dihapus');
    }
}
