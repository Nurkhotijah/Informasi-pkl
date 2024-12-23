@extends('components.layout-user')

@section('title', 'Profile Siswa')

@section('content')
<!-- Main Content -->
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <main class="w-full p-4 flex-1">
        <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden mt-10 flex">
            <!-- Foto Profil dan Nama Siswa -->
            <div class="w-1/3 bg-gray-100 flex flex-col items-center justify-center p-6">
                <img 
                  class="w-40 h-40 rounded-full object-cover border-4 border-white shadow-md" 
                  src="{{ asset(Auth::user()->foto_profile ?? 'assets/default-profile.png') }}" 
                  alt="Foto Profil Siswa">
                <p class="mt-4 text-lg font-semibold text-gray-700">{{ $profilesiswa->role }}</p> <!-- Teks Siswa -->
            </div>
            <!-- Informasi Siswa -->
            <div class="w-2/3 p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Profil Siswa</h2>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Nama Sekolah</label>
                        <p class="text-gray-700 font-semibold">{{ $profilesiswa->profile->sekolah->nama ?? 'Sekolah tidak ditemukan' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Jurusan</label>
                        <p class="text-gray-700 font-semibold">{{ $profilesiswa->profile->jurusan ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Tanggal Mulai PKL</label>
                        <p class="text-gray-700 font-semibold">{{ \Carbon\Carbon::parse($profilesiswa->profile->tanggal_mulai)->format('d M Y') ?? 'Tanggal tidak ditemukan' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Tanggal Selesai PKL</label>
                        <p class="text-gray-700 font-semibold">{{ \Carbon\Carbon::parse($profilesiswa->profile->tanggal_selesai)->format('d M Y') ?? 'Tanggal tidak ditemukan' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
@endsection
