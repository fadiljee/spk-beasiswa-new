<?php

namespace App\Http\Controllers;

use App\Models\DataPelamar;
use App\Models\Kriteria;
use App\Models\Penilaian;
use Illuminate\Support\Facades\Mail;
use App\Mail\HasilAkhirMail;
use Illuminate\Http\Request;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Collection;
use Barryvdh\DomPDF\Facade\Pdf;

class PerhitunganController extends Controller
{
    /**
     * Menampilkan halaman utama dengan semua langkah perhitungan SAW.
     */
    public function index()
    {
        // Panggil method terpusat untuk mendapatkan semua data perhitungan
        $sawResults = $this->performSawCalculation();

        return view('admin.perhitungan.index', $sawResults);
    }

    /**
     * Menampilkan halaman khusus untuk hasil akhir yang sudah diranking.
     */
    public function hasilAkhir()
    {
        // Panggil method terpusat, hanya ambil data hasil akhir
        $sawResults = $this->performSawCalculation();

        return view('admin.hasil.index', ['hasilAkhir' => $sawResults['finalRanking']]);
    }

    /**
     * Mengekspor hasil akhir ke dalam format PDF.
     */
    public function exportPdf()
    {
        // Panggil method terpusat, hanya ambil data hasil akhir untuk PDF
        $sawResults = $this->performSawCalculation();

        $pdf = PDF::loadView('admin.cetak.index', ['hasilAkhir' => $sawResults['finalRanking']]);

        return $pdf->download('hasil-akhir-ranking-'.date('Y-m-d').'.pdf');
    }

    /**
     * Method terpusat untuk melakukan seluruh proses perhitungan SAW.
     * Mengembalikan array yang berisi semua tahapan hasil.
     *
     * @return array
     */
    private function performSawCalculation(): array
    {
        // 1. Pengambilan Data Awal
        $kriterias = Kriteria::orderBy('id')->get();
        $penilaians = Penilaian::with('pelamar', 'subkriteria.kriteria')->get();

        // Jika tidak ada data penilaian, kembalikan array kosong untuk menghindari error
        if ($penilaians->isEmpty() || $kriterias->isEmpty()) {
            return [
                'matriksKeputusan' => [], 'kriterias' => $kriterias,
                'normalizedMatrix' => [], 'weightedMatrix' => [],
                'finalRanking' => [], 'calculationDetails' => []
            ];
        }

        // 2. Membuat Matriks Keputusan (X)
        $matriksKeputusan = [];
        foreach ($penilaians as $penilaian) {
            $matriksKeputusan[$penilaian->pelamar_id]['pelamar'] = $penilaian->pelamar->nama_lengkap;
            $matriksKeputusan[$penilaian->pelamar_id]['nilai'][$penilaian->subkriteria->kriteria->nama_kriteria] = $penilaian->nilai;
        }

        // 3. Normalisasi Matriks (R)
        $normalizedMatrix = $this->normalizeMatrix($matriksKeputusan, $kriterias);

        // 4. Matriks Terbobot (V)
        $weightedMatrix = $this->applyWeights($normalizedMatrix, $kriterias);

        // 5. Menghitung Skor Akhir dan Membuat Peringkat
        $finalRanking = [];
        $calculationDetails = [];
        foreach ($weightedMatrix as $pelamar_id => $data) {
            $totalScore = array_sum($data['nilai']);
            $calculationString = implode(' + ', array_map(fn($v) => number_format($v, 3), $data['nilai']));

            $finalRanking[] = [
                'pelamar' => $matriksKeputusan[$pelamar_id]['pelamar'],
                'skor' => round($totalScore, 4),
            ];

            $calculationDetails[$pelamar_id] = $calculationString . ' = ' . round($totalScore, 4);
        }

        // Urutkan hasil akhir berdasarkan skor tertinggi
        usort($finalRanking, fn($a, $b) => $b['skor'] <=> $a['skor']);

        // 6. Kembalikan semua hasil dalam satu array
        return compact(
            'matriksKeputusan', 'kriterias', 'normalizedMatrix',
            'weightedMatrix', 'finalRanking', 'calculationDetails'
        );
    }

