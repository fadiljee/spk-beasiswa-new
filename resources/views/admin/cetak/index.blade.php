<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hasil Akhir Ranking - PDF</title>
    <style>
        body {
            font-family: 'Poppins', Arial, sans-serif;
            font-size: 13px;
            background: #f8fafc;
            margin: 18px;
        }
        .judul {
            text-align: center;
            color: #4f46e5;
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.2rem;
            letter-spacing: 0.03em;
        }
        .subjudul {
            text-align: center;
            font-size: 1rem;
            color: #444;
            margin-bottom: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 0.9rem;
            background: #fff;
        }
        th, td {
            border: 1px solid #d1d5db;
            padding: 8px 12px;
            text-align: center;
        }
        th {
            background: linear-gradient(90deg, #7c3aed 0%, #6366f1 100%);
            color: #fff;
            text-transform: uppercase;
            font-size: 1em;
            letter-spacing: 0.07em;
        }
        td.text-left { text-align: left; }
        tr.top-rank {
            background-color: #ecfdf5 !important;
            font-weight: 600;
        }
        tr:nth-child(even):not(.top-rank) { background-color: #f4f8fd; }
        .score-pill {
            display: inline-block;
            background: #eef2ff;
            color: #4f46e5;
            font-weight: 700;
            border-radius: 7px;
            padding: 4px 18px;
            font-size: 1em;
            min-width: 72px;
        }
        @page { margin: 18px; }
    </style>
</head>
<body>
    <div class="judul">Hasil Akhir & Perankingan</div>
    <div class="subjudul">Penjumlahan seluruh nilai preferensi (V) untuk ranking</div>
    <table>
        <thead>
            <tr>
                <th style="width:9%;">Ranking</th>
                <th style="width:36%;">Nama Pelamar</th>
                <th style="width:25%;">Nilai Akhir (V)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($hasilAkhir as $data)
            <tr @if($data['ranking']==1) class="top-rank" @endif>
                <td>
                    @if($data['ranking']==1)  @endif
                    {{ $data['ranking'] }}
                </td>
                <td class="text-left">{{ $data['pelamar'] }}</td>
                <td>
                    <span class="score-pill">{{ number_format($data['V'], 4, '.', ',') }}</span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
