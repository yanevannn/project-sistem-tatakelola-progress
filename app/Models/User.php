<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_periode',          // ID Periode (foreign key menghubungkan anggota dengan periode)
        'id_anggota',                 // Nomor Induk Mahasiswa (NIM)
        'nama',                // Nama anggota
        'role',                // Jabatan anggota
        'email',               // Alamat email anggota
        'password',            // Kata sandi anggota
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function periode()
    {
        return $this->belongsTo(Periode::class, 'id_periode');
    }

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'id_anggota');
    }

    public function isPengurusInti(): bool
    {
        return in_array($this->role, ['Ketua', 'Wakil Ketua', 'Bendahara', 'Sekretaris']);
    }

    // Periksa apakah pengguna adalah pengurus biasa
    public function isPengurus(): bool
    {
        return in_array($this->role, ['Divisi I', 'Divisi II', 'Divisi III']);
    }
}
