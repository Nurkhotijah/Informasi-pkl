<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Tampilkan form login.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('login'); // Pastikan Anda memiliki file login.blade.php
    }

    // Proses login
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5',
        ]);

        // Coba autentikasi pengguna
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Cek role pengguna dan redirect ke halaman sesuai
            if (Auth::user()->role === 'industri') {
                return redirect()->route('industri.dashboard');
            } elseif (Auth::user()->role === 'siswa') {
                return redirect()->route('user.dashboard'); 
            } elseif (Auth::user()->role === 'sekolah') {
            return redirect()->route('admin.dashboard'); 
        }
         

        }

        // Jika autentikasi gagal
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput();
    }


    /**
     * Tangani login tanpa menggunakan database.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    // public function login(Request $request)
    // {
    //     // Data pengguna statis (tanpa database)
    //     $users = [
    //         [
    //             'email' => 'user1@example.com',
    //             'password' => 'password123',
    //         ],
    //         [
    //             'email' => 'user2@example.com',
    //             'password' => 'password456',
    //         ],
    //     ];

    //     // Validasi input
    //     $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required',
    //     ]);

    //     // Cek apakah pengguna ada dalam daftar
    //     $authenticated = false;
    //     foreach ($users as $user) {
    //         if ($user['email'] == $request->email && $user['password'] == $request->password) {
    //             $authenticated = true;
    //             break;
    //         }
    //     }

    //     // Jika pengguna berhasil login
    //     if ($authenticated) {
    //         // Simpan pengguna di session
    //         Session::put('user', $request->email);

    //         // Redirect ke dashboard user
    //         return redirect('/dashboard-user');
    //     }

    //     // Jika login gagal
    //     return redirect()->back()
    //         ->withInput($request->only('email'))
    //         ->withErrors(['email' => 'Email atau kata sandi tidak valid.']);
    // }

    // /**
    //  * Logout dari aplikasi.
    //  *
    //  * @return \Illuminate\Http\RedirectResponse
    //  */
    // public function logout()
    // {
    //     // Hapus session pengguna
    //     Session::forget('user');

    //     return redirect('/login');
    // }
}
