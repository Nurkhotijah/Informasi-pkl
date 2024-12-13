@extends('components.layout-industri')

@section('title', 'Data Sekolah')

@section('content')
<div class="bg-gray-100">
    <main class="p-6 overflow-y-auto h-full">
        <div class="max-w-7xl mx-auto bg-white p-4 sm:p-6 rounded-lg shadow-md">
            <!-- Header Section -->
            <div class="mb-4">
                <h1 class="text-xl sm:text-2xl font-bold mb-2 sm:mb-4">Kelola Data Sekolah</h1>
                <div class="flex flex-col sm:flex-row items-center justify-between space-y-2 sm:space-y-0 sm:space-x-4">
                    <div class="relative w-full sm:w-auto">
                        <input class="border rounded p-2 pl-10 w-full sm:w-64" id="search" placeholder="Cari Nama Sekolah" type="text" oninput="searchTable()">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                    </div>                
                </div>
            </div>

            <!-- Table Section -->
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border" id="schoolTable">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="py-2 px-4 border-b text-center">No</th>
                            <th class="py-2 px-4 border-b text-left">Nama Sekolah</th>
                            <th class="py-2 px-4 border-b text-left">Email Sekolah</th>
                            <th class="py-2 px-4 border-b text-left">Alamat Sekolah</th>
                            <th class="py-2 px-4 border-b text-center">Status</th>
                            <th class="py-2 px-4 border-b text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Example rows for schools -->
                        @foreach ($listSekolah as $item)
                            <tr class="school-row" data-school="smkn_1_ciomas">
                                <td class="py-2 px-4 border-b text-center">1</td>
                                <td class="py-2 px-4 border-b text-left">{{ $item->name }}</td>
                                <td class="py-2 px-4 border-b text-left">{{ $item->email }}</td>
                                <td class="py-2 px-4 border-b text-left">{{ $item->sekolah->alamat }}</td>
                                <td class="py-2 px-4 border-b text-center">
                                    <button onclick="updateStatus({{ $item->sekolah->id }})" id="status-{{ $item->sekolah->id }}" class="bg-yellow-500 text-white text-xs px-3 py-1 rounded shadow hover:bg-green-500 transition duration-300 ease-in-out">
                                        Pending
                                    </button>
                                </td>
                                <td class="py-2 px-4 border-b text-center">
                                    <div class="flex justify-center space-x-2">
                                        <button onclick="window.open('{{ route('sekolah.show', $item->sekolah->id) }}', '_blank')" class="bg-yellow-400 text-white text-xs px-3 py-1 rounded shadow hover:bg-yellow-500 transition duration-300 ease-in-out">
                                            <i class="fas fa-eye mr-1"></i> Lihat
                                        </button>                                    
                                        <button onclick="deleteSchool(1)" class="bg-red-400 text-white text-xs px-3 py-1 rounded shadow hover:bg-red-500 transition duration-300 ease-in-out">
                                            <i class="fas fa-trash mr-1"></i> Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination Section -->
            <div class="flex justify-end items-center mt-4">
                <span class="mr-4" id="pageNumber">Halaman 1</span>
                <button class="bg-gray-300 text-gray-700 p-2 rounded mr-2" onclick="prevPage()" id="prevButton" disabled>
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="bg-gray-300 text-gray-700 p-2 rounded" onclick="nextPage()" id="nextButton">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>

            <script>
                let currentPage = 1;
                const rowsPerPage = 5;
                const rows = document.querySelectorAll('.school-row');
                const totalPages = Math.ceil(rows.length / rowsPerPage);
                
                function showPage(page) {
                    const start = (page - 1) * rowsPerPage;
                    const end = start + rowsPerPage;
                    
                    rows.forEach((row, index) => {
                        if (index >= start && index < end) {
                            row.style.display = '';
                            // Update nomor urut
                            row.querySelector('td:first-child').textContent = index + 1;
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
                showPage(1);
            </script>
        </div>
    </main>
</div>

<script>
    // Function to handle searching in the table
    function searchTable() {
        const searchInput = document.getElementById('search').value.toLowerCase();
        const rows = document.querySelectorAll('.school-row');
        rows.forEach(row => {
            const schoolName = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
            if (schoolName.includes(searchInput)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    // Function to update status
    function updateStatus(schoolId) {
        const statusButton = document.getElementById(`status-${schoolId}`);
        if (statusButton.textContent.trim() === 'Pending') {
            statusButton.textContent = 'Diterima';
            statusButton.classList.remove('bg-yellow-500');
            statusButton.classList.add('bg-green-500');
            // Here you would make an API call to update the status in the backend
            // fetch('/api/school/status/' + schoolId, {
            //     method: 'POST',
            //     headers: {
            //         'Content-Type': 'application/json',
            //     },
            //     body: JSON.stringify({
            //         status: 'accepted'
            //     })
            // });
        }
    }
   
    // Function to view students for a selected school
    function viewStudents(school) {
        alert(`Menampilkan siswa untuk sekolah: ${school}`);
        // Here you would redirect to another page or load student data dynamically
    }

    // Function to handle deletion of school data
    function deleteSchool(schoolId) {
        if (confirm('Apakah Anda yakin ingin menghapus data sekolah ini?')) {
            alert(`Data sekolah dengan ID ${schoolId} dihapus.`);
            // Here, you would normally call an API to delete the school
        }
    }

   
</script>

@endsection