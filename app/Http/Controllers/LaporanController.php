<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf|max:5000', // Validasi file
        ]);

        // Simpan file ke storage
        $file = $request->file('file');
        $filePath = $file->store('laporan', 'public');

        // Simpan data ke database
        Laporan::create([
            'user_id' => Auth::id(), // Relasi ke user yang login
            'file_name' => $file->getClientOriginalName(),
            'file_path' => $filePath,
        ]);

        return redirect()->back()->with('success', 'Laporan berhasil diunggah.');
    }
}
