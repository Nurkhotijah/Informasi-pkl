@extends('components.layout-industri')

@section('title', 'Edit Nilai Siswa')

@section('content')

<div class="overflow-x-auto">
    {{-- <form action="{{ route('submit-data') }}" method="POST"> --}}
        @csrf
        <div class="space-y-6">
            <!-- Aspek Kepribadian (Aspek Non-Teknis) -->
            <h2 class="text-lg font-semibold text-gray-700">A. Aspek Kepribadian (Aspek Non-Teknis)</h2>
            <table class="min-w-full bg-white border">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="py-2 px-4 border-b text-center">No</th>
                        <th class="py-2 px-4 border-b text-left">Kemampuan</th>
                        <th class="py-2 px-4 border-b text-center">Nilai (Angka)</th>
                        <th class="py-2 px-4 border-b text-center">Nilai (Huruf)</th>
                        <th class="py-2 px-4 border-b text-left">Kualifikasi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="py-2 px-4 border-b text-center">1</td>
                        <td class="py-2 px-4 border-b text-left">Disiplin Waktu</td>
                        <td class="py-2 px-4 border-b text-center">
                            <input type="number" name="nilai_disiplin_waktu_angka" class="border rounded px-2 py-1 w-full" placeholder="Angka">
                        </td>
                        <td class="py-2 px-4 border-b text-center">
                            <input type="text" name="nilai_disiplin_waktu_huruf" class="border rounded px-2 py-1 w-full" placeholder="Huruf">
                        </td>
                        <td class="py-2 px-4 border-b text-left">
                            <input type="text" name="kualifikasi_disiplin_waktu" class="border rounded px-2 py-1 w-full" placeholder="Kualifikasi">
                        </td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 border-b text-center">2</td>
                        <td class="py-2 px-4 border-b text-left">Kemampuan Kerja / Motivasi</td>
                        <td class="py-2 px-4 border-b text-center">
                            <input type="number" name="nilai_kemampuan_kerja_angka" class="border rounded px-2 py-1 w-full" placeholder="Angka">
                        </td>
                        <td class="py-2 px-4 border-b text-center">
                            <input type="text" name="nilai_kemampuan_kerja_huruf" class="border rounded px-2 py-1 w-full" placeholder="Huruf">
                        </td>
                        <td class="py-2 px-4 border-b text-left">
                            <input type="text" name="kualifikasi_kemampuan_kerja" class="border rounded px-2 py-1 w-full" placeholder="Kualifikasi">
                        </td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 border-b text-center">3</td>
                        <td class="py-2 px-4 border-b text-left">Kualitas Kerja</td>
                        <td class="py-2 px-4 border-b text-center">
                            <input type="number" name="nilai_kualitas_kerja_angka" class="border rounded px-2 py-1 w-full" placeholder="Angka">
                        </td>
                        <td class="py-2 px-4 border-b text-center">
                            <input type="text" name="nilai_kualitas_kerja_huruf" class="border rounded px-2 py-1 w-full" placeholder="Huruf">
                        </td>
                        <td class="py-2 px-4 border-b text-left">
                            <input type="text" name="kualifikasi_kualitas_kerja" class="border rounded px-2 py-1 w-full" placeholder="Kualifikasi">
                        </td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 border-b text-center">4</td>
                        <td class="py-2 px-4 border-b text-left">Inisiatif dan Kreatif</td>
                        <td class="py-2 px-4 border-b text-center">
                            <input type="number" name="nilai_inisiatif_angka" class="border rounded px-2 py-1 w-full" placeholder="Angka">
                        </td>
                        <td class="py-2 px-4 border-b text-center">
                            <input type="text" name="nilai_inisiatif_huruf" class="border rounded px-2 py-1 w-full" placeholder="Huruf">
                        </td>
                        <td class="py-2 px-4 border-b text-left">
                            <input type="text" name="kualifikasi_inisiatif" class="border rounded px-2 py-1 w-full" placeholder="Kualifikasi">
                        </td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 border-b text-center">5</td>
                        <td class="py-2 px-4 border-b text-left">Perilaku / Keselamatan Kerja</td>
                        <td class="py-2 px-4 border-b text-center">
                            <input type="number" name="nilai_perilaku_angka" class="border rounded px-2 py-1 w-full" placeholder="Angka">
                        </td>
                        <td class="py-2 px-4 border-b text-center">
                            <input type="text" name="nilai_perilaku_huruf" class="border rounded px-2 py-1 w-full" placeholder="Huruf">
                        </td>
                        <td class="py-2 px-4 border-b text-left">
                            <input type="text" name="kualifikasi_perilaku" class="border rounded px-2 py-1 w-full" placeholder="Kualifikasi">
                        </td>
                    </tr>
                </tbody>
            </table>
        
            <!-- Aspek Produktif -->
            <h2 class="text-lg font-semibold text-gray-700 mt-6">B. Aspek Produktif</h2>
            <table class="min-w-full bg-white border">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="py-2 px-4 border-b text-center">No</th>
                        <th class="py-2 px-4 border-b text-left">Kemampuan</th>
                        <th class="py-2 px-4 border-b text-center">Nilai (Angka)</th>
                        <th class="py-2 px-4 border-b text-center">Nilai (Huruf)</th>
                        <th class="py-2 px-4 border-b text-left">Kualifikasi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="py-2 px-4 border-b text-center">1</td>
                        <td class="py-2 px-4 border-b text-left">Kemampuan A</td>
                        <td class="py-2 px-4 border-b text-center">
                            <input type="number" name="nilai_kemampuan_a_angka" class="border rounded px-2 py-1 w-full" placeholder="Angka">
                        </td>
                        <td class="py-2 px-4 border-b text-center">
                            <input type="text" name="nilai_kemampuan_a_huruf" class="border rounded px-2 py-1 w-full" placeholder="Huruf">
                        </td>
                        <td class="py-2 px-4 border-b text-left">
                            <input type="text" name="kualifikasi_kemampuan_a" class="border rounded px-2 py-1 w-full" placeholder="Kualifikasi">
                        </td>
                    </tr>
                    <tr>
                        <td class="py-2 px-4 border-b text-center">2</td>
                        <td class="py-2 px-4 border-b text-left">Kemampuan B</td>
                        <td class="py-2 px-4 border-b text-center">
                            <input type="number" name="nilai_kemampuan_b_angka" class="border rounded px-2 py-1 w-full" placeholder="Angka">
                        </td>
                        <td class="py-2 px-4 border-b text-center">
                            <input type="text" name="nilai_kemampuan_b_huruf" class="border rounded px-2 py-1 w-full" placeholder="Huruf">
                        </td>
                        <td class="py-2 px-4 border-b text-left">
                            <input type="text" name="kualifikasi_kemampuan_b" class="border rounded px-2 py-1 w-full" placeholder="Kualifikasi">
                        </td>
                    </tr>
                    <!-- Tambahkan lebih banyak baris sesuai kebutuhan -->
                </tbody>
            </table>
        
            <div class="flex justify-end mt-6">
                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600">Simpan</button>
            </div>
        </div>        
    </form>
</div>
<script>
    document.querySelector('form').addEventListener('submit', function(e) {
    e.preventDefault(); // Mencegah reload halaman

    // Mendapatkan nilai dari form
    const attendanceData = {
        name: document.getElementById('name').value,
        school: document.getElementById('school').value,
        date: document.getElementById('date').value,
        checkInTime: document.getElementById('checkInTime').value,
        checkOutTime: document.getElementById('checkOutTime').value,
        status: document.getElementById('status').value
    };

    // Simpan data ke database (contoh: console.log untuk simulasi)
    console.log("Data yang disimpan:", attendanceData);

    // Notifikasi data berhasil disimpan
    alert('Data berhasil disimpan!');

    // Arahkan kembali ke halaman "Kelola nilai"
    window.location.href = '/kelola-nilai'; // Ganti dengan path halaman Kelola nilai yang benar
});
</script>
@endsection