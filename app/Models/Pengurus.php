<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengurus extends Model
{
    use HasFactory;
    // Define the table name if it's not the default plural form
    protected $table = 'penguruses';

    // Primary key (if it's not 'id')
    protected $primaryKey = 'nim';

    // Disable auto-incrementing as NIM is not auto-incremented
    public $incrementing = false;

    // Set primary key type to string (for NIM)
    protected $keyType = 'string';

    // Mass assignable attributes
    protected $fillable = [
        'nim',
        'email',
        'jabatan',
        'jenis_kelamin',
        'alamat',
        'no_hp',
        'status',
        'password',
        'role'
    ];
}
