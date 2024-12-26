@extends('components.layout-admin')

@section('title', 'Pengajuan Siswa')

@section('content')

<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-2xl font-bold">Data PKL</h1>
            </div>
            <div class="mb-4 flex justify-between items-center">
                <div class="relative w-1/3">
                        <input class="border rounded p-2 pl-10 w-full sm:w-64" id="search" name="search" placeholder="Cari Tahun " type="text" value="{{ request('search') }}">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>              
                 </div>
                <a href="{{ Auth::user()->sekolah->status === 'diterima' ? route('pkl.create') : '#' }}" 
                    class="bg-green-500 text-white text-xs px-4 py-2 rounded shadow hover:bg-green-600 transition duration-300 ease-in-out" 
                    {{ Auth::user()->sekolah->status !== 'diterima' ? 'disabled' : '' }}>
                    <i class="fas fa-plus mr-2"></i>Tambah Data
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full table-auto border-collapse">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="py-2 px-4 text-center">No</th>
                            <th class="py-2 px-4 text-left">Judul PKL</th>
                            <th class="py-2 px-4 text-center">Tahun Ajaran</th>
                            <th class="py-2 px-4 text-left">Nama Pembimbing</th>
                            <th class="py-2 px-4 text-center">Lampiran</th>
                            <th class="py-2 px-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pengajuan as $item)
                        <tr>
                            <td class="py-2 px-4 border-b text-center">{{ $loop->iteration }}</td>
                            <td class="py-2 px-4 border-b ">{{ $item->judul_pkl }}</td>
                            <td class="py-2 px-4 border-b text-center">{{ $item->tahun }}</td>
                            <td class="py-2 px-4 border-b">{{ $item->pembimbing }}</td>
                            <td class="py-2 px-4 border-b text-center">
                                <a href="{{ asset('storage/' . $item->lampiran) }}" target="_blank" class="bg-blue-500 text-white text-xs px-3 py-1 rounded hover:bg-blue-600 transition duration-300">
                                    <i class="fas fa-file-pdf"></i>
                                </a>
                            </td>
                            <td class="py-2 px-4 border-b text-center">
                                <a href="{{ route('pengajuan.index', $item->id) }}" class="bg-blue-500 text-white text-xs px-3 py-1 rounded hover:bg-blue-600 transition duration-300">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

<script>
    const ITEMS_PER_PAGE = 10;
    let currentPage = 1;
    let filteredData = [];

    function initializeTable() {
        const tableBody = document.querySelector('#attendanceTable tbody');
        const rows = Array.from(tableBody.querySelectorAll('tr'));
        filteredData = rows;
        updateTableDisplay();
    }


    function searchTable() {
    const searchTerm = document.getElementById('search').value.toLowerCase();
    const tableBody = document.querySelector('#attendanceTable tbody');
    const rows = Array.from(tableBody.querySelectorAll('tr'));
    
    filteredData = rows.filter(row => {
        const nameCell = row.querySelector('td:nth-child(2)');
        const schoolCell = row.querySelector('td:nth-child(3)');
        return nameCell.textContent.toLowerCase().includes(searchTerm) || 
               schoolCell.textContent.toLowerCase().includes(searchTerm);
    });
    
    currentPage = 1;
    updateTableDisplay();
    }
    function updateTableDisplay() {
        const tableBody = document.querySelector('#attendanceTable tbody');
        const startIndex = (currentPage - 1) * ITEMS_PER_PAGE;
        const endIndex = startIndex + ITEMS_PER_PAGE;
        
        tableBody.querySelectorAll('tr').forEach(row => {
            row.style.display = 'none';
        });
        
        filteredData.slice(startIndex, endIndex).forEach(row => {
            row.style.display = '';
        });
        
        updatePaginationControls();
    }

</script>

@endsection
