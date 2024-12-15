<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Aplikasi Absensi PKL</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #c7d9f2; /* bg-blue-50 */
        }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen">

    <div class="w-full max-w-lg p-6 bg-white rounded-xl shadow-xl border border-gray-200">
        <h2 class="text-2xl font-semibold mb-6 text-center text-gray-800">Daftar</h2>
        @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            <!-- CSRF Token -->
            @csrf

            <!-- Nama Sekolah/Username dan Email (dalam 1 baris) -->
            <div class="grid grid-cols-1 gap-4">
    <div>
        <label for="username" class="block text-sm font-medium text-gray-600 mb-1">Nama Sekolah</label>
        <input type="text" id="name" name="name" required
            class="w-full px-3 py-2 rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition duration-300"
            placeholder="Masukkan Nama Sekolah">
    </div>
    <div>
        <label for="email" class="block text-sm font-medium text-gray-600 mb-1">Email</label>
        <input type="email" id="email" name="email" required
            class="w-full px-3 py-2 rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition duration-300"
            placeholder="you@gmail.com">
    </div>
</div>

<!-- Alamat dan Password (dalam 1 baris) -->
<div class="grid grid-cols-1 gap-4">
    <div>
        <label for="alamat" class="block text-sm font-medium text-gray-600 mb-1">Alamat</label>
        <input type="text" id="alamat" name="alamat" required
            class="w-full px-3 py-2 rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition duration-300"
            placeholder="Masukkan Alamat Lengkap">
    </div>
    <div>
        <label for="password" class="block text-sm font-medium text-gray-600 mb-1">Kata Sandi</label>
        <input type="password" id="password" name="password" required
            class="w-full px-3 py-2 rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition duration-300"
            placeholder="Masukkan Kata Sandi">
    </div>
</div>

            

            <!-- Persetujuan Kebijakan -->
            <div class="mb-4 flex items-center">
                <input type="checkbox" id="agreement" name="agreement" class="h-4 w-4 text-blue-500 border-gray-300 rounded" required>
                <label for="agreement" class="ml-2 text-sm text-gray-600">Saya setuju dengan <a href="#" class="text-blue-500 hover:text-blue-600 transition duration-300">kebijakan privasi</a> dan ketentuan penggunaan.</label>
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="w-full py-2 bg-blue-500 text-white rounded-lg shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 transition duration-300 font-semibold">Daftar</button>
        </form>

        <!-- Login Link -->
        <p class="mt-4 text-center text-gray-600">
            Sudah punya akun? <a href="/login" class="text-blue-500 font-semibold hover:text-blue-600 transition duration-300">Masuk disini</a>
        </p>
    </div>

</body>

</html>