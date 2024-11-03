<?php

namespace App\Http\Controllers;

use App\Models\Inventaris;
use Illuminate\Http\Request;

class InventarisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $maxdata = 5 ;
        if(request('search')){
            $inventaris = Inventaris::where('nama_barang','like','%'.request('search').'%')->paginate($maxdata)->appends(['search' => request('search')]);
            return view('inventaris.index', compact('inventaris'));
        } else {

            $inventaris = Inventaris::paginate($maxdata);
            return view('inventaris.index', compact('inventaris'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        return view('inventaris.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'id_user' => 'required|string',
            'nama_barang' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'satuan' => 'required|string|max:50',
            'sumber_pengadaan' => 'required|string|max:255',
            'keterangan' => 'nullable|string|max:255',
            'status' => 'required|in:baik,rusak,perbaikan,hilang',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Maksimal 2MB
        ],
        [
            'foto.max' => 'Foto maksimal 2 MB',
            'foto.mimes' => 'File ekstensi hanya bisa jpg,png,jpeg,gif, svg',
            'foto.image' => 'File harus berbentuk image'
        ]);

        // Mengganti spasi dengan underscore untuk nama barang
        $formattedNamaBarang = str_replace(' ', '_', $request->nama_barang);

        // Memproses file foto
        if (!empty($request->foto)) {
            $fileName = 'foto-' .$formattedNamaBarang.'-'. uniqid() . '.' . $request->foto->extension();
            $request->foto->move(public_path('image/inventaris'), $fileName);
        } else {
            $fileName = 'nophoto.jpg'; // Menggunakan gambar default jika tidak ada foto
        }
        // Simpan data inventaris ke database
        Inventaris::create([
            'id_user' => $request->id_user,
            'gambar' => $fileName,
            'nama_barang' => $request->nama_barang,
            'jumlah' => $request->jumlah,
            'satuan' => $request->satuan,
            'sumber_pengadaan' => $request->sumber_pengadaan,
            'keterangan' => $request->keterangan,
            'kondisi' => $request->status,
        ]);

        // Redirect ke halaman yang diinginkan dengan pesan sukses
        return redirect()->route('inventaris.index');
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
        $inventaris = Inventaris::findOrFail($id);
        return view('inventaris.edit', compact('id','inventaris'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input
        $request->validate([
            'id_user' => 'required|string',
            'nama_barang' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'satuan' => 'required|string|max:50',
            'sumber_pengadaan' => 'required|string|max:255',
            'keterangan' => 'nullable|string|max:255',
            'status' => 'required|in:baik,rusak,perbaikan,hilang',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Maksimal 2MB
        ],
        [
            'foto.max' => 'Foto maksimal 2 MB',
            'foto.mimes' => 'File ekstensi hanya bisa jpg,png,jpeg,gif, svg',
            'foto.image' => 'File harus berbentuk image'
        ]);

        // Temukan data inventaris berdasarkan ID
        $inventaris = Inventaris::findOrFail($id);

        // Foto lama dari database
        $fotoLama = $inventaris->gambar;
        // Mengganti spasi dengan underscore untuk nama barang
        $formattedNamaBarang = str_replace(' ', '_', $request->nama_barang);

        // Foto lama dari database
        $fotoLama = $inventaris->gambar;

        // Jika ada foto baru yang diupload
        if ($request->hasFile('foto')) {
            // Jika ada foto lama, dan bukan default, maka hapus file foto lama
            if ($fotoLama && $fotoLama !== 'nophoto.jpg') {
                $fotoLamaPath = public_path('image/inventaris/' . $fotoLama); 
                if (file_exists($fotoLamaPath)) {
                    unlink($fotoLamaPath); // Hapus foto lama dari folder
                }
            }
            // Ganti dengan foto baru
            $fileName = 'foto-' .$formattedNamaBarang.'-'. uniqid() . '.' . $request->foto->extension();
            $request->foto->move(public_path('image/inventaris'), $fileName); // Simpan foto baru
        } else {
            // Jika tidak ada foto baru, gunakan foto lama
            $fileName = $fotoLama;
        }

        $inventaris->update([
            'id_user' => $request->id_user,
            'gambar' => $fileName,
            'nama_barang' => $request->nama_barang,
            'jumlah' => $request->jumlah,
            'satuan' => $request->satuan,
            'sumber_pengadaan' => $request->sumber_pengadaan,
            'keterangan' => $request->keterangan,
            'kondisi' => $request->status,
        ]);
    
        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('inventaris.index');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $inventaris= Inventaris::findOrFail($id);
        // Periksa apakah gambar bukan gambar default
        if ($inventaris->gambar !== 'nophoto.jpg') {
            // Hapus gambar dari folder 'public/image/inventaris'
            $imagePath = public_path('image/inventaris/' . $inventaris->gambar);
            if (file_exists($imagePath)) {
                unlink($imagePath); // Hapus file gambar
            }
        }
        $inventaris->delete();
        return redirect()->route('inventaris.index')->with('success', 'Periode berhasil dihapus');
    }
}
