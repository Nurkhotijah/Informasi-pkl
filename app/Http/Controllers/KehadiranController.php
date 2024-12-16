<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Kehadiran;
use App\Models\Profile;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class KehadiranController extends Controller
{
    public function index(Request $request)
    {
        // Get search query and date filter
        $search = $request->input('search');
        $tanggal = $request->input('tanggal');

        // Mendapatkan data kehadiran berdasarkan user yang sedang login
        $kehadiran = Kehadiran::with('user')
            ->where('user_id', Auth::id());

        // Apply search filter if search query exists
        if ($search) {
            $kehadiran->whereHas('user', function($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            });
        }

        // Apply date filter if date is selected
        if ($tanggal) {
            $kehadiran->whereDate('tanggal', $tanggal);
        }

        // Menerapkan pagination dengan 10 data per halaman
        $kehadiran = $kehadiran->orderBy('tanggal', 'desc')->paginate(10);

        // Hitung jumlah kehadiran user
        $jumlahKehadiran = Kehadiran::where('user_id', Auth::id())
            ->where('status', 'Hadir')
            ->count();

        // Cek status absen hari ini untuk menentukan jenis button yang ditampilkan
        $today = Carbon::now()->toDateString();
        $absenHariIni = Kehadiran::where('user_id', Auth::id())
            ->whereDate('tanggal', $today)
            ->first();

        $jenisButton = 'masuk'; // Default button masuk

        if ($absenHariIni) {
            if ($absenHariIni->foto_masuk && !$absenHariIni->foto_keluar) {
                $jenisButton = 'pulang';
            } else if ($absenHariIni->foto_masuk && $absenHariIni->foto_keluar) {
                $jenisButton = 'selesai';
            }
        }

        // Tambahkan URL foto untuk setiap kehadiran
        foreach ($kehadiran as $absen) {
            $absen->foto_masuk_url = $absen->foto_masuk ? Storage::url($absen->foto_masuk) : null;
            $absen->foto_keluar_url = $absen->foto_keluar ? Storage::url($absen->foto_keluar) : null;
            $absen->foto_izin_url = $absen->foto_izin ? Storage::url($absen->foto_izin) : null;
        }

        return view('pages-user.riwayat-absensi', compact('kehadiran', 'jenisButton', 'jumlahKehadiran'));
    }

    public function store(Request $request)
    {
        try {
            $user = Auth::user();
            $now = Carbon::now();
            $tanggal = $now->toDateString();

            // Cek apakah sudah absen hari ini
            $kehadiran = Kehadiran::where('user_id', $user->id)
                ->whereDate('tanggal', $tanggal)
                ->first();

            // Cek jika user sudah absen masuk atau pulang
            if ($kehadiran && ($kehadiran->foto_masuk || $kehadiran->foto_keluar)) {
                return response()->json(['message' => 'Anda sudah absen masuk atau pulang, tidak bisa upload foto izin.'], 400);
            }

            // Cek jika user sudah upload foto izin
            if ($kehadiran && ($kehadiran->foto_izin)) {
                return response()->json(['message' => 'Anda sudah upload foto izin, tidak bisa absen masuk atau pulang.'], 400);
            }

            // Validasi request
            if ($request->hasFile('foto_izin')) {
                $request->validate([
                    'foto_izin' => 'required|file|image|max:2048'
                ]);
            } else {
                $request->validate([
                    'foto_absen' => 'required|file|image|max:2048',
                    'jenis_absen' => 'required|in:masuk,pulang'
                ]);
            }

            // Jika upload foto izin
            if ($request->hasFile('foto_izin')) {
                if (!$kehadiran) {
                    $kehadiran = new Kehadiran();
                    $kehadiran->user_id = $user->id;
                    $kehadiran->tanggal = $tanggal;
                } else {
                    return response()->json(['message' => 'Anda tidak bisa upload, karena sudah melakukan absen.'], 400);
                }
                
                $fotoPath = $request->file('foto_izin')->store('kehadiran/izin', 'public');
                $kehadiran->foto_izin = $fotoPath;
                $kehadiran->status = 'Izin';
                $kehadiran->save();

                return response()->json([
                    'message' => 'Foto izin berhasil diupload',
                    'status' => 'Izin'
                ]);
            }

            // Jika absen normal (masuk/pulang)
            if ($request->jenis_absen === 'masuk') {
                // Hapus pengecekan foto_masuk karena ini adalah absen masuk pertama
                if (!$kehadiran) {
                    $kehadiran = new Kehadiran();
                    $kehadiran->user_id = $user->id;
                    $kehadiran->tanggal = $tanggal;
                    $kehadiran->status = 'Hadir';
                }

                $fotoPath = $request->file('foto_absen')->store('kehadiran/masuk', 'public');
                $kehadiran->foto_masuk = $fotoPath;
                $kehadiran->waktu_masuk = $now->toTimeString();
            } else { // Jika absen pulang
                if (!$kehadiran || !$kehadiran->foto_masuk) {
                    return response()->json(['message' => 'Anda belum absen masuk hari ini.'], 400);
                }
                if ($kehadiran->foto_keluar) {
                    return response()->json(['message' => 'Anda sudah absen pulang hari ini.'], 400);
                }

                $fotoPath = $request->file('foto_absen')->store('kehadiran/keluar', 'public');
                $kehadiran->foto_keluar = $fotoPath;
                $kehadiran->waktu_keluar = $now->toTimeString();
            }
            
            $kehadiran->save();
        
            // Hitung jumlah kehadiran
            $jumlahKehadiran = Kehadiran::where('user_id', $user->id)
                ->where('status', 'Hadir')
                ->count();
        
            return response()->json([
                'message' => 'Data kehadiran berhasil disimpan',
                'jumlah_kehadiran' => $jumlahKehadiran,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function rekapkehadiran()
    {
        $user = auth()->user(); // Mendapatkan pengguna yang sedang login
        $kehadiran = Kehadiran::where('user_id', $user->id)->get(); // Ambil data kehadiran berdasarkan user_id

        // Ambil data tanggal mulai dan tanggal selesai PKL dari tabel profile sesuai user_id
        $profile = Profile::where('user_id', $user->id)->first(); // Ambil data profile sesuai user_id
        $tanggalMulai = $profile ? $profile->tanggal_mulai : null; // Mengambil tanggal mulai jika ada
        $tanggalSelesai = $profile ? $profile->tanggal_selesai : null; // Mengambil tanggal selesai jika ada

        // Hitung jumlah kehadiran, izin, dan tidak hadir
        $hadirCount = $kehadiran->where('status', 'Hadir')->count();
        $izinCount = $kehadiran->where('status', 'Izin')->count();
        $tidakHadirCount = $kehadiran->where('status', 'Tidak Hadir')->count();
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

    // Command to update attendance status daily
    public function updateDailyAttendance()
    {
        $users = User::all();
        $today = Carbon::now()->toDateString();

        foreach ($users as $user) {
            $kehadiran = Kehadiran::where('user_id', $user->id)
                ->whereDate('tanggal', $today)
                ->first();

            if (!$kehadiran) {
                $kehadiran = new Kehadiran();
                $kehadiran->user_id = $user->id;
                $kehadiran->tanggal = $today;
                $kehadiran->status = 'Tidak Hadir'; // Default status
                $kehadiran->save();
            }
        }
    }
}    