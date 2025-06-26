<?php

namespace App\Http\Controllers;

use App\Models\Beasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class BeasiswaController extends Controller
{
    // Menampilkan form untuk menambah beasiswa
    public function create()
    {
        return view('admin.beasiswa.create'); // Mengarahkan ke view untuk menambah beasiswa
    }

    // Menyimpan data beasiswa baru
    public function store(Request $request)
{
    $request->validate([
        'nama_universitas' => 'required|string|max:255',
        'deskripsi' => 'required',
        'persyaratan' => 'required',
        'periode_akademik' => 'required|string|max:255',
        'statistik_penerimaan' => 'required',
        // 'manfaat' => 'required',
        'logo' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
    ]);

    if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
        $file = $request->file('logo'); 
        $fileName = now()->format('Y-m-d_H-i-s') . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
        Storage::disk('public')->put('logo/'.$fileName, file_get_contents($file));
    } else {
        $fileName = 'default.png';
    }

    $beasiswaData = [
        'nama_universitas' => $request->nama_universitas,
        'deskripsi' => $request->deskripsi,
        'persyaratan' => $request->persyaratan,
        'periode_akademik' => $request->periode_akademik,
        'statistik_penerimaan' => $request->statistik_penerimaan,
        // 'manfaat' => $request->manfaat,
        'logo' => $fileName,
    ];

    Beasiswa::create($beasiswaData);

    return redirect()->route('admin.beasiswa.index')->with('success', 'Beasiswa berhasil ditambahkan');
}
    public function edit($id)
    {
        $beasiswa = Beasiswa::findOrFail($id);
        return view('admin.beasiswa.edit', compact('beasiswa'));
    }
   public function update(Request $request, $id)
{
    $beasiswa = Beasiswa::findOrFail($id);

    $request->validate([
        'nama_universitas' => 'required|string|max:255',
        'deskripsi' => 'required',
        'persyaratan' => 'required',
        'periode_akademik' => 'required|string|max:255',
        'statistik_penerimaan' => 'required',
        // 'manfaat' => 'required',
        'logo' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
    ]);

    $fileName = $beasiswa->logo;

    if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
        if ($beasiswa->logo && $beasiswa->logo !== 'default.png' && Storage::disk('public')->exists('logo/'.$beasiswa->logo)) {
            Storage::disk('public')->delete('logo/'.$beasiswa->logo);
        }

        $file = $request->file('logo');
        $fileName = now()->format('Y-m-d_H-i-s') . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
        Storage::disk('public')->put('logo/'.$fileName, file_get_contents($file));
    }

    $beasiswa->update([
        'nama_universitas' => $request->nama_universitas,
        'deskripsi' => $request->deskripsi,
        'persyaratan' => $request->persyaratan,
        'periode_akademik' => $request->periode_akademik,
        'statistik_penerimaan' => $request->statistik_penerimaan,
        // 'manfaat' => $request->manfaat,
        'logo' => $fileName,
    ]);

    return redirect()->route('admin.beasiswa.index')->with('success', 'Beasiswa berhasil diperbarui');
}





    // Menampilkan semua beasiswa
    public function index()
    {
        $beasiswa = Beasiswa::all();
        return view('admin.beasiswa.index', compact('beasiswa'));
    }

    // public function dataInfo()
    // {
    //     // Ambil semua data beasiswa
    //     $beasiswa = Beasiswa::all();
        
    //     // Kirim data ke view user.index
    //     return view('user.beranda', compact('beasiswa'));
    // }
    // Menghapus beasiswa
    public function destroy($id)
    {
        $beasiswa = Beasiswa::findOrFail($id);

        // Menghapus logo jika ada
        if ($beasiswa->logo && Storage::exists('public/storage/logo/' . basename($beasiswa->logo))) {
            Storage::delete('public/storage/logo/' . basename($beasiswa->logo));
        }

        $beasiswa->delete();

        return redirect()->route('admin.beasiswa.index')->with('success', 'Beasiswa berhasil dihapus');
    }

    public function show($id)
    {
        // Ambil data beasiswa berdasarkan ID
        $beasiswa = Beasiswa::findOrFail($id);

        // Kirim data ke view beasiswa.show
        return view('user.detaiInfo', compact('beasiswa'));
    }

}

