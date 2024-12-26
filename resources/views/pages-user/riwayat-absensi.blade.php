@extends('components.layout-user')

@section('title', 'Riwayat Kehadiran')

@section('content')
<!-- Main Content -->
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <div class="bg-white rounded-lg shadow p-6">
            <h1 class="text-2xl font-bold mb-4">Riwayat Kehadiran</h1>
            <div class="flex flex-col md:flex-row justify-between items-center mb-4">
                <!-- Form for Upload Foto Izin -->
                <form action="{{ route('kehadiran.store') }}" method="POST" enctype="multipart/form-data" id="formIzin">
                    @csrf
                    <input type="hidden" name="jenis_absen" value="masuk">
                    <div class="flex flex-col md:flex-row md:space-x-4 mb-4 md:mb-0 w-full">
                        <div class="flex space-x-2 mb-4 md:mb-0 w-full md:w-auto">
                            <label for="uploadIzin" class="bg-blue-500 text-white text-xs px-6 py-3 rounded shadow hover:bg-blue-600 transition duration-300 ease-in-out cursor-pointer flex items-center w-full">
                                <i class="fas fa-upload mr-2"></i> Upload Foto Izin
                            </label>
                            <input type="file" id="uploadIzin" name="foto_izin" class="hidden" accept="image/jpeg, image/png" onchange="submitForm()">
                        </div>
            
                        <!-- Tombol Unduh Rekap Kehadiran -->
                        <div class="w-full md:w-auto">
                            <a class="bg-green-500 text-white text-xs px-6 py-3 rounded-lg hover:bg-green-600 transition duration-300 ease-in-out flex items-center space-x-2 w-full justify-center md:justify-start" href="{{ route('rekap.kehadiran') }}">
                                <i class="fas fa-download"></i>
                                <span>Rekap Kehadiran</span>
                            </a>
                        </div>
                    </div>
                </form>
            
                <!-- Filter Tanggal -->
                <div class="mt-4 md:mt-0">
                    <input type="date" id="filterTanggal" class="border rounded p-2 w-full md:w-auto" onchange="filterByDate()">
                </div>
            </div>
                        
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b">No</th>
                            <th class="py-2 px-4 border-b">Nama Lengkap</th>
                            <th class="py-2 px-4 border-b">Tanggal</th>
                            <th class="py-2 px-4 border-b">Status</th>
                            <th class="py-2 px-4 border-b">Waktu Masuk</th>
                            <th class="py-2 px-4 border-b">Waktu Pulang</th>
                            <th class="py-2 px-4 border-b">Foto Masuk</th>
                            <th class="py-2 px-4 border-b">Foto Pulang</th>
                            <th class="py-2 px-4 border-b">Foto Izin</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kehadiran as $absensi)
                    @if($loop->iteration <= 2) <!-- Limit to 2 entries per page -->
                        <tr class="kehadiran-row">
                            <td class="py-2 px-4 border-b">1</td>
                            <td class="py-2 px-4 border-b">{{ Auth::user()->name }}</td>
                            <td class="py-2 px-4 border-b tanggal-cell">{{ \Carbon\Carbon::parse($absensi->tanggal)->format('Y-m-d') }}</td>
                            <td class="py-2 px-4 border-b">{{ $absensi->foto_izin ? 'Izin' : $absensi->status }}</td>
                            <td class="py-2 px-4 border-b">{{ $absensi->waktu_masuk ? \Carbon\Carbon::parse($absensi->waktu_masuk)->format('H:i:s') : '-' }}</td>
                            <td class="py-2 px-4 border-b">{{ $absensi->waktu_keluar ? \Carbon\Carbon::parse($absensi->waktu_keluar)->format('H:i:s') : '-' }}</td>
                            <td class="py-2 px-4 border-b">
                                @if($absensi->foto_masuk)
                                <a href="{{ asset('storage/' . $absensi->foto_masuk) }}" target="_blank">
                                    <img class="w-10 h-10 object-cover rounded-full mx-auto hover:opacity-75 transition duration-300"
                                         src="{{ asset('storage/' . $absensi->foto_masuk) }}" 
                                         alt="Foto Masuk" 
                                         title="Klik untuk memperbesar">
                                </a>
                                @else
                                <span class="text-gray-400">Tidak ada foto</span>
                                @endif
                            </td>
                            
                            <td class="py-2 px-4 border-b">
                                @if($absensi->foto_keluar)
                                <a href="{{ asset('storage/' . $absensi->foto_keluar) }}" target="_blank">
                                    <img class="w-10 h-10 object-cover rounded-full mx-auto hover:opacity-75 transition duration-300"
                                         src="{{ asset('storage/' . $absensi->foto_keluar) }}" 
                                         alt="Foto Pulang" 
                                         title="Klik untuk memperbesar">
                                </a>
                                @else
                                <span class="text-gray-400">Tidak ada foto</span>
                                @endif
                            </td>
                            
                            <td class="py-2 px-4 border-b">
                                @if($absensi->foto_izin)
                                <a href="{{ asset('storage/' . $absensi->foto_izin) }}" target="_blank">
                                    <img class="w-10 h-10 object-cover rounded-full mx-auto hover:opacity-75 transition duration-300"
                                         src="{{ asset('storage/' . $absensi->foto_izin) }}" 
                                         alt="Foto Izin" 
                                         title="Klik untuk memperbesar">
                                </a>
                                @else
                                <span class="text-gray-400">Tidak ada foto izin</span>
                                @endif
                            </td>                            
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="flex justify-between items-center mt-4">
                <!-- Page Number Display -->
                <div class="flex items-center space-x-1" id="pageNumber">
                    <!-- Previous Page Button -->
                    <button class="bg-gray-300 text-gray-700 p-2 rounded" onclick="prevPage()" id="prevButton" 
                        {{ $kehadiran->currentPage() == 1 ? 'disabled' : '' }}>
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    
                    <!-- Halaman Text -->
                    <span>Halaman {{ $kehadiran->currentPage() }}</span>
            
                    <!-- Next Page Button -->
                    <button class="bg-gray-300 text-gray-700 p-2 rounded" onclick="nextPage()" id="nextButton" 
                        {{ $kehadiran->currentPage() == $kehadiran->lastPage() ? 'disabled' : '' }}>
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
                
                <!-- Pagination Buttons -->
                <div class="flex space-x-2">
                    <!-- Previous Page Button -->
                    <button class="bg-gray-300 text-gray-700 p-2 rounded mr-2" onclick="prevPage()" id="prevButton" 
                        {{ $kehadiran->currentPage() == 1 ? 'disabled' : '' }}>
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    
                    <!-- Next Page Button -->
                    <button class="bg-gray-300 text-gray-700 p-2 rounded" onclick="nextPage()" id="nextButton" 
                        {{ $kehadiran->currentPage() == $kehadiran->lastPage() ? 'disabled' : '' }}>
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>            
        </div>
    </div>
