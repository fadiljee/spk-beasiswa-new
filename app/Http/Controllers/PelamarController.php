<?php

namespace App\Http\Controllers;

use App\Models\Pelamar;
use App\Models\DataPelamar;
use Illuminate\Http\Request;

class PelamarController extends Controller
{
    // Menampilkan daftar pelamar
    // Contoh di PelamarController.php

public function index(Request $request)
{
    $query = DataPelamar::query();

    // Logika Pencarian
    if ($request->has('search') && $request->search != '') {
        $search = $request->search;
        $query->where('nama_lengkap', 'like', '%' . $search . '%')
              ->orWhere('asal_universitas', 'like', '%' . $search . '%');
    }

    // Ambil data dengan paginasi, misalnya 10 data per halaman
    $pelamars = $query->latest()->paginate(10);

    return view('admin.pelamar.index', compact('pelamars'));
}

    // Menampilkan form untuk menambah pelamar
    public function create()
    {
        return view('admin.pelamar.create');
    }

    // Menyimpan data pelamar baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_pelamar' => 'required|string|max:255',
            'email' => 'required|email|unique:pelamars,email',
            'jurusan' => 'required|string|max:255',
            'alamat' => 'nullable|string',
        ]);

        Pelamar::create([
            'nama_pelamar' => $request->nama_pelamar,
            'email' => $request->email,
            'jurusan' => $request->jurusan,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('admin.pelamar.index')->with('success', 'Pelamar berhasil ditambahkan!');
    }

    // Menampilkan form untuk mengedit pelamar
    public function edit($id)
    {
        $pelamar = Pelamar::findOrFail($id);
        return view('admin.pelamar.edit', compact('pelamar'));
    }

    // Mengupdate data pelamar
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pelamar' => 'required|string|max:255',
            'email' => 'required|email|unique:pelamar,email,' . $id,
            'jurusan' => 'required|string|max:255',
            'alamat' => 'nullable|string',
        ]);

        $pelamar = Pelamar::findOrFail($id);
        $pelamar->update([
            'nama_pelamar' => $request->nama_pelamar,
            'email' => $request->email,
            'jurusan' => $request->jurusan,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('admin.pelamar.index')->with('success', 'Pelamar berhasil diperbarui!');
    }

    // Menghapus pelamar
    public function destroy($id)
    {
        $pelamar = Pelamar::findOrFail($id);
        $pelamar->delete();

        return redirect()->route('admin.pelamar.index')->with('success', 'Pelamar berhasil dihapus!');
    }
}

