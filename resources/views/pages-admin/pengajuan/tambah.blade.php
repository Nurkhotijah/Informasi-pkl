@extends('components.layout-admin')

@section('title', 'Tambah Pengajuan Siswa')

@section('content')
<div class="bg-gray-100 h-screen flex items-center justify-center">
    <!-- Tambahkan margin atas untuk menaikkan kotak -->
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-4xl">
        <h2 class="text-2xl font-bold mb-6 text-center">Tambah Data Pengajuan</h2>
        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="">
            <main class="p-6 overflow-y-auto h-full">
                    <form action="{{ route('pengajuan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="tahun" class="block text-sm font-medium text-gray-700">Tahun</label>
                            <input type="text" name="tahun" id="tahun" class="w-full p-2 border rounded" required>
                        </div>
                        <div class="mb-4">
                            <label for="pembimbing" class="block text-sm font-medium text-gray-700">Nama Pembimbing</label>
                            <input type="text" name="pembimbing" id="pembimbing" class="w-full p-2 border rounded" required>
                        </div>
                        <div class="mb-4">
                            <label for="lampiran" class="block text-sm font-medium text-gray-700">Lampiran (PDF)</label>
                            <input type="file" name="lampiran" id="lampiran" accept=".pdf" class="w-full p-2 border rounded" required>
                        </div>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Simpan</button>
                    </form>
                </div>
            </main>
        </div>

@endsection
