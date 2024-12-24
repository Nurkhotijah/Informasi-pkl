@extends('components.layout-user')

@section('title', 'Tambah Jurnal ')

@section('content')

<div class="max-w-7xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-6">Form Jurnal</h1>
    @if ($errors->any())
    <div class="bg-red-500 text-white p-4 mb-4">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <form action="{{ route('jurnal-siswa.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
            <div class="flex flex-col">
                <label for="deskripsi" class="block text-gray-700 font-semibold mb-2">Deskripsi Kegiatan</label>
                <textarea id="kegiatan" name="kegiatan" class="w-full p-3 border border-gray-300 rounded-md" placeholder="Masukkan deskripsi kegiatan"></textarea>
            </div>
    
            <div class="flex flex-col">
                <label for="tanggal" class="block text-gray-700 font-semibold mb-2">Tanggal Laporan</label>
                <div class="relative">
                    <input type="date" id="tanggal" name="tanggal" class="w-full p-3 border border-gray-300 rounded-md" placeholder="dd/mm/yyyy">
                </div>
            </div>
    
            <div class="flex flex-col">
                <label for="jam-mulai" class="block text-gray-700 font-semibold mb-2">Jam Mulai</label>
                <div class="relative">
                    <!-- Menggunakan input type="time" -->
                    <input type="time" id="waktu_mulai" name="waktu_mulai" class="w-full p-3 border border-gray-300 rounded-md" placeholder="--:--">
                </div>
            </div>
            
    
            <div class="flex flex-col">
                <label for="jam-selesai" class="block text-gray-700 font-semibold mb-2">Jam Selesai</label>
                <div class="relative">
                    <input type="time" id="waktu_selesai" name="waktu_selesai" class="w-full p-3 border border-gray-300 rounded-md" placeholder="--:--">
                </div>
            </div>
    
            <div class="flex flex-col">
                <label for="foto" class="block text-gray-700 font-semibold mb-2">Foto Bukti Kegiatan</label>
                <input type="file" id="foto_kegiatan" name="foto_kegiatan" class="w-full p-3 border border-gray-300 rounded-md">
            </div>
        </div>
    
        <div class="text-center">
            <button type="submit" class="bg-blue-500 text-white font-semibold py-3 px-6 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                Kirim Jurnal Kegiatan
            </button>
        </div>
    </form>    
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



@endsection