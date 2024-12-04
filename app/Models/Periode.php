<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Periode extends Model
{
    use HasFactory;

    protected $table = 'periode';
    
    protected $primaryKey = 'id';

    protected $fillable = [
        'tahun',
        'status',
    ];
}
