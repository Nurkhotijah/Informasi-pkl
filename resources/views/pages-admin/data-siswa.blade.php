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
                        <input class="border rounded p-2 pl-10 w-full sm:w-64" id="search" placeholder="Cari Nama Sekolah" type="text" oninput="searchTable()">
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
                            <tr class="student-row" data-id="1">
                                <td class="py-2 px-4 border-b text-center">{{ $loop->iteration }}</td>
                                <td class="py-2 px-4 border-b text-left">{{ $item->name }}</td>
                                <td class="py-2 px-4 border-b text-left">{{ $item->user->pengajuan->jurusan ?? 'Jurusan Tidak Tersedia' }}</td>
                                <td class="py-2 px-4 border-b text-center">
                                    <a href="{{ route('penilaiansiswa.unduh', $item->id) }}" target="_blank" class="inline-flex items-center justify-center p-2 bg-blue-500 text-white rounded hover:bg-blue-600"> 
                                        <i class="fas fa-eye mr-1"></i> 
                                    </a>                                                                      
                                </td>
                                <td class="py-2 px-4 border-b text-center">
                                    <a href="{{ route('kehadiransiswa.unduh', ['userId' => $item->id]) }}" target="_blank" class="inline-flex items-center justify-center p-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                                        <i class="fas fa-eye mr-1"></i>                                   
                                     </a>
                                </td>
                                
                                <td class="py-2 px-4 border-b text-center">
                                    <a href="{{ route('cetak-sertifikat-siswa', $item->id) }}" target="_blank" class="inline-flex items-center justify-center p-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                                        <i class="fas fa-eye mr-1"></i>                                    
                                    </a>
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