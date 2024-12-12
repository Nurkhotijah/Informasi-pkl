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
                            <th class="py-2 px-4 border-b text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Contoh baris data siswa -->
                        <tr class="student-row" data-id="1">
                            <td class="py-2 px-4 border-b text-center">1</td>
                            <td class="py-2 px-4 border-b text-left">Budi Santoso</td>
                            <td class="py-2 px-4 border-b text-left">PPLG</td>
                            <td class="py-2 px-4 border-b text-center">
                                <a href="/path/to/grades/budi_santoso.pdf" target="_blank" class="text-blue-500 hover:underline">
                                    Unduh PDF
                                </a>
                            </td>
                            <td class="py-2 px-4 border-b text-center">
                                <a href="/path/to/attendance/budi_santoso.pdf" target="_blank" class="text-blue-500 hover:underline">
                                    Unduh PDF
                                </a>
                            </td>
                            <td class="py-2 px-4 border-b text-center">
                                <a href="/path/to/certificates/budi_santoso.pdf" target="_blank" class="text-blue-500 hover:underline">
                                    Unduh PDF
                                </a>
                            </td>
                            <td class="py-2 px-4 border-b text-center">
                                <button onclick="openReportPopup(1)" class="text-blue-500 hover:underline">
                                    Lihat Laporan
                                </button>
                            </td>
                            <td class="py-2 px-4 border-b text-center">
                                <button onclick="deleteStudent(1)" class="bg-red-400 text-white text-xs px-3 py-1 rounded shadow hover:bg-red-500 transition duration-300 ease-in-out">
                                    <i class="fas fa-trash mr-1"></i> Hapus
                                </button>
                            </td>
                        </tr>
                        <tr class="student-row" data-id="2">
                            <td class="py-2 px-4 border-b text-center">2</td>
                            <td class="py-2 px-4 border-b text-left">Siti Aisyah</td>
                            <td class="py-2 px-4 border-b text-left">PPLG</td>
                            <td class="py-2 px-4 border-b text-center">
                                <a href="/path/to/grades/siti_aisyah.pdf" target="_blank" class="text-blue-500 hover:underline">
                                    Unduh PDF
                                </a>
                            </td>
                            <td class="py-2 px-4 border-b text-center">
                                <a href="/path/to/attendance/siti_aisyah.pdf" target="_blank" class="text-blue-500 hover:underline">
                                    Unduh PDF
                                </a>
                            </td>
                            <td class="py-2 px-4 border-b text-center">
                                <a href="/path/to/certificates/siti_aisyah.pdf" target="_blank" class="text-blue-500 hover:underline">
                                    Unduh PDF
                                </a>
                            </td>
                            <td class="py-2 px-4 border-b text-center">
                                <button onclick="openReportPopup(1)" class="text-blue-500 hover:underline">
                                    Lihat Laporan
                                </button>
                            </td>                            
                            <td class="py-2 px-4 border-b text-center">
                                <button onclick="deleteStudent(2)" class="bg-red-400 text-white text-xs px-3 py-1 rounded shadow hover:bg-red-500 transition duration-300 ease-in-out">
                                    <i class="fas fa-trash mr-1"></i> Hapus
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- Pop-up Laporan PKL Siswa -->
<div id="reportPopup" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
    <div class="bg-white p-6 rounded shadow-lg w-1/3">
        <h2 class="text-xl font-semibold mb-4">Laporan PKL Siswa</h2>
        <div id="reportContent">
            <!-- Konten laporan akan dimuat di sini -->
        </div>
        <button onclick="closeReportPopup()" class="bg-red-400 text-white px-4 py-2 rounded mt-4 hover:bg-red-500">
            Tutup
        </button>
    </div>
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
    // Fungsi untuk membuka pop-up dan menampilkan laporan
function openReportPopup(studentId) {
    // Menentukan URL atau konten yang ingin ditampilkan di dalam pop-up
    var reportUrl = `/path/to/reports/siswa_${studentId}.pdf`;

    // Memasukkan laporan ke dalam div #reportContent
    var reportContent = `
        <iframe src="${reportUrl}" width="100%" height="400px"></iframe>
    `;
    document.getElementById('reportContent').innerHTML = reportContent;

    // Menampilkan pop-up
    document.getElementById('reportPopup').classList.remove('hidden');
}

// Fungsi untuk menutup pop-up
function closeReportPopup() {
    // Menyembunyikan pop-up
    document.getElementById('reportPopup').classList.add('hidden');
}

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