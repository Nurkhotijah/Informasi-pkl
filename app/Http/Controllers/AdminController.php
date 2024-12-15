<?php

namespace App\Http\Controllers;

use App\Models\Kehadiran;
use App\Models\Penilaian;
use App\Models\Profile;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public function dashboard()
    {
        return view('pages-admin.dashboard-admin');
    }
    public function kehadiranSiswapkl()
    {
        // Logika untuk mengelola kehadiran
        return view('pages-admin.kehadiran-siswapkl');
    }
    public function index()
    {
        $kehadiran = Kehadiran::with('user')->whereHas('user.profile', function($query) {
            $query->where('id_sekolah', Auth::user()->sekolah->id);
        })->get();

        // Mengirim data ke tampilan
        return view('pages-admin.kehadiran-siswapkl', compact('kehadiran'));
    }
    public function downloadpenilaian($id)
    {
        // Mengambil data penilaian berdasarkan ID
        $penilaian = Penilaian::findOrFail($id);
    
        // Menyiapkan data untuk template
        $data = [
            'penilaian' => $penilaian,
        ];
    
        // Membuat PDF dari template Blade
        $pdf = Pdf::loadView('template-penilaian', $data);
    
        // Mengunduh file PDF
        return $pdf->download('penilaian_' . $penilaian->id . '.pdf');
    }

    public function indexlaporan()
    {
        // Mendapatkan sekolah yang login
        $sekolahId = Auth::user()->id;
    
        $siswa = User::whereHas('pengajuan', function ($query) use ($sekolahId) {
            $query->where('id_sekolah', $sekolahId);
        })->with('pengajuan')->get();        
    
        return view('pages-admin.data-siswa', compact('siswa'));
    }
    

    public function pengajuanSiswa()
    {
        // Logika untuk mengelola pengajuan
        return view('pages-admin.pengajuan-siswa');
    }

    public function tambahSiswa()
    {
        // Logika untuk mengelola pengajuan
        return view('pages-admin.tambah-siswa');
    }
    public function dataSiswa()
    {
        $siswa = User::whereHas('profile', function ($query) {
            $query->where('id_sekolah', Auth::user()->sekolah->id);
        })->get();

        // Logika untuk mengelola pengajuan
        return view('pages-admin.data-siswa', compact('siswa'));
    }

    public function kehadiransekolah($userId)
    {
        // Ambil data user berdasarkan userId
        $user = User::with('profile.sekolah')->find($userId); // Pastikan relasi sudah didefinisikan di model
    
        if (!$user) {
            return redirect()->back()->with('error', 'Data user tidak ditemukan.');
        }
    
        // Ambil data kehadiran berdasarkan user_id
        $kehadiran = Kehadiran::where('user_id', $userId)->get();
    
        // Ambil data tanggal mulai dan tanggal selesai PKL dari tabel profile
        $tanggalMulai = $user->profile ? $user->profile->tanggal_mulai : null;
        $tanggalSelesai = $user->profile ? $user->profile->tanggal_selesai : null;
    
        // Hitung jumlah kehadiran, izin, dan tidak hadir
        $hadirCount = $kehadiran->where('status', 'hadir')->count();
        $izinCount = $kehadiran->where('status', 'izin')->count();
        $tidakHadirCount = $kehadiran->where('status', 'tidak hadir')->count();
        $total = $hadirCount + $izinCount + $tidakHadirCount;
    
        // Menyusun data untuk dikirim ke view
        $data = [
            'user' => $user,
            'kehadiran' => $kehadiran,
            'hadirCount' => $hadirCount,
            'izinCount' => $izinCount,
            'tidakHadirCount' => $tidakHadirCount,
            'total' => $total,
            'tanggalMulai' => $tanggalMulai,
            'tanggalSelesai' => $tanggalSelesai,
        ];
    
        // Membuat PDF menggunakan template
        $pdf = PDF::loadView('template-kehadiran', $data);
    
        // Mengunduh PDF
        return $pdf->download('rekap-kehadiran-' . $userId . '.pdf');
    }
    

    public function cetakSertifikatSiswa($id)
    {
        $siswa = User::with('profile.sekolah.user.profile')->find($id);

        if (!$siswa || !$siswa->profile || !$siswa->profile->sekolah || !$siswa->profile->sekolah->user || !$siswa->profile->sekolah->user->profile) {
            return redirect()->back()->with('error', 'Data sertifikat tidak ditemukan.');
        }

        $pdf = Pdf::loadView('pages-admin.pdf.sertifikat', compact('siswa'));
        $pdf->setPaper('A4', 'Landscape');
        return $pdf->stream($siswa->name . '-sertifikat.pdf');
    }

    public function jurnalSiswa()
    {
        // Logika untuk menampilkan jurnal siswa
        return view('pages-admin.jurnal-siswa');
    }

    public function jurnalDetail()
    {
        // Logika untuk menampilkan jurnal siswa
        return view('pages-admin.jurnal-detail');
    }

    public function nilaiSiswa()
    {

        return view('pages-admin.nilai-siswa');
    }

    public function rekapKehadiransiswa()
    {

        return view('pages-admin.rekap-kehadiransiswa');
    }

    public function profileAdmin()
    {
        // Logika untuk menampilkan jurnal siswa
        return view('pages-admin.profile-admin');
    }

    public function profileUpdate()
    {
        // Logika untuk menampilkan jurnal siswa
        return view('pages-admin.profile-update');
    }

    // public function showRiwayat()
    // {
    //     // // Debug ID pengguna yang sedang login
    //     // dd(auth()->id()); // Pastikan ini mengembalikan ID pengguna yang sedang login

    //     // Mengambil riwayat pengajuan berdasarkan ID user yang sedang login
    //     $riwayatPengajuan = Pengajuan::where('user_id', auth()->id())->get();

    //     // Mengirimkan data riwayat pengajuan ke view
    //     return view('pages-admin.pengajuan', compact('riwayatPengajuan'));
    // }

    // public function editPengajuan()
    // {
    //     // Logika untuk menampilkan jurnal siswa
    //     return view('pages-admin.edit-pengajuan'); 
    // }
    // public function editKehadiran()
    // {
    //     // Logika untuk menampilkan jurnal siswa
    //     return view('pages-admin.edit-kehadiran'); 
    // }
}
