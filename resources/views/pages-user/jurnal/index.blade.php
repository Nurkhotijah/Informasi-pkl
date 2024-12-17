@extends('components.layout-user')

@section('title', 'Jurnal Kegiatan')

@section('content')

<main class="p-6 overflow-y-auto h-full">
    <div class="max-w-7xl mx-auto bg-white p-4 sm:p-6 rounded-lg shadow-md">
        <!-- Header Section -->
        <div class="mb-4 flex justify-between items-center">
            <h1 class="text-xl sm:text-2xl font-bold mb-2 sm:mb-4">Jurnal</h1>
            <div class="flex items-center">
                <label for="dateFilter" class="mr-2">Tanggal:</label>
                <input type="date" id="dateFilter" class="border rounded p-2" onchange="filterByDate()">
            </div>
        </div>

        <!-- Action Buttons Section -->
        <div class="flex space-x-4 mb-6">
            <!-- Tombol Tambah Jurnal -->
            <a href="{{ route('jurnal-siswa.create') }}" class="bg-blue-500 text-white text-xs px-4 py-2 rounded shadow hover:bg-blue-600 transition duration-300 ease-in-out">
                <i class="fas fa-user-plus mr-2"></i> Tambah Jurnal
            </a>

            <!-- Tombol Lihat Jurnal -->
            <a href="{{ route('penilaian.show.user') }}" class="bg-green-500 text-white text-xs px-4 py-2 rounded shadow hover:bg-green-600 transition duration-300 ease-in-out">
                <i class="fas fa-eye mr-2"></i> Lihat Penilaian
            </a>
        </div>

        <!-- Table Section -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border" id="pengajuanTable">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="py-2 px-4 border-b text-center">No</th>
                        <th class="py-2 px-4 border-b text-left">Kegiatan</th>
                        <th class="py-2 px-4 border-b text-center">Tanggal</th>
                        <th class="py-2 px-4 border-b text-center">Waktu Mulai</th>
                        <th class="py-2 px-4 border-b text-center">Waktu Selesai</th>
                        <th class="py-2 px-4 border-b text-center">Foto</th>
                        <th class="py-2 px-4 border-b text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="jurnalBody">
                    @foreach($jurnal as $index => $siswa)
                        <tr>
                            <td class="py-2 px-4 border-b text-center">{{ $index + 1 }}</td>
                            <td class="py-2 px-4 border-b text-left">{{ $siswa->kegiatan }}</td>
                            <td class="py-2 px-4 border-b text-center">{{ \Carbon\Carbon::parse($siswa->tanggal)->format('Y-m-d') }}</td>
                            <td class="py-2 px-4 border-b text-center">{{ \Carbon\Carbon::parse($siswa->waktu_mulai)->format('H:i') }}</td>
                            <td class="py-2 px-4 border-b text-center">{{ \Carbon\Carbon::parse($siswa->waktu_selesai)->format('H:i') }}</td>
                            <td class="py-2 px-4 border-b text-center">
                                <img src="{{ asset('storage/'.$siswa->foto_kegiatan) }}" alt="Foto Kegiatan" class="w-14 h-14 object-cover rounded-full cursor-pointer" onclick="showActivityImage('{{ asset('storage/'.$siswa->foto_kegiatan) }}')">
                            </td>
                            <td class="py-2 px-4 border-b text-center">
                                <a href="{{ route('jurnal-siswa.edit', ['id' => $siswa->id]) }}" class="bg-blue-500 text-white text-xs px-3 py-1 rounded shadow hover:bg-blue-600 transition duration-300 ease-in-out">
                                    <i class="fas fa-edit mr-1"></i> Edit
                                </a>
                                <form action="{{ route('jurnal-siswa.destroy', ['id' => $siswa->id]) }}" method="POST" class="inline-block ml-2" onsubmit="return confirm('Apakah Anda yakin ingin menghapus siswa ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white text-xs px-3 py-1 rounded shadow hover:bg-red-600 transition duration-300 ease-in-out">
                                        <i class="fas fa-trash-alt mr-1"></i> Hapus
                                    </button>
                                </form>
                            </td>                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination Section -->
        <div class="flex justify-end items-center mt-4">
            <span class="mr-4" id="pageNumber">Halaman <span id="currentPage">1</span> dari <span id="totalPages">1</span></span>
            <button class="bg-gray-300 text-gray-700 p-2 rounded mr-2" onclick="prevPage()">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button class="bg-gray-300 text-gray-700 p-2 rounded" onclick="nextPage()">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    </div>
</main>

<div id="imageModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white rounded-lg p-4 relative max-w-md w-full">
        <button onclick="closeModal()" class="absolute top-2 right-2 text-gray-500 hover:text-black">
            ✕
        </button>
        <img id="activityImage" src="" alt="Activity Image" class="w-full rounded-md">
    </div>
</div>

<script>
    let currentPage = 1;
    const ITEMS_PER_PAGE = 10;
    let filteredData = [];

    function showActivityImage(imageSrc) {
        const modal = document.getElementById('imageModal');
        const activityImage = document.getElementById('activityImage');
        activityImage.src = imageSrc;
        modal.classList.remove('hidden');
    }

    function closeModal() {
        const modal = document.getElementById('imageModal');
        modal.classList.add('hidden');
    }

    function filterByDate() {
        const selectedDate = document.getElementById('dateFilter').value;
        const rows = Array.from(document.querySelectorAll('#jurnalBody tr'));
        
        filteredData = rows.filter(row => {
            const dateCell = row.querySelector('td:nth-child(3)').textContent;
            return selectedDate ? dateCell === selectedDate : true;
        });

        currentPage = 1;
        updateTableDisplay();
    }

    function updateTableDisplay() {
        const startIndex = (currentPage - 1) * ITEMS_PER_PAGE;
        const endIndex = startIndex + ITEMS_PER_PAGE;

        document.querySelectorAll('#jurnalBody tr').forEach((row, index) => {
            row.style.display = (index >= startIndex && index < endIndex) ? '' : 'none';
        });

        document.getElementById('currentPage').textContent = currentPage;
        document.getElementById('totalPages').textContent = Math.ceil(filteredData.length / ITEMS_PER_PAGE);
    }

    function prevPage() {
        if (currentPage > 1) {
            currentPage--;
            updateTableDisplay();
        }
    }

    function nextPage() {
        const totalPages = Math.ceil(filteredData.length / ITEMS_PER_PAGE);
        if (currentPage < totalPages) {
            currentPage++;
            updateTableDisplay();
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        filteredData = Array.from(document.querySelectorAll('#jurnalBody tr'));
        updateTableDisplay();
    });
</script>

@endsection