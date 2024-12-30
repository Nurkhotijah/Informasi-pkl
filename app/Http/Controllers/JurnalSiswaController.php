<?php

namespace App\Http\Controllers;

use App\Models\Jurnal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\JurnalKegiatan;

class JurnalSiswaController extends Controller
{
    public function index(Request $request)
    {
        $users = Auth::user();
        
        // Ambil data jurnal berdasarkan user_id
        $jurnal = Jurnal::where('user_id', $users->id);
    
        // Filter berdasarkan tanggal jika ada
        if ($request->has('tanggal') && $request->tanggal) {
            $jurnal = $jurnal->whereDate('tanggal', $request->tanggal);
        }
    
        // Ambil data jurnal dan kirim ke view
        $jurnal = $jurnal->get();
    
        // Kembalikan tampilan dengan data jurnal
        return view('pages-user.jurnal.index', compact('jurnal'));
    }
    
    public function edit($id)
    {
        $jurnal = Jurnal::findOrFail($id);
        $users = Auth::user();
        return view('pages-user.jurnal.edit', compact('jurnal'));
    }
    
    
    public function create()
    {
        return view('pages-user.jurnal.create');
    }

   // store method
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'kegiatan' => 'required|string|max:100',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
            'foto_kegiatan' => 'nullable|image|mimes:jpeg,png,jpg|max:5000',
        ]);

        // Mendapatkan data pengguna yang login
        $users = Auth::user();

        $fotoPath = $request->file('foto_kegiatan') ? $request->file('foto_kegiatan')->store('kegiatan', 'public') : null;

        // Menyimpan data jurnal kegiatan ke dalam database
        Jurnal::create([
            'kegiatan' => $request->kegiatan,
            'tanggal' => $request->tanggal,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'foto_kegiatan' => $fotoPath,
            'user_id' => $users->id,  // ID pengguna yang login (siswa)
        ]);

        // // Menghitung jumlah jurnal yang sudah dikirim oleh pengguna
        // $jumlahJurnal = Jurnal::where('user_id', $users->id)->count();

        // Redirect ke halaman jurnal kegiatan dengan pesan sukses dan jumlah jurnal yang baru
        return redirect()->route('jurnal-siswa.index')->with('success', 'Jurnal kegiatan berhasil ditambahkan!');
                                                    
    }


    public function show($id)
    {
        $jurnal = Jurnal::findOrFail($id);
        return view('pages-user.jurnal.index', compact('jurnal'));
    }

   
    public function update(Request $request, $id)
    {
        $request->validate([
            'kegiatan' => 'required|string|max:100',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
            'foto_kegiatan' => 'nullable|image|mimes:jpeg,png,jpg|max:5000',
        ]);

        $jurnal = Jurnal::findOrFail($id);

        

        if ($request->hasFile('foto_kegiatan')) {
            if ($jurnal->foto_kegiatan) {
                Storage::disk('public')->delete($jurnal->foto_kegiatan);
            }
            $jurnal->foto_kegiatan = $request->file('foto_kegiatan')->store('kegiatan', 'public');
        }

        $jurnal->update([
            'kegiatan' => $request->kegiatan,
            'tanggal' => $request->tanggal,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
        ]);

        return redirect()->route('jurnal-siswa.index')->with('success', 'Jurnal berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $jurnal = Jurnal::findOrFail($id);

        // Hapus file foto jika ada
        if ($jurnal->foto_kegiatan) {
            Storage::disk('public')->delete($jurnal->foto_kegiatan);
        }

        $jurnal->delete();

        return redirect()->route('jurnal-siswa.index')->with('success', 'Jurnal kegiatan berhasil dihapus!');
    }

    
}
