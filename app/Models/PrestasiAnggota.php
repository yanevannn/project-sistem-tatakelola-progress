<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PrestasiAnggota extends Model
{
    use HasFactory;

    protected $table = 'prestasi';

    protected $fillable = [
        'id_anggota',
        'nama_prestasi',
        'tingkat',
        'tahun_prestasi',
        'file',
    ];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'id_anggota');
    }
}
