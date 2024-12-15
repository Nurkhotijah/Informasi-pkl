<?php

namespace App\Http\Controllers;

use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class CertificateController extends Controller
{
    public function cetakSertifikat($id)
    {
        $siswa = User::with('profile.sekolah.user')->findOrFail($id);

        // Load view dan generate PDF
        $pdf = Pdf::loadView('pages-user.pdf.sertifikatuser', compact('siswa'));
        $pdf->setPaper('A4', 'landscape');

        // Return PDF untuk di-download
        return $pdf->download($siswa->name . '-sertifikat.pdf');
    }
}
