<?php

namespace App\Http\Controllers;

use App\Models\DataPelamar;
use App\Models\Kriteria;
use App\Models\Penilaian;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Collections\ExportCollection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Collection;
use App\Mail\HasilAkhirPelamarMail;


class PerhitunganController extends Controller
{
    public function index()
    {
        $sawResults = $this->performSawCalculation();
        return view('admin.perhitungan.index', $sawResults);
    }

   private function performSawCalculation(): array
{
    // --- Step 1: Ambil data utama ---
    $kriterias = Kriteria::orderBy('id')->get();
    $penilaians = Penilaian::with('pelamar', 'subkriteria.kriteria')->get();

    if ($penilaians->isEmpty() || $kriterias->isEmpty()) {
        return [
            'matriksKeputusan' => [],
            'kriterias' => $kriterias,
            'normalizedMatrix' => [],
            'weightedMatrix' => [],
            'nilaiPreferensi' => [],
        ];
    }

    // --- Step 2: Matriks Keputusan (X) ---
    $matriksKeputusan = [];
    $pelamars = DataPelamar::orderBy('id')->get();

    foreach ($pelamars as $pelamar) {
        $matriksKeputusan[$pelamar->id]['pelamar'] = $pelamar->nama_lengkap;
        foreach ($kriterias as $kriteria) {
            $matriksKeputusan[$pelamar->id]['nilai'][$kriteria->nama_kriteria] = 0;
        }
    }
    foreach ($penilaians as $penilaian) {
        if (
            isset($matriksKeputusan[$penilaian->pelamar_id]) &&
            isset($penilaian->subkriteria->kriteria)
        ) {
            $nama_kriteria = $penilaian->subkriteria->kriteria->nama_kriteria;
            if (isset($matriksKeputusan[$penilaian->pelamar_id]['nilai'][$nama_kriteria])) {
                $matriksKeputusan[$penilaian->pelamar_id]['nilai'][$nama_kriteria] = $penilaian->nilai;
            }
        }
    }

    // --- Step 3: Normalisasi Matriks (R) ---
    $normalizedMatrix = [];
    $minValues = [];
    $maxValues = [];

    foreach ($kriterias as $kriteria) {
        $nama_kriteria = $kriteria->nama_kriteria;
        $values = [];
        foreach ($matriksKeputusan as $pelamar) {
            $values[] = $pelamar['nilai'][$nama_kriteria];
        }
        $minValues[$nama_kriteria] = min($values);
        $maxValues[$nama_kriteria] = max($values);
    }

    foreach ($matriksKeputusan as $pid => $pelamar) {
        foreach ($kriterias as $kriteria) {
            $nama_kriteria = $kriteria->nama_kriteria;
            $nilai = $pelamar['nilai'][$nama_kriteria];
            if (strtolower($kriteria->jenis) === 'cost') {
                // cost: min(x)/xi
                $normalized = ($nilai > 0) ? $minValues[$nama_kriteria] / $nilai : 0;
            } else {
                // benefit: xi/max(x)
                $normalized = ($maxValues[$nama_kriteria] > 0) ? $nilai / $maxValues[$nama_kriteria] : 0;
            }
            $normalizedMatrix[$pid]['nilai'][$nama_kriteria] = round($normalized, 6);
        }
    }

    // --- Step 4: Matriks Terbobot (W) ---
    $weightedMatrix = [];
    $bobotMap = $kriterias->pluck('bobot', 'nama_kriteria')->toArray();
    foreach ($normalizedMatrix as $pid => $pelamar) {
        foreach ($pelamar['nilai'] as $kriteria_name => $normalized) {
            $bobot = floatval(str_replace(',', '.', $bobotMap[$kriteria_name]));
            $weightedMatrix[$pid]['nilai'][$kriteria_name] = round($normalized * $bobot, 6);
        }
    }

    // --- Step 5: Nilai Preferensi (V) & Ranking ---
    $nilaiPreferensi = [];
    foreach ($weightedMatrix as $pid => $pelamar) {
        $nilaiPerKriteria = $pelamar['nilai'];
        $v = array_sum($nilaiPerKriteria);
        // Calculation string untuk semua kriteria aktif (otomatis looping)
        $calculationString = implode(' + ', array_map(
            function($kn) use ($nilaiPerKriteria) {
                return number_format($nilaiPerKriteria[$kn] ?? 0, 3);
            },
            array_keys($nilaiPerKriteria)
        ));
        // Isian tabel, tetap isi semua field (key = lower case nama_kriteria)
        $row = [
            'pelamar' => $matriksKeputusan[$pid]['pelamar'],
            'V' => round($v, 3),
            'calculation' => $calculationString,
        ];
        // Tambahkan semua nilai per kriteria
        foreach ($kriterias as $kriteria) {
            $kn = strtolower($kriteria->nama_kriteria);
            $row[$kn] = $nilaiPerKriteria[$kriteria->nama_kriteria] ?? 0;
        }
        $nilaiPreferensi[] = $row;
    }
    usort($nilaiPreferensi, fn($a, $b) => $b['V'] <=> $a['V']);
    foreach ($nilaiPreferensi as $i => &$row) {
        $row['ranking'] = $i + 1;
    }

    // --- Kembalikan semua hasil ---
    return [
        'matriksKeputusan' => $matriksKeputusan,
        'kriterias' => $kriterias,
        'normalizedMatrix' => $normalizedMatrix,
        'weightedMatrix' => $weightedMatrix,
        'nilaiPreferensi' => $nilaiPreferensi,
    ];
    }
     public function hasilAkhir(Request $request)
{
    // 1. Lakukan kalkulasi dan dapatkan seluruh hasil (sama seperti sebelumnya)
    $sawResults = $this->performSawCalculation();
    $hasilAkhirArray = $sawResults['nilaiPreferensi']; // Ini adalah array lengkap

    // 2. Tentukan parameter paginasi
    $perPage = 10; // Jumlah item per halaman
    $currentPage = $request->input('page', 1); // Ambil nomor halaman dari URL, default 1

    // 3. Buat koleksi dari array agar mudah diolah
    $collection = new Collection($hasilAkhirArray);

    // 4. "Potong" koleksi untuk mengambil data sesuai halaman saat ini
    $currentPageItems = $collection->slice(($currentPage - 1) * $perPage, $perPage)->values();

    // 5. Buat objek paginator secara manual dari hasil potongan
    $hasilAkhir = new LengthAwarePaginator(
        $currentPageItems,        // Data untuk halaman ini
        count($collection),       // Total semua data
        $perPage,                 // Item per halaman
        $currentPage,             // Halaman saat ini
        [
            'path' => $request->url(), // URL dasar untuk link paginasi
            'query' => $request->query(),
        ]
    );

    // 6. Kirim objek paginasi '$hasilAkhir' ke view 'admin.hasil.index'
    return view('admin.hasil.index', ['hasilAkhir' => $hasilAkhir]);
}

