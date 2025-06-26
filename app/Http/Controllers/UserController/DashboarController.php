<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataPelamar;
use App\Models\Mahasiswa;
use App\Models\Kriteria;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Collection;

use App\Models\Penilaian;
use App\Models\Subkriteria;


class DashboarController extends Controller
{
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

        return view('panel-user.hasil-akhir.index', ['hasilAkhir' => $sawResults['finalRanking']]);
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



public function logout(Request $request)
{
    $request->session()->flush(); // ⬅️ hapus semua session
    return redirect()->route('user.beranda');
}



 public function edit($id)
    {
        // Mencari mahasiswa berdasarkan id
        $mahasiswa = mahasiswa::findOrFail($id);

        // Mengirim data mahasiswa ke view
        return view('panel-user.edituser', compact('mahasiswa'));
    }

    // Menangani permintaan untuk memperbarui data mahasiswa
    public function update(Request $request, $id)
    {
        // Validasi data input dari form
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|numeric',
            'email' => 'required|email|unique:mahasiswa,email,' . $id,
            'password' => 'nullable|min:8',
            'jurusan' => 'required|string|max:255',
        ]);

        // Mencari mahasiswa berdasarkan id
        $mahasiswa = mahasiswa::findOrFail($id);

        // Mengupdate data mahasiswa
        $mahasiswa->update([
            'nama' => $validated['nama'],
            'nim' => $validated['nim'],
            'email' => $validated['email'],
            'password' => $validated['password'] ? bcrypt($validated['password']) : $mahasiswa->password,  // Jika password kosong, tidak diubah
            'jurusan' => $validated['jurusan'],
        ]);

        // Mengarahkan kembali ke halaman yang relevan dengan pesan sukses
        return redirect()->route('panel-user.edituser')->with('success', 'Data mahasiswa berhasil diperbarui');
    }
}
