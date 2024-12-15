<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Kehadiran PKL</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #fff;
        }

        main {
            background: #fff;
            padding: 2rem;
        }

        .container {
            max-width: 42rem;
            margin: 0 auto;
            border: 1px solid #000;
            padding: 2rem;
        }

        h1 {
            text-align: center;
            font-size: 1.25rem;
            font-weight: bold;
            margin-bottom: 1.5rem;
        }

        .info-section {
            margin-bottom: 1rem;
        }

        .info-row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-bottom: 0.5rem;
        }

        .info-label {
            width: 50%;
        }

        .info-value {
            width: 50%;
            text-align: right;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid black;
            margin-bottom: 1rem;
            font-size: 0.875rem;
        }

        th, td {
            border: 1px solid black;
            padding: 0.5rem;
        }

        th {
            background: #f3f4f6;
        }

        td.center {
            text-align: center;
        }
    </style>
</head>
<body>
    <main>
        <div class="container">
            <h1>LAPORAN KEHADIRAN PRAKTIK KERJA LAPANGAN (PKL)</h1>
            
            <div class="info-section">
                <div class="info-row">
                    <span class="info-label">Nama Siswa</span>
                    <span class="info-value">: {{ $user->name }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Sekolah</span>
                    <span class="info-value">: {{ $user->profile->sekolah->nama ?? 'Data Sekolah Tidak Tersedia' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Tanggal Mulai PKL</span>
                    <span class="info-value">: {{ $tanggalMulai }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Tanggal Selesai PKL</span>
                    <span class="info-value">: {{ $tanggalSelesai }}</span>
                </div>                
            </div>

            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Uraian</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="center">1</td>
                        <td>Hadir</td>
                        <td>{{ $hadirCount }}</td>
                    </tr>
                    <tr>
                        <td class="center">2</td>
                        <td>Izin</td>
                        <td>{{ $izinCount }}</td>
                    </tr>
                    <tr>
                        <td class="center">3</td>
                        <td>Tidak Hadir</td>
                        <td>{{ $tidakHadirCount }}</td>
                    </tr>
                    <tr>
                        <td class="center"></td>
                        <td>Jumlah Total Kehadiran</td>
                        <td>{{ $total }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>