 public function hasilAkhirUser(Request $request)
{
    // 1. Lakukan kalkulasi dan dapatkan seluruh hasil (sama seperti sebelumnya)
    $sawResults = $this->performSawCalculation();
    $hasilAkhirArray = $sawResults['nilaiPreferensi']; // Ini adalah array lengkap

    // 2. Tentukan parameter paginasi
    $perPage = 10; // Jumlah item per halaman (bisa diubah sesuai selera)
    $currentPage = $request->input('page', 1); // Ambil nomor halaman dari URL, default 1

    // 3. Buat koleksi dari array agar mudah diolah
    $collection = new Collection($hasilAkhirArray);

    // 4. "Potong" koleksi untuk mengambil data sesuai halaman saat ini
    $currentPageItems = $collection->slice(($currentPage - 1) * $perPage, $perPage)->values();

    // 5. Buat objek paginator secara manual dari hasil potongan
    $hasilAkhir = new LengthAwarePaginator(
        $currentPageItems,        // Data untuk halaman ini
        count($collection),       // Total semua data
        $perPage,                 // Item per halaman
        $currentPage,             // Halaman saat ini
        [
            'path' => $request->url(), // URL dasar untuk link paginasi
            'query' => $request->query(),
        ]
    );

    // 6. Kirim objek paginasi '$hasilAkhir' ke view
    return view('panel-user.hasil-akhir.index', ['hasilAkhir' => $hasilAkhir]);
}


   public function simpanStatus(Request $request)
{
    $tahun = date('Y');
    $pelamar_ids = $request->input('pelamar_id', []);
    $statuses    = $request->input('status_lulus', []);

    foreach ($pelamar_ids as $i => $id) {
        $pelamar = \App\Models\DataPelamar::find($id);
        if (!$pelamar) continue;

        $status = $statuses[$i] ?? null;

        if ($status == 'lulus') {
            $pelamar->status_lulus = 'lulus';
            $pelamar->tahun_lulus = $tahun;
            $pelamar->tahun_tidak_lulus = null;
        } elseif ($status == 'tidak_lulus') {
            $pelamar->status_lulus = 'tidak_lulus';
            $pelamar->tahun_lulus = null;
            $pelamar->tahun_tidak_lulus = $tahun;
        } else {
            $pelamar->status_lulus = null;
            $pelamar->tahun_lulus = null;
            $pelamar->tahun_tidak_lulus = null;
        }
        $pelamar->save();
    }

    return redirect()->back()->with('success', 'Status kelulusan berhasil diperbarui.');
}


    // public function exportExcel()
    // {
    //     $sawResults = $this->performSawCalculation();
    //     $hasilAkhir = $sawResults['nilaiPreferensi'];

    //     // Siapkan data array
    //     $exportData = [];
    //     foreach ($hasilAkhir as $row) {
    //         $exportData[] = [
    //             'Ranking'      => $row['ranking'],
    //             'Nama Pelamar' => $row['pelamar'],
    //             'Nilai Akhir'  => $row['V'],
    //         ];
    //     }

    //     $filename = 'hasil_akhir_ranking_' . now()->format('Ymd_His') . '.xlsx';

    //     // Export anonymous collection
    //     return Excel::download(new \Maatwebsite\Excel\Collections\ExportCollection(collect($exportData)), $filename);
    // }
    public function exportPdf()
    {
        $sawResults = $this->performSawCalculation();
        $hasilAkhir = $sawResults['nilaiPreferensi'];

        // View khusus PDF (lihat langkah 4 di bawah)
        $pdf = Pdf::loadView('admin.cetak.index', [
            'hasilAkhir' => $hasilAkhir,
        ])->setPaper('a4', 'portrait');

        return $pdf->download('hasil_akhir_ranking_' . now()->format('Ymd_His') . '.pdf');
    }

public function kirimEmailKePelamar()
{
    $sawResults = $this->performSawCalculation();
    $hasilAkhir = $sawResults['nilaiPreferensi'];

    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.cetak.index', [
        'hasilAkhir' => $hasilAkhir,
    ])->setPaper('a4', 'portrait');
    $pdfContent = $pdf->output();
    $pdfName = 'hasil_akhir_ranking_' . now()->format('Ymd_His') . '.pdf';

    $pelamars = \App\Models\DataPelamar::whereNotNull('email')
        ->where('email', '!=', '')
        ->get();

    $count = 0;
    $fail = 0;

    foreach ($pelamars as $pelamar) {
        if (filter_var($pelamar->email, FILTER_VALIDATE_EMAIL)) {
            try {
                Mail::to($pelamar->email)->send(
                    new \App\Mail\HasilAkhirPelamarMail($pelamar, $pdfContent, $pdfName)
                );
                $count++;
            } catch (\Exception $e) {
                $fail++;
                // Optional: log error, misal:
                // \Log::error("Gagal kirim ke {$pelamar->email}: " . $e->getMessage());
            }
        } else {
            $fail++;
        }
    }

    return back()->with('success', "Berhasil mengirim email & PDF ranking ke $count pelamar." . ($fail ? " Gagal ke $fail pelamar." : ''));
}


public function kirimWa(Request $request)
{
    $apiKey = 'ksvnXjyB1JWtkgDpRe5w'; // ganti dengan API key asli!
    $pelamars = \App\Models\DataPelamar::whereNotNull('nomor_whatsapp')
        ->where('nomor_whatsapp', '!=', '')
        ->get();

    $count = 0; $fail = 0;

    foreach ($pelamars as $pelamar) {
        // Format nomor WA: 628xx dst
        $wa = preg_replace('/^0/', '62', $pelamar->nomor_whatsapp);
        $pesan = "*PENGUMUMAN SELEKSI BEASISWA*\n\n"
            . "Halo, $pelamar->nama_lengkap!\n"
            . "Status: *".strtoupper($pelamar->status_lulus ?? 'Belum Ada')."*\n"
            . ($pelamar->status_lulus == 'lulus'
                ? "Selamat! Anda LULUS. Tahun: $pelamar->tahun_lulus"
                : ($pelamar->status_lulus == 'tidak_lulus'
                    ? "Maaf, Anda tidak lulus. Tahun: $pelamar->tahun_tidak_lulus"
                    : "Status seleksi Anda belum tersedia.")
            )
            . "\n\nTerima kasih telah berpartisipasi.";

        $res = \Illuminate\Support\Facades\Http::withHeaders([
                'Authorization' => $apiKey
            ])->asForm()->post('https://api.fonnte.com/send', [
                'target' => $wa,
                'message' => $pesan,
                'countryCode' => '62', // optional
            ]);

        if ($res->ok() && $res->json('status') == true) $count++; else $fail++;
    }

    return back()->with('success', "Berhasil kirim WA ke $count pelamar." . ($fail ? ", gagal $fail." : ''));
}

}
