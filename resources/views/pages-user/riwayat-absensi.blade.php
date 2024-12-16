@extends('components.layout-user')

@section('title', 'Riwayat Kehadiran')

@section('content')
<!-- Main Content -->
<main class="bg-gray-100 p-8">
    <div class="container mx-auto bg-white p-6 shadow-lg rounded-lg">
        <h1 class="text-2xl font-bold mb-4">Riwayat Kehadiran</h1>
        <!-- Tombol Upload Foto Izin dan Filter Tanggal -->
        <div class="mt-4 sm:mt-0 mb-4 flex items-center justify-between">
            <div class="flex absensis-center space-x-4">
                <form action="{{ route('kehadiran.store') }}" method="POST" enctype="multipart/form-data" id="formIzin">
                    @csrf
                    <input type="hidden" name="jenis_absen" value="masuk">
                    <label for="uploadIzin" class="bg-blue-500 text-white text-xs px-6 py-3 rounded shadow hover:bg-blue-600 transition duration-300 ease-in-out cursor-pointer flex absensis-center w-auto">
                        <i class="fas fa-upload mr-2"></i> Upload Foto Izin
                    </label>
                    <input type="file" id="uploadIzin" name="foto_izin" class="hidden" accept="image/jpeg, image/png" onchange="submitForm()">
                </form>    

                <!-- Tombol Unduh Rekap Kehadiran -->
                <a class="bg-green-500 text-white text-xs px-6 py-3 rounded-lg hover:bg-green-600 transition duration-300 ease-in-out flex absensis-center space-x-2 w-auto" 
                   href="{{ route('rekap.kehadiran') }}">
                    <i class="fas fa-download"></i>
                    <span>Rekap Kehadiran</span>
                </a>
            </div>
            <!-- Filter Tanggal -->
            <div>
                <input type="date" id="filterTanggal" class="border rounded p-2" onchange="filterByDate()">
            </div>
        </div>

        <!-- Tabel Riwayat Kehadiran -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
                <thead class="bg-gray-200">
                    <tr class="text-gray-600 text-sm">
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b border-gray-300">No</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b border-gray-300">Nama Lengkap</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b border-gray-300">Tanggal</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b border-gray-300">Status</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b border-gray-300">Waktu Masuk</th>
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700 border-b border-gray-300">Waktu Keluar</th>
                        <th class="py-3 px-4 text-center text-sm font-semibold text-gray-700 border-b border-gray-300">Foto Masuk</th>
                        <th class="py-3 px-4 text-center text-sm font-semibold text-gray-700 border-b border-gray-300">Foto Keluar</th>
                        <th class="py-3 px-4 text-center text-sm font-semibold text-gray-700 border-b border-gray-300">Foto izin</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @foreach($kehadiran as $absensi)
                    @php
                        $tanggalAbsen = \Carbon\Carbon::parse($absensi->tanggal);
                        $now = \Carbon\Carbon::now();
                        $diffInHours = $tanggalAbsen->diffInHours($now);
                        
                        // Set status tidak hadir jika lebih dari 24 jam tidak ada aktivitas
                        if ($diffInHours >= 24 && !$absensi->foto_masuk && !$absensi->foto_keluar && !$absensi->foto_izin) {
                            $absensi->status = 'Tidak Hadir';
                            $absensi->save();
                        }
                    @endphp
                    <tr class="bg-white hover:bg-gray-50 transition duration-200 ease-in-out kehadiran-row">
                        <td class="py-4 px-4 border-b border-gray-300 text-gray-700">{{ $loop->iteration + ($kehadiran->currentPage() - 1) * $kehadiran->perPage() }}</td>
                        <td class="py-4 px-4 border-b border-gray-300 text-gray-800">{{ Auth::user()->name }}</td>
                        <td class="py-4 px-4 border-b border-gray-300 text-gray-600 tanggal-cell">{{ $tanggalAbsen->format('Y-m-d') }}</td>
                        <td class="py-4 px-4 border-b border-gray-300 text-gray-600">{{ $absensi->foto_izin ? 'Izin' : $absensi->status }}</td>
                        <td class="py-4 px-4 border-b border-gray-300 text-gray-600">{{ $absensi->waktu_masuk ? \Carbon\Carbon::parse($absensi->waktu_masuk)->format('H:i:s') : '-' }}</td>
                        <td class="py-4 px-4 border-b border-gray-300 text-gray-600">{{ $absensi->waktu_keluar ? \Carbon\Carbon::parse($absensi->waktu_keluar)->format('H:i:s') : '-' }}</td>
                        <td class="py-4 px-4 border-b border-gray-300 text-center">
                            @if($absensi->foto_masuk)
                            <a href="{{ asset('storage/' . $absensi->foto_masuk) }}" target="_blank">
                                <img class="w-16 h-16 object-cover rounded-full mx-auto hover:opacity-75 transition duration-300" 
                                     src="{{ asset('storage/' . $absensi->foto_masuk) }}" 
                                     alt="Foto Masuk"
                                     title="Klik untuk memperbesar">
                            </a>
                            @else
                            <span class="text-gray-400">Tidak ada foto</span>
                            @endif
                        </td>
                        <td class="py-4 px-4 border-b border-gray-300 text-center">
                            @if($absensi->foto_keluar)
                            <a href="{{ asset('storage/' . $absensi->foto_keluar) }}" target="_blank">
                                <img class="w-16 h-16 object-cover rounded-full mx-auto hover:opacity-75 transition duration-300" 
                                     src="{{ asset('storage/' . $absensi->foto_keluar) }}" 
                                     alt="Foto Keluar"
                                     title="Klik untuk memperbesar">
                            </a>
                            @else
                            <span class="text-gray-400">Tidak ada foto</span>
                            @endif
                        </td>
                        <td class="py-4 px-4 border-b border-gray-300 text-center">
                            @if($absensi->foto_izin)
                            <a href="{{ asset('storage/' . $absensi->foto_izin) }}" target="_blank">
                                <img class="w-16 h-16 object-cover rounded-full mx-auto hover:opacity-75 transition duration-300" 
                                     src="{{ asset('storage/' . $absensi->foto_izin) }}" 
                                     alt="Foto Izin"
                                     title="Klik untuk memperbesar">
                            </a>
                            @else
                            <span class="text-gray-400">Tidak ada foto izin</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="flex justify-end absensis-center mt-4">
            <span class="mr-4" id="pageNumber">Halaman {{ $kehadiran->currentPage() }}</span>
            <button class="bg-gray-300 text-gray-700 p-2 rounded mr-2" @if($kehadiran->onFirstPage()) disabled @endif onclick="window.location='{{ $kehadiran->previousPageUrl() }}'">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button class="bg-gray-300 text-gray-700 p-2 rounded" @if(!$kehadiran->hasMorePages()) disabled @endif onclick="window.location='{{ $kehadiran->nextPageUrl() }}'">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    </div>
</main>

<script>
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
