@extends('components.layout-admin')

@section('title', 'Tambah Pengajuan Siswa')

@section('content')
<div class="bg-gray-100  flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-4xl">
        <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Tambah Siswa</h2>
        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 mb-4 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <main class="p-6">
            <form action="{{ route('pengajuan.store', $id_pkl) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="nama" class="block text-sm font-medium text-gray-700">Nama Siswa</label>
                    <input type="text" name="nama" id="nama" class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="mb-4">
                    <label for="jurusan" class="block text-sm font-medium text-gray-700">Jurusan</label>
                    <input type="text" name="jurusan" id="jurusan" class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="mb-4">
                    <label for="tanggal_mulai" class="block text-sm font-medium text-gray-700">Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="mb-4">
                    <label for="tanggal_selesai" class="block text-sm font-medium text-gray-700">Tanggal Selesai</label>
                    <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div class="mb-4">
                    <label for="cv" class="block text-sm font-medium text-gray-700">CV</label>
                    <input type="file" name="cv" id="cv" accept=".pdf" class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <p class="text-xs text-gray-500">Harap unggah file dalam format PDF.</p>
                </div>
                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600 transition duration-300">Simpan</button>
            </form>
        </main>
    </div>
</div>
@endsection
