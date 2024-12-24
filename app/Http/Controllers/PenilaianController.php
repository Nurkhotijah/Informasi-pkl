<?php

namespace App\Http\Controllers;

use App\Models\Penilaian;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PenilaianController extends Controller
{
    public function showuser()
{
    // Ambil penilaian berdasarkan user ID yang sedang login
    $penilaian = Penilaian::with('user') // Memastikan relasi 'user' di-load
        ->where('user_id', auth()->user()->id) // Filter berdasarkan ID pengguna yang sedang login
        ->first(); // Ambil penilaian pertama, bisa kosong jika tidak ada
    
    // Jika penilaian tidak ditemukan, arahkan kembali ke halaman jurnal.index
    if (!$penilaian) {
        return redirect()->action([JurnalSiswaController::class, 'index']);
    }

    // Jika penilaian ditemukan, buat PDF dan download
    $pdf = Pdf::loadView('template-penilaian', compact('penilaian'));
    $pdf->setPaper('A4', 'portrait');
    return $pdf->download('Laporan_Penilaian_PKL.pdf');
}

}
