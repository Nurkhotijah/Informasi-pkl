<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function showprofilesekolah()
    {
        // Ambil data pengguna yang sedang login
        $profilesekolah = User::findOrFail(auth()->id());

        return view('pages-admin.profile-admin', compact('profilesekolah'));
    }

    public function edit()
    {
        $profile = User::findOrFail(auth()->id());
        return view('pages-admin.profile-update', compact('profile'));
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . auth()->id(),
            'foto_profile' => 'nullable|image|mimes:jpeg,png,jpg|max:5000',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $profile = User::findOrFail(auth()->id());

        $profile->name = $request->name;
        $profile->alamat = $request->alamat;
        $profile->email = $request->email;

        if ($request->hasFile('foto_profile')) {
            $path = $request->file('foto_profile')->store('profile_pictures', 'public');
            $profile->foto_profile = $path;
        }

        if ($request->filled('password')) {
            $profile->password = Hash::make($request->password);
        }

        $profile->save();

        return redirect()->route('profile-admin')->with('success', 'Profil berhasil diperbarui.');
    }
}