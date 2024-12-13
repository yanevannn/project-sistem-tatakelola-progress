<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Periode;
use App\Models\PrestasiAnggota;
use Illuminate\Http\Request;

class PrestasiAnggotaController extends Controller
{
    public function index(){
        $maxdata = 10;
        $periode = Periode::all();
        $prestasi = PrestasiAnggota::paginate(10);
        $anggota = Anggota::all();
        
        return view('prestasi_anggota.index', compact('periode', 'prestasi', 'anggota'));
    }

    public function create(Request $request){
        return view('prestasi_anggota.create');
    }

    public function searchAnggota(Request $request)
    {
        if ($request->ajax()) {
            $search = $request->get('search');
            $anggota = Anggota::where('nama', 'like', "%{$search}%")
                            ->orWhere('nim', 'like', "%{$search}%")
                            ->get();

            return response()->json($anggota);
        }
    }


    public function store(Request $request){
        
    }

}
