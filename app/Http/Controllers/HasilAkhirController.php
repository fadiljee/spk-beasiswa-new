<?php

namespace App\Http\Controllers;

use App\Models\DataPelamar;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;
use App\Mail\HasilAkhirMail;

use App\Mail\HasilAkhirPelamarMail;

class HasilAkhirController extends Controller
{
  public function kirimEmail(Request $request)
{
    $pelamars = \App\Models\DataPelamar::whereNotNull('email')
        ->where('email', '!=', '')
        //->whereNotNull('status_lulus') // sementara di-nonaktifkan!
        ->get();

    $count = 0;
foreach ($pelamars as $pelamar) {
    dump($pelamar->nama_lengkap, $pelamar->email); // Lihat outputnya di browser
    if (filter_var($pelamar->email, FILTER_VALIDATE_EMAIL)) {
        try {
            Mail::to($pelamar->email)->send(new \App\Mail\HasilAkhirPelamarMail($pelamar));
            $count++;
        } catch (\Exception $e) {
            dump('Error kirim ke: ' . $pelamar->email . ' | ' . $e->getMessage());
        }
    } else {
        dump('Email tidak valid: ' . $pelamar->email);
    }
}
dd($count);
    return back()->with('success', "Berhasil mengirim email ke $count pelamar.");
}


}
