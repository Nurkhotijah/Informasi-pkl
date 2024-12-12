@extends('components.layout-industri')

@section('title', 'Tambah Nilai Siswa')

@section('content')

<main class="overflow-x-auto">
    @csrf
    <div class="space-y-6 bg-white shadow-lg p-8 rounded-xl">
        <!-- Step 1: Nama Siswa dan Sekolah -->
        <div id="step-1">
            <div class="flex space-x-4">
                <div class="flex-1">
                    <label for="nama_siswa" class="block text-sm font-semibold text-gray-700">Nama Siswa</label>
                    <select id="nama_siswa" name="nama_siswa" class="border rounded px-3 py-2 w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="">Pilih Nama Siswa</option>
                        <option value="siswa1">Siswa 1</option>
                        <option value="siswa2">Siswa 2</option>
                        <option value="siswa3">Siswa 3</option>
                    </select>
                    </div>
                <div class="flex-1">
                    <label for="sekolah_siswa" class="block text-sm font-semibold text-gray-700">Sekolah Siswa</label>
                    <select id="sekolah_siswa" name="sekolah_siswa" class="border rounded px-3 py-2 w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="">Pilih Sekolah</option>
                        <option value="sekolah1">Sekolah 1</option>
                        <option value="sekolah2">Sekolah 2</option>
                        <option value="sekolah3">Sekolah 3</option>
                    </select>
                </div>
            </div>
            <div class="mt-4 flex justify-end">
                <button type="button" class="bg-blue-500 text-white py-2 px-4 rounded" onclick="nextStep(2)">Selanjutnya</button>
            </div>
        </div>

        <!-- Step 2: Aspek kemampuan_kerjapribadian (Aspek Non-Teknis) -->
        <div id="step-2" class="hidden">
            <h2 class="text-lg font-semibold text-gray-700 mt-6">A. Aspek Kepribadian (Aspek Non-Teknis)</h2>
            <table class="min-w-full bg-white border rounded-lg shadow-sm text-xs">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-2 px-3 border-b text-center">No</th>
                        <th class="py-2 px-3 border-b text-left">Kemampuan</th>
                        <th class="py-2 px-3 border-b text-center">Nilai (Angka)</th>
                        <th class="py-2 px-3 border-b text-center">Nilai (Huruf)</th>
                        <th class="py-2 px-3 border-b text-left">Kualifikasi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="py-2 px-3 border-b text-center">1</td>
                        <td class="py-2 px-3 border-b text-left">Disiplin Waktu</td>
                        <td class="py-2 px-3 border-b text-center">
                            <input type="number" name="nilai_disiplin_waktu_angka" class="border rounded px-2 py-1 w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Angka">
                        </td>
                        <td class="py-2 px-3 border-b text-center">
                            <input type="text" name="nilai_disiplin_waktu_huruf" class="border rounded px-2 py-1 w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Huruf">
                        </td>
                        <td class="py-2 px-3 border-b text-left">
                            <input type="text" name="kualifikasi_disiplin_waktu" class="border rounded px-2 py-1 w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Kualifikasi">
                        </td>
                    </tr>
                    <tr>
                        <td class="py-2 px-3 border-b text-center">2</td>
                        <td class="py-2 px-3 border-b text-left">Kemampuan Kerja/Motivasi</td>
                        <td class="py-2 px-3 border-b text-center">
                            <input type="number" name="nilai_kemampuan_kerja_angka" class="border rounded px-2 py-1 w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Angka">
                        </td>
                        <td class="py-2 px-3 border-b text-center">
                            <input type="text" name="nilai_kemampuan_kerja_huruf" class="border rounded px-2 py-1 w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Huruf">
                        </td>
                        <td class="py-2 px-3 border-b text-left">
                            <input type="text" name="kualifikasi_kemampuan_kerja" class="border rounded px-2 py-1 w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Kualifikasi">
                        </td>
                    </tr>
                    <tr>
                        <td class="py-2 px-3 border-b text-center">3</td>
                        <td class="py-2 px-3 border-b text-left">Kualitas Kerja</td>
                        <td class="py-2 px-3 border-b text-center">
                            <input type="number" name="nilai_kualitas_kerja_angka" class="border rounded px-2 py-1 w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Angka">
                        </td>
                        <td class="py-2 px-3 border-b text-center">
                            <input type="text" name="nilai_kualitas_kerja_huruf" class="border rounded px-2 py-1 w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Huruf">
                        </td>
                        <td class="py-2 px-3 border-b text-left">
                            <input type="text" name="kualifikasi_kualitas_kerja" class="border rounded px-2 py-1 w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Kualifikasi">
                        </td>
                    </tr>
                    <tr>
                        <td class="py-2 px-3 border-b text-center">4</td>
                        <td class="py-2 px-3 border-b text-left">Inisiatif dan Kreatif</td>
                        <td class="py-2 px-3 border-b text-center">
                            <input type="number" name="nilai_inisiatif_kreatif_angka" class="border rounded px-2 py-1 w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Angka">
                        </td>
                        <td class="py-2 px-3 border-b text-center">
                            <input type="text" name="nilai_inisiatif_kreatif_huruf" class="border rounded px-2 py-1 w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Huruf">
                        </td>
                        <td class="py-2 px-3 border-b text-left">
                            <input type="text" name="kualifikasi_inisiatif_kreatif" class="border rounded px-2 py-1 w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Kualifikasi">
                        </td>
                    </tr>
                    <tr>
                        <td class="py-2 px-3 border-b text-center">5</td>
                        <td class="py-2 px-3 border-b text-left">Perilaku/Keselamatan Kerja</td>
                        <td class="py-2 px-3 border-b text-center">
                            <input type="number" name="nilai_perilaku_keselamatan_angka" class="border rounded px-2 py-1 w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Angka">
                        </td>
                        <td class="py-2 px-3 border-b text-center">
                            <input type="text" name="nilai_perilaku_keselamatan_huruf" class="border rounded px-2 py-1 w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Huruf">
                        </td>
                        <td class="py-2 px-3 border-b text-left">
                            <input type="text" name="kualifikasi_perilaku_keselamatan" class="border rounded px-2 py-1 w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Kualifikasi">
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="mt-4 flex justify-between">
                <button type="button" class="bg-gray-500 text-white py-2 px-4 rounded" onclick="prevStep(1)">Sebelumnya</button>
                <button type="button" class="bg-blue-500 text-white py-2 px-4 rounded" onclick="nextStep(3)">Selanjutnya</button>
            </div>
        </div>
        
       <!-- Step 3: Aspek Produktif -->
