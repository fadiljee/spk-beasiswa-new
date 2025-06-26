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
    // Menampilkan form input penilaian
    public function create($pelamar_id)
    {
        $pelamar = DataPelamar::findOrFail($pelamar_id);
        $kriterias = Kriteria::all();

        return view('admin.penilaian.create', compact('pelamar', 'kriterias'));
    }

    // Menyimpan atau update penilaian
    public function store(Request $request)
    {
        $request->validate([
            'pelamar_id' => 'required|exists:data_pelamar,id',
            'subkriteria_id' => 'required|exists:subkriteria,id',
            'nilai' => 'required|numeric|min:0|max:100',
        ]);

        Penilaian::updateOrCreate(
            [
                'pelamar_id' => $request->pelamar_id,
                'subkriteria_id' => $request->subkriteria_id,
            ],
            [
                'nilai' => $request->nilai,
            ]
        );

        Log::info('Penilaian berhasil disimpan', $request->all());

        return redirect()->route('penilaian.index')->with('success', 'Penilaian berhasil disimpan!');
    }

    // Mendapatkan subkriteria berdasar kriteria (AJAX)
    public function getSubkriteria($kriteria_id)
    {
        $subkriterias = Subkriteria::where('kriteria_id', $kriteria_id)->get();

        return response()->json($subkriterias);
    }

    // Menampilkan daftar penilaian dan pelamar
    public function index()
    {
        // Ambil pelamar dengan penilaian dan subkriteria terkait sekaligus
        $pelamar = DataPelamar::with('penilaians.subkriteria')->get();
        $kriterias = Kriteria::with('subkriteria')->get();

        return view('admin.penilaian.index', compact('pelamar', 'kriterias'));
    }
}
