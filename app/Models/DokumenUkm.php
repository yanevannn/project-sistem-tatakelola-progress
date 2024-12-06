<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DokumenUkm extends Model
{
    protected $table = 'dokumen_ukm';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_user',
        'id_periode',
        'nama_ketua',
        'rka',
        'adart',
        'updated_at',
        'created_at',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'id_user');
    }

    public function periode(){
        return $this->belongsTo(Periode::class, 'id_periode');
    }
}
