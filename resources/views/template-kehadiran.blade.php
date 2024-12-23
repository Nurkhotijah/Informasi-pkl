<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Template Kehadiran</title>
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
            color: #4a5568; /* Changed to gray-700 */
        }

        .info {
            margin-bottom: 20px;
        }

        .info p {
            margin: 8px 0;
            font-size: 16px;
            color: #4a5568; /* Changed to gray-700 */
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
            color: #4a5568; /* Changed to gray-700 */
            font-weight: bold;
        }

        table td {
            color: #4a5568; /* Changed to gray-700 */
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="{{ public_path('assets/certificate/qelopak.png') }}" alt="Logo" class="logo">
        <h1>Kehadiran</h1>

        <div class="info">
            <p><strong>Nama Siswa:</strong> {{ $user->name }}</p>
            <p><strong>Sekolah:</strong> {{ $user->profile->sekolah->nama ?? 'Data Sekolah Tidak Tersedia' }}</p>
            <p><strong>Tanggal Mulai PKL:</strong> {{ $tanggalMulai }}</p>
            <p><strong>Tanggal Selesai PKL:</strong> {{ $tanggalSelesai }}</p>
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
                    <td>1</td>
                    <td>Hadir</td>
                    <td>{{ $hadirCount }}</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Izin</td>
                    <td>{{ $izinCount }}</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Tidak Hadir</td>
                    <td>{{ $tidakHadirCount }}</td>
                </tr>
                <tr>
                    <td colspan="2"><strong>Total Kehadiran</strong></td>
                    <td><strong>{{ $total }}</strong></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
