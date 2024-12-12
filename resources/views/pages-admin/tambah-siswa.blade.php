@extends('components.layout-admin')

@section('title', 'Tambah Pengajuan Siswa')

@section('content')
<div class="bg-gray-100 h-screen flex items-center justify-center">
    <!-- Tambahkan margin atas untuk menaikkan kotak -->
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-4xl mt-[-130px]">
        <h2 class="text-2xl font-bold mb-6 text-center">Formulir Pengajuan PKL</h2>
        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="bg-gray-100">
            <main class="p-6 overflow-y-auto h-full">
                <div class="max-w-7xl mx-auto bg-white p-4 sm:p-6 rounded-lg shadow-md">
                    <h1 class="text-xl sm:text-2xl font-bold mb-4">Tambah Siswa</h1>
                    <form action="{{ route('pengajuan-siswa.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="nama" class="block text-sm font-medium text-gray-700">Nama Siswa</label>
                            <input type="text" name="nama" id="nama" class="w-full p-2 border rounded" required>
                        </div>
                        <div class="mb-4">
                            <label for="jurusan" class="block text-sm font-medium text-gray-700">Jurusan</label>
                            <input type="text" name="jurusan" id="jurusan" class="w-full p-2 border rounded" required>
                        </div>
                        <div class="mb-4">
                            <label for="tanggal_mulai" class="block text-sm font-medium text-gray-700">Tanggal Mulai</label>
                            <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="w-full p-2 border rounded" required>
                        </div>
                        <div class="mb-4">
                            <label for="tanggal_selesai" class="block text-sm font-medium text-gray-700">Tanggal Selesai</label>
                            <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="w-full p-2 border rounded" required>
                        </div>
                        <div class="mb-4">
                            <label for="cv" class="block text-sm font-medium text-gray-700">CV</label>
                            <input type="file" name="cv" id="cv" class="w-full p-2 border rounded">
                        </div>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
                    </form>
                </div>
            </main>
        </div>

@endsection

