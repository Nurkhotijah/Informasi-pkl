<?php

namespace App\Http\Controllers;

use App\Models\Kehadiran;
use App\Models\Penilaian;
use App\Models\laporan;
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
    
    public function index()
    {
        $kehadiran = Kehadiran::with('user')->whereHas('user.profile', function($query) {
            $query->where('id_sekolah', Auth::user()->sekolah->id);
        })->get();

        // Mengirim data ke tampilan
        return view('pages-admin.kehadiran-siswapkl', compact('kehadiran'));
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
        $penilaian = Penilaian::where("user_id", $id)->first();
        
        if (!$penilaian) {
            $siswa = User::whereHas('profile', function ($query) {
                $query->where('id_sekolah', Auth::user()->sekolah->id);
            })->get();
        
            return view('pages-admin.data-siswa', compact('siswa'))
                ->with('error', 'Data Penilaian tidak ditemukan.');
        }
    
        // Pastikan relasi user dan profile sudah dimuat
        $penilaian->load('user.profile');
    
        // Ambil tanggal dari tabel profile
        $tanggalMulai = $penilaian->user->profile->tanggal_mulai;
        $tanggalSelesai = $penilaian->user->profile->tanggal_selesai;
    
        // Kirim data sebagai array ke view PDF
        $pdf = Pdf::loadView('template-penilaian', [
            'penilaian' => $penilaian,
            'tanggalMulai' => $tanggalMulai,
            'tanggalSelesai' => $tanggalSelesai,
        ]);
    
        $pdf->setPaper('A4', 'portrait');
    
        // Gunakan properti user->name untuk nama file
        return $pdf->download('Laporan_Penilaian_PKL_' . $penilaian->user->name . '.pdf');
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
        return $pdf->download('rekap-kehadiran-' . $user->name . '.pdf');
    }

    public function cetakSertifikatSiswa($id)
    {
        $siswa = User::with('profile.sekolah.user.profile')->find($id);
        
        $pdf = Pdf::loadView('pages-admin.pdf.sertifikat', compact('siswa'));
        $pdf->setPaper('A4', 'Landscape');
        return $pdf->download($siswa->name . '-sertifikat.pdf');
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

    public function downloadLaporan($id)
    {
        // Cari laporan berdasarkan ID
        $laporan = Laporan::findOrFail($id);
    
        // Pastikan bahwa siswa (user) yang terkait dengan laporan ada
        $siswa = $laporan->user;  // Mengakses relasi user pada laporan
    
        // Cek jika siswa ada dan memiliki nama
        if (!$siswa) {
            return redirect()->back()->with('error', 'Siswa tidak ditemukan.');
        }
    
        // Path lengkap file di storage
        $filePath = storage_path('app/public/' . $laporan->file_path);
    
        // Cek apakah file ada
        if (file_exists($filePath)) {
            // Nama file yang akan didownload (menambahkan nama siswa ke nama file)
            $downloadFileName = $siswa->name . '-' . $laporan->file_name;
    
            // Download file dengan nama file sesuai nama siswa
            return response()->download($filePath, $downloadFileName);
        }
    
        // Jika file tidak ditemukan, kembali ke halaman sebelumnya dengan pesan error
        return redirect()->back()->with('error', 'File tidak ditemukan.');
    }
    

/* -------------------------------------------------------------------------- */
/*                                  END DATA SISWA                            */
/* -------------------------------------------------------------------------- */

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
            'foto_profile' => 'nullable|image|mimes:jpeg,png,jpg|max:1000',
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
