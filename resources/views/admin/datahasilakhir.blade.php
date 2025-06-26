@extends('admin.layout')

@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Hasil Akhir SPK SAW</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .content {
            margin-left: 180px;
            padding: 20px;
            width: calc(100% - 250px);
        }
        .box-container {
            background: white;
            border-left: 5px solid #0C91A6;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .table th {
            background: #0C91A6;
            color: white;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .section-header {
            color: #0C91A6;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .print-button {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="content">
        <div class="box-container">
            <h2 class="section-header">
                <i class="bi bi-table"></i> Data Hasil Akhir SPK SAW
            </h2>
            <button class="btn btn-primary print-button" onclick="window.print()">Cetak Laporan</button>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Alternatif</th>
                            <th>Nilai Akhir</th>
                            <th>Peringkat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Carlie</td>
                            <td>2.67</td>
                            <td>1</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Lina</td>
                            <td>2.54</td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Pandu</td>
                            <td>2.42</td>
                            <td>3</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection
