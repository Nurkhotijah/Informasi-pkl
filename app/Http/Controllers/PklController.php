<?php

namespace App\Http\Controllers;

use App\Models\Pkl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PklController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = Auth::user();
        
        // Ambil query pencarian dari input
        $search = $request->input('search');
    
        // Ambil data pengajuan berdasarkan id_sekolah dan filter berdasarkan pencarian
        $pengajuan = Pkl::where('id_sekolah', $users->sekolah->id)
                        ->where(function ($query) use ($search) {
                            $query->where('tahun', 'like', "%$search%")
                                  ->orWhere('judul_pkl', 'like', "%$search%")
                                  ->orWhere('pembimbing', 'like', "%$search%");
                        })
                        ->get();
    
        return view('pages-admin.pkl.index', compact('pengajuan'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
    
        // Periksa status sekolah
        if ($user->sekolah->status !== 'diterima') {
            return redirect('/pkl')->with('error', 'Sekolah Anda belum disetujui oleh industri.');
        }
    
        return view('pages-admin.pkl.create');
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
    
        // Periksa status sekolah
        if ($user->sekolah->status !== 'diterima') {
            return redirect('/pkl')->with('error', 'Sekolah Anda belum disetujui oleh industri.');
        }
    
        $request->validate([
            'judul' => 'required|string|max:255',
            'tahun' => 'required|string|max:255',
            'pembimbing' => 'required|string|max:255',
            'lampiran' => 'required|mimes:pdf',
        ]);
    
        // Simpan file lampiran
        $filePath = $request->file('lampiran')->store('pengajuan-pkl', 'public');
    
        // Simpan data pengajuan ke database
        Pkl::create([
            'judul_pkl' => $request->judul,
            'tahun' => $request->tahun,
            'pembimbing' => $request->pembimbing,
            'lampiran' => $filePath,
            'id_sekolah' => $user->sekolah->id,
        ]);
    
        return redirect('/pkl')->with('success', 'Pengajuan siswa berhasil diajukan.');
    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
