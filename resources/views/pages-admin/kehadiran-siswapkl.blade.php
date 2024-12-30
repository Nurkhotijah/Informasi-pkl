@extends('components.layout-admin')

@section('title', 'Kehadiran Siswa')

@section('content')

<main class="p-6 overflow-y-auto h-full">
    <div class="max-w-7xl mx-auto bg-white p-4 sm:p-6 rounded-lg shadow-md">
        <div class="flex flex-col sm:flex-row justify-between items-center mb-4">
            <h1 class="text-xl sm:text-2xl font-bold mb-2 sm:mb-0">Kelola Kehadiran</h1>
        </div>
        <div class="flex flex-col sm:flex-row justify-between items-center mb-4 space-y-4 sm:space-y-0 sm:space-x-4">
            <div class="relative w-full sm:w-auto">
                <input class="border rounded p-2 pl-10 w-full sm:w-64" id="searchInput" placeholder="Cari Nama" type="text">
                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
            </div>
            <div class="flex items-center">
              <label class="mr-2" for="date">Tanggal:</label>
              <input class="border rounded p-2" id="dateInput" type="date" />
          </div>
        </div>
        <div class="overflow-x-auto">
            <table id="attendanceTable" class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
                <thead class="bg-gray-200">
                    <tr class="text-gray-600 text-sm">
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b border-gray-300">No</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b border-gray-300">Nama Lengkap</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b border-gray-300">Tanggal</th>
                        <th class="py-3 px-4 text-center text-sm font-semibold text-gray-700 border-b border-gray-300">Waktu Masuk</th>
                        <th class="py-3 px-4 text-center text-sm font-semibold text-gray-700 border-b border-gray-300">Waktu Keluar</th>
                        <th class="py-3 px-4 text-center text-sm font-semibold text-gray-700 border-b border-gray-300">Foto Masuk</th>
                        <th class="py-3 px-4 text-center text-sm font-semibold text-gray-700 border-b border-gray-300">Foto Keluar</th>
                        <th class="py-3 px-4 text-center text-sm font-semibold text-gray-700 border-b border-gray-300">Foto Izin</th>
                        <th class="py-3 px-4 text-center text-sm font-semibold text-gray-700 border-b border-gray-300">Status</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @foreach ($kehadiran as $index => $data)
                    <tr class="bg-white hover:bg-gray-50 transition duration-200 ease-in-out">
                        <td class="py-4 px-4 border-b border-gray-300 text-gray-700">{{ $loop->iteration }}</td>
                        <td class="py-4 px-4 border-b border-gray-300 text-gray-800">{{ $data->user->name }}</td>
                        <td class="py-2 px-4 border-b text-center">{{ \Carbon\Carbon::parse($data->tanggal)->format('Y-m-d') }}</td>
                        <td class="py-2 px-4 border-b text-center">{{ $data->waktu_masuk ? \Carbon\Carbon::parse($data->waktu_masuk)->format('H:i:s') : '-' }}</td>
                        <td class="py-2 px-4 border-b text-center">{{ $data->waktu_keluar ? \Carbon\Carbon::parse($data->waktu_keluar)->format('H:i:s') : '-' }}</td>
                        <td class="py-2 px-4 border-b text-center">
                            @if ($data->foto_masuk)
                                <img src="{{ asset('storage/' . $data->foto_masuk) }}" alt="Foto Masuk" class="w-16 h-16 object-cover rounded-full cursor-pointer" onclick="bukaModal('{{ asset('storage/' . $data->foto_masuk) }}')">
                            @else
                                - 
                            @endif
                        </td>
                        <td class="py-2 px-4 border-b text-center">
                            @if ($data->foto_keluar)
                                <img src="{{ asset('storage/' . $data->foto_keluar) }}" alt="Foto Keluar" class="w-16 h-16 object-cover rounded-full cursor-pointer" onclick="bukaModal('{{ asset('storage/' . $data->foto_keluar) }}')">
                            @else
                                - 
                            @endif
                        </td>
                        <td class="py-2 px-4 border-b text-center">
                            @if ($data->foto_izin)
                                <img src="{{ asset('storage/' . $data->foto_izin) }}" alt="Foto Izin" class="w-16 h-16 object-cover rounded-full cursor-pointer" onclick="bukaModal('{{ asset('storage/' . $data->foto_izin) }}')">
                            @else
                                - 
                            @endif
                        </td>
                        <td class="py-4 px-4 border-b border-gray-300 text-center text-gray-600">{{ $data->status }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Pagination Section -->
        <div class="flex justify-end items-center mt-4">
            <span class="mr-4" id="pageNumber">Halaman 1</span>
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
// Fungsi pencarian berdasarkan nama
document.getElementById('searchInput').addEventListener('keyup', function() {
    filterTable();
});

// Fungsi pencarian berdasarkan tanggal
document.getElementById('dateInput').addEventListener('change', function() {
    filterTable(); 
});

function filterTable() {
    let searchValue = document.getElementById('searchInput').value.toLowerCase();
    let dateValue = document.getElementById('dateInput').value;
    let table = document.getElementById('attendanceTable');
    let rows = table.getElementsByTagName('tr');

    // Start from index 1 to skip the header row
    for (let i = 1; i < rows.length; i++) {
        let row = rows[i];
        let nameCell = row.getElementsByTagName('td')[1]; // Index 1 is the name column
        let dateCell = row.getElementsByTagName('td')[2]; // Index 2 is the date column
        
        if (nameCell && dateCell) {
            let name = nameCell.textContent || nameCell.innerText;
            let date = dateCell.textContent || dateCell.innerText;
            
            let nameMatch = name.toLowerCase().indexOf(searchValue) > -1;
            let dateMatch = !dateValue || date.includes(dateValue);

            if (nameMatch && dateMatch) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        }
    }
}

// Pagination variables
let currentPage = 1;
const rowsPerPage = 1;

function showPage(page) {
    const table = document.getElementById('attendanceTable');
    const rows = table.getElementsByTagName('tr');
    const totalRows = rows.length - 1; // Subtract 1 to exclude header row
    const totalPages = Math.ceil(totalRows / rowsPerPage);
    
    // Update current page
    currentPage = Math.min(Math.max(1, page), totalPages);
    
    // Calculate start and end rows for current page
    const start = ((currentPage - 1) * rowsPerPage) + 1; // Add 1 to skip header
    const end = Math.min(start + rowsPerPage - 1, totalRows);
    
    // Hide all rows first
    for (let i = 1; i < rows.length; i++) {
        rows[i].style.display = 'none';
    }
    
    // Show rows for current page
    for (let i = start; i <= end; i++) {
        if (rows[i]) {
            rows[i].style.display = '';
        }
    }
    
    // Update page number display
    document.getElementById('pageNumber').textContent = `Halaman ${currentPage}`;
}

function nextPage() {
    showPage(currentPage + 1);
}

function prevPage() {
    showPage(currentPage - 1);
}

// Initialize pagination
window.onload = function() {
    showPage(1);
};
</script>

@endsection
