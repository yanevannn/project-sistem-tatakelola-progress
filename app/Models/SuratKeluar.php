<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class SuratKeluar extends Model
{
    use HasFactory;

    protected $table = 'surat_keluar';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id_user',
        'id_periode',
        'nomor_surat_keluar',
        'tertuju',
        'keterangan',
        'tanggal_surat',
        'tanggal_terkirim',
        'file',
    ];

    public function periode(){
        return $this->belongsTo(Periode::class, 'id_periode');
    }
}
