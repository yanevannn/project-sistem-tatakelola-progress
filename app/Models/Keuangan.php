<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keuangan extends Model
{
    use HasFactory;

    protected $table = 'keuangan';
    protected $fillable =[
        'id_user',
        'id_periode',
        'tanggal',
        'keterangan',
        'pemasukan',
        'pengeluaran',
        'updated_at',
        'created_at',
    ];
}
