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
    
    // Menampilkan riwayat kehadiran
    public function index(Request $request)
    {
        // Ambil data kehadiran berdasarkan user yang login
        $kehadiran = Kehadiran::where('user_id', Auth::id())
            ->orderBy('tanggal', 'desc');

        // Filter berdasarkan tanggal
        if ($request->has('tanggal')) {
            $kehadiran = $kehadiran->whereDate('tanggal', $request->tanggal);
        }

        // Mengambil data kehadiran dengan paginasi
        $kehadiran = $kehadiran->paginate(2); // 2 entries per page

        return view('pages-user.riwayat-absensi', compact('kehadiran'));
    }

    public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'id'=> 'nullable',
        'foto_keluar' => 'nullable|image|mimes:jpeg,png,jpg|max:5000', 
        'foto_masuk' => 'nullable|image|mimes:jpeg,png,jpg|max:5000', 
        'foto_izin' => 'nullable|image|mimes:jpeg,png,jpg|max:5000', 
    ]);

    // Menyimpan foto masuk jika ada
    if ($request->hasFile('foto_masuk')) {
        $fotoMasuk = $request->file('foto_masuk')->store('kehadiran/masuk', 'public');
    } else {
        $fotoMasuk = null;
    }

    // Menyimpan foto izin jika ada
    if ($request->hasFile('foto_izin')) {
        $fotoIzin = $request->file('foto_izin')->store('kehadiran/izin', 'public');
    } else {
        $fotoIzin = null;
    }

    // Menentukan status kehadiran
    $status = $fotoIzin ? 'Izin' : 'Hadir';

    if ($request->id){
        // update data kehadiran
        Kehadiran::find($request->id)?->update([
            'waktu_keluar' => $status === 'Hadir' ? now()->toTimeString() : null, // Set waktu pulang hanya jika status 'Hadir'
            'foto_keluar' => $fotoMasuk,
        ]);
    } else {
        // Menyimpan data kehadiran
        Kehadiran::create([
            'user_id' => Auth::id(),
            'sekolah_id' => Auth::user()->profile->id_sekolah,
            'tanggal' => now(),
            'waktu_masuk' => $status === 'Hadir' ? now()->toTimeString() : null, // Set waktu masuk hanya jika status 'Hadir'
            'status' => $status,
            'foto_masuk' => $fotoMasuk,
            'foto_izin' => $fotoIzin,
        ]);
    }

    return response()->json(['message' => 'Kehadiran berhasil disimpan!']);
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
   
}    