@extends('components.layout-admin')

@section('title', 'Pengajuan Siswa')

@section('content')

<main class="p-6 overflow-y-auto h-full">
    <div class="max-w-7xl mx-auto bg-white p-4 sm:p-6 rounded-lg shadow-md">
        <div class="flex justify-between mb-4">
            <h1 class="text-2xl font-bold">Pengajuan Izin Siswa</h1>
            <div class="flex items-center">
                <label class="mr-2" for="date">Pilih Tanggal:</label>
                <input class="border rounded p-2" id="date" type="date" onchange="searchByDate()" />
            </div>
        </div>

        <div class="flex items-center mb-4 relative">
            <input class="border rounded-l p-2 pl-10 w-full sm:w-64" id="search" placeholder="Cari Nama" type="text" />
            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i> 
            <button class="bg-blue-500 text-white p-2 rounded-r" onclick="searchTable()">Cari</button>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border rounded-lg shadow-md" id="izinTable">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="py-3 px-5 border-b text-center font-semibold">No</th>
                        <th class="py-3 px-5 border-b text-left font-semibold">Nama Lengkap</th>
                        <th class="py-3 px-5 border-b text-center font-semibold">Tanggal Pengajuan</th>
                        <th class="py-3 px-5 border-b text-left font-semibold">Alasan</th>
                        <th class="py-3 px-5 border-b text-left font-semibold">Foto Keterangan</th>
                        <th class="py-3 px-5 border-b text-center font-semibold">Status</th>
                        <th class="py-3 px-5 border-b text-center font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr class="hover:bg-gray-50">
                        <td class="py-3 px-5 text-center">1</td>
                        <td class="py-3 px-5 text-left">Siswa A</td>
                        <td class="py-3 px-5 text-center">2023-10-01</td>
                        <td class="py-3 px-5 text-left">Sakit</td>
                        <td class="py-3 px-5 text-center">
                            <a href="foto_surat_sakit.jpg" target="_blank" class="text-blue-500 underline">Lihat Foto</a>
                        </td>
                        <td class="py-3 px-5 text-center">
                            <span class="text-green-600 font-semibold">Setujui</span>
                        </td>
                        <td class="py-3 px-5 text-center">
                            <button class="bg-yellow-400 text-white text-sm px-4 py-2 rounded-full shadow-lg hover:bg-yellow-500 transition duration-300 ease-in-out flex items-center transform hover:scale-105">
                                <i class=" mr-2"></i>Lihat
                            </button>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="py-3 px-5 text-center">2</td>
                        <td class="py-3 px-5 text-left">Siswa B</td>
                        <td class="py-3 px-5 text-center">2023-10-02</td>
                        <td class="py-3 px-5 text-left">Izin Keluarga</td>
                        <td class="py-3 px-5 text-center">
                            <a href="foto_surat_izin.jpg" target="_blank" class="text-blue-500 underline">Lihat Foto</a>
                        </td>
                        <td class="py-3 px-5 text-center">
                            <span class="text-yellow-600 font-semibold">Proses</span>
                        </td>
                        <td class="py-3 px-5 text-center">
                            <button class="bg-yellow-400 text-white text-sm px-4 py-2 rounded-full shadow-lg hover:bg-yellow-500 transition duration-300 ease-in-out flex items-center transform hover:scale-105">
                                <i class=" mr-2"></i>Lihat
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

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
let currentPage = 1; // Halaman saat ini
const rowsPerPage = 10; // Jumlah data per halaman

// Fungsi untuk menampilkan data berdasarkan halaman
function displayTableData(page) {
    const table = document.getElementById("izinTable").getElementsByTagName("tbody")[0];
    const rows = table.getElementsByTagName("tr");

    const start = (page - 1) * rowsPerPage;
    const end = start + rowsPerPage;

    for (let i = 0; i < rows.length; i++) {
        rows[i].style.display = i >= start && i < end ? "" : "none";
    }
    document.getElementById("pageNumber").textContent = `Halaman ${page}`;
}

// Paginasi - tombol berikutnya
function nextPage() {
    const table = document.getElementById("izinTable").getElementsByTagName("tbody")[0];
    const rows = table.getElementsByTagName("tr");

    if (currentPage * rowsPerPage < rows.length) {
        currentPage++;
        displayTableData(currentPage);
    }
}

// Paginasi - tombol sebelumnya
function prevPage() {
    if (currentPage > 1) {
        currentPage--;
        displayTableData(currentPage);
    }
}

// Inisialisasi tabel untuk halaman pertama
displayTableData(currentPage);

document.getElementById('profileButton').onclick = () => {
    document.getElementById('profileDropdown').classList.toggle('hidden');
};

document.addEventListener('click', (event) => {
    if (!document.getElementById('profileButton').contains(event.target) &&
        !document.getElementById('profileDropdown').contains(event.target)) {
        document.getElementById('profileDropdown').classList.add('hidden');
    }
});

function searchTable() {
    const searchValue = document.getElementById("search").value.toLowerCase();
    const rows = document.querySelectorAll("#izinTable tbody tr");
    rows.forEach(row => {
        const name = row.children[1].textContent.toLowerCase();
        const className = row.children[2].textContent.toLowerCase();
        if (name.includes(searchValue) || className.includes(searchValue)) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    });
}

function searchByDate() {
    const date = document.getElementById("date").value;
    const rows = document.querySelectorAll("#izinTable tbody tr");
    rows.forEach(row => {
        const submissionDate = row.children[3].textContent.trim();
        if (submissionDate.includes(date)) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    });
}
</script>
@endsection