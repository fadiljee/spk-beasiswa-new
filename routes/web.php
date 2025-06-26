<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BljrController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\SubkriteriaController;
use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\DataUserController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PelamarController;
use App\Http\Controllers\UserController\DashboardController;

use App\Http\Controllers\PerhitunganController;
use App\Http\Controllers\BeasiswaController;
use App\Http\Controllers\dataPelamarController;
use App\Http\Controllers\UserController\DashboarController;
use App\Http\Middleware\LoginCheck;
use App\Http\Middleware\LoggedIn;
use App\Http\Controllers\UserController\LoginController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', [LoginController::class, 'beranda'])->name('user.beranda');
Route::get('/admin', function ( ) {
    return view('admin.login');
});
Route::get('/register', function () {
    return view('user.register');
});

// Panel User
Route::get('/panel-user', [LoginController::class, 'dashboarduser'])->name('pendafaran.user');
Route::get('/panel-user/hasil-akhir', [DashboarController::class, 'hasilAkhir'])->name('hasil-akhir');
Route::post('/userlogout', [DashboarController::class, 'logout'])->name('user.logout');
// Route::get('mahasiswa/edit', [DashboarController::class, 'edit'])->name('usermahasiswa.edit');
// Route::put('mahasiswa/update/{id}', [DashboarController::class, 'update'])->name('usermahasiswa.update');

   Route::get('/perhitungan/hasil-akhir/pdf', [PerhitunganController::class, 'exportPdf'])->name('perhitungan.hasil_akhir.pdf');

// Route::get('/beranda', [LoginController::class, 'login'])->name('loginUser');
// Route::post('/beranda', [LoginController::class, 'login'])->name('login');
// Route::post('/register', [LoginController::class, 'register'])->name('registeruser');
// routes/web.php
Route::get('/loginuser', [LoginController::class, 'login'])->name('loginuser');
Route::post('/loginproses', [LoginController::class, 'proseslogin'])->name('proseslogin');

Route::get('/register', [LoginController::class, 'register'])->name('register.user');
Route::post('/registerproses', [LoginController::class, 'registerProses'])->name('registerproses');

Route::post('/logoutuser', [LoginController::class, 'logout'])->name('logoutuser');
// Tampilkan form edit profile user (pastikan middleware auth atau session sudah jalan)
Route::get('/profile/edit', [LoginController::class, 'edit'])->name('profile.edit');

// Proses update data profile
Route::post('/profile/update', [LoginController::class, 'update'])->name('profile.update');



// form inputan
Route::get('user/pelamar/create', [dataPelamarController::class, 'create'])->name('user.pelamar.create');
Route::post('/pelamar', [dataPelamarController::class, 'store'])->name('pelamar.store');




    Route::get('/beasiswa/{id}', [BeasiswaController::class, 'show'])->name('beasiswa.show');

// Group Middleware untuk LoginCheck
Route::middleware(LoginCheck::class)->group(function () {
    Route::get('/login', [BljrController::class, 'login'])->name('loginadmin');
    Route::post('/proseslogin', [BljrController::class, 'proseslogin'])->name('loginproses'); // Ubah GET ke POST
});


