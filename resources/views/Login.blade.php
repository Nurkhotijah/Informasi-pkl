<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Aplikasi Absensi PKL</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #c7d9f2; 
        }
    </style>
</head>
<body class="bg-blue-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-sm">
        <h2 class="text-2xl font-bold mb-6 text-center">Masuk</h2>

        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action={{ route('login') }}>
            <!-- CSRF Token -->
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-gray-700 mb-2" for="email">Email</label>
                <input type="email" id="email" name="email" required class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" type="email" id="email" placeholder="you@gmail.com">
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700 mb-2" for="password">Kata Sandi</label>
                <input type="password" id="password" name="password" required class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" type="password" id="password" placeholder="Masukkan Kata Sandi">
            </div>
            <div class="flex items-center justify-between mb-6">
                <div>
                    <input type="checkbox" id="remember_me" name="remember" class="mr-2">
                    <label for="remember" class="text-gray-700">Ingat Saya</label>
                </div>
                <a href="/forgot-password" class="text-blue-500">Lupa Kata Sandi?</a>
            </div>
            <button class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Masuk</button>
        </form>
        <p class="mt-6 text-center text-gray-700">Belum punya akun? <a href="{{ route('register') }}" class="text-blue-500">Daftar sekarang</a></p>
    </div>
</body>
</html>