</body>
<script>
let currentPage = {{ $kehadiran->currentPage() }};
const rowsPerPage = 1; // Set to 2 entries per page
const rows = document.querySelectorAll('.kehadiran-row');
const totalPages = Math.ceil(rows.length / rowsPerPage);

function showPage(page) {
    const start = (page - 1) * rowsPerPage;
    const end = start + rowsPerPage;
    
    rows.forEach((row, index) => {
        if (index >= start && index < end) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
    
    document.getElementById('pageNumber').textContent = `Halaman ${page}`;
    document.getElementById('prevButton').disabled = page === 1;
    document.getElementById('nextButton').disabled = page === totalPages;
}

function nextPage() {
    if (currentPage < totalPages) {
        currentPage++;
        showPage(currentPage);
    }
}

function prevPage() {
    if (currentPage > 1) {
        currentPage--;
        showPage(currentPage);
    }
}

// Initialize first page
showPage(currentPage);

function submitForm() {
    const form = document.getElementById('formIzin');
    const fileInput = document.getElementById('uploadIzin');
    
    if (fileInput.files.length > 0) {
        const formData = new FormData(form);
        
        fetch("{{ route('kehadiran.store') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.message) {
                alert('Foto izin berhasil diupload');
                window.location.reload();
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat mengupload foto izin');
        });
    }
}

document.getElementById('filterTanggal').addEventListener('change', function() {
    const selectedDate = this.value;
    const filteredRows = document.querySelectorAll('.kehadiran-row'); // Assuming each row has a class 'kehadiran-row'
    
    filteredRows.forEach(row => {
        const rowDate = row.querySelector('.tanggal-cell').textContent; // Assuming the date is in a cell with class 'tanggal-cell'
        if (rowDate === selectedDate || selectedDate === '') {
            row.style.display = ''; // Show the row if the date matches or if no date is selected
        } else {
            row.style.display = 'none'; // Hide the row if it doesn't match
        }
    });
});

</script>
@endsection
