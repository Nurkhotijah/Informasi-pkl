@extends('components.layout-industri')

@section('title', 'Update Profile Industri')

@section('content')

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <main class="w-full p-4 flex-1">
        <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg p-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Update Profile Industri</h2>
            
            <form id="profileForm" class="space-y-6 max-w-full sm:max-w-lg mx-auto" method="POST" action="{{ route('update-industri.save') }}" enctype="multipart/form-data">
                @csrf
                <!-- Foto Profil -->
                <div class="text-center">
                    <div class="relative inline-block p-6 cursor-pointer" onclick="document.getElementById('fileInput').click()">
                        <img id="profilePic" class="w-24 h-24 sm:w-auto sm:h-12 mx-auto" 
                            src="{{ asset($user->foto_profile ? 'storage/' . $user->foto_profile : 'assets/default-profile.png') }}" alt="Profile Picture">
                        <input type="file" id="fileInput" name="foto_profile" class="hidden" onchange="changePhoto()">
                    </div>
                </div>
            
                <!-- Form Input -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label for="name" class="block font-medium text-gray-700 text-sm">Nama Perusahaan</label>
                        <input type="text" id="name" name="name" 
                            value="{{ old('name', $user->name) }}" 
                            class="w-full border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 rounded-lg p-2 text-sm shadow-sm transition">
                    </div>
            
                    <div class="space-y-2">
                        <label for="alamat" class="block font-medium text-gray-700 text-sm">Alamat</label>
                        <textarea id="alamat" name="alamat" rows="3" 
                            class="w-full border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 rounded-lg p-2 text-sm shadow-sm transition">{{ old('alamat', $user->alamat) }}</textarea>
                    </div>
            
                    <div class="space-y-2">
                        <label for="email" class="block font-medium text-gray-700 text-sm">Email</label>
                        <input type="email" id="email" name="email" 
                            value="{{ old('email', $user->email) }}" 
                            class="w-full border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 rounded-lg p-2 text-sm shadow-sm transition">
                    </div>
                </div>
            
                <!-- Tombol Simpan -->
                <div class="flex justify-end">
                    <button type="submit" 
                        class="bg-blue-500 text-white text-sm px-6 py-2 rounded-lg shadow-lg hover:bg-blue-600 transition duration-300 ease-in-out">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </main>

    <script>
        function changePhoto() {
            const fileInput = document.getElementById('fileInput');
            const reader = new FileReader();

            if (fileInput.files && fileInput.files[0]) {
                reader.onload = function (e) {
                    document.getElementById('profilePic').src = e.target.result;
                };
                reader.readAsDataURL(fileInput.files[0]);
            }
        }
    </script>
</body>

@endsection
