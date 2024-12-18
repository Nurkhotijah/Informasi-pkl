@extends('components.layout-admin')

@section('title', 'Data Siswa')

@section('content')
<div class="bg-gray-100">
    <main class="p-6 overflow-y-auto h-full">
        <div class="max-w-7xl mx-auto bg-white p-4 sm:p-6 rounded-lg shadow-md">
            <!-- Header Section -->
            <div class="mb-4">
                <h1 class="text-xl sm:text-2xl font-bold mb-2 sm:mb-4">Kelola Data Siswa</h1>
                <div class="flex flex-col sm:flex-row items-center justify-between space-y-2 sm:space-y-0 sm:space-x-4">
                    <div class="relative w-full sm:w-auto">
                        <input class="border rounded p-2 pl-10 w-full sm:w-64" id="search" placeholder="Cari Nama atau Jurusan" type="text" oninput="searchTable()">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                    </div>
                </div>
            </div>

            <!-- Table Section -->
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border" id="studentTable">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="py-2 px-4 border-b text-center">No</th>
                            <th class="py-2 px-4 border-b text-left">Nama Siswa</th>
                            <th class="py-2 px-4 border-b text-left">Jurusan</th>
                            <th class="py-2 px-4 border-b text-center">Nilai</th>
                            <th class="py-2 px-4 border-b text-center">Kehadiran</th>
                            <th class="py-2 px-4 border-b text-center">Sertifikat</th>
                            <th class="py-2 px-4 border-b text-center">Laporan</th> <!-- Kolom Laporan Baru -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($siswa as $item)
                            <tr class="student-row" data-id="{{ $item->id }}">
                                <td class="py-2 px-4 border-b text-center">{{ $loop->iteration }}</td>
                                <td class="py-2 px-4 border-b text-left">{{ $item->name }}</td>
                                <td class="py-2 px-4 border-b text-left">{{ $item->profile->jurusan ?? 'Jurusan Tidak Tersedia' }}</td>
                                <td class="py-2 px-4 border-b text-center">
                                    @if ($item->profile && $item->profile->tanggal_selesai && $item->profile->tanggal_selesai <= now())
                                        <a href="{{ route('penilaiansiswa.unduh', $item->id) }}" target="_blank" class="inline-flex items-center justify-center p-2 bg-blue-500 text-white rounded hover:bg-blue-600"> 
                                            <i class="fas fa-eye mr-1"></i> 
                                        </a>
                                    @else
                                        <button class="inline-flex items-center justify-center p-2 bg-gray-400 text-white rounded cursor-not-allowed" disabled>
                                            <i class="fas fa-eye mr-1"></i> 
                                        </button>
                                    @endif
                                </td>
                                
                                <td class="py-2 px-4 border-b text-center">
                                    @if ($item->profile && $item->profile->tanggal_selesai && $item->profile->tanggal_selesai <= now())
                                        <a href="{{ route('kehadiransiswa.unduh', ['userId' => $item->id]) }}" target="_blank" class="inline-flex items-center justify-center p-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                                            <i class="fas fa-eye mr-1"></i>                                   
                                        </a>
                                    @else
                                        <button class="inline-flex items-center justify-center p-2 bg-gray-400 text-white rounded cursor-not-allowed" disabled>
                                            <i class="fas fa-eye mr-1"></i> 
                                        </button>
                                    @endif
                                </td>
                                
                                <td class="py-2 px-4 border-b text-center">
                                    @if ($item->profile && $item->profile->tanggal_selesai && $item->profile->tanggal_selesai <= now())
                                        <a href="{{ route('cetak-sertifikat-siswa', $item->id) }}" target="_blank" class="inline-flex items-center justify-center p-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                                            <i class="fas fa-eye mr-1"></i>                                    
                                        </a>
                                    @else
                                        <button class="inline-flex items-center justify-center p-2 bg-gray-400 text-white rounded cursor-not-allowed" disabled>
                                            <i class="fas fa-eye mr-1"></i> 
                                        </button>
                                    @endif
                                </td>                                
                                <td class="py-2 px-4 border-b text-center">
                                    @if ($item->laporan)
                                    <a href="{{ asset('storage/' . $item->laporan->file_path) }}" target="_blank" class="inline-flex items-center justify-center p-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                                        <i class="fas fa-eye mr-1"></i> 
                                    </a>
                                    @else
                                    <p class="text-gray-500">Belum ada laporan</p>
                                    @endif
                                </td>
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
</div>

<script>
// Pagination variables
let currentPage = 1;
const rowsPerPage = 1;

function showPage(page) {
    const table = document.getElementById('studentTable');
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

// Search function
function searchTable() {
    const input = document.getElementById('search');
    const filter = input.value.toLowerCase();
    const table = document.getElementById('studentTable');
    const rows = table.getElementsByTagName('tr');

    for (let i = 1; i < rows.length; i++) {
        const nameCell = rows[i].getElementsByTagName('td')[1];
        const majorCell = rows[i].getElementsByTagName('td')[2];
        if (nameCell || majorCell) {
            const nameValue = nameCell.textContent || nameCell.innerText;
            const majorValue = majorCell.textContent || majorCell.innerText;
            if (nameValue.toLowerCase().indexOf(filter) > -1 || majorValue.toLowerCase().indexOf(filter) > -1) {
                rows[i].style.display = "";
            } else {
                rows[i].style.display = "none";
            }
        }       
    }
}

// Initialize pagination
window.onload = function() {
    showPage(1);
};

function deleteStudent(studentId) {
    // Tampilkan dialog konfirmasi
    const confirmDelete = confirm("Apakah Anda yakin ingin menghapus data siswa ini?");
    if (confirmDelete) {
        // Hapus baris siswa berdasarkan ID
        const studentRow = document.querySelector(`.student-row[data-id="${studentId}"]`);
        if (studentRow) {
            studentRow.remove();
        } else {
            alert("Data siswa tidak ditemukan!");
        }
    }
}
</script>

@endsection