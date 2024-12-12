<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    // Menampilkan daftar siswa
    public function index()
    {
        $siswas = Siswa::all();
        return view('pages-admin.pengajuan-siswa', compact('siswas'));
    }

    public function tambah()
    {
        return view('pages-admin.pengajuan.tambah');
    }
    // Menampilkan form untuk menambah siswa
    public function create()
    {
        return view('pages-admin.tambah-siswa');
    }

    public function lihat()
    {
        // Ambil data siswa dari model Siswa
        $siswas = Siswa::all(); // Pastikan model Siswa sudah ada
    
        // Kirim data ke view menggunakan compact
        return view('pages-admin.pengajuan.lihat', compact('siswas'));
    }
    
    // Menyimpan data siswa baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'cv' => 'nullable|file|mimes:pdf,doc,docx',
        ]);

        $cvPath = null;
        if ($request->hasFile('cv')) {
            $cvPath = $request->file('cv')->store('cv');
        }

        Siswa::create([
            'nama' => $request->nama,
            'jurusan' => $request->jurusan,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'cv' => $cvPath,
            'status' => 'Pending',
        ]);

        // Mengarahkan ke halaman yang sesuai
        return redirect()->route('pages-admin.pengajuan-siswa')->with('success', 'Siswa berhasil ditambahkan.');
    }


    // Menghapus data siswa
    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->delete();

        return redirect()->route('pengajuan-siswa')->with('success', 'Siswa berhasil dihapus.');
    }
}
