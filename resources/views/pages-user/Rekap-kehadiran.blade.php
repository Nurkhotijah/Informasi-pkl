@extends('components.layout-user')

@section('title', 'Rekap Kehadiran')

@section('content')

<body class="bg-gray-100 p-8">
    <div class="bg-white max-w-2xl mx-auto border p-8">
        <h1 class="text-center text-xl font-bold mb-8">REKAPITULASI KEHADIRAN PKL</h1>
        <div class="mb-4">
            <div class="flex justify-between mb-2">
                <span>Nama Siswa</span>
                <span>: ....................................................</span>
            </div>
            <div class="flex justify-between mb-2">
                <span>Program Keahlian</span>
                <span>: ....................................................</span>
            </div>
            <div class="flex justify-between mb-2">
                <span>Nama Instansi / Perusahaan</span>
                <span>: ....................................................</span>
            </div>
            <div class="flex justify-between mb-2">
                <span>Lama Praktik</span>
                <span>: ....................................................</span>
            </div>
        </div>
        <table class="w-full border-collapse border border-black mb-4">
            <thead>
                <tr>
                    <th class="border border-black p-2">No</th>
                    <th class="border border-black p-2">Uraian</th>
                    <th class="border border-black p-2">Tingkat Kehadiran</th>
                    <th class="border border-black p-2">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border border-black p-2 text-center">1</td>
                    <td class="border border-black p-2">Hadir</td>
                    <td class="border border-black p-2">_________ Hari</td>
                    <td class="border border-black p-2"></td>
                </tr>
                <tr>
                    <td class="border border-black p-2 text-center">2</td>
                    <td class="border border-black p-2">Sakit</td>
                    <td class="border border-black p-2">_________ Hari</td>
                    <td class="border border-black p-2"></td>
                </tr>
                <tr>
                    <td class="border border-black p-2 text-center">3</td>
                    <td class="border border-black p-2">Izin Tertulis</td>
                    <td class="border border-black p-2">_________ Hari</td>
                    <td class="border border-black p-2"></td>
                </tr>
                <tr>
                    <td class="border border-black p-2 text-center">4</td>
                    <td class="border border-black p-2">Tanpa Izin</td>
                    <td class="border border-black p-2">_________ Hari</td>
                    <td class="border border-black p-2"></td>
                </tr>
                <tr>
                    <td class="border border-black p-2 text-center"></td>
                    <td class="border border-black p-2 font-bold">Jumlah</td>
                    <td class="border border-black p-2">_________ Hari</td>
                    <td class="border border-black p-2"></td>
                </tr>
            </tbody>
        </table>
        <div class="mb-4">
            <div class="flex justify-between mb-2">
                <span>Dibuat tanggal</span>
                <span>: _________ 20____</span>
            </div>
        </div>
        <div class="flex justify-between mb-4">
            <div class="text-center">
                <p>Mengetahui,</p>
                <p>Pembimbing Industri dan Dunia Kerja</p>
                <p>(IDUKA)</p>
                <br><br><br>
                <p>________________________</p>
                <p>NIP</p>
            </div>
            <div class="text-center">
                <p>Pembimbing Sekolah (1)</p>
                <br><br><br>
                <p>________________________</p>
                <p>NIP</p>
            </div>
        </div>
    </div>
</body>



@endsection