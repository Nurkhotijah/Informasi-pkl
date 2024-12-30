<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\Pkl;
use App\Models\Profile;
use App\Models\Sekolah;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\SekolahAcceptedMail;
use Illuminate\Support\Facades\Log;


class SekolahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listSekolah = User::where('role', 'sekolah')->get();

        return view('pages-industri.sekolah.index', compact('listSekolah'));
    }

    public function updateStatusSekolah(Request $request, $id)
    {
        try {
            // Temukan data sekolah berdasarkan ID
            $sekolah = Sekolah::findOrFail($id); // Ambil satu data Sekolah.

            // Update status sekolah menjadi "diterima"
            $sekolah->status = 'diterima';
            $sekolah->save();

            // Kirimkan email pemberitahuan ke sekolah
            Mail::to($sekolah->user->email)->send(new SekolahAcceptedMail($sekolah));

            // Set pesan sukses menggunakan session
        } catch (\Exception $e) {
            Log::error('Gagal mengirim email: ' . $e->getMessage());

            // Set pesan error menggunakan session
            $request->session()->flash('error', 'Gagal memperbarui status sekolah.');
        }

        // Redirect kembali ke halaman index
        return redirect()->route('sekolah.index');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function showpkl(string $id)
    {
        $listSekolah = Pkl::where('id_sekolah', $id)->get();
        return view('pages-industri.sekolah.show', compact('listSekolah'));
    }

    /**
     * Display the specified resource.
     */
    public function detailSiswa(string $id)
    {
        $listSiswa = Pengajuan::where('id_pkl', $id)->get();

        return view('pages-industri.sekolah.detail-siswa', compact('listSiswa'));
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
        try {
            $sekolah = Sekolah::find($id);

            Pkl::where('id_sekolah', $id)->delete();
            Pengajuan::where('id_sekolah', $id)->delete();
            User::whereHas('profile', function ($q) use ($id) {
                $q->where('id_sekolah', $id);
            })->delete();
            User::where('id', $sekolah->user_id)->delete();
            Profile::where('user_id', $sekolah->user_id)->delete();
            Profile::where('id_sekolah', $id)->delete();
            $sekolah->delete();

            return response()->json(['message' => 'Data sekolah berhasil dihapus.'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal menghapus data sekolah.', 'error' => $e->getMessage()], 500);
        }
    }

    public function updateStatusSiswa(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required',
            'status' => 'required',
        ]);

        $id = $validated['id'];
        $status = $validated['status'];

        $pengajuanSiswa = Pengajuan::where('id', $id)->first();

        Pengajuan::where('id', $id)->update(['status_persetujuan' => $status]);

        $user = User::create([
            'name' => $pengajuanSiswa->nama,
            'email' => preg_replace('/\s+/', '-', $pengajuanSiswa->nama) . '@gmail.com',
            'password' => Hash::make('siswa123'),
            'role' => 'siswa',
        ]);

        Profile::create([
            'user_id' => $user->id,
            'id_sekolah' => $pengajuanSiswa->id_sekolah,
            'alamat' => null,
            'jurusan' => $pengajuanSiswa->jurusan,
            'tanggal_mulai' => $pengajuanSiswa->tanggal_mulai,
            'tanggal_selesai' => $pengajuanSiswa->tanggal_selesai,
            'cv_file' => $pengajuanSiswa->cv_file,
        ]);

        // Kembalikan response sukses
        return response()->json([
            'success' => 200,
            'message' => "Status siswa telah diperbarui menjadi {$status}.",
        ]);
    }
}
