<?php

namespace App\Http\Controllers;
use App\Models\Jurnal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function dashboard()
{
    $users = Auth::user();

    // Ambil semua jurnal yang dimiliki pengguna
    $jurnal = Jurnal::where('user_id', $users->id)->get();

    // Hitung jumlah jurnal yang sudah dikirim oleh pengguna
    $jumlahJurnal = $jurnal->count();

    return view('pages-user.Dashboard-user', compact('jurnal', 'jumlahJurnal'));
}

    
    public function riwayatabsensi() {
    return view('pages-user.riwayat-absensi');
}

public function uploadFotoizin() {
    return view('pages-user.uploadFotoizin');
}
     public function pengajuanizin() {
    return view('pages-user.Pengajuan-izin');
}
// public function jurnalKegiatan() {
//     return view('pages-user.Jurnal-kegiatan');
// }

public function editjurnal() {
    return view('pages-user.Edit-jurnal');
}

public function profile() {
    return view('pages-user.Profile');
}

 // Metode untuk menampilkan halaman edit pengajuan
 public function editizin()
{
    return view('pages-user.Edit-izin'); 
}

public function tambahjurnal()
{
    return view('pages-user.Tambah-jurnal'); 
}

public function hapusizin()
{
    return view('pages-user.Hapus-izin'); 
}

public function laporanpkl()
{
    return view('pages-user.laporan-pkl'); 
}

   
    public function logout(Request $request)
    {
        Auth::logout(); // Menggunakan facade Auth untuk logout

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
