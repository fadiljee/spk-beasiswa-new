<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Beasiswa;
use App\Models\Useraja;
use Illuminate\Support\Facades\DB;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login() {
    return view('user.login');
}

public function register() {
    return view('user.register');
}
public function dashboarduser()
{
    $universitas = Beasiswa::paginate(4); // misal 9 data per halaman
    return view('panel-user.pelamar.create', compact('universitas'));
}
public function beranda()
{
    $beasiswa = Beasiswa::paginate(4); // misal 9 data per halaman
    return view('user.beranda', compact('beasiswa'));
}


public function registerProses(Request $request) {
    $request->validate([
        'nama' => 'required',
        'nim' => 'required|unique:mahasiswa',
        'email' => 'required|email|unique:mahasiswa',
        'password' => 'required|confirmed|min:6',
        'jurusan' => 'required',
    ]);

    Mahasiswa::create([
        'nama' => $request->nama,
        'nim' => $request->nim,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'jurusan' => $request->jurusan,
    ]);

    return redirect()->route('loginuser')->with('success', 'Registrasi berhasil, silakan login.');
}

public function proseslogin(Request $request)
{
    $request->validate([
        'nim' => 'required',
        'password' => 'required',
    ]);

    $mahasiswa = Mahasiswa::where('nim', $request->nim)->first();

    if ($mahasiswa && Hash::check($request->password, $mahasiswa->password)) {
        // ✅ Simpan session manual
        session([
            'mahasiswa_id' => $mahasiswa->id,
            'mahasiswa_nama' => $mahasiswa->nama,
            'mahasiswa_nim' => $mahasiswa->nim,
            'mahasiswa_jurusan' => $mahasiswa->jurusan,
        ]);

        return redirect()->route('pendafaran.user');
    }

    return back()->withErrors(['nim' => 'NIM atau Password salah.']);
}
  public function edit()
{
    $id = session('mahasiswa_id');
    $user = Mahasiswa::find($id);

    if (!$user) {
        return redirect()->route('loginuser')->withErrors('User tidak ditemukan.');
    }

    return view('panel-user.profile.edit', compact('user'));
}

public function update(Request $request)
{
    $id = session('mahasiswa_id');

    $validated = $request->validate([
        'nama' => 'required|string|max:255',
        'nim' => 'required|string|max:50|unique:mahasiswa,nim,' . $id,
        'email' => 'required|email|max:255|unique:mahasiswa,email,' . $id,
        'password' => 'nullable|string|min:6|confirmed',
        'jurusan' => 'nullable|string|max:255',
    ]);

    $user = Mahasiswa::find($id);
    if (!$user) {
        return redirect()->route('loginuser')->withErrors('User tidak ditemukan.');
    }

    // Jika password diisi, hash dan update, kalau kosong jangan diubah
    if (!empty($validated['password'])) {
        $validated['password'] = Hash::make($validated['password']);
    } else {
        unset($validated['password']);
    }

    $user->update($validated);

    return redirect()->route('profile.edit')->with('success', 'Profil berhasil diperbarui.');
}


public function logout(Request $request)
{
    $request->session()->flush(); // ⬅️ hapus semua session
    return redirect()->route('user.beranda')->with('success', 'Anda telah berhasil logout.');
}

}
