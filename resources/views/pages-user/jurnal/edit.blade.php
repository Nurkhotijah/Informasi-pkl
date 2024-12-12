@extends('components.layout-user')

@section('title', 'Edit Jurnal Kegiatan')

@section('content')

<div class="max-w-7xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-6">Edit Jurnal Kegiatan</h1>
    @if ($errors->any())
    <div class="bg-red-500 text-white p-4 mb-4">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{ route('jurnal-siswa.update', $jurnal->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- Menambahkan metode PUT untuk pembaruan -->
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
            <div class="flex flex-col">
                <label for="kegiatan" class="block text-gray-700 font-semibold mb-2">Deskripsi Kegiatan</label>
                <textarea id="kegiatan" name="kegiatan" class="w-full p-3 border border-gray-300 rounded-md" placeholder="Masukkan deskripsi kegiatan">{{ old('kegiatan', $jurnal->kegiatan) }}</textarea>
            </div>
    
            <div class="flex flex-col">
                <label for="tanggal" class="block text-gray-700 font-semibold mb-2">Tanggal Laporan</label>
                <div class="relative">
                    <input type="date" id="tanggal" name="tanggal" value="{{ old('tanggal', \Carbon\Carbon::parse($jurnal->tanggal)->format('Y-m-d')) }}" class="w-full p-3 border border-gray-300 rounded-md" placeholder="dd/mm/yyyy">
                </div>
            </div>
    
            <div class="flex flex-col">
                <label for="waktu_mulai" class="block text-gray-700 font-semibold mb-2">Jam Mulai</label>
                <div class="relative">
                    <input type="time" id="waktu_mulai" name="waktu_mulai" value="{{ old('waktu_mulai', \Carbon\Carbon::parse($jurnal->waktu_mulai)->format('H:i')) }}" class="w-full p-3 border border-gray-300 rounded-md" placeholder="--:--">
                </div>
            </div>
            
            <div class="flex flex-col">
                <label for="waktu_selesai" class="block text-gray-700 font-semibold mb-2">Jam Selesai</label>
                <div class="relative">
                    <input type="time" id="waktu_selesai" name="waktu_selesai" value="{{ old('waktu_selesai', \Carbon\Carbon::parse($jurnal->waktu_selesai)->format('H:i')) }}" class="w-full p-3 border border-gray-300 rounded-md" placeholder="--:--">
                </div>
            </div>
    
            <div class="flex flex-col">
                <label for="foto_kegiatan" class="block text-gray-700 font-semibold mb-2">Foto Bukti Kegiatan</label>
                <input type="file" id="foto_kegiatan" name="foto_kegiatan" class="w-full p-3 border border-gray-300 rounded-md">
                @if($jurnal->foto_kegiatan)
                    <img src="{{ asset('storage/'.$jurnal->foto_kegiatan) }}" alt="Foto Kegiatan" class="mt-2 w-32 h-32 object-cover rounded-md">
                @endif
            </div>
        </div>
    
        <div class="text-center">
            <button type="submit" class="bg-blue-500 text-white font-semibold py-3 px-6 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                Perbarui Jurnal Kegiatan
            </button>
        </div>
    </form>    
</div>

@endsection