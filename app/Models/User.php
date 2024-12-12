<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles; // Tambahkan ini


class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'alamat',
        'foto_profile',
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

    public function setAlamatAttribute($value)
    {
        // Cek jika role adalah sekolah atau industri, atau jika role belum diatur
        if (!isset($this->attributes['role']) || in_array($this->attributes['role'], ['sekolah', 'industri'])) {
            $this->attributes['alamat'] = $value;
        } else {
            $this->attributes['alamat'] = null;
        }
    }
    
    
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function sekolah()
    {
        return $this->hasOne(Sekolah::class);
    }

    public function kehadiran()
    {
        return $this->hasMany(kehadiran::class, 'user_id');
    }
    

    // Relasi satu ke banyak (User ke PengajuanSiswa)
    public function pengajuan()
    {
        return $this->hasMany(Pengajuan::class, 'id_sekolah');
    }

    // Relasi dengan JurnalKegiatan (Seorang User dapat memiliki banyak JurnalKegiatan)
    public function jurnal()
    {
        return $this->hasMany(Jurnal::class, 'user_id');
    }

    public function laporan()
    {
        return $this->hasOne(Laporan::class);
    }

    public function penilaian()
    {
        return $this->hasMany(Penilaian::class, 'user_id');
    }
}
