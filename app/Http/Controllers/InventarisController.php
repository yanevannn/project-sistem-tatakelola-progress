<?php

namespace App\Http\Controllers;

use App\Models\Inventaris;
use Illuminate\Http\Request;

class InventarisController extends Controller
{
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

    public function create()
    {   
        return view('inventaris.create');
    }

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
            'id_user.required' => 'ID pengguna wajib diisi.',
            'id_user.string' => 'ID pengguna harus berupa teks.',
            
            'nama_barang.required' => 'Nama barang wajib diisi.',
            'nama_barang.string' => 'Nama barang harus berupa teks.',
            'nama_barang.max' => 'Nama barang maksimal 255 karakter.',
            
            'jumlah.required' => 'Jumlah barang wajib diisi.',
            'jumlah.integer' => 'Jumlah barang harus berupa angka.',
            'jumlah.min' => 'Jumlah barang minimal 1.',
            
            'satuan.required' => 'Satuan barang wajib diisi.',
            'satuan.string' => 'Satuan barang harus berupa teks.',
            'satuan.max' => 'Satuan barang maksimal 50 karakter.',
            
            'sumber_pengadaan.required' => 'Sumber pengadaan wajib diisi.',
            'sumber_pengadaan.string' => 'Sumber pengadaan harus berupa teks.',
            'sumber_pengadaan.max' => 'Sumber pengadaan maksimal 255 karakter.',
            
            'keterangan.string' => 'Keterangan harus berupa teks.',
            'keterangan.max' => 'Keterangan maksimal 255 karakter.',
            
            'status.required' => 'Status barang wajib dipilih.',
            'status.in' => 'Status barang hanya bisa "baik", "rusak", "perbaikan", atau "hilang".',
            
            'foto.image' => 'File foto harus berupa gambar.',
            'foto.mimes' => 'Foto hanya bisa menggunakan ekstensi jpg, jpeg, png, gif.',
            'foto.max' => 'Foto maksimal 2MB.',
        ]
        );
        

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
        return redirect()->route('inventaris.index')->with("success", "Data Inventaris Berhasil Ditambahkan !");
    }

    public function show(string $id)
    {
        //
    }

    function edit(string $id)
    {
        $inventaris = Inventaris::findOrFail($id);
        return view('inventaris.edit', compact('id','inventaris'));
    }

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
            'id_user.required' => 'ID Pengguna wajib diisi.',
            'id_user.string' => 'ID Pengguna harus berupa teks.',
        
            'nama_barang.required' => 'Nama Barang wajib diisi.',
            'nama_barang.string' => 'Nama Barang harus berupa teks.',
            'nama_barang.max' => 'Nama Barang tidak boleh lebih dari 255 karakter.',
        
            'jumlah.required' => 'Jumlah Barang wajib diisi.',
            'jumlah.integer' => 'Jumlah Barang harus berupa angka.',
            'jumlah.min' => 'Jumlah Barang harus lebih dari atau sama dengan 1.',
        
            'satuan.required' => 'Satuan wajib diisi.',
            'satuan.string' => 'Satuan harus berupa teks.',
            'satuan.max' => 'Satuan tidak boleh lebih dari 50 karakter.',
        
            'sumber_pengadaan.required' => 'Sumber Pengadaan wajib diisi.',
            'sumber_pengadaan.string' => 'Sumber Pengadaan harus berupa teks.',
            'sumber_pengadaan.max' => 'Sumber Pengadaan tidak boleh lebih dari 255 karakter.',
        
            'keterangan.string' => 'Keterangan harus berupa teks.',
            'keterangan.max' => 'Keterangan tidak boleh lebih dari 255 karakter.',
        
            'status.required' => 'Status wajib dipilih.',
            'status.in' => 'Status hanya bisa "baik", "rusak", "perbaikan", atau "hilang".',
        
            'foto.image' => 'File Foto harus berbentuk gambar (jpg, jpeg, png, gif).',
            'foto.mimes' => 'File Foto harus berekstensi jpg, jpeg, png, atau gif.',
            'foto.max' => 'Foto maksimal 2 MB.',
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
        return redirect()->route('inventaris.index')->with('success', 'Data Inventaris Berhasil Diperbarui!');
        
    }

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
        return redirect()->route('inventaris.index')->with('success', 'Data Inventaris Berhasil Dihapus');
    }
}
