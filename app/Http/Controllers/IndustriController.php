<?php

namespace App\Http\Controllers;

use App\Models\Jurnal;
use App\Models\Pengajuan;
use App\Models\Kehadiran;
use App\Models\Penilaian;
use App\Models\Profile;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class IndustriController extends Controller
{
    public function dashboard()
    {
        return view('pages-industri.dashboard-industri');
    }

/* -------------------------------------------------------------------------- */
/*                                  START KEHADIRAN                           */
/* -------------------------------------------------------------------------- */

    public function Kehadiran()
    {
        // Ambil data kehadiran dari database
        $kehadiran = Kehadiran::all(); // Sesuaikan dengan query yang sesuai dengan kebutuhan
        return view('pages-industri.kelola-kehadiran', compact('kehadiran'));
    }
    public function edit($id)
    {
        $item = Kehadiran::with('user')->find($id);
        $item = Kehadiran::findOrFail($id);
        return view('pages-industri.edit-kehadiran', compact('item'));
    }


    public function update(Request $request, $id)
{
    // Update status kehadiran berdasarkan ID
    $kehadiran = Kehadiran::findOrFail($id);
    
    // Validasi status, jika diperlukan
    $kehadiran->status = $request->status;
    $kehadiran->save();

    return redirect()->route('pages-industri.kelola-kehadiran')->with('success', 'Status kehadiran berhasil diperbarui');
}


    public function detail($id)
    {
        $kehadiran = Kehadiran::where('user_id', $id)
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('pages-industri.detail-kehadiran', compact('kehadiran'));
    }


/* -------------------------------------------------------------------------- */
/*                                  END KEHADIRAN                             */
/* -------------------------------------------------------------------------- */

/* -------------------------------------------------------------------------- */
/*                                  START PENGAJUAN                           */
/* -------------------------------------------------------------------------- */
    public function dataSekolah()
    {
        $listSekolah = User::where('role', 'sekolah')->get();
        return view('pages-industri.data-sekolah', compact('listSekolah'));
    }

    public function lihatSiswa($id)
    {
        $listSiswa = Pengajuan::where('id_sekolah', $id)->get();
        return view('pages-industri.lihat-siswa', compact('listSiswa'));
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

        Pengajuan::where('id', $id)->update(['status' => $status]);

        User::create([
            'name' => $pengajuanSiswa->nama_siswa,
            'email' => preg_replace('/\s+/', '-', $pengajuanSiswa->nama_siswa) . '@gmail.com',
            'alamat' => null,
            'password' => Hash::make('siswa123'),
            'role' => 'siswa',
        ]);

        return response()->json([
            'success' => 200,
            'message' => "Status siswa telah diperbarui menjadi {$status}.",
        ]);
    }

    protected function createSiswaAccount(Pengajuan $pengajuanSiswa)
    {
        User::create([
            'name' => $pengajuanSiswa->nama_siswa,
            'email' => $pengajuanSiswa->nama_siswa . '@gmail.com',
            'password' => bcrypt('siswa123'),
            'role' => 'siswa',
            'id_sekolah' => $pengajuanSiswa->id_sekolah,
        ]);
    }

/* -------------------------------------------------------------------------- */
/*                                  END PENGAJUAN                             */
/* -------------------------------------------------------------------------- */

/* -------------------------------------------------------------------------- */
/*                                  START JURNAL                              */
/* -------------------------------------------------------------------------- */
    public function index()
    {
        $jurnal = User::whereHas('profile', function ($query) {
                $query->where('id_sekolah', '!=', null);
            })
            ->where('role', 'siswa')
            ->with('laporan')
            ->get();

        return view('pages-industri.jurnal.index', compact('jurnal'));
    }

/* -------------------------------------------------------------------------- */
/*                                  END JURNAL                                */
/* -------------------------------------------------------------------------- */

/* -------------------------------------------------------------------------- */
/*                                  START PENILAIAN                           */
/* -------------------------------------------------------------------------- */
    public function indexpenilaian()
    {
        $penilaian = Penilaian::with('siswa', 'sekolah')->paginate(10);
        return view('pages-industri.penilaian.index', compact('penilaian'));
    }

    public function create()
    {
        $siswa = User::where('role', 'siswa')->get();
        $sekolah = Profile::with('sekolah')->get();
        return view('pages-industri.penilaian.create', compact('siswa', 'sekolah'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'sikap' => 'required|string',
            'microteaching' => 'required|string', 
            'kehadiran' => 'required|string',
            'project' => 'required|string',
        ]);

        Penilaian::create($validated);

        return redirect()->route('penilaian.index')
            ->with('success', 'Penilaian berhasil disimpan!');
    }

    public function show($id)
    {
        $penilaian = Penilaian::with(relations: 'user')->findOrFail($id);
        return view('pages-industri.penilaian.show', compact('penilaian'));
    }

    public function destroy($id)
{
    // Cari data penilaian berdasarkan ID
    $penilaian = Penilaian::findOrFail($id);

    // Hapus data penilaian
    $penilaian->delete();

    // Redirect kembali ke halaman index dengan pesan sukses
    return redirect()->route('penilaian.index')
        ->with('success', 'Penilaian berhasil dihapus!');
}


    public function cetakPdf($id)
    {
        $penilaian = Penilaian::with(['user', 'sekolah'])->findOrFail($id);
        $pdf = Pdf::loadView('template-penilaian', compact('penilaian'));
        $pdf->setPaper('A4', 'portrait');
        return $pdf->download('Laporan_Penilaian_PKL.pdf');
    }

/* -------------------------------------------------------------------------- */
/*                                  END PENILAIAN                             */
/* -------------------------------------------------------------------------- */

/* -------------------------------------------------------------------------- */
/*                                  START PROFILE                             */
/* -------------------------------------------------------------------------- */
    public function showProfile()
    {
        $user = Auth::user();
        return view('pages-industri.profile-industri', compact('user'));
    }

    public function editProfile()
    {
        $user = Auth::user();
        return view('pages-industri.update-industri', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'foto_profile' => 'nullable|image|max:2048',
        ]);

        $user = Auth::user();

        $user->name = $request->input('name');
        $user->alamat = $request->input('alamat');
        $user->email = $request->input('email');

        if ($request->hasFile('foto_profile')) {
            if ($user->foto_profile) {
                Storage::delete('public/' . $user->foto_profile);
            }

            $path = $request->file('foto_profile')->store('profile_pictures', 'public');
            $user->foto_profile = $path;
        }

        $user->save();

        return redirect()->route('profile-industri')
            ->with('success', 'Profil berhasil diperbarui.');

    }
/* -------------------------------------------------------------------------- */
/*                                  END PROFILE                               */
/* -------------------------------------------------------------------------- */
}
