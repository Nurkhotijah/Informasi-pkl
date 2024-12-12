<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PengajuanController extends Controller
{
    public function index()
    {
        $users = Auth::user();
        $pengajuan = Pengajuan::where('id_sekolah', $users->sekolah->id)->get();

        return view('pages-admin.pengajuan.index', compact('pengajuan'));
    }

    public function create() // Untuk menampilkan form pengajuan siswa
    {
        return view('pages-admin.pengajuan.create'); // Pastikan view yang dimaksud sesuai
    }

    public function store(Request $request) // Untuk menyimpan pengajuan siswa baru
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'cv' => 'required|mimes:pdf',
        ]);

        $users = Auth::user(); // Mendapatkan data pengguna yang login

        // Menyimpan file CV ke direktori public
        $filePath = $request->file('cv')->store('cv_siswa', 'public');

        // Menyimpan pengajuan siswa ke dalam database
        Pengajuan::create([
            'nama' => $request->nama,
            'jurusan' => $request->jurusan,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'cv_file' => $filePath,
            'status_persetujuan' => 'pending',
            'id_sekolah' => $users->sekolah->id, // ID Sekolah yang login
        ]);

        return redirect('/pengajuan')->with('success', 'Pengajuan siswa berhasil diajukan.');
    }

    public function destroy($id)
    {
        // Cari pengajuan siswa berdasarkan ID
        $pengajuan = Pengajuan::find($id);

        // Periksa apakah data pengajuan ditemukan
        if (!$pengajuan) {
            return response()->json([
                'status' => 'error',
                'message' => 'Pengajuan siswa tidak ditemukan'
            ], 404);
        }

        // Hapus file CV jika ada
        if ($pengajuan->cv_file && Storage::exists('public/' . $pengajuan->cv_file)) {
            Storage::delete('public/' . $pengajuan->cv_file);
        }

        // Hapus data pengajuan siswa dari database
        $pengajuan->delete();

        // Kembali ke halaman yang sama dengan pesan sukses
        return redirect()->back()->with('success', 'Pengajuan siswa berhasil dihapus.');
    }

    // Method untuk mengupdate status pengajuan siswa yang dipilih

}
