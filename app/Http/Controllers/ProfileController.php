<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function showprofilsiswa()
{
    $profilesiswa = User::with(['sekolah', 'profile', 'pengajuan.sekolah', 'pengajuan.pkl'])->findOrFail(auth()->id());

    // Ambil pengajuan pertama jika ada, atau null jika tidak ada
    $pengajuan = $profilesiswa->pengajuan->first();

    return view('pages-user.profile', compact('profilesiswa', 'pengajuan'));
}

}