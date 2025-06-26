<?php

namespace App\Http\Controllers;

use App\Models\Beasiswa;
use App\Models\DataPelamar;
use Illuminate\Http\Request;

class DataPelamarController extends Controller
{
    public function create()
    {
        // Mengambil semua data beasiswa untuk ditampilkan di form
        $universitas = Beasiswa::all();
        return view('panel-user.pelamar.create', compact('universitas'));
    }

    public function store(Request $request)
    {
        // Validasi inputan dari user, termasuk file baru
        $validated = $request->validate([
        'email' => 'required|email|unique:data_pelamar,email',
        'nama_lengkap' => 'required|string|max:255',
        'jurusan' => 'nullable|string|max:255',
        'asal_universitas' => 'nullable|string|max:255',
        'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        'tempat_lahir' => 'required|string|max:255',
        'tanggal_lahir' => 'required|date',
        'nomor_whatsapp' => 'required|string|max:20',
        'alamat' => 'required|string',
        'cv' => 'required|file|mimes:pdf|max:2048',
        'ipk' => 'nullable|numeric|min:0|max:4',
        'transkrip_nilai' => 'nullable|file|mimes:pdf|max:2048',
        'ijazah' => 'nullable|file|mimes:pdf|max:2048',
        'universitas_beasiswa_id_1' => 'required|exists:beasiswa,id',
        'universitas_beasiswa_id_2' => 'nullable|exists:beasiswa,id|different:universitas_beasiswa_id_1',
    ]);


        // Upload CV, Transkrip Nilai, dan Ijazah ke storage
        $cvPath = $request->file('cv')->store('pelamar_cv', 'public');
        $transkripPath = $request->file('transkrip_nilai') ? $request->file('transkrip_nilai')->store('pelamar_transkrip', 'public') : null;
        $ijazahPath = $request->file('ijazah') ? $request->file('ijazah')->store('pelamar_ijazah', 'public') : null;

        // Simpan data pelamar (termasuk IPK, Transkrip Nilai, dan Ijazah)
        $pelamar = DataPelamar::create([
            'email' => $validated['email'],
            'nama_lengkap' => $validated['nama_lengkap'],
            'jurusan' => $validated['jurusan'],
            'asal_universitas' => $validated['asal_universitas'],
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'tempat_lahir' => $validated['tempat_lahir'],
            'tanggal_lahir' => $validated['tanggal_lahir'],
            'nomor_whatsapp' => $validated['nomor_whatsapp'],
            'alamat' => $validated['alamat'],
            'cv_path' => $cvPath,
            'ipk' => $validated['ipk'], // Menyimpan IPK
            'transkrip_nilai_path' => $transkripPath, // Menyimpan Transkrip Nilai
            'ijazah_path' => $ijazahPath, // Menyimpan Ijazah
        ]);

        // Siapkan array universitas yang dipilih (maksimal 2 universitas)
        $universitasIds = [$validated['universitas_beasiswa_id_1']];
        if (!empty($validated['universitas_beasiswa_id_2'])) {
            $universitasIds[] = $validated['universitas_beasiswa_id_2'];
        }

        // Menyambungkan pelamar dengan universitas melalui relasi many-to-many
        $pelamar->beasiswas()->sync($universitasIds);

        // Redirect ke halaman beranda dengan pesan sukses
        return redirect()->route('user.pelamar.create')->with('success', 'Data pelamar berhasil disimpan!');
    }

    public function show($id)
{
    // Ambil data pelamar berdasarkan ID
    $pelamar = DataPelamar::findOrFail($id);

    // Kembalikan tampilan dengan data pelamar
    return view('admin.pelamar.show', compact('pelamar'));
}

    public function destroy($id)
    {
        // Ambil data pelamar berdasarkan ID
        $pelamar = DataPelamar::findOrFail($id);

        // Hapus relasi many-to-many terlebih dahulu (untuk memastikan data pada tabel pivot dihapus)
        $pelamar->beasiswas()->detach();

        // Hapus data pelamar
        $pelamar->delete();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('pelamar.index')->with('success', 'Data pelamar berhasil dihapus!');
    }
}
