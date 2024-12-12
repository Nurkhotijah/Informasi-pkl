@extends('components.layout-admin')

@section('title', 'Update Profile Sekolah')

@section('content')
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <main class="w-full p-4 flex-1">
        <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg p-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Update Profile Sekolah</h2>

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="text-center mb-6">
                    <img id="profilePic" class="w-24 h-24 mx-auto rounded-full cursor-pointer" 
                        src="{{ Auth::user()->foto_profile ? asset('storage/' . Auth::user()->foto_profile) : asset('assets/default-profile.png') }}" alt="Profile Picture" 
                        onclick="document.getElementById('fileInput').click();">
                    <input type="file" id="fileInput" name="foto_profile" class="hidden" onchange="changePhoto()">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama Sekolah</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $profile->name) }}" 
                            class="w-full border border-gray-300 focus:border-blue-500 focus:ring-blue-200 rounded-lg p-2 text-sm">
                    </div>

                    <div>
                        <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                        <textarea id="alamat" name="alamat" rows="3" 
                            class="w-full border border-gray-300 focus:border-blue-500 focus:ring-blue-200 rounded-lg p-2 text-sm">{{ old('alamat', $profile->sekolah->alamat ?? '') }}</textarea>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $profile->email) }}" 
                            class="w-full border border-gray-300 focus:border-blue-500 focus:ring-blue-200 rounded-lg p-2 text-sm">
                    </div>
                </div>

                <div class="flex justify-end mt-6">
                    <button type="submit" 
                        class="bg-blue-500 text-white px-6 py-2 rounded-lg shadow-lg hover:bg-blue-600 transition">
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
