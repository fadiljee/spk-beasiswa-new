<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Akhir Peringkat Seleksi</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">

    <h1 style="color: #1d4ed8;">Hasil Akhir Peringkat Seleksi</h1>

    <p>Berikut adalah hasil akhir peringkat seleksi berdasarkan skor yang dihitung:</p>

    <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
        <thead>
            <tr>
                <th style="border: 1px solid #ddd; padding: 8px; text-align: left; background-color: #f9fafb;">Peringkat</th>
                <th style="border: 1px solid #ddd; padding: 8px; text-align: left; background-color: #f9fafb;">Nama Pelamar</th>
                <th style="border: 1px solid #ddd; padding: 8px; text-align: left; background-color: #f9fafb;">Skor Akhir</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($hasilAkhir as $index => $data)
                <tr>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: left;">
                        {{ $index + 1 }}
                    </td>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: left;">
                        {{ $data['pelamar'] }}
                    </td>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: left;">
                        {{ number_format($data['skor'], 4) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p style="margin-top: 20px;">Terima kasih atas partisipasi Anda dalam seleksi ini. Jika Anda memiliki pertanyaan, jangan ragu untuk menghubungi kami.</p>

    <p>Salam,<br> Tim Seleksi</p>

</body>
</html>
