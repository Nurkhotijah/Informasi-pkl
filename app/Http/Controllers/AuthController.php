<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Sekolah;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Validasi data registrasi
        $validated = $request->validate([
            'name' => 'required|string|max:255', // Nama Sekolah atau Username
            'email' => 'required|string|email|max:255|unique:users',
            'alamat' => 'required|string|max:255', // Alamat
            'password' => 'required|string|min:5', // Password
            'agreement' => 'accepted', // Validasi checkbox persetujuan
        ]);

        // Menyimpan data sekolah ke database
        $user = User::create([
            'name' => $validated['name'], // Nama Sekolah atau Username
            'email' => $validated['email'],
            'alamat' => $validated['alamat'],
            'password' => Hash::make($validated['password']),
            'role' => 'sekolah', // Mengubah role menjadi sekolah
        ]);

        // Menetapkan role sekolah
        $user->assignRole('sekolah');

        Profile::create([
            'user_id' => $user->id,
            'alamat' => $validated['alamat']
        ]);

        Sekolah::create([
            'user_id' => $user->id,
            'nama' => $validated['name'],
            'alamat' => $validated['alamat']
        ]);

        // Login otomatis setelah registrasi (opsional)
        // auth()->login($user);

        return redirect()->route('login')->with('success', 'Registrasi berhasil. Silakan login.');
    }

    // public function login(Request $request)
    // {
    //     $validated = $request->validate([
    //         'email' => 'required|string|email',
    //         'password' => 'required|string',
    //     ]);

    //     if (auth()->attempt($validated)) {
    //         return redirect()->route('dashboard');
    //     }

    //     return back()->withErrors(['email' => 'Invalid credentials']);
    // }
}