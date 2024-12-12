@extends('components.layout-admin')

@section('title', 'Data Penilaian Siswa')

@section('content')

<body class="bg-gray-100 p-8">
    <div class="bg-white p-8 rounded shadow-md max-w-4xl mx-auto">
        <h1 class="text-center text-xl font-bold mb-4">FORM PENILAIAN HASIL PRAKTIK KERJA LAPANGAN</h1>
        <div class="mb-4">
            <h2 class="font-semibold">A. Aspek Kepribadian (Aspek Non Teknis)</h2>
            <table class="w-full border-collapse border border-gray-400 mt-2">
                <thead>
                    <tr>
                        <th class="border border-gray-400 p-2">NO</th>
                        <th class="border border-gray-400 p-2">KEMAMPUAN</th>
                        <th class="border border-gray-400 p-2" colspan="2">NILAI</th>
                        <th class="border border-gray-400 p-2">KUALIFIKASI</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border border-gray-400 p-2 text-center">1</td>
                        <td class="border border-gray-400 p-2">Disiplin Waktu</td>
                        <td class="border border-gray-400 p-2"></td>
                        <td class="border border-gray-400 p-2"></td>
                        <td class="border border-gray-400 p-2"></td>
                    </tr>
                    <tr>
                        <td class="border border-gray-400 p-2 text-center">2</td>
                        <td class="border border-gray-400 p-2">Kemampuan Kerja / Motivasi</td>
                        <td class="border border-gray-400 p-2"></td>
                        <td class="border border-gray-400 p-2"></td>
                        <td class="border border-gray-400 p-2"></td>
                    </tr>
                    <tr>
                        <td class="border border-gray-400 p-2 text-center">3</td>
                        <td class="border border-gray-400 p-2">Kualitas Kerja</td>
                        <td class="border border-gray-400 p-2"></td>
                        <td class="border border-gray-400 p-2"></td>
                        <td class="border border-gray-400 p-2"></td>
                    </tr>
                    <tr>
                        <td class="border border-gray-400 p-2 text-center">4</td>
                        <td class="border border-gray-400 p-2">Inisiatif dan Kreatif</td>
                        <td class="border border-gray-400 p-2"></td>
                        <td class="border border-gray-400 p-2"></td>
                        <td class="border border-gray-400 p-2"></td>
                    </tr>
                    <tr>
                        <td class="border border-gray-400 p-2 text-center">5</td>
                        <td class="border border-gray-400 p-2">Perilaku / Keselamatan Kerja</td>
                        <td class="border border-gray-400 p-2"></td>
                        <td class="border border-gray-400 p-2"></td>
                        <td class="border border-gray-400 p-2"></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="mb-4">
            <h2 class="font-semibold">B. Aspek Produktif (Aspek Pekerjaan/Teknis) *diisi oleh IDUKA</h2>
            <table class="w-full border-collapse border border-gray-400 mt-2">
                <thead>
                    <tr>
                        <th class="border border-gray-400 p-2">NO</th>
                        <th class="border border-gray-400 p-2">KEMAMPUAN</th>
                        <th class="border border-gray-400 p-2" colspan="2">NILAI</th>
                        <th class="border border-gray-400 p-2">KUALIFIKASI</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border border-gray-400 p-2 text-center">1</td>
                        <td class="border border-gray-400 p-2"></td>
                        <td class="border border-gray-400 p-2"></td>
                        <td class="border border-gray-400 p-2"></td>
                        <td class="border border-gray-400 p-2"></td>
                    </tr>
                    <tr>
                        <td class="border border-gray-400 p-2 text-center">2</td>
                        <td class="border border-gray-400 p-2"></td>
                        <td class="border border-gray-400 p-2"></td>
                        <td class="border border-gray-400 p-2"></td>
                        <td class="border border-gray-400 p-2"></td>
                    </tr>
                    <tr>
                        <td class="border border-gray-400 p-2 text-center">3</td>
                        <td class="border border-gray-400 p-2"></td>
                        <td class="border border-gray-400 p-2"></td>
                        <td class="border border-gray-400 p-2"></td>
                        <td class="border border-gray-400 p-2"></td>
                    </tr>
                    <tr>
                        <td class="border border-gray-400 p-2 text-center">4</td>
                        <td class="border border-gray-400 p-2"></td>
                        <td class="border border-gray-400 p-2"></td>
                        <td class="border border-gray-400 p-2"></td>
                        <td class="border border-gray-400 p-2"></td>
                    </tr>
                    <tr>
                        <td class="border border-gray-400 p-2 text-center">5</td>
                        <td class="border border-gray-400 p-2"></td>
                        <td class="border border-gray-400 p-2"></td>
                        <td class="border border-gray-400 p-2"></td>
                        <td class="border border-gray-400 p-2"></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            <p class="text-sm">Keterangan :</p>
            <ul class="text-sm list-disc list-inside">
                <li>80 s/d 100 : A = Sangat Baik</li>
                <li>70 s/d 79 : B = Baik</li>
                <li>60 s/d 69 : C = Cukup</li>
                <li>0 s/d 59 : D = Kurang</li>
            </ul>
            <div class="mt-4">
                <p class="text-sm">Rata - rata Nilai A = ______ Huruf = ______</p>
                <p class="text-sm">Rata - rata Nilai B = ______ Huruf = ______</p>
            </div>
            <div class="mt-4">
                <p class="text-sm">Bogor, ___________________ 20____</p>
                <p class="text-sm">Pembimbing Industri dan Dunia Kerja (IDUKA)</p>
            </div>
        </div>
    </div>
</body>


@endsection