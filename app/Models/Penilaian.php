<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;
    protected $table = 'penilaian';
    // Tentukan kolom yang bisa diisi secara massal
    protected $fillable = [
        'user_id',
        'sikap',
        'microteaching',
        'kehadiran',
        'project',
    ];

    // Relasi ke siswa (user_id)
    public function siswa()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke sekolah (sekolah_id)
    // public function sekolah()
    // {
    //     return $this->belongsTo(User::class, 'sekolah_id');
    // }

    public function sekolah()
    {
        return $this->hasOneThrough(Sekolah::class, User::class, 'id', 'user_id');
    }

    public function profile()
    {
        return $this->belongsTo(Profile::class, 'user_id');
    }

    // Di dalam model Penilaian.php
public function user()
{
    return $this->belongsTo(User::class);
}

}