    /**
     * Melakukan normalisasi matriks keputusan.
     *
     * @param array $matriksKeputusan
     * @param Collection $kriterias
     * @return array
     */
    private function normalizeMatrix(array $matriksKeputusan, Collection $kriterias): array
    {
        $normalized = [];
        $maxValues = [];

        // Langkah 1: Cari nilai maksimum untuk setiap kriteria (lebih efisien)
        foreach ($kriterias as $kriteria) {
            $maxValues[$kriteria->nama_kriteria] = 0;
            foreach ($matriksKeputusan as $data) {
                $nilai = $data['nilai'][$kriteria->nama_kriteria] ?? 0;
                if ($nilai > $maxValues[$kriteria->nama_kriteria]) {
                    $maxValues[$kriteria->nama_kriteria] = $nilai;
                }
            }
        }

        // Langkah 2: Lakukan normalisasi
        foreach ($matriksKeputusan as $pelamar_id => $data) {
            foreach ($kriterias as $kriteria) {
                $nama_kriteria = $kriteria->nama_kriteria;
                $nilai = $data['nilai'][$nama_kriteria] ?? 0;
                $max_value = $maxValues[$nama_kriteria];

                $normalizedValue = ($max_value > 0) ? ($nilai / $max_value) : 0;
                $normalized[$pelamar_id]['nilai'][$nama_kriteria] = $normalizedValue;
            }
        }

        return $normalized;
    }

    /**
     * Mengalikan matriks ternormalisasi dengan bobot setiap kriteria.
     *
     * @param array $normalizedMatrix
     * @param Collection $kriterias
     * @return array
     */
    private function applyWeights(array $normalizedMatrix, Collection $kriterias): array
    {
        $weightedMatrix = [];
        // Buat map kriteria => bobot untuk akses cepat
        $bobotMap = $kriterias->pluck('bobot', 'nama_kriteria');

        foreach ($normalizedMatrix as $pelamar_id => $data) {
            foreach ($data['nilai'] as $kriteria_name => $value) {
                $weight = $bobotMap[$kriteria_name] ?? 0;
                $weightedMatrix[$pelamar_id]['nilai'][$kriteria_name] = $value * $weight;
            }
        }
        return $weightedMatrix;
    }


      public function kirimHasilKeEmail()
    {
        $sawResults = $this->performSawCalculation();
        $hasilAkhir = $sawResults['finalRanking'];

        $pelamars = DataPelamar::all(); // Mengambil semua pelamar
        foreach ($pelamars as $pelamar) {
            Mail::to($pelamar->email)->send(new HasilAkhirMail($hasilAkhir));
        }

        return back()->with('success', 'Hasil akhir telah dikirim via email!');
    }

    // Fungsi untuk mengirim hasil via WhatsApp
    public function kirimHasilKeWhatsApp()
    {
        // Ambil hasil akhir dari perhitungan SAW
        $sawResults = $this->performSawCalculation();
        $hasilAkhir = $sawResults['finalRanking'];

        // Kredensial Twilio
        $sid = env('TWILIO_SID');
        $token = env('TWILIO_AUTH_TOKEN');
        $from = env('TWILIO_WHATSAPP_FROM'); // Nomor WhatsApp Twilio
        $client = new Client($sid, $token);

        // Mengambil semua pelamar dari DataPelamar
        $pelamars = DataPelamar::all();

        foreach ($pelamars as $pelamar) {
            // Menyiapkan pesan WhatsApp
            $message = "Hasil Akhir Peringkat Seleksi:\n";
            foreach ($hasilAkhir as $index => $data) {
                $message .= "Peringkat: " . ($index + 1) . "\n";
                $message .= "Nama: " . $data['pelamar'] . "\n";
                $message .= "Skor: " . number_format($data['skor'], 4) . "\n";
            }

            // Mengirim pesan WhatsApp ke pelamar
            try {
                $client->messages->create(
                    'whatsapp:' . $pelamar->whatsapp, // Nomor WhatsApp pelamar
                    [
                        'from' => $from,
                        'body' => $message
                    ]
                );
                Log::info("Pesan WhatsApp berhasil dikirim ke: " . $pelamar->whatsapp);
            } catch (\Exception $e) {
                Log::error("Gagal mengirim WhatsApp ke " . $pelamar->whatsapp . ": " . $e->getMessage());
            }
        }

        return back()->with('success', 'Hasil akhir telah dikirim via WhatsApp!');
    }
}
