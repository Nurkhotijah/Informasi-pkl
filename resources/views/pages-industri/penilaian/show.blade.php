@extends('components.layout-industri')

@section('title', 'Laporan Penilaian PKL')

@section('content')

<body class="bg-white font-sans">
    <div class="max-w-3xl mx-auto my-8 p-6 bg-white rounded-lg shadow-lg relative">
        <!-- Logo -->
        {{-- <img src="{{ asset('assets/certificate/qelopak.png') }}" alt="Logo" class="absolute top-6 right-6 w-24"> --}}

        <!-- Title -->
        <h1 class="text-2xl font-bold text-center text-gray-700 mb-6">Penilaian PKL</h1>

        <!-- Informasi Siswa -->
        <div class="mb-6 text-gray-700">
            <p class="mb-2"><strong>Nama Siswa:</strong> {{ $penilaian->user->name }}</p>
            <p class="mb-2"><strong>Sekolah:</strong> {{ $penilaian->user->profile->sekolah->nama }}</p>
            <p class="mb-2"><strong>Periode PKL:</strong> {{ $tanggalMulai }} - {{ $tanggalSelesai }}</p>
        </div>

       <!-- Table -->
    <div class="overflow-x-auto mb-6">
        <table class="w-full border border-gray-200">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="border border-gray-300 px-4 py-2 text-center">No</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">Aspek Penilaian</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">Nilai</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                <tr class="even:bg-gray-50">
                    <td class="border border-gray-300 px-4 py-2 text-center">1</td>
                    <td class="border border-gray-300 px-4 py-2">Nilai Sikap</td>
                    <td class="border border-gray-300 px-4 py-2 text-left">{{ $penilaian->sikap }}</td>
                </tr>
                <tr class="even:bg-gray-50">
                    <td class="border border-gray-300 px-4 py-2 text-center">2</td>
                    <td class="border border-gray-300 px-4 py-2">Nilai Microteaching</td>
                    <td class="border border-gray-300 px-4 py-2 text-left">{{ $penilaian->microteaching }}</td>
                </tr>
                <tr class="even:bg-gray-50">
                    <td class="border border-gray-300 px-4 py-2 text-center">3</td>
                    <td class="border border-gray-300 px-4 py-2">Nilai Kehadiran</td>
                    <td class="border border-gray-300 px-4 py-2 text-left">{{ $penilaian->kehadiran }}</td>
                </tr>
                <tr class="even:bg-gray-50">
                    <td class="border border-gray-300 px-4 py-2 text-center">4</td>
                    <td class="border border-gray-300 px-4 py-2">Nilai Project</td>
                    <td class="border border-gray-300 px-4 py-2 text-left">{{ $penilaian->project }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Button -->
    <div class="flex justify-end">
        <a href="{{ route('penilaian.cetak.pdf', $penilaian->id) }}" 
        class="bg-green-400 text-white text-xs px-5 py-2 shadow hover:bg-green-500 transition duration-300 ease-in-out">
            <i class="fas fa-print mr-1"></i> Cetak
        </a>
    </div>
    </div>
</body>

@endsection
