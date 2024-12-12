<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class CertificateController extends Controller
{
    public function download()
    {
        $user = Auth::user();
        $certificatePath = public_path('certificates/' . $user->certificate_filename); // Gantilah sesuai penyimpanan file sertifikat
        return response()->download($certificatePath, 'Sertifikat_PKL_' . $user->name . '.pdf');
    }
}
