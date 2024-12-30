@extends('components.layout-industri')

@section('title', 'Data Sekolah')

@section('content')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

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
                        @if (session('success'))
                    <div class="bg-green-500 text-white px-4 py-3 rounded shadow-md mb-4">
                        <p>{{ session('success') }}</p>
                    </div>
                @endif

                @if (session('error'))
                    <div class="bg-red-500 text-white px-4 py-3 rounded shadow-md mb-4">
                        <p>{{ session('error') }}</p>
                    </div>
                @endif
                        <tr>
                            <th class="py-2 px-4 border-b text-center">No</th>
                            <th class="py-2 px-4 border-b text-left">Nama Sekolah</th>
                            <th class="py-2 px-4 border-b text-left">Email</th>
                            <th class="py-2 px-4 border-b text-left">Alamat</th>
                            <th class="py-2 px-4 border-b text-center">Status</th>
                            <th class="py-2 px-4 border-b text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Example rows for schools -->
                        @foreach ($listSekolah as $item)
                            <tr class="school-row" data-school="smkn_1_ciomas">
                                <td class="py-2 px-4 border-b text-center">{{ $loop->iteration }}</td>
                                <td class="py-2 px-4 border-b text-left">{{ $item->name }}</td>
                                <td class="py-2 px-4 border-b text-left">{{ $item->email }}</td>
                                <td class="py-2 px-4 border-b text-left">{{ $item->sekolah->alamat }}</td>
                                <td class="py-2 px-4 border-b text-center">
                                    <form action="/sekolah/{{ $item->sekolah->id }}/update-status" method="POST">
                                        @csrf
                                        <button type="submit" 
                                            class="text-xs px-3 py-1 rounded shadow transition duration-300 ease-in-out
                                                @if ($item->sekolah->status === 'pending')
                                                    bg-yellow-200 text-yellow-800 text-xs px-2 py-1 rounded-full
                                                @elseif ($item->sekolah->status === 'diterima')
                                                    bg-green-200 text-green-800 text-xs px-2 py-1 rounded-full
                                                @endif">
                                            {{ $item->sekolah->status }}
                                        </button>
                                    </form>
                                    
                                </td>                                
                                <td class="py-2 px-4 border-b text-center">
                                    <div class="flex justify-center space-x-2">
                                        <button onclick="window.location.href='{{ route('sekolah.show', $item->sekolah->id) }}'" class="bg-blue-500 text-white text-xs px-3 py-1 rounded shadow hover:bg-blue-600 transition duration-300 ease-in-out">
                                            <i class="fas fa-eye"></i> 
                                        </button>                                                                         
                                        <button onclick="deleteSchool({{ $item->sekolah->id }})" class="bg-red-500 text-white text-xs px-3 py-1 rounded shadow hover:bg-red-600 transition duration-300 ease-in-out">
                                            <i class="fas fa-trash"></i> 
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

   
    // Function to view students for a selected school
    function viewStudents(school) {
        alert(`Menampilkan siswa untuk sekolah: ${school}`);
        // Here you would redirect to another page or load student data dynamically
    }

    // Function to handle deletion of school data
    function deleteSchool(schoolId) {
        if (confirm('Apakah Anda yakin ingin menghapus data sekolah ini?')) {
            const url = `{{ route('sekolah.delete', ':schoolId') }}`.replace(':schoolId', schoolId);

            fetch(url, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // If using Laravel CSRF protection
                }
            })
            .then(response => {
                if (response.ok) {
                    alert(`Data sekolah berhasil dihapus.`);
                    location.reload();
                } else {
                    alert('Terjadi kesalahan saat menghapus data sekolah.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Gagal menghapus data sekolah. Coba lagi nanti.');
            });
        }
    }

   
</script>
  
        </div>
    </main>
</div>

@endsection