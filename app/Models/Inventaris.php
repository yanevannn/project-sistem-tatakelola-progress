<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Inventaris extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_user', 
        'gambar',
        'nama_barang', 
        'jumlah', 
        'satuan', 
        'sumber_pengadaan', 
        'keterangan', 
        'kondisi'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'id_user');
    }
}
