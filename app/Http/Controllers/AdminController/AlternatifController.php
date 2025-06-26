<?php
namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    // Menampilkan halaman daftar kriteria
    public function index()
    {
        $kriteria = Kriteria::all();
        return view('admin.kriteria.index', compact('kriteria'));
    }

    // Menampilkan form untuk menambah kriteria
    public function create()
    {
        return view('admin.kriteria.create');
    }

    // Menyimpan data kriteria yang baru
    public function store(Request $request)
    {
        $request->validate([
            'kode_kriteria' => 'required|string|max:255',
            'nama_kriteria' => 'required|string|max:255',
            'bobot' => 'required|numeric|min:0|max:1',
            'jenis' => 'required|string|max:255',
        ]);

        Kriteria::create([
            'kode_kriteria' => $request->kode_kriteria,
            'nama_kriteria' => $request->nama_kriteria,
            'bobot' => $request->bobot,
            'jenis' => $request->jenis,
        ]);

        return redirect()->route('kriteria.index')->with('success', 'Kriteria berhasil ditambahkan!');
    }

    // Menampilkan form untuk mengedit kriteria
    public function edit($id)
    {
        $kriteria = Kriteria::findOrFail($id);
        return view('admin.kriteria.edit', compact('kriteria'));
    }

    // Mengupdate data kriteria
    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_kriteria' => 'required|string|max:255',
            'nama_kriteria' => 'required|string|max:255',
            'bobot' => 'required|numeric|min:0|max:1',
            'jenis' => 'required|string|max:255',
        ]);

        $kriteria = Kriteria::findOrFail($id);
        $kriteria->update([
            'kode_kriteria' => $request->kode_kriteria,
            'nama_kriteria' => $request->nama_kriteria,
            'bobot' => $request->bobot,
            'jenis' => $request->jenis,
        ]);

        return redirect()->route('kriteria.index')->with('success', 'Kriteria berhasil diperbarui!');
    }

    // Menghapus data kriteria
    public function destroy($id)
    {
        $kriteria = Kriteria::findOrFail($id);
        $kriteria->delete();

        return redirect()->route('kriteria.index')->with('success', 'Kriteria berhasil dihapus!');
    }
}
