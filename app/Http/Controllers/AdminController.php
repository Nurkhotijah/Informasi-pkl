<?php

namespace App\Http\Controllers;

use App\Models\Kehadiran;
use App\Models\Penilaian;
use App\Models\Profile;
use App\Models\Jurnal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{

    public function dashboard()
    {
        $jumlahjurnal = Jurnal::count(); // Menghitung total semua jurnal yang siswa kirim

        return view('pages-admin.dashboard-admin');
    }
    // public function kehadiranSiswapkl()
    // {
    //     // Logika untuk mengelola kehadiran
    //     return view('pages-admin.kehadiran-siswapkl');
    // }
    public function index()
    {
        $kehadiran = Kehadiran::with('user')->whereHas('user.profile', function($query) {
            $query->where('id_sekolah', Auth::user()->sekolah->id);
        })->get();

        // Mengirim data ke tampilan
        return view('pages-admin.kehadiran-siswapkl', compact('kehadiran'));
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
    

    // public function pengajuanSiswa()
    // {
    //     // Logika untuk mengelola pengajuan
    //     return view('pages-admin.pengajuan-siswa');
    // }

    // public function tambahSiswa()
    // {
    //     // Logika untuk mengelola pengajuan
    //     return view('pages-admin.tambah-siswa');
    // }

/* -------------------------------------------------------------------------- */
/*                                  START DATA SISWA                          */
/* -------------------------------------------------------------------------- */

public function dataSiswa()
{
    $siswa = User::whereHas('profile', function ($query) {
        $query->where('id_sekolah', Auth::user()->sekolah->id);
    })->get();

    return view('pages-admin.data-siswa', compact('siswa'));
}
public function downloadPenilaian($id)
{
    
    $penilaian = Penilaian::find($id);

    if (!$penilaian) {
        $siswa = User::whereHas('profile', function ($query) {
            $query->where('id_sekolah', Auth::user()->sekolah->id);
        })->get();
    
        return view('pages-admin.data-siswa', compact('siswa'))
            ->with('error', 'Data Penilaian tidak ditemukan.');
    }
    
    $penilaian = ['penilaian' => $penilaian];
    $pdf = Pdf::loadView('template-penilaian', $penilaian);
    $pdf->setPaper('A4', 'portrait');
    return $pdf->download('Laporan_Penilaian_PKL.pdf');
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
        
        $pdf = Pdf::loadView('pages-admin.pdf.sertifikat', compact('siswa'));
        $pdf->setPaper('A4', 'Landscape');
        return $pdf->stream($siswa->name . '-sertifikat.pdf');
    }

/* -------------------------------------------------------------------------- */
/*                                  END DATA SISWA                            */
/* -------------------------------------------------------------------------- */


    // public function jurnalSiswa()
    // {
    //     // Logika untuk menampilkan jurnal siswa
    //     return view('pages-admin.jurnal-siswa');
    // }

    // public function jurnalDetail()
    // {
    //     // Logika untuk menampilkan jurnal siswa
    //     return view('pages-admin.jurnal-detail');
    // }

    public function nilaiSiswa()
    {

        return view('pages-admin.nilai-siswa');
    }

    public function rekapKehadiransiswa()
    {

        return view('pages-admin.rekap-kehadiransiswa');
    }

/* -------------------------------------------------------------------------- */
/*                                  START PROFILE                             */
/* -------------------------------------------------------------------------- */

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

/* -------------------------------------------------------------------------- */
/*                                  END PROFILE                               */
/* -------------------------------------------------------------------------- */


}
