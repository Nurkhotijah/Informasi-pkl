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

<body class="flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md p-8 bg-white rounded-2xl shadow-xl border border-gray-200">
        <h2 class="text-3xl font-semibold mb-8 text-center text-gray-800">Masuk</h2>
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

            <!-- Email -->
            <div class="mb-6">
                <label for="email" class="block text-sm font-medium text-gray-600 mb-2">Alamat Email</label>
                <input type="email" id="email" name="email" required
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition duration-300"
                    placeholder="you@gmail.com">
            </div>

            <!-- Password -->
            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-600 mb-2">Kata Sandi</label>
                <input type="password" id="password" name="password" required
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 transition duration-300"
                    placeholder="Masukkan kata sandi">
            </div>

            <!-- Remember Me -->
            <div class="mb-6 flex items-center justify-between">
                <label for="remember_me" class="flex items-center text-gray-600">
                    <input type="checkbox" id="remember_me" name="remember" class="h-4 w-4 text-blue-500 border-gray-300 rounded">
                    <span class="ml-2 text-sm">Ingat Saya</span>
                </label>
                <a href="/forgot-password" class="text-sm text-blue-500 hover:text-blue-600 transition duration-300">Lupa Kata Sandi?</a>
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="w-full py-3 bg-blue-500 text-white rounded-lg shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 transition duration-300 font-semibold">Masuk</button>

        </form>

        <!-- Register Link -->
        <p class="mt-6 text-center text-gray-600">
            Belum punya akun? <a href="{{ route('register') }}" class="text-blue-500 font-semibold hover:text-blue-600 transition duration-300">Daftar sekarang</a>
        </p>
    </div>

</body>

</html>
