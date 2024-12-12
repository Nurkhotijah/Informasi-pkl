@extends('components.layout-industri')

@section('title', 'Lihat Rekap Kehadiran')

@section('content')

<main class="p-6 h-full">
    <div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-6 text-center">Rekap Kehadiran Siswa</h1>

        <div class=" p-6 max-w-4xl mx-auto grid grid-cols-1 sm:grid-cols-3 gap-4">
                       <!-- Nama Siswa -->
                       <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Siswa</label>
                        <p class="border rounded p-3 mt-1">Fitri Amaliah</p>
                    </div>
        
                    <!-- Nama Sekolah -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Sekolah</label>
                        <p class="border rounded p-3 mt-1">SMKN 1 Ciomas</p>
                    </div>
        
                    <!-- Program Keahlian -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Program Keahlian</label>
                        <p class="border rounded p-3 mt-1">Rekayasa Perangkat Lunak</p>
                    </div>
        
                    <!-- Nama Perusahaan -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Perusahaan</label>
                        <p class="border rounded p-3 mt-1">PT Teknologi Masa Depan</p>
                    </div>
        
                    <!-- Lama Praktik -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Lama Praktik</label>
                        <p class="border rounded p-3 mt-1">6 Bulan</p>
                    </div>
        
                    <!-- Total Hadir -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Total Hadir</label>
                        <p class="border rounded p-3 mt-1">120 Hari</p>
                    </div>
        
                    <!-- Total Tidak Hadir -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Total Tidak Hadir</label>
                        <p class="border rounded p-3 mt-1">5 Hari</p>
                    </div>
        
                    <!-- Total Izin -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Total Izin</label>
                        <p class="border rounded p-3 mt-1">2 Hari</p>
                    </div>
        
                    <!-- Tanda Tangan Pembimbing Sekolah -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">TTD Pembimbing Sekolah</label>
                        <div class="border rounded p-2 mt-1">
                            <input type="file" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-1 file:px-4 file:rounded-lg file:border file:border-gray-300 file:text-sm file:bg-gray-50 file:cursor-pointer hover:file:bg-gray-100" />
                        </div>
                    </div>
        
                    <!-- NIP Pembimbing Sekolah -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">NIP Pembimbing Sekolah</label>
                        <p class="border rounded p-3 mt-1">123456789</p>
                    </div>
        
                    <!-- Tanda Tangan Pembimbing IDUKA -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">TTD Pembimbing Industri</label>
                        <div class="border rounded p-2 mt-1">
                            <input type="file" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-1 file:px-4 file:rounded-lg file:border file:border-gray-300 file:text-sm file:bg-gray-50 file:cursor-pointer hover:file:bg-gray-100" />
                        </div>
                    </div>
        
                    <!-- NIP Pembimbing IDUKA -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">NIP Pembimbing IDUKA</label>
                        <p class="border rounded p-3 mt-1">987654321</p>
                    </div>
        </div>

        <div class="mt-6 flex justify-end">
            <a href="/kehadiran-siswa" class="bg-blue-400 text-white text-sm px-4 py-2 rounded shadow hover:bg-blue-500 transition duration-300 ease-in-out">
                Kembali ke Daftar Kehadiran
            </a>
        </div>
    </div>
</main>

@endsection
