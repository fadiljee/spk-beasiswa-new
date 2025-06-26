<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Kriteria;
use App\Rules\LoginCheck;
use Illuminate\Support\Facades\Session;

class BljrController extends Controller
{


    public function dashboard()
    {
        $kriteria = Kriteria::all();
        return view('admin.dashboard', compact('kriteria'));
    }
    public function layout()
    {
        $kriteria = Kriteria::all();
        return view('admin.layout', compact('kriteria'));
    }

    public function login()
    {
        return view('admin.login');
    }

    public function proseslogin(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => ['required', new LoginCheck($request)],
        ]);

        // Jika validasi LoginCheck berhasil, redirect ke dashboard
        return redirect()->route('dashboardadmin');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('loginadmin');
    }
}
