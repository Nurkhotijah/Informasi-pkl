<?php

namespace App\Http\Controllers;

use App\Models\Penilaian;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PenilaianController extends Controller
{
    public function show()
{
    // Ambil penilaian berdasarkan user ID yang sedang login
    $penilaian = Penilaian::with('user') // Memastikan relasi 'user' di-load
        ->where('user_id', auth()->user()->id) // Filter berdasarkan ID pengguna yang sedang login
        ->firstOrFail(); // Ambil penilaian pertama atau gagal jika tidak ditemukan
    
    return view('pages-user.penilaian.show', compact('penilaian'));
}

//     public function showPenilaian($id)
// {
//     // Ambil data penilaian berdasarkan user_id
//     $penilaian = Penilaian::where('user_id', $id)->get();

//     // Ambil data user berdasarkan id
//     $user = User::find($id);

//     // Tampilkan halaman penilaian dengan data penilaian dan user
//     return view('pages-industri.penilaian.show', compact('penilaian', 'user'));
// }

}
