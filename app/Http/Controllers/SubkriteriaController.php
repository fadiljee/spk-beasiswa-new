<?php
namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Subkriteria;
use Illuminate\Http\Request;

class SubkriteriaController extends Controller
{
    // Menampilkan form untuk menambah subkriteria
    public function create()
    {
        $kriterias = Kriteria::all(); // Ambil semua data kriteria
        return view('admin.subkriteria.create', compact('kriterias')); // Kirim ke view
    }

    // Menyimpan subkriteria yang baru
    public function store(Request $request)
    {
        $request->validate([
            'kriteria_id' => 'required|exists:kriterias,id',  // Pastikan kriteria_id ada
            'nama' => 'required|string|max:255',
            'nilai' => 'required|integer|min:0|max:100',
        ]);

        // Simpan subkriteria yang dipilih
        Subkriteria::create([
            'kriteria_id' => $request->kriteria_id,
            'nama' => $request->nama,
            'nilai' => $request->nilai,
        ]);

        return redirect()->route('subkriteria.index')->with('success', 'Subkriteria berhasil ditambahkan!');
    }

    // Menampilkan daftar subkriteria berdasarkan kriteria
   public function index()
{
    // Ambil semua data kriteria dengan subkriteria yang terkait menggunakan eager loading
    $kriterias = Kriteria::with('subkriteria')->get();  // Mengambil kriteria beserta subkriteria yang terkait

    return view('admin.subkriteria.index', compact('kriterias'));  // Kirim data kriteria dengan subkriteria ke view
}
// Menampilkan form untuk mengedit subkriteria
public function edit($id)
{
    $subkriteria = Subkriteria::findOrFail($id);  // Ambil subkriteria berdasarkan ID
    $kriterias = Kriteria::all();  // Ambil semua data kriteria
    return view('admin.subkriteria.edit', compact('subkriteria', 'kriterias'));
}

// Mengupdate subkriteria
public function update(Request $request, $id)
{
    $request->validate([
        'kriteria_id' => 'required|exists:kriterias,id',
        'nama' => 'required|string|max:255',
        'nilai' => 'required|integer|min:1|max:100',
    ]);

    $subkriteria = Subkriteria::findOrFail($id);  // Ambil subkriteria berdasarkan ID
    $subkriteria->update([
        'kriteria_id' => $request->kriteria_id,
        'nama' => $request->nama,
        'nilai' => $request->nilai,
    ]);

    return redirect()->route('subkriteria.index')->with('success', 'Subkriteria berhasil diperbarui!');
}
// Menghapus subkriteria
public function destroy($id)
{
    $subkriteria = Subkriteria::findOrFail($id);
    $subkriteria->delete();

    return redirect()->route('subkriteria.index')->with('success', 'Subkriteria berhasil dihapus!');
}

}
