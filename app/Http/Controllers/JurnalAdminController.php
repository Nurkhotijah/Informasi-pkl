<?php

namespace App\Http\Controllers;

use App\Models\Jurnal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JurnalAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $userId = Auth::user()->id;
        $search = $request->input('search');

        $query = User::whereHas('profile', function ($query) use ($userId) {
            $query->whereHas('sekolah', function ($subQuery) use ($userId) {
                $subQuery->where('user_id', $userId);
            });
        });

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        $siswa = $query->paginate(10);

        return view('pages-admin.jurnal.index', compact('siswa'));
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
        $jurnal = Jurnal::where('user_id', $id)->get();

        return view('pages-admin.jurnal.detail', compact('jurnal'));
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
