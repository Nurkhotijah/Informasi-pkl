@extends('components.layout-admin')

@section('title', 'Pengajuan Siswa')

@section('content')
<div class="bg-gray-100">
    <main class="p-6 overflow-y-auto h-full">
        <div class="max-w-7xl mx-auto bg-white p-4 sm:p-6 rounded-lg shadow-md">
            <!-- Header Section -->
            <div class="mb-4">
                <h1 class="text-xl sm:text-2xl font-bold mb-2 sm:mb-4">Pengajuan Siswa</h1>
                <div class="flex flex-col sm:flex-row items-center justify-between space-y-2 sm:space-y-0 sm:space-x-4">
                    <div class="relative w-full sm:w-auto">
                        <input class="border rounded p-2 pl-10 w-full sm:w-64" id="search" placeholder="Cari Tahun" type="text" oninput="searchTable()">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                    </div>
                </div>
            </div>

            <!-- Add Button Outside Table -->
            <div class="mb-4">
                <a href="{{ route('pengajuan.tambah') }}" class="bg-blue-500 text-white text-xs px-4 py-2 rounded shadow hover:bg-blue-600 transition duration-300 ease-in-out">
                    <i class="fas fa-plus mr-2"></i>Tambah Data
                </a>
            </div>

            <!-- Table Section -->
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border" id="studentTable">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="py-2 px-4 border-b text-center">No</th>
                            <th class="py-2 px-4 border-b text-center">Tahun</th>
                            <th class="py-2 px-4 border-b text-left">Nama Pembimbing</th>
                            <th class="py-2 px-4 border-b text-left">Judul PKL</th>
                            <th class="py-2 px-4 border-b text-center">Lampiran</th>
                            <th class="py-2 px-4 border-b text-center">Status</th>
                            <th class="py-2 px-4 border-b text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pengajuan as $item)
                        <tr>
                            <td class="py-2 px-4 border-b text-center">{{ $loop->iteration }}</td>
                            <td class="py-2 px-4 border-b text-center">{{ $item->tahun }}</td>
                            <td class="py-2 px-4 border-b">{{ $item->pembimbing }}</td>
                            <td class="py-2 px-4 border-b">{{ $item->judul_pkl }}</td>
                            <td class="py-2 px-4 border-b text-center">
                                <a href="{{ asset('storage/' . $item->lampiran) }}" target="_blank" class="text-blue-500 hover:underline">Download</a>
                            </td>
                            <td class="py-2 px-4 border-b text-center">
                                @if ($item->status_sekolah == 'pending')
                                    <span class="bg-yellow-200 text-yellow-800 text-xs px-2 py-1 rounded-full">Pending</span>
                                @elseif ($item->status_sekolah == 'diterima')
                                    <span class="bg-green-200 text-green-800 text-xs px-2 py-1 rounded-full">Diterima</span>
                            </td>
                            <td class="py-2 px-4 border-b text-center">
                               
                                <a href="{{ route('pengajuan.lihat', $item->id) }}" class="bg-green-500 text-white text-xs px-3 py-1 rounded hover:bg-green-600 transition duration-300">
                                    Lihat
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

<script>
    function searchTable() {
        const input = document.getElementById('search');
        const filter = input.value.toLowerCase();
        const table = document.getElementById('studentTable');
        const rows = table.getElementsByTagName('tr');

        for (let i = 1; i < rows.length; i++) {
            const yearCell = rows[i].getElementsByTagName('td')[1]; // Index 1 adalah kolom tahun
            if (yearCell) {
                const yearText = yearCell.textContent || yearCell.innerText;
                if (yearText.toLowerCase().indexOf(filter) > -1) {
                    rows[i].style.display = '';
                } else {
                    rows[i].style.display = 'none';
                }
            }
        }
    }
</script>

@endsection
