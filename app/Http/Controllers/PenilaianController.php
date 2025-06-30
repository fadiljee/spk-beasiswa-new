<?php

namespace App\Http\Controllers;

use App\Models\Penilaian;
use App\Models\DataPelamar;
use App\Models\Kriteria;
use App\Models\Subkriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PenilaianController extends Controller
{
    /**
     * Menampilkan daftar pelamar untuk dinilai.
     */
    public function index()
    {
        // Variabel yang dikirim adalah 'pelamar', sudah sesuai dengan view yang diperbarui
        $pelamar = DataPelamar::with('penilaians')->get();
        $kriterias = Kriteria::all();

        return view('admin.penilaian.index', compact('pelamar', 'kriterias'));
    }

    /**
     * Menampilkan form untuk input penilaian baru.
     */
    public function create(DataPelamar $pelamar)
    {
        $kriterias = Kriteria::with('subkriteria')->orderBy('nama_kriteria')->get();
        return view('admin.penilaian.create', [
            'pelamar' => $pelamar,
            'kriterias' => $kriterias,
        ]);
    }

    /**
     * Menyimpan data penilaian baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pelamar_id' => 'required|exists:data_pelamar,id',
            'penilaian' => 'required|array',
            'penilaian.*.subkriteria_id' => 'required|exists:subkriteria,id',
        ]);

        $pelamarId = $request->input('pelamar_id');
        $penilaianData = $request->input('penilaian');

        foreach ($penilaianData as $kriteriaId => $data) {
            $subkriteria = Subkriteria::find($data['subkriteria_id']);
            if ($subkriteria) {
                Penilaian::updateOrCreate([
                    'pelamar_id' => $pelamarId,
                    'kriteria_id' => $kriteriaId,
                ], [
                    'subkriteria_id' => $subkriteria->id,
                    'nilai' => $subkriteria->nilai,
                ]);
            }
        }

        return redirect()->route('penilaian.index')->with('success', 'Data penilaian berhasil disimpan!');
    }

    /**
     * TAMBAHAN: Menampilkan form untuk mengedit penilaian.
     */
    public function edit(DataPelamar $pelamar)
    {
        $kriterias = Kriteria::with('subkriteria')->orderBy('nama_kriteria')->get();

        // Ambil penilaian yang sudah ada untuk pelamar ini
        // dan buat menjadi array asosiatif [kriteria_id => subkriteria_id]
        // untuk memudahkan pengisian nilai di form edit.
        $penilaianTersimpan = Penilaian::where('pelamar_id', $pelamar->id)
                                      ->pluck('subkriteria_id', 'kriteria_id');

        // Anda mungkin perlu membuat view baru: 'admin.penilaian.edit'
        // yang mirip dengan 'create.blade.php'
        return view('admin.penilaian.edit', [
            'pelamar' => $pelamar,
            'kriterias' => $kriterias,
            'penilaianTersimpan' => $penilaianTersimpan,
        ]);
    }

    /**
     * TAMBAHAN: Mengupdate data penilaian yang sudah ada.
     */
    public function update(Request $request, DataPelamar $pelamar)
    {
        // Validasi sama seperti store
        $request->validate([
            'penilaian' => 'required|array',
            'penilaian.*.subkriteria_id' => 'required|exists:subkriteria,id',
        ]);

        // Logika updateOrCreate sama persis dengan store, karena ia akan
        // meng-update jika ada, atau membuat jika tidak ada.
        $penilaianData = $request->input('penilaian');

        foreach ($penilaianData as $kriteriaId => $data) {
            $subkriteria = Subkriteria::find($data['subkriteria_id']);
            if ($subkriteria) {
                Penilaian::updateOrCreate([
                    'pelamar_id' => $pelamar->id, // Mengambil ID dari route model binding
                    'kriteria_id' => $kriteriaId,
                ], [
                    'subkriteria_id' => $subkriteria->id,
                    'nilai' => $subkriteria->nilai,
                ]);
            }
        }

        return redirect()->route('penilaian.index')->with('success', 'Data penilaian berhasil diperbarui!');
    }


    /**
     * Mendapatkan subkriteria berdasarkan kriteria untuk AJAX.
     */
    public function getSubkriteria($kriteria_id)
    {
        $subkriterias = Subkriteria::where('kriteria_id', $kriteria_id)->get();
        return response()->json($subkriterias);
    }
}
