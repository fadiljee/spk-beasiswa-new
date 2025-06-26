<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class DataUserController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::paginate(10);
        return view('admin.dataUser.index', compact('mahasiswa'));
    }

    public function create()
    {
        return view('admin.dataUser.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:50|unique:mahasiswa,nim',
            'jurusan' => 'required|string|max:100',
            'email' => 'required|email|unique:mahasiswa,email',
            'password' => 'required|string|min:6',
        ]);

        $data = $request->only(['nama', 'nim', 'jurusan', 'email']);
        $data['password'] = bcrypt($request->password);

        Mahasiswa::create($data);

        return redirect()->route('dataMahasiswa.index')->with('success', 'Data mahasiswa berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $mhs = Mahasiswa::findOrFail($id);
        return view('admin.dataUser.edit', compact('mhs'));
    }

    public function update(Request $request, $id)
    {
        $mhs = Mahasiswa::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:50|unique:mahasiswa,nim,' . $mhs->id,
            'jurusan' => 'required|string|max:100',
            'email' => 'required|email|unique:mahasiswa,email,' . $mhs->id,
            'password' => 'nullable|string|min:6',
        ]);

        $data = $request->only(['nama', 'nim', 'jurusan', 'email']);

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $mhs->update($data);

        return redirect()->route('dataMahasiswa.index')->with('success', 'Data mahasiswa berhasil diupdate.');
    }

    public function destroy($id)
    {
        $mhs = Mahasiswa::findOrFail($id);
        $mhs->delete();

        return redirect()->route('dataMahasiswa.index')->with('success', 'Data mahasiswa berhasil dihapus.');
    }
}
