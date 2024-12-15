<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penilaian PKL</title>
    <style>
        body {
            background-color: white;
            padding: 32px;
            font-family: Arial, sans-serif;
        }
        
        .container {
            max-width: 672px;
            margin: 0 auto;
            border: 1px solid #000;
            padding: 32px;
        }
        
        h1 {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 32px;
        }
        
        .info {
            margin-bottom: 16px;
        }
        
        .info-row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-bottom: 8px;
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
            margin-bottom: 16px;
            font-size: 14px;
        }
        
        th, td {
            border: 1px solid black;
            padding: 8px;
        }
        
        th {
            background-color: #f3f4f6;
        }
        
        td.center {
            text-align: center;
        }
        
        .button-container {
            display: flex;
            justify-content: flex-end;
        }
        
        .print-button {
            background-color: #4ade80;
            color: white;
            font-size: 12px;
            padding: 8px 20px;
            border: none;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        .print-button:hover {
            background-color: #22c55e;
        }
        
        @media (min-width: 768px) {
            .info-label, .info-value {
                width: auto;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>PENILAIAN PRAKTIK KERJA LAPANGAN (PKL)</h1>
        
        <div class="info">
            <div class="info-row">
                <span class="info-label">Nama Siswa</span>
                <span class="info-value">: {{ $penilaian->user->name }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Sekolah</span>
                <span class="info-value">: {{ $penilaian->user->profile->sekolah->nama ?? 'Data Sekolah Tidak Tersedia' }}</span>
            </div>
           
        </div>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kategori Penilaian</th>
                    <th>Nilai</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="center">1</td>
                    <td>Nilai Sikap</td>
                    <td>{{ $penilaian->sikap }}</td>
                </tr>
                <tr>
                    <td class="center">2</td>
                    <td>Nilai Microteaching</td>
                    <td>{{ $penilaian->microteaching }}</td>
                </tr>
                <tr>
                    <td class="center">3</td>
                    <td>Nilai Kehadiran</td>
                    <td>{{ $penilaian->kehadiran }}</td>
                </tr>
                <tr>
                    <td class="center">4</td>
                    <td>Nilai Project</td>
                    <td>{{ $penilaian->project }}</td>
                </tr>
            </tbody>
        </table>

    </div>
</body>
</html>
