<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

        $user = User::where("email", $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Invalid email or password.']);
        }

        Auth::guard('industri')->logout();
        Auth::guard('sekolah')->logout();
        Auth::logout();

        // Cek role user dan arahkan ke halaman dashboard sesuai role
        if ($user->role === 'industri') {
            if (Auth::guard('industri')->attempt($request->only('email', 'password'))){
                $request->session()->regenerate();
                
                return redirect()->route('industri.dashboard')->with('success', 'Login successful!');
            } 
            
        } elseif ($user->role === 'sekolah') {
            if (Auth::guard('sekolah')->attempt($request->only('email', 'password'))){
                $request->session()->regenerate();
                
                return redirect()->route('admin.dashboard')->with('success', 'Login successful!');
            }
        } elseif ($user->role === 'siswa') {
            if (Auth::attempt($request->only('email', 'password'))){
                $request->session()->regenerate();

                return redirect()->route('user.dashboard')->with('success', 'Login successful!');
            }
        }

        return back()->withErrors(['email' => 'Invalid email or password.']);
    }   
       
    

        public function logout(Request $request)
        {
            Auth::logout();
            $request->session()->invalidate();
     
            $request->session()->regenerateToken();
    
            return redirect('/login')->with('success', 'Anda berhasil logout.');       
        }
    
        // Proses logout
        public function logoutsekolah(Request $request)
        {
            Auth::guard('sekolah')->logout();
            $request->session()->invalidate();
            
     
            $request->session()->regenerateToken();
    
            return redirect('/login')->with('success', 'Anda berhasil logout.');       
        }
        public function logoutindustri(Request $request)
        {
            Auth::guard('industri')->logout();
            $request->session()->invalidate();
            
     
            $request->session()->regenerateToken();
    
            return redirect('/login')->with('success', 'Anda berhasil logout.');       
        }
    }

     // // Coba autentikasi pengguna
        // if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        //     // Cek role pengguna dan redirect ke halaman sesuai
        //     if (Auth::user()->role === 'industri') {
        //         return redirect()->route('industri.dashboard');
        //     } elseif (Auth::user()->role === 'siswa') {
        //         return redirect()->route('user.dashboard'); 
        //     } elseif (Auth::user()->role === 'sekolah') {
        //     return redirect()->route('admin.dashboard'); 
        // 