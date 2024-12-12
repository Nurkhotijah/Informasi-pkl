@extends('components.layout-industri')

@section('title', 'Data Penilaian Siswa')

@section('content')

<div class="bg-gray-100">
    <main class="p-6 overflow-y-auto h-full">
        <div class="max-w-7xl mx-auto bg-white p-4 sm:p-6 rounded-lg shadow-md">
            <!-- Header Section -->
            <div class="mb-4">
                <h1 class="text-xl sm:text-2xl font-bold mb-2 sm:mb-4">Kelola Nilai Siswa</h1>
                <div class="flex flex-col sm:flex-row items-center justify-between space-y-2 sm:space-y-0 sm:space-x-4">
                    <div class="relative w-full sm:w-auto">
                        <input class="border rounded-l p-2 pl-10 w-full sm:w-64" id="search" placeholder="Cari Nama atau sekolah" type="text" oninput="searchTable()">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                    </div>
                    <!-- Tombol Tambah -->
<div class="flex justify-end mb-4">
    <a href="{{ route('tambah-nilai', 1) }}" class="bg-green-500 text-white text-xs px-4 py-2 rounded shadow hover:bg-green-600 transition duration-300 ease-in-out" onclick="openAddForm()">
        <i class="fas fa-plus mr-2"></i> Tambah 
    </a>
</div>

                    <div class="flex items-center w-full sm:w-auto sm:ml-auto">
                        <label class="mr-2" for="school">Pilih Sekolah:</label>
                        <select class="border rounded p-2 w-full sm:w-auto" id="school" onchange="filterBySchool()">
                            <option value="">Pilih Sekolah</option>
                            <option value="smkn_1_ciomas">SMKN 1 Ciomas</option>
                            <option value="smk_komputer_indonesia">SMK Komputer Indonesia</option>
                            <option value="smk_adi_sanggoro">SMK Adi Sanggoro</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Table Section -->
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border" id="attendanceTable">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="py-2 px-4 border-b text-center">No</th>
                            <th class="py-2 px-4 border-b text-left">Nama Lengkap</th>
                            <th class="py-2 px-4 border-b text-left">Sekolah</th>
                            <th class="py-2 px-4 border-b text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="py-2 px-4 border-b text-center">1</td>
                            <td class="py-2 px-4 border-b text-left">Fitri Amaliah</td>
                            <td class="py-2 px-4 border-b text-left">SMKN 1 Ciomas</td>
                            <td class="py-2 px-4 border-b text-center">
                                <div class="flex justify-center space-x-2">
                                    <a href="{{ route('edit-nilai', 1) }}" class="bg-yellow-400 text-white text-xs px-3 py-1 rounded shadow hover:bg-yellow-500 transition duration-300 ease-in-out">
                                        <i class="fas fa-edit mr-1"></i> Edit
                                    </a>
                                    <button class="bg-blue-400 text-white text-xs px-3 py-1 rounded shadow hover:bg-blue-500 transition duration-300 ease-in-out" onclick="viewPhoto(1)">
                                        <i class="fas fa-eye mr-1"></i> Lihat
                                    </button>
                                    <a href="{{ route('cetak-nilai', 1) }}" target="_blank" class="bg-green-400 text-white text-xs px-3 py-1 rounded shadow hover:bg-green-500 transition duration-300 ease-in-out">
                                        <i class="fas fa-print mr-1"></i> Cetak
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4 border-b text-center">2</td>
                            <td class="py-2 px-4 border-b text-left">Marsya</td>
                            <td class="py-2 px-4 border-b text-left">SMK Komputer Indonesia</td>
                            <td class="py-2 px-4 border-b text-center">
                                <div class="flex justify-center space-x-2">
                                    <a href="{{ route('edit-nilai', 2) }}" class="bg-yellow-400 text-white text-xs px-3 py-1 rounded shadow hover:bg-yellow-500 transition duration-300 ease-in-out">
                                        <i class="fas fa-edit mr-1"></i> Edit
                                    </a>
                                    <button class="bg-blue-400 text-white text-xs px-3 py-1 rounded shadow hover:bg-blue-500 transition duration-300 ease-in-out" onclick="viewPhoto(2)">
                                        <i class="fas fa-eye mr-1"></i> Lihat
                                    </button>
                                    <a href="{{ route('cetak-nilai', 2) }}" target="_blank" class="bg-green-400 text-white text-xs px-3 py-1 rounded shadow hover:bg-green-500 transition duration-300 ease-in-out">
                                        <i class="fas fa-print mr-1"></i> Cetak
                                    </a>
                                </div>
                            </td>
                        </tr>
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
      
        let currentPage = 1; // Halaman saat ini
        const rowsPerPage = 10; // Jumlah data per halaman

        // Fungsi untuk menampilkan data berdasarkan halaman
        function displayTableData(page) {
            const table = document.getElementById("attendanceTable").getElementsByTagName("tbody")[0];
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
            const table = document.getElementById("attendanceTable").getElementsByTagName("tbody")[0];
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

        function searchTable() {
            const searchValue = document.getElementById("search").value.toLowerCase();
            const rows = document.querySelectorAll("#attendanceTable tbody tr");
            rows.forEach(row => {
                const name = row.children[1].textContent.toLowerCase();
                const school = row.children[2].textContent.toLowerCase();
                if (name.includes(searchValue) || school.includes(searchValue)) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        }

        window.onload = function() {
            populateSchoolDropdown();
        };

        function populateSchoolDropdown() {
            const rows = document.querySelectorAll("#attendanceTable tbody tr");
            const schoolDropdown = document.getElementById("school");

            const schools = new Set(); // Using a Set to ensure no duplicates

            rows.forEach(row => {
                const school = row.children[2].textContent.trim(); // Get the school name
                schools.add(school); // Add school to the Set (duplicates will be ignored)
            });

            // Clear the dropdown before adding new options
            schoolDropdown.innerHTML = '<option value="">Pilih Sekolah</option>'; 

            // Add the schools to the dropdown
            schools.forEach(school => {
                const option = document.createElement("option");
                option.value = school.toLowerCase().replace(/\s+/g, '_'); // Convert school name to a suitable format for value
                option.textContent = school;
                schoolDropdown.appendChild(option);
            });
        }

        function filterBySchool() {
            const school = document.getElementById("school").value.toLowerCase();
            const rows = document.querySelectorAll("#attendanceTable tbody tr");

            rows.forEach(row => {
                const rowSchool = row.children[2].textContent.toLowerCase().replace(/\s+/g, '_');
                if (school === "" || rowSchool.includes(school)) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        }
    </script>
</div>

@endsection