<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kehadiran extends Model
{
    use HasFactory;
    
    // Tentukan nama tabel yang sesuai dengan tabel di database
    protected $table = 'kehadiran';

    protected $fillable = [
        'user_id',
        'sekolah_id',
        'tanggal',
        'status',
        'waktu_masuk',
        'waktu_keluar',
        'foto_izin',
        'foto_masuk',
        'foto_keluar',
    ];

    // Relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function profile()
    {
        return $this->belongsTo(Profile::class, 'user_id');
    }
    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class, 'sekolah_id');
    }
}
