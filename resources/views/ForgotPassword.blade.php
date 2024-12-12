<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Kata Sandi - Aplikasi Absensi PKL</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-lg border border-gray-200">
        <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Lupa Kata Sandi</h2>

        @if (session('status'))
            <div class="mb-4 text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        @error('email')
            <div class="mb-4 text-sm text-red-600">
                {{ $message }}
            </div>
        @enderror

        <form action="{{ route('password.email') }}" method="POST">
            @csrf

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Alamat Email</label>
                <input type="email" id="email" name="email" required
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-200 focus:border-blue-200 sm:text-sm">
            </div>

            <!-- Tombol Kirim Link Reset -->
            <button type="submit"
                class="w-full bg-blue-400 text-white py-2 px-4 rounded-lg font-semibold shadow-md hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200 transition ease-in-out duration-200">Kirim Link Reset</button>
        </form>

        <p class="mt-6 text-center text-sm text-gray-600">
            Kembali ke <a href="/login" class="text-blue-400 font-semibold hover:text-blue-500 transition duration-200">halaman login</a>.
        </p>
    </div>

</body>

</html>
