@extends('components.layout-admin')

@section('title', 'Profile Admin')

@section('content')

<body class="bg-gray-100 flex items-center justify-center h-screen">
    <main class="w-full p-4 flex-1">
        <div class="max-w-6xl mx-auto mt-10 bg-white rounded-lg shadow-md relative"> 
            <div class="flex flex-col md:flex-row items-center md:items-start py-8 px-8">
                <!-- Foto Profil di Pojok Kiri -->
                <div class="flex-shrink-0 mb-4 md:mb-0 md:w-1/3 text-center relative">
                    <img id="profilePic" class="w-auto h-20 mx-auto" src="{{ $profilesekolah->foto_profile ? asset('storage/' . $profilesekolah->foto_profile) : asset('assets/default-profile.png') }}" alt="Profile Picture">
                    <input type="file" id="fileInput" class="hidden" onchange="changePhoto()">
                    <div class="mt-4">
                        <h2 class="text-2xl font-semibold text-gray-800">{{ $profilesekolah->name }}</h2>
                        <p class="text-gray-600">{{ $profilesekolah->role }}</p>
                    </div>
                </div>                              
                
                <!-- Data Industri di Sebelah Kanan -->
                <div class="w-full md:w-2/3 text-center md:text-left md:pl-8">
                    <div class="max-w-2xl mx-auto border border-gray-300 rounded-lg mb-6">
                        <h3 class="bg-blue-500 text-white p-3 font-semibold text-center rounded-t-lg">Informasi Sekolah</h3>
                        <div class="p-3 text-left space-y-2">
                            <p class="font-sans text-base"><span class="font-medium">Nama Sekolah:</span> {{ $profilesekolah->name }}</p>
                            <p class="font-sans text-base"><span class="font-medium">Email:</span> {{ $profilesekolah->email }}</p>
                            <p class="font-sans text-base"><span class="font-medium">Alamat:</span>  {{ $profilesekolah->alamat }}</p>                            
                        </div>
                    </div>                    
                    <!-- Tombol Edit di bawah Info Sekolah -->
                    <div class="flex justify-end mt-4">
                        <button class="bg-yellow-400 text-white text-base px-4 py-2 rounded-lg shadow-lg hover:bg-yellow-500 transition duration-300 ease-in-out flex items-center transform hover:scale-105">
                            <a href="{{ route('profile.edit') }}" class="flex items-center">
                                <i class="fas fa-edit mr-2"></i>
                                Edit
                            </a>                            
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>

</body>
@endsection