<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hasil Akhir Seleksi Beasiswa</title>
    <style>
        body {
            font-family: 'Poppins', Arial, sans-serif;
            font-size: 15px;
            background: #F9FAFB;
            color: #212121;
            padding: 0;
        }
        .email-container {
            background: #fff;
            border-radius: 10px;
            margin: 32px auto;
            max-width: 450px;
            padding: 32px 28px 22px 28px;
            box-shadow: 0 5px 16px 0 rgba(80,100,160,.08);
        }
        .title {
            color: #4F46E5;
            font-size: 1.3em;
            font-weight: 700;
            text-align: center;
            margin-bottom: 14px;
        }
        .intro {
            font-size: 1.03em;
            margin-bottom: 10px;
            text-align: center;
        }
        .user-name {
            font-weight: 600;
            color: #4338CA;
            text-align: center;
            font-size: 1.1em;
            margin-bottom: 8px;
        }
        .status-box {
            text-align: center;
            margin: 18px 0 12px 0;
        }
        .badge {
            display: inline-block;
            padding: 0.36em 1.15em;
            border-radius: 50px;
            font-size: 0.98em;
            font-weight: 600;
            letter-spacing: 0.1em;
            background: #EEF2FF;
            color: #4F46E5;
            border: 1px solid #E0E7FF;
        }
        .badge.lulus {
            background: #D1FAE5;
            color: #047857;
            border: 1px solid #6EE7B7;
        }
        .badge.tidak {
            background: #FEE2E2;
            color: #991B1B;
            border: 1px solid #FCA5A5;
        }
        .info {
            font-size: 0.98em;
            color: #555;
            margin-bottom: 4px;
            text-align: center;
        }
        .footer {
            margin-top: 16px;
            font-size: 0.95em;
            color: #AAA;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="email-container">
    <div class="title">Hasil Seleksi Beasiswa</div>
    <div class="user-name">
        Kepada: {{ $pelamar->nama_lengkap }}
    </div>
    <div class="intro">
        Terima kasih telah mengikuti proses seleksi beasiswa ini.<br>
        Berikut adalah status hasil akhir Anda:
    </div>
    <div class="status-box">
        @if($pelamar->status_lulus == 'lulus')
            <span class="badge lulus">LULUS</span>
        @elseif($pelamar->status_lulus == 'tidak_lulus')
            <span class="badge tidak">TIDAK LULUS</span>
        @else
            <span class="badge">BELUM ADA</span>
        @endif
    </div>
    <div class="info">
        @if($pelamar->status_lulus == 'lulus')
            Tahun Lulus: <b>{{ $pelamar->tahun_lulus ?? '-' }}</b>
        @elseif($pelamar->status_lulus == 'tidak_lulus')
            Tahun Tidak Lulus: <b>{{ $pelamar->tahun_tidak_lulus ?? '-' }}</b>
        @else
            Status seleksi Anda belum tersedia.
        @endif
    </div>
    <div class="info">
        Silakan download <b>lampiran PDF</b> pada email ini untuk melihat hasil ranking dan nilai akhir seluruh peserta.
    </div>
    <div class="footer">
        Email ini dikirim otomatis. Jika ada pertanyaan, silakan hubungi panitia beasiswa.<br>
        &copy; {{ date('Y') }} Tim Seleksi Beasiswa
    </div>
</div>
</body>
</html>
