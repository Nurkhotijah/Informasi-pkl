@extends('components.layout-user')

@section('title', 'Profile Siswa')

@section('content')
<body class="bg-gray-100 flex items-center justify-center h-screen">
  <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden flex flex-col md:flex-row w-full">
    <div class="bg-gray-100 flex items-center justify-center w-full md:w-1/3 p-6">
      <div class="text-center">
        <img alt="Profile picture of the student" class="rounded-full mx-auto mb-2" height="100" src="{{ asset(Auth::user()->foto_profile ?? 'assets/default-profile.png') }}" width="100"/>
        <p class="text-gray-700">{{ $profilesiswa->role }}</p>
      </div>
    </div>
    <div class="bg-white w-full md:w-2/3 p-6">
      <h2 class="text-xl font-bold mb-4">Profile Siswa</h2>
      <p class="mb-2">
        <span class="font-semibold">Nama Sekolah</span><br/>
        {{ $profilesiswa->profile->sekolah->nama }}
      </p>
      <p class="mb-2">
        <span class="font-semibold">Jurusan</span><br/>
        {{ $profilesiswa->profile->jurusan }}
      </p>
      <p class="mb-2">
        <span class="font-semibold">Tanggal Mulai PKL</span><br/>
        {{ \Carbon\Carbon::parse($profilesiswa->profile->tanggal_mulai)->format('d M Y') }}
      </p>
      <p class="mb-2">
        <span class="font-semibold">Tanggal Selesai PKL</span><br/>
        {{ \Carbon\Carbon::parse($profilesiswa->profile->tanggal_selesai)->format('d M Y') }}
      </p>
    </div>
  </div>
</body>
@endsection