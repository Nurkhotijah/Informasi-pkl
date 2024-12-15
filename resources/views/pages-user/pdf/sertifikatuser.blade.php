<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sertifikat PKL</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f4f4f4;
            height: 100vh;
        }

        .certificate {
            width: 800px;
            height: 600px;
            border: 10px solid #4a90e2;
            background: white;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            position: relative;
            text-align: center;
            box-sizing: border-box; /* Ensure padding is included in the width/height */
        }

        .certificate h1 {
            font-size: 2.5rem;
            color: #333;
            margin-bottom: 10px;
        }

        .certificate h2 {
            font-size: 1.8rem;
            color: #333;
            margin-bottom: 20px;
        }

        .certificate p {
            font-size: 1rem;
            color: #555;
            margin: 15px 0;
            line-height: 1.6;
        }

        .certificate .name {
            font-size: 1.5rem;
            font-weight: bold;
            color: #000;
            margin: 20px 0;
        }

        .certificate .signature {
            margin-top: 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 30px;
        }

        .certificate .signature div {
            text-align: center;
        }

        .certificate .signature div p {
            margin: 5px 0;
        }

        .certificate .signature div span {
            display: block;
            border-top: 1px solid #333;
            margin-top: 5px;
            font-size: 0.9rem;
            color: #333;
        }

        .certificate .logo {
            position: absolute;
            top: 20px;
            width: 100px;
        }

        .certificate .logo.left {
            left: 20px;
        }

        .certificate .logo.right {
            right: 20px;
        }

        .certificate .logo img {
            width: 100%;
        }

        .certificate .footer {
            position: absolute;
            bottom: 20px;
            width: 100%;
            text-align: center;
            font-size: 0.8rem;
            color: #777;
        }

        .certificate .signature-space {
            margin-top: 40px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="certificate">
        <div class="logo left">
            <img src="{{ public_path('storage/profile_pictures/' . $siswa->profile->sekolah->user->foto_profile) }}" alt="Logo sekolah">
        </div>
        <div class="logo right">
            <img src="{{ public_path('assets/certificate/qelopak.png') }}" class="bg" alt="Logo qelopak">
        </div>
        <h1>Sertifikat Praktik Kerja Lapangan</h1>
        <h2>Diberikan Kepada</h2>
        <p class="name">{{ $siswa->name }}</p>
        <p>
            Sebagai pengakuan atas partisipasi dan kontribusi selama menjalankan <br>
            Praktik Kerja Lapangan di <strong>
                PT Qelopak Teknologi Indonesia</strong>,
            pada tanggal <strong>{{ $siswa->profile->tanggal_mulai }}</strong> hingga <strong>{{ $siswa->profile->tanggal_selesai }}</strong>.
        </p>
        <div class="signature">
        </div>
        <div class="signature-space">
            <img src="{{ public_path('assets/certificate/ttd.png') }}" alt="Tanda Tangan" style="width: 150px;"/>
            <p>Nama Pembimbing</p>
        </div>
        <div class="footer">
            <p>Terima kasih atas dedikasi dan kerja keras yang telah diberikan selama program PKL.</p>
        </div>
    </div>
</body>
</html>