<div id="step-3" class="hidden">
    <h2 class="text-lg font-semibold text-gray-700 mt-6">B. Aspek Produktif</h2>
    <table class="min-w-full bg-white border rounded-lg shadow-sm text-xs">
        <thead class="bg-gray-100">
            <tr>
                <th class="py-2 px-3 border-b text-center">No</th>
                <th class="py-2 px-3 border-b text-left">Kemampuan</th>
                <th class="py-2 px-3 border-b text-center">Nilai (Angka)</th>
                <th class="py-2 px-3 border-b text-center">Nilai (Huruf)</th>
                <th class="py-2 px-3 border-b text-left">Kualifikasi</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="py-2 px-3 border-b text-center">1</td>
                <td class="py-2 px-3 border-b text-left">Kemampuan Kerja A</td>
                <td class="py-2 px-3 border-b text-center">
                    <input type="number" name="nilai_kemampuan_kerja_a_angka" class="border rounded px-2 py-1 w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Angka">
                </td>
                <td class="py-2 px-3 border-b text-center">
                    <input type="text" name="nilai_kemampuan_kerja_a_huruf" class="border rounded px-2 py-1 w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Huruf">
                </td>
                <td class="py-2 px-3 border-b text-left">
                    <input type="text" name="kualifikasi_kemampuan_kerja_a" class="border rounded px-2 py-1 w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Kualifikasi">
                </td>
            </tr>
            <tr>
                <td class="py-2 px-3 border-b text-center">2</td>
                <td class="py-2 px-3 border-b text-left">Kemampuan Kerja B</td>
                <td class="py-2 px-3 border-b text-center">
                    <input type="number" name="nilai_kemampuan_kerja_b_angka" class="border rounded px-2 py-1 w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Angka">
                </td>
                <td class="py-2 px-3 border-b text-center">
                    <input type="text" name="nilai_kemampuan_kerja_b_huruf" class="border rounded px-2 py-1 w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Huruf">
                </td>
                <td class="py-2 px-3 border-b text-left">
                    <input type="text" name="kualifikasi_kemampuan_kerja_b" class="border rounded px-2 py-1 w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Kualifikasi">
                </td>
            </tr>
            <tr>
                <td class="py-2 px-3 border-b text-center">3</td>
                <td class="py-2 px-3 border-b text-left">Kemampuan Kerja C</td>
                <td class="py-2 px-3 border-b text-center">
                    <input type="number" name="nilai_kemampuan_kerja_c_angka" class="border rounded px-2 py-1 w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Angka">
                </td>
                <td class="py-2 px-3 border-b text-center">
                    <input type="text" name="nilai_kemampuan_kerja_c_huruf" class="border rounded px-2 py-1 w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Huruf">
                </td>
                <td class="py-2 px-3 border-b text-left">
                    <input type="text" name="kualifikasi_kemampuan_kerja_c" class="border rounded px-2 py-1 w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Kualifikasi">
                </td>
            </tr>
            <tr>
                <td class="py-2 px-3 border-b text-center">4</td>
                <td class="py-2 px-3 border-b text-left">Kemampuan Kerja D</td>
                <td class="py-2 px-3 border-b text-center">
                    <input type="number" name="nilai_kemampuan_kerja_d_angka" class="border rounded px-2 py-1 w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Angka">
                </td>
                <td class="py-2 px-3 border-b text-center">
                    <input type="text" name="nilai_kemampuan_kerja_d_huruf" class="border rounded px-2 py-1 w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Huruf">
                </td>
                <td class="py-2 px-3 border-b text-left">
                    <input type="text" name="kualifikasi_kemampuan_kerja_d" class="border rounded px-2 py-1 w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Kualifikasi">
                </td>
            </tr>
            <tr>
                <td class="py-2 px-3 border-b text-center">5</td>
                <td class="py-2 px-3 border-b text-left">Kemampuan Kerja E</td>
                <td class="py-2 px-3 border-b text-center">
                    <input type="number" name="nilai_kemampuan_kerja_e_angka" class="border rounded px-2 py-1 w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Angka">
                </td>
                <td class="py-2 px-3 border-b text-center">
                    <input type="text" name="nilai_kemampuan_kerja_e_huruf" class="border rounded px-2 py-1 w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Huruf">
                </td>
                <td class="py-2 px-3 border-b text-left">
                    <input type="text" name="kualifikasi_kemampuan_kerja_e" class="border rounded px-2 py-1 w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Kualifikasi">
                </td>
            </tr>
        </tbody>
    </table>
    <div class="mt-6">
        <label for="signature_industry" class="block text-sm font-semibold text-gray-700">Tanda Tangan Industri</label>
        <input type="file" id="signature_industry" name="signature_industry" accept="image/*" class="border rounded px-2 py-1 w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 mt-2">
        <small class="text-gray-500">Upload foto tanda tangan dari supervisor industri (format: JPG, PNG, JPEG)</small>
    </div>
    <div class="mt-4 flex justify-between">
        <button type="button" class="bg-gray-500 text-white py-2 px-4 rounded" onclick="prevStep(2)">Sebelumnya</button>
        <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded">Simpan</button>
    </div>
</div>

    </div>
</main>

<script>
     document.getElementById('attendanceForm').addEventListener('submit', function(e) {
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

    // Fungsi untuk menampilkan langkah berikutnya
    function nextStep(step) {
        // Sembunyikan langkah saat ini
        document.getElementById('step-' + (step - 1)).classList.add('hidden');
        // Tampilkan langkah berikutnya
        document.getElementById('step-' + step).classList.remove('hidden');
    }

    // Fungsi untuk menampilkan langkah sebelumnya
    function prevStep(step) {
        // Sembunyikan langkah saat ini
        document.getElementById('step-' + (step + 1)).classList.add('hidden');
        // Tampilkan langkah sebelumnya
        document.getElementById('step-' + step).classList.remove('hidden');
    }
</script>

@endsection