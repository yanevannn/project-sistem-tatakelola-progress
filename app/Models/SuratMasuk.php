<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class SuratMasuk extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak menggunakan penamaan default (plural)
    protected $table = 'surat_masuk';

    // Tentukan primary key jika tidak menggunakan 'id'
    protected $primaryKey = 'id';

    // Tentukan field yang boleh diisi (fillable)
    protected $fillable = [
        'id_user',
        'id_periode',
        'nomor_surat_masuk',
        'pengirim',
        'tanggal_surat',
        'tanggal_terima',
        'penerima',
        'file',
        'keterangan'
    ];

    public function periode()
    {
        return $this->belongsTo(Periode::class, 'id_periode');
        // id_periode reference ke tabel surat masuk dengan colomn id_periode
    }
}
