@extends('components.layout-industri')

@section('title', 'Data Sekolah')

@section('content')
<div class="bg-gray-100">
    <main class="p-6 overflow-y-auto h-full">
        <div class="max-w-7xl mx-auto bg-white p-4 sm:p-6 rounded-lg shadow-md">
            <!-- Header Section -->
            <div class="mb-4">
                <h1 class="text-xl sm:text-2xl font-bold mb-2 sm:mb-4">Data PKL</h1>
                <div class="flex flex-col sm:flex-row items-center justify-between space-y-2 sm:space-y-0 sm:space-x-4">
                    <div class="relative w-full sm:w-auto">
                        <form method="GET" action="{{ url()->current() }}">
                            <input 
                                type="text" 
                                name="search" 
                                id="search" 
                                class="border rounded p-2 pl-10 w-full sm:w-64" 
                                placeholder="Cari Tahun Ajaran, Judul, atau Pembimbing" 
                                value="{{ request('search') }}"
                            >
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        </form>
                    </div>                              
                </div>
            </div>

            <!-- Table Section -->
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border" id="schoolTable">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="py-2 px-4 border-b text-center">No</th>
                            <th class="py-2 px-4 border-b text-left">Judul PKL</th>
                            <th class="py-2 px-4 border-b text-center">Tahun Ajaran</th>
                            <th class="py-2 px-4 border-b text-left">Nama Pembimbing</th>
                            <th class="py-2 px-4 border-b text-center">Lampiran</th>
                            <th class="py-2 px-4 border-b text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listSekolah as $item)
                            <tr class="school-row">
                                <td class="py-2 px-4 border-b text-center">{{ $loop->iteration }}</td>
                                <td class="py-2 px-4 border-b text-left">{{ $item->judul_pkl }}</td>
                                <td class="py-2 px-4 border-b text-center">{{ $item->tahun }}</td>
                                <td class="py-2 px-4 border-b text-left">{{ $item->pembimbing }}</td>
                                <td class="py-2 px-4 border-b text-center">
                                    <a href="{{ asset('storage/' . $item->lampiran) }}" target="_blank" class="bg-blue-500 text-white text-xs px-3 py-1 rounded hover:bg-blue-600">
                                        <i class="fas fa-file-pdf"></i>
                                    </a>
                                </td>
                                <td class="py-2 px-4 border-b text-center">
                                    <div class="flex justify-center space-x-2">
                                        <a href="{{ route('sekolah.detail-siswa', $item->id) }}" class="bg-blue-500 text-white text-xs px-3 py-1 rounded hover:bg-blue-600">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination Section -->
            <div class="flex justify-end items-center mt-4">
                <span class="mr-4" id="pageInfo">Halaman 1 dari 1</span>
                <button class="bg-gray-300 text-gray-700 p-2 rounded mr-2" id="prevBtn" onclick="prevPage()" disabled>
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="bg-gray-300 text-gray-700 p-2 rounded" id="nextBtn" onclick="nextPage()">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </main>
</div>

<script>
    // Function to handle searching in the table
    function searchTable() {
        const searchInput = document.getElementById('search').value.toLowerCase();
        const rows = document.querySelectorAll('.school-row');
        let visibleRows = 0;
        
        rows.forEach(row => {
            const tahunAjaran = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
            if (tahunAjaran.includes(searchInput)) {
                row.classList.remove('hidden-row');
                visibleRows++;
            } else {
                row.classList.add('hidden-row');
            }
        });
        
        currentPage = 1;
        updatePagination();
    }

    // Pagination logic
    let currentPage = 1;
    const rowsPerPage = 5;
    const rows = document.querySelectorAll('.school-row');
    const totalPages = Math.ceil(rows.length / rowsPerPage);

    function prevPage() {
        if (currentPage > 1) {
            currentPage--;
            updatePagination();
        }
    }

    function nextPage() {
        const visibleRows = document.querySelectorAll('.school-row:not(.hidden-row)').length;
        const maxPages = Math.ceil(visibleRows / rowsPerPage);
        
        if (currentPage < maxPages) {
            currentPage++;
            updatePagination();
        }
    }

    function updatePagination() {
        const visibleRows = Array.from(document.querySelectorAll('.school-row:not(.hidden-row)'));
        const totalVisibleRows = visibleRows.length;
        const maxPages = Math.ceil(totalVisibleRows / rowsPerPage);
        
        // Update buttons state
        document.getElementById('prevBtn').disabled = currentPage === 1;
        document.getElementById('nextBtn').disabled = currentPage >= maxPages;
        
        // Update page info
        document.getElementById('pageInfo').textContent = `Halaman ${currentPage} dari ${maxPages || 1}`;
        
        // Show/hide rows based on current page
        visibleRows.forEach((row, index) => {
            const start = (currentPage - 1) * rowsPerPage;
            const end = start + rowsPerPage;
            
            if (index >= start && index < end) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
        
        // Hide all filtered rows
        document.querySelectorAll('.school-row.hidden-row').forEach(row => {
            row.style.display = 'none';
        });
    }

    // Initialize pagination
    updatePagination();
</script>

@endsection