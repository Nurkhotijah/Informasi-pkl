@extends('components.layout-industri')

@section('title', 'Kehadiran Siswa')

@section('content')

<div class="bg-gray-100">
    <main class="p-6 overflow-y-auto h-full">
        <div class="max-w-7xl mx-auto bg-white p-4 sm:p-6 rounded-lg shadow-md">
            <!-- Header Section -->
            <div class="mb-4">
                <h1 class="text-xl sm:text-2xl font-bold mb-2 sm:mb-4">Detail Kehadiran</h1>
                <div class="flex flex-col sm:flex-row items-center justify-between space-y-2 sm:space-y-0 sm:space-x-4">
                    <div class="flex items-center w-full sm:w-auto sm:ml-auto">
                        <label class="mr-2" for="date">Pilih Tanggal:</label>
                        <input 
                            type="date" 
                            class="border rounded p-2 w-full sm:w-auto" 
                            id="date" 
                            onchange="filterByDate()"
                        />
                    </div>    
                                     
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border" id="attendanceTable">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="py-2 px-4 border-b text-center">No</th>
                            <th class="py-2 px-4 border-b text-center">Tanggal</th>
                            <th class="py-2 px-4 border-b text-center">Waktu Masuk</th>
                            <th class="py-2 px-4 border-b text-center">Waktu Keluar</th> 
                            <th class="py-2 px-4 border-b text-center">Foto Masuk</th> 
                            <th class="py-2 px-4 border-b text-center">Foto Keluar</th> 
                            <th class="py-2 px-4 border-b text-center">Foto Izin</th>
                            <th class="py-2 px-4 border-b text-center">Status</th> 
                            <th class="py-2 px-4 border-b text-center">Aksi</th> 
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kehadiran as $item)
                            <tr>
                                <td class="py-2 px-4 border-b text-center">{{ $loop->iteration }}</td>
                                <td class="py-2 px-4 border-b text-center">{{ \Carbon\Carbon::parse($item->tanggal)->format('Y-m-d') }}</td>
                                <td class="py-2 px-4 border-b text-center">{{ $item->waktu_masuk ? \Carbon\Carbon::parse($item->waktu_masuk)->format('H:i:s') : '-' }}</td>
                                <td class="py-2 px-4 border-b text-center">{{ $item->waktu_keluar ? \Carbon\Carbon::parse($item->waktu_keluar)->format('H:i:s') : '-' }}</td>
                                <td class="py-2 px-4 border-b text-center">
                                    @if($item->foto_masuk)
                                    <img src="{{ asset('storage/' . $item->foto_masuk) }}" alt="Foto Masuk" class="w-16 h-16 object-cover rounded-full cursor-pointer" onclick="openModal('{{ asset('storage/' . $item->foto_masuk) }}')">
                                    @else
                                    <span class="text-gray-400">Tidak ada foto</span>
                                    @endif
                                </td>
                                <td class="py-2 px-4 border-b text-center">
                                    @if($item->foto_keluar)
                                    <img src="{{ asset('storage/' . $item->foto_keluar) }}" alt="Foto Keluar" class="w-16 h-16 object-cover rounded-full cursor-pointer" onclick="openModal('{{ asset('storage/' . $item->foto_keluar) }}')">
                                    @else
                                    <span class="text-gray-400">Tidak ada foto</span>
                                    @endif
                                </td>
                                <td class="py-2 px-4 border-b text-center">
                                    @if($item->foto_izin)
                                    <img src="{{ asset('storage/' . $item->foto_izin) }}" alt="Foto Izin" class="w-16 h-16 object-cover rounded-full cursor-pointer" onclick="openModal('{{ asset('storage/' . $item->foto_izin) }}')">
                                    @else
                                    <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="py-4 px-4 border-b border-gray-300 text-center text-gray-600">{{ $item->status }}</td>
                                <td class="py-2 px-4 border-b text-center">
                                    <a href="{{ route('kehadiran.edit', $item->id) }}" class="bg-yellow-400 text-white text-xs px-3 py-1 rounded shadow hover:bg-yellow-500 transition duration-300 ease-in-out">
                                        <i class="fas fa-edit mr-1"></i> Edit
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination Section -->
            <div class="flex justify-end items-center mt-4 space-x-2">
                <button id="prevPage" class="px-3 py-1 bg-gray-200 rounded-md hover:bg-gray-300 disabled:opacity-50 disabled:cursor-not-allowed">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <span id="pageInfo" class="text-sm text-gray-600"></span>
                <button id="nextPage" class="px-3 py-1 bg-gray-200 rounded-md hover:bg-gray-300 disabled:opacity-50 disabled:cursor-not-allowed">
                    <i class="fas fa-chevron-right"></i>
                </button>
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

function filterByDate() {
    const selectedDate = document.getElementById('date').value;
    const tableBody = document.querySelector('#attendanceTable tbody');
    const rows = Array.from(tableBody.querySelectorAll('tr'));
    
    if (!selectedDate) {
        filteredData = rows;
    } else {
        filteredData = rows.filter(row => {
            const dateCell = row.querySelector('td:nth-child(4)');
            return dateCell.textContent.includes(selectedDate);
        });
    }
    
    currentPage = 1;
    updateTableDisplay();
}


const ITEMS_PER_PAGE = 10;
let currentPage = 1;
let filteredData = [];

function initializeTable() {
    const tableBody = document.querySelector('#attendanceTable tbody');
    const rows = Array.from(tableBody.querySelectorAll('tr'));
    filteredData = rows;
    updateTableDisplay();
}

function searchTable() {
    const searchTerm = document.getElementById('search').value.toLowerCase();
    const tableBody = document.querySelector('#attendanceTable tbody');
    const rows = Array.from(tableBody.querySelectorAll('tr'));
    
    filteredData = rows.filter(row => {
        const nameCell = row.querySelector('td:nth-child(2)');
        const schoolCell = row.querySelector('td:nth-child(3)');
        return nameCell.textContent.toLowerCase().includes(searchTerm) || 
               schoolCell.textContent.toLowerCase().includes(searchTerm);
    });
    
    currentPage = 1;
    updateTableDisplay();
}

function filterByDate() {
    const selectedDate = document.getElementById('date').value;
    const tableBody = document.querySelector('#attendanceTable tbody');
    const rows = Array.from(tableBody.querySelectorAll('tr'));
    
    if (!selectedDate) {
        filteredData = rows;
    } else {
        filteredData = rows.filter(row => {
            const dateCell = row.querySelector('td:nth-child(4)');
            return dateCell.textContent.includes(selectedDate);
        });
    }
    
    currentPage = 1;
    updateTableDisplay();
}

function updateTableDisplay() {
    const tableBody = document.querySelector('#attendanceTable tbody');
    const startIndex = (currentPage - 1) * ITEMS_PER_PAGE;
    const endIndex = startIndex + ITEMS_PER_PAGE;
    
    tableBody.querySelectorAll('tr').forEach(row => {
        row.style.display = 'none';
    });
    
    filteredData.slice(startIndex, endIndex).forEach(row => {
        row.style.display = '';
    });
    
    updatePaginationControls();
}

function updatePaginationControls() {
    const totalPages = Math.ceil(filteredData.length / ITEMS_PER_PAGE);
    const prevButton = document.getElementById('prevPage');
    const nextButton = document.getElementById('nextPage');
    const pageInfo = document.getElementById('pageInfo');
    
    prevButton.disabled = currentPage === 1;
    nextButton.disabled = currentPage === totalPages;
    pageInfo.textContent = `Halaman ${currentPage} dari ${totalPages}`;
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
