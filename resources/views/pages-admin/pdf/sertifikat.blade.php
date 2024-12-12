<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sertifikat</title>

    <style>
        @page { 
        }

        body {
            font-family: Arial, sans-serif;
        }

        table {
            border-collapse: collapse;
            
        }

        .component {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .component tr {
            text-align: center
        }
    </style>
</head>
<body>
    <table class="component" style="width: 100%;">
        <tr>
            <td style="font-size: 40px">S E R T I F I K A T</td>
        </tr>
        <tr>
            <td>DINAS PERHUBUNGAN</td>
        </tr>
        <tr>
            <td>Sertifikat Diberikan Kepada:</td>
        </tr>
        <tr>
            <td style="font-size: 45px">{{ $siswa->name }}</td>
        </tr>
    </table>
</body>
</html>