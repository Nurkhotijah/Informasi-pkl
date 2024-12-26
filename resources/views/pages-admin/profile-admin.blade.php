@extends('components.layout-admin')

@section('title', 'Profile Sekolah')

@section('content')
<body class="bg-gray-100 flex items-center justify-center h-screen">
  <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden flex flex-col md:flex-row w-full">
    <div class="bg-gray-100 flex items-center justify-center w-full md:w-1/3 p-6">
      <div class="text-center">
        <img alt="Profile picture of the student" class="rounded-full mx-auto mb-2" height="100" src="{{ $profilesekolah->foto_profile ? asset('storage/' . $profilesekolah->foto_profile) : asset('assets/default-profile.png') }}" width="100"/>
        <h2 class="text-2xl font-semibold text-gray-800">{{ $profilesekolah->name }}</h2>
        <p class="text-gray-700">{{ $profilesekolah->role }}</p>
      </div>
    </div>
    <div class="bg-white w-full md:w-2/3 p-6">
      <h2 class="text-xl font-bold mb-4">Profile Sekolah</h2>
      <p class="mb-2">
        <span class="font-semibold">Nama Sekolah</span><br/>
        {{ $profilesekolah->name }}
      </p>
      <p class="mb-2">
        <span class="font-semibold">Email</span><br/>
        {{ $profilesekolah->email }}
      </p>
      <p class="mb-2">
        <span class="font-semibold">Alamat</span><br/>
        {{ $profilesekolah->alamat }}
      </p>
      <a href="{{ route('profile.edit') }}" class=" px-6 py-2 bg-yellow-400 text-white text-sm rounded-lg shadow-lg hover:bg-yellow-500 transition duration-300 ease-in-out transform hover:scale-105">
        Edit
      </a>    
    </div>
  </div>
</body>
@endsection