// Group Middleware untuk LoggedIn
Route::middleware(LoggedIn::class)->group(function () {


    // beasiswa
    Route::get('/admin/beasiswa', [BeasiswaController::class, 'index'])->name('admin.beasiswa.index');
    Route::get('/admin/beasiswa/create', [BeasiswaController::class, 'create'])->name('admin.beasiswa.create');
    Route::post('/admin/beasiswa', [BeasiswaController::class, 'store'])->name('admin.beasiswa.store');
    Route::get('/admin/beasiswa/{id}/edit', [BeasiswaController::class, 'edit'])->name('admin.beasiswa.edit');
    Route::put('/admin/beasiswa/{id}', [BeasiswaController::class, 'update'])->name('admin.beasiswa.update');
    Route::delete('/admin/beasiswa/{id}', [BeasiswaController::class, 'destroy'])->name('admin.beasiswa.destroy');


    // Route dari BljrController
    Route::get('/dashboardadmin', [BljrController::class, 'dashboard'])->name('dashboard');
    Route::get('/dataperhitungan', [BljrController::class, 'dataperhitungan'])->name('dataperhitungan');
    Route::get('/datahasilakhir', [BljrController::class, 'datahasilakhir'])->name('datahasilakhir');
    Route::get('/dataprofile', [BljrController::class, 'dataprofile'])->name('dataprofile');
    Route::get('/dashboard', [BljrController::class, 'dashboard'])->name('dashboardadmin');


    // Data Mahasiswa
    // Route::get('/datamahasiswa', [dataController::class, 'index'])->name('dataMahasiswa');
    // Route::post('/prosesTambah', [dataController::class, 'store'])->name('prosesDataMahasiswa');
    // Route::get('/mahasiswa/{id}/edit', [dataController::class, 'edit'])->name('editDataMahasiswa');
    // Route::put('/mahasiswa/{id}', [dataController::class, 'update'])->name('updateDataMahasiswa');
    // Route::get('/mahasiswa/create', [dataController::class, 'create'])->name('createDataMahasiswa');
    // Route::get('/mahasiswa/{id}', [dataController::class, 'show'])->name('showDataMahasiswa');
    // Route::delete('/mahasiswa/{id}', [dataController::class, 'destroy'])->name('deleteDataMahasiswa');

    // Data Kreteria
    Route::get('kriteria', [KriteriaController::class, 'index'])->name('kriteria.index');

    // Menampilkan form tambah kriteria
    Route::get('kriteria/create', [KriteriaController::class, 'create'])->name('kriteria.create');

    // Menyimpan kriteria baru
    Route::post('kriteria', [KriteriaController::class, 'store'])->name('kriteria.store');

    // Menampilkan form edit kriteria
    Route::get('kriteria/{id}/edit', [KriteriaController::class, 'edit'])->name('kriteria.edit');

    // Mengupdate data kriteria
    Route::put('kriteria/{id}', [KriteriaController::class, 'update'])->name('kriteria.update');

    // Menghapus kriteria
    Route::delete('kriteria/{id}', [KriteriaController::class, 'destroy'])->name('kriteria.destroy');



    // Sub Kriteria
 // Menampilkan form untuk menambah subkriteria
    Route::get('subkriteria/create', [SubkriteriaController::class, 'create'])->name('subkriteria.create');

     Route::post('subkriteria', [SubkriteriaController::class, 'store'])->name('subkriteria.store');

    // Menampilkan daftar subkriteria
    Route::get('subkriteria', [SubkriteriaController::class, 'index'])->name('subkriteria.index');

    // Menampilkan form untuk mengedit subkriteria
    Route::get('subkriteria/{id}/edit', [SubkriteriaController::class, 'edit'])->name('subkriteria.edit');

    // Mengupdate subkriteria
    Route::put('subkriteria/{id}', [SubkriteriaController::class, 'update'])->name('subkriteria.update');

    // Menghapus subkriteria
    Route::delete('subkriteria/{id}', [SubkriteriaController::class, 'destroy'])->name('subkriteria.destroy');


    // Route dari PelamarController
    // Menyimpan data pelamar baru
    Route::post('/penilaian/store', [PenilaianController::class, 'store'])->name('penilaian.store');

    Route::get('pelamar/create', [PelamarController::class, 'create'])->name('pelamar.create');

    // Menampilkan daftar pelamar
    Route::get('pelamar', [PelamarController::class, 'index'])->name('pelamar.index');

    // Menampilkan form untuk mengedit pelamar
    Route::get('pelamar/{id}/edit', [PelamarController::class, 'edit'])->name('pelamar.edit');

    // Mengupdate data pelamar
    Route::put('pelamar/{id}', [PelamarController::class, 'update'])->name('pelamar.update');

    // Menghapus pelamar
    Route::delete('pelamar/destroy/{id}', [DataPelamarController::class, 'destroy'])->name('pelamar.destroy');

    Route::get('/pelamar/{id}', [DataPelamarController::class, 'show'])->name('pelamar.show');



    //penilian

        Route::get('/penilaian', [PenilaianController::class, 'index'])->name('penilaian.index');
        Route::get('/penilaian/create/{pelamar_id}', [PenilaianController::class, 'create'])->name('penilaian.create');
        Route::post('/penilaian/store', [PenilaianController::class, 'store'])->name('penilaian.store');
        Route::get('/get-subkriteria/{kriteria_id}', [PenilaianController::class, 'getSubkriteria']);

    // Perhitungan
    Route::get('/perhitungan', [PerhitunganController::class, 'index'])->name('perhitungan.index');

    Route::get('/perhitungan/hasil-akhir', [PerhitunganController::class, 'hasilAkhir'])->name('hasilakhir');


    // Data User
     // Tampil semua data mahasiswa
    Route::get('dataMahasiswa', [DataUserController::class, 'index'])->name('dataMahasiswa.index');

    // Form tambah mahasiswa
    Route::get('dataMahasiswa/create', [DataUserController::class, 'create'])->name('dataMahasiswa.create');

    // Simpan data mahasiswa baru
    Route::post('dataMahasiswa', [DataUserController::class, 'store'])->name('dataMahasiswa.store');

    // Form edit mahasiswa berdasarkan id
    Route::get('dataMahasiswa/{id}/edit', [DataUserController::class, 'edit'])->name('dataMahasiswa.edit');

    // Update data mahasiswa berdasarkan id
    Route::put('dataMahasiswa/{id}', [DataUserController::class, 'update'])->name('dataMahasiswa.update');

    // Hapus data mahasiswa berdasarkan id
    Route::delete('dataMahasiswa/{id}', [DataUserController::class, 'destroy'])->name('dataMahasiswa.destroy');

    Route::post('/kirim/hasil/email', [PerhitunganController::class, 'kirimHasilKeEmail'])->name('kirim.email');
Route::post('/kirim/hasil/whatsapp', [PerhitunganController::class, 'kirimHasilKeWhatsApp'])->name('kirim.whatsapp');




    // Logout
    Route::post('/logout', [BljrController::class, 'logout'])->name('logout');
});
