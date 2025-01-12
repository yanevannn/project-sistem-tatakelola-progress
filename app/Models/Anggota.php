<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Anggota extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'anggota';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_periode',
        'nim',
        'nama',
        'no_hp',
        'kelas',
        'status_keanggotaan'
    ];

    /**
     * Get the associated Periode.
     */
    public function periode()
    {
        return $this->belongsTo(Periode::class, 'id_periode');
    }
}
