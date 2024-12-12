<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Kehadiran;
use App\Models\Profile;
use Carbon\Carbon;

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

        // Update status tidak hadir jika dalam 24 jam tidak ada aktivitas
        $yesterday = Carbon::now()->subHours(24);
        Kehadiran::where('user_id', Auth::id())
            ->where('tanggal', '<=', $yesterday)
            ->whereNull('foto_masuk')
            ->whereNull('foto_keluar')
            ->whereNull('foto_izin')
            ->update(['status' => 'Tidak Hadir']);

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
        
            $user = Auth::user();
            $now = Carbon::now();
            $tanggal = $now->toDateString();
        
            // Cek apakah sudah absen hari ini
            $kehadiran = Kehadiran::where('user_id', $user->id)
                ->whereDate('tanggal', $tanggal)
                ->first();

            // Jika upload foto izin
            if ($request->hasFile('foto_izin')) {
                if (!$kehadiran) {
                    $kehadiran = new Kehadiran();
                    $kehadiran->user_id = $user->id;
                    $kehadiran->tanggal = $tanggal;
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
}    