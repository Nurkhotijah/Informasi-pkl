@extends('components.layout-industri')

@section('title', 'Jurnal Siswa')

@section('content')
  
<main class="p-6 overflow-y-auto h-full">
    <div class="max-w-7xl mx-auto bg-white p-4 sm:p-6 rounded-lg shadow-md">
        <!-- Header Section -->
        <div class="mb-4">
            <h1 class="text-xl sm:text-2xl font-bold mb-2 sm:mb-4">Jurnal Siswa</h1>
            <div class="flex flex-col sm:flex-row items-center justify-between space-y-2 sm:space-y-0 sm:space-x-4">
                <div class="relative w-full sm:w-auto">
                    <input class="border rounded-l p-2 pl-10 w-full sm:w-64" id="search" name="search" placeholder="Cari Nama atau sekolah" type="text" value="{{ request()->get('search') }}" oninput="searchTable()">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>
            </div>
        </div>

        <!-- Table Section -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border" id="pengajuanTable">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="py-2 px-4 border-b text-center">No</th>
                        <th class="py-2 px-4 border-b text-left">Nama Lengkap</th>
                        <th class="py-2 px-4 border-b text-left">Sekolah</th>
                        <th class="py-2 px-4 border-b text-center">Laporan PKL</th>
                        <th class="py-2 px-4 border-b text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jurnal as $item)
                    <tr>
                        <td class="py-2 px-4 border-b text-center">{{ $loop->iteration }}</td>
                        <td class="py-2 px-4 border-b text-left">{{ $item->name }}</td> <!-- Menampilkan Nama Siswa -->
                        <td class="py-2 px-4 border-b text-left">{{ $item->profile->sekolah->nama }}</td> <!-- Menampilkan Nama Sekolah -->
                        <td class="py-2 px-4 border-b text-center">
                            @if ($item->laporan)
                            <a href="{{ asset('storage/' . $item->laporan->file_path) }}"  class="inline-flex items-center justify-center p-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                                <i class="fas fa-file-pdf"></i> 
                            </a><!-- Klik untuk melihat laporan -->
                            @else
                                <p>Tidak ada laporan</p>
                            @endif
                        </td>
                        
                        <td class="py-2 px-4 border-b text-center">
                            <div class="flex justify-center space-x-2">
                                <a href="{{ route('jurnal-industri.detail', $item->id) }}" class="bg-blue-500 text-white text-xs px-3 py-1 rounded shadow hover:bg-blue-600 transition duration-300 ease-in-out">
                                    <i class="fas fa-eye mr-1"></i> Lihat
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>                
            </table>
        </div>

        <!-- Modal untuk Preview Laporan -->
        {{-- <div id="reportModal" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center hidden">
            <div class="bg-white p-4 rounded-lg shadow-lg max-w-4xl w-full">
                <div class="flex justify-between items-center">
                    <h3 class="text-xl font-bold">Preview Laporan</h3>
                    <button onclick="closeReportPreview()" class="text-gray-500 hover:text-gray-700">×</button>
                </div>
                <div id="reportContent" class="mt-4">
                    <!-- Isi laporan akan ditampilkan di sini -->
                </div>
            </div>
        </div> --}}

    </div>
</main>

<script>
    // Fungsi untuk menampilkan modal dan preview file laporan
    function showReportPreview(fileUrl) {
        const modal = document.getElementById('reportModal');
        const reportContent = document.getElementById('reportContent');
        
        // Menampilkan laporan sesuai dengan tipe file
        reportContent.innerHTML = `<embed src="${fileUrl}" width="100%" height="500px" type="application/pdf">`;

        // Menampilkan modal
        modal.classList.remove('hidden');
    }

    // Fungsi untuk menutup modal
    function closeReportPreview() {
        const modal = document.getElementById('reportModal');
        modal.classList.add('hidden');
    }

    function searchTable() {
        const input = document.getElementById('search');
        const filter = input.value.toLowerCase();
        const table = document.getElementById('pengajuanTable');
        const tr = table.getElementsByTagName('tr');

        for (let i = 1; i < tr.length; i++) {
            const tdName = tr[i].getElementsByTagName('td')[1];
            const tdSchool = tr[i].getElementsByTagName('td')[2];
            if (tdName || tdSchool) {
                const txtValueName = tdName.textContent || tdName.innerText;
                const txtValueSchool = tdSchool.textContent || tdSchool.innerText;
                if (txtValueName.toLowerCase().indexOf(filter) > -1 || txtValueSchool.toLowerCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }       
        }
    }
</script>

@endsection
