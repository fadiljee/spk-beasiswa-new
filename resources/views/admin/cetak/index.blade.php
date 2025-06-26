<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hasil Akhir Ranking PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
        }
        h2 {
            text-align: center;
            color: #19692c;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }
        th, td {
            border: 1px solid #19692c;
            padding: 8px 12px;
            text-align: center;
        }
        th {
            background-color: #28a745;
            color: white;
            text-transform: uppercase;
        }
        td.text-left {
            text-align: left;
        }
        tr:nth-child(even) {
            background-color: #e6f4ea;
        }
    </style>
</head>
<body>
    <h2>Hasil Akhir Ranking</h2>

    <table>
        <thead>
            <tr>
                <th>Ranking</th>
                <th>Nama Pelamar</th>
                <th>Nilai Akhir</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($hasilAkhir as $index => $data)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td class="text-left">{{ $data['pelamar'] }}</td>
                <td>{{ number_format($data['skor'], 4, '.', ',') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
