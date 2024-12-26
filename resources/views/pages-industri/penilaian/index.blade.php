@extends('components.layout-industri')

@section('title', 'Data Rekap Penilaian Siswa')

@section('content')
<main class="bg-gray-100">
    <div class="p-6 overflow-y-auto h-full">
        <div class="max-w-7xl mx-auto bg-white p-4 sm:p-6 rounded-lg shadow-md">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4">
                <h1 class="text-xl sm:text-2xl font-bold mb-2 sm:mb-0">Penilaian Siswa</h1>
                <a href="{{ route('penilaian.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">
                    <i class="fas fa-plus mr-2"></i>Tambah
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border text-sm sm:text-base">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="py-2 px-4 border-b text-center">No</th>
                            <th class="py-2 px-4 border-b text-left">Nama Siswa</th>
                            <th class="py-2 px-4 border-b text-left">Sekolah</th>
                            <th class="py-2 px-4 border-b text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($penilaian as $item)
                        <tr>
                            <td class="py-2 px-4 border-b text-center">{{ $loop->iteration }}</td>
                            <td class="py-2 px-4 border-b text-left">{{ $item->user->name }}</td>
                            <td class="py-2 px-4 border-b text-left">{{ $item->user->profile->sekolah->nama }}</td>
                            <td class="py-2 px-4 border-b text-center">
                                <div class="flex justify-center space-x-2">
                                    <a href="{{ route('penilaian.show', $item->id) }}" class="bg-blue-400 text-white text-xs sm:text-sm px-3 py-1 shadow hover:bg-blue-500">
                                        <i class="fas fa-eye mr-1"></i> Lihat
                                    </a>
                                    <form action="{{ route('penilaian.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 text-white text-xs sm:text-sm px-3 py-1 shadow hover:bg-red-600">
                                            <i class="fas fa-trash mr-1"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@endsection
