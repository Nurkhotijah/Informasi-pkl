<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pkl extends Model
{
    use HasFactory;

    // Define the table name if it's different from the default
    protected $table = 'pkl';

    // Define the fillable fields for mass assignment
    protected $fillable = [
        'tahun',
        'pembimbing',
        'judul_pkl',
        'lampiran',
        'id_sekolah'
    ];

    // Define the relationships
    public function pengajuan()
    {
        return $this->hasMany(Pengajuan::class, 'id_pkl');
    }
}
