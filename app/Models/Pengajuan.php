<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    protected $table = 'pengajuan';

    protected $fillable = [
        'id_sekolah',
        'nama',
        'jurusan',
        'tanggal_mulai',
        'tanggal_selesai',
        'cv_file',
        'status_persetujuan',
        'tahun',
        'pembimbing',
        'judul_pkl',
        'lampiran',
    ];

    // Relasi dengan model Sekolah
    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class, 'id_sekolah');
    }

    
    public function pengajuan()
{
    return $this->hasOne(Pengajuan::class, 'user_id');
}

}
