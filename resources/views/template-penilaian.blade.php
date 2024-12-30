<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penilaian PKL</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .logo {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 100px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #4a5568; /* Warna gray-700 */
        }

        .info {
            margin-bottom: 20px;
        }

        .info p {
            margin: 8px 0;
            font-size: 16px;
            color: #4a5568; /* Warna gray-700 */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            border: 1px solid #dddddd;
            padding: 10px;
            text-align: center;
        }

        table th {
            background-color: #f4f4f4;
            color: #4a5568; /* Warna gray-700 */
            font-weight: bold;
        }

        table td {
            color: #4a5568; /* Warna gray-700 */
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="{{ public_path('assets/certificate/qelopak.png') }}" alt="Logo" class="logo">
        <h1>Penilaian PKL</h1>
        <div class="info">
            <p><strong>Nama Siswa:</strong> {{ $penilaian->user->name }}</p>
            <p><strong>Sekolah:</strong> {{ $penilaian->user->profile->sekolah->nama }}</p>
            <p><strong>Periode PKL:</strong> {{ \Carbon\Carbon::parse($tanggalMulai)->format('d F Y') }} - {{ \Carbon\Carbon::parse($tanggalSelesai)->format('d F Y') }}</p>
        </div>        
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Aspek Penilaian</th>
                    <th>Nilai</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Nilai Sikap</td>
                    <td>{{ $penilaian->sikap }}</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Nilai Microteaching</td>
                    <td>{{ $penilaian->microteaching }}</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Nilai Kehadiran</td>
                    <td>{{ $penilaian->kehadiran }}</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Nilai Project</td>
                    <td>{{ $penilaian->project }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
