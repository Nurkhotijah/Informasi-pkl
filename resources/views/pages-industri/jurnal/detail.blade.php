@extends('components.layout-industri')

@section('title', 'Detail Jurnal Siswa')

@section('content')
  
<main class="p-6 overflow-y-auto h-full">
    <div class="max-w-7xl mx-auto bg-white p-4 sm:p-6 rounded-lg shadow-md">
        <!-- Header Section -->
        <div class="mb-4">
            <h1 class="text-xl sm:text-2xl font-bold mb-2 sm:mb-4">Detail Jurnal Siswa</h1>
            <div class="flex items-center">
                <label for="dateFilter" class="mr-2">Tanggal:</label>
                <input type="date" id="dateFilter" class="border rounded p-2" onchange="filterByDate()">
            </div>
        </div>

        <!-- Table Section -->
        <table class="min-w-full bg-white border">
            <thead class="bg-gray-200">
                <tr>
                    <th class="py-2 px-4 border-b text-center">No</th>
                    <th class="py-2 px-4 border-b text-left">Kegiatan</th>
                    <th class="py-2 px-4 border-b text-center">Tanggal</th>
                    <th class="py-2 px-4 border-b text-center">Waktu Mulai</th>
                    <th class="py-2 px-4 border-b text-center">Waktu Selesai</th>
                    <th class="py-2 px-4 border-b text-center">Foto Kegiatan</th>
                </tr>
            </thead>
            <tbody id="journalTableBody">
                @foreach ($listdetail as $item)
                <tr data-tanggal="{{ \Carbon\Carbon::parse($item->tanggal)->format('Y-m-d') }}">
                    <td class="py-2 px-4 border-b text-center">{{ $loop->iteration + ($listdetail->currentPage() - 1) * $listdetail->perPage() }}</td>
                    <td class="py-2 px-4 border-b text-left">{{ $item->kegiatan }}</td>
                    <td class="py-2 px-4 border-b text-center">{{ \Carbon\Carbon::parse($item->tanggal)->locale('id')->format('d F Y') }}</td>
                    <td class="py-2 px-4 border-b text-center">{{ \Carbon\Carbon::parse($item->waktu_mulai)->locale('id')->format('H:i') }}</td>
                    <td class="py-2 px-4 border-b text-center">{{ \Carbon\Carbon::parse($item->waktu_selesai)->locale('id')->format('H:i') }}</td>
                    <td class="py-2 px-4 border-b text-center">
                        @if ($item->foto_kegiatan)
                            <img src="{{ asset('storage/'.$item->foto_kegiatan) }}" alt="Foto Kegiatan" class="w-16 h-16 object-cover rounded-full cursor-pointer" onclick="showActivityImage('{{ asset('storage/'.$item->foto_kegiatan) }}')">
                        @else
                            <span class="text-gray-500">No Image</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Modal untuk menampilkan gambar besar -->
        <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
            <div class="bg-white rounded-lg p-4 relative max-w-md w-full">
                <button onclick="closeModal()" class="absolute top-2 right-2 text-gray-500 hover:text-black">
                    ✕
                </button>
                <img id="activityImage" src="" alt="Activity Image" class="w-full rounded-md">
            </div>
        </div>
         <!-- Pagination Section -->
         <div class="flex justify-end items-center mt-4">
            <span class="mr-4" id="pageNumber">Halaman {{ $listdetail->currentPage() }}</span>
            <button class="bg-gray-300 text-gray-700 p-2 rounded mr-2" onclick="prevPage()">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button class="bg-gray-300 text-gray-700 p-2 rounded" onclick="nextPage()">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    </div>
</main>

<script>
    // Pagination functions
    let currentPage = 1;
    const rowsPerPage = 5; 
    const totalRows = {{ $listdetail->total() }}; // Total rows from pagination

    function updateTable() {
        const rows = document.querySelectorAll('#journalTableBody tr');
        rows.forEach((row, index) => {
            if (index >= (currentPage - 1) * rowsPerPage && index < currentPage * rowsPerPage) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
        document.getElementById('pageNumber').textContent = `Halaman ${currentPage}`;
    }

    function nextPage() {
        if (currentPage * rowsPerPage < totalRows) {
            currentPage++;
            updateTable();
        }
    }

    function prevPage() {
        if (currentPage > 1) {
            currentPage--;
            updateTable();
        }
    }

    updateTable();
   // Fungsi untuk menampilkan gambar besar di modal
   function showActivityImage(imageSrc) {
        const modal = document.getElementById('imageModal');
        const image = document.getElementById('activityImage');
        image.src = imageSrc;
        modal.classList.remove('hidden');
    }

    // Fungsi untuk menutup modal
    function closeModal() {
        const modal = document.getElementById('imageModal');
        modal.classList.add('hidden');
    }

    // Fungsi untuk memfilter tabel berdasarkan tanggal
    function filterByDate() {
        const filterDate = document.getElementById('dateFilter').value;
        const rows = document.querySelectorAll('#journalTableBody tr');

        rows.forEach(row => {
            const rowDate = row.getAttribute('data-tanggal');
            if (rowDate === filterDate) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
</script>

@endsection
