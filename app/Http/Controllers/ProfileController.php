<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function showprofilsiswa()
    {
        $profilesiswa = User::with(['sekolah', 'profile', 'pengajuan.sekolah', 'pengajuan.pkl'])->findOrFail(Auth::user()->id);

        return view('pages-user.profile', compact('profilesiswa'));
    }
}
