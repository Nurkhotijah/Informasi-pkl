@extends('components.layout-industri')

@section('title', 'Kehadiran Siswa')

@section('content')

<div class="bg-gray-100">
    <main class="p-6 overflow-y-auto h-full">
        <div class="max-w-7xl mx-auto bg-white p-4 sm:p-6 rounded-lg shadow-md">
            <!-- Header Section -->
            <div class="mb-4">
                <h1 class="text-xl sm:text-2xl font-bold mb-2 sm:mb-4">Kelola Kehadiran</h1>
                <div class="flex flex-col sm:flex-row items-center justify-between space-y-2 sm:space-y-0 sm:space-x-4">
                    <div class="relative w-full sm:w-auto">
                        <input class="border rounded p-2 pl-10 w-full sm:w-64" id="search" placeholder="Cari Nama atau sekolah" type="text" oninput="searchTable()">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                    </div>
                                   
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border" id="attendanceTable">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="py-2 px-4 border-b text-center">No</th>
                            <th class="py-2 px-4 border-b text-left">Nama Lengkap</th>
                            <th class="py-2 px-4 border-b text-left">Sekolah</th>
                            <th class="py-2 px-4 border-b text-center">Aksi</th> 
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kehadiran as $item)
                            <tr>
                                <td class="py-2 px-4 border-b text-center">{{ $loop->iteration }}</td>
                                <td class="py-2 px-4 border-b text-left">{{ $item->user->name ?? 'Nama tidak ditemukan' }}</td>
                                <td class="py-2 px-4 border-b text-left">{{ $item->profile?->sekolah?->nama ?? 'Sekolah tidak ditemukan' }}</td>
                              
                                <td class="py-2 px-4 border-b text-center">
                                    <div class="flex justify-center space-x-2">
                                       
                                        <a href="{{ route('kehadiran.detail', $item->user_id) }}" class="bg-blue-500 text-white text-xs px-3 py-1 rounded shadow hover:bg-blue-600 transition duration-300 ease-in-out">
                                            <i class="fas fa-eye mr-1"></i> Lihat
                                        </a>
                                        <a href="{{ route('kehadiran.pdf', $item->user_id) }}" class="bg-green-500 text-white text-xs px-3 py-1 rounded shadow hover:bg-green-600 transition duration-300 ease-in-out">
                                            <i class="fas fa-eye mr-1"></i> Cetak
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

           <!-- Pagination -->
        <div class="mt-4">
            {{ $kehadiran->links('pagination::tailwind') }}
        </div>

        </div>
    </main>

    <!-- Modal -->
    <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden" id="modal" onclick="closeModal()">
        <div class="bg-white rounded-lg shadow-lg p-6 w-96" onclick="event.stopPropagation();">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Foto Absensi</h2>
                <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div id="modalImage">
                <img alt="Foto Absensi" class="w-full h-auto rounded-lg shadow-md transition duration-300 transform hover:scale-105"/>
            </div>
        </div>
    </div>
</div>

<script>


function openModal(imageUrl) {
    const modal = document.getElementById("modal");
    const modalImage = document.getElementById("modalImage").querySelector("img");
    modalImage.src = imageUrl;
    modal.classList.remove("hidden");
}

function closeModal() {
    const modal = document.getElementById("modal");
    modal.classList.add("hidden");
}

document.addEventListener('DOMContentLoaded', initializeTable);
</script>

@endsection
