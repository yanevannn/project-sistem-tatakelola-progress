<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DokumenKegiatan extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan oleh model ini
    protected $table = 'dokumen_kegiatan';

    // Kolom yang dapat diisi
    protected $fillable = [
        'id_user',
        'id_periode',
        'nama_kegiatan',
        'proposal',
        'lpj',
        'lpjk',
        'tanggal_mulai',
        'tanggal_selesai',
        'keterangan'
    ];
    // Definisikan relasi dengan tabel users
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Definisikan relasi dengan tabel periodes
    public function periode()
    {
        return $this->belongsTo(Periode::class, 'id_periode');
    }
}
