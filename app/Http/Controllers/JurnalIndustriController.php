<?php

namespace App\Http\Controllers;

use App\Models\Jurnal;
use App\Models\User;
use Illuminate\Http\Request;

class JurnalIndustriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jurnal = User::whereHas('profile', function ($query) {
            $query->where('id_sekolah', '!=', null);
        })->where('role', 'siswa')->get();

        // Mengirim data jurnal ke tampilan
        return view('pages-industri.jurnal.index', compact('jurnal'));
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
    public function show(string $id)
    {
        $listdetail = Jurnal::where('user_id', $id)->paginate(2); // Added pagination

        // Mengirim data detail jurnal ke tampilan
        return view('pages-industri.jurnal.detail', compact('listdetail'));
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
