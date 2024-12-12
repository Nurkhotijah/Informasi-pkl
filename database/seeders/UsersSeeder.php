<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run()
    {
        // Membuat akun admin industri
        $Industri = User::create([
            'name' => 'qelopak',
            'email' => 'qelopak@gmail.com',
            'role' => 'industri', // Tetapkan role dulu
            'alamat' => 'Ruko Pakuan Regency, Jl. Amparan Jati Blok A2 No 11, RT.01/RW.07, Margajaya, Kec. Bogor Bar., Kota Bogor, Jawa Barat 16116',
            'password' => Hash::make('industri'), // Password admin industri
        ]);
        $Industri->assignRole('industri');

        $Industri->profile()->create([
            'alamat' => 'Ruko Pakuan Regency, Jl. Amparan Jati Blok A2 No 11, RT.01/RW.07, Margajaya, Kec. Bogor Bar., Kota Bogor, Jawa Barat 16116',
        ]);

        // Membuat akun sekolah (registrasi sekolah)
        $sekolah = User::create([
            'name' => 'SMKN 1 Ciomas',
            'email' => 'smkn1ciomas@gmail.com',
            'role' => 'sekolah', // Tetapkan role dulu
            'alamat' => 'Jl. Raya Laladon, Laladon, Kec. Ciomas, Kabupaten Bogor, Jawa Barat 16610',
            'password' => Hash::make('skanic'), // Password sekolah
        ]);
        $sekolah->assignRole('sekolah');

        $sekolah->profile()->create([
            'alamat' => 'Jl. Raya Laladon, Laladon, Kec. Ciomas, Kabupaten Bogor, Jawa Barat 16610',
        ]);

        $sekolah->sekolah()->create([
            'nama' => 'SMKN 1 Ciomas',
            'alamat' => 'Jl. Raya Laladon, Laladon, Kec. Ciomas, Kabupaten Bogor, Jawa Barat 16610',
        ]);

        // Membuat akun siswa
        $siswa = User::create([
            'name' => 'Fitri Amaliah',
            'email' => 'fitri@gmail.com',
            'role' => 'siswa', // Tetapkan role dulu
            'password' => Hash::make('fitri'), // Password siswa
        ]);
        $siswa->assignRole('siswa');

        $siswa->profile()->create([
            'alamat' => null,
        ]);
    }
}
