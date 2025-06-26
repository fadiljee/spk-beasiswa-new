@extends('admin.layout')

{{-- Menggunakan section dari layout utama untuk judul --}}
@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Selamat datang kembali, ' . (Auth::user()->name ?? 'Admin') . '!')

@section('styles')
<style>
    /* Welcome Banner */
    .welcome-banner {
        background: linear-gradient(135deg, var(--primary-color), #7143e0);
        border-radius: 12px;
        padding: 2rem;
        color: #fff;
    }
    .welcome-banner h3 {
        font-weight: 700;
    }

    /* Stat Cards */
    .stat-card {
        background-color: #fff;
        border-radius: 12px;
        padding: 1.5rem;
        display: flex;
        align-items: center;
        border: 1px solid var(--border-color);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--card-shadow);
    }
    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-right: 1rem;
    }
    .stat-icon.bg-primary-light { background-color: var(--primary-light); color: var(--primary-color); }
    .stat-icon.bg-success-light { background-color: #dcfce7; color: #16a34a; }
    .stat-icon.bg-warning-light { background-color: #fef3c7; color: #d97706; }

    .stat-info .stat-number {
        font-size: 2rem;
        font-weight: 700;
        color: var(--text-dark);
    }
    .stat-info .stat-label {
        font-size: 0.9rem;
        color: #6b7280;
    }

    /* Navigation Cards */
    .nav-card {
        background-color: #fff;
        border-radius: 12px;
        border: 1px solid var(--border-color);
        text-align: center;
        padding: 2rem 1.5rem;
        text-decoration: none;
        color: var(--text-dark);
        display: block;
        height: 100%;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .nav-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 10px 25px rgba(79, 70, 229, 0.1);
        color: var(--primary-color);
    }
    .nav-card .nav-card-icon {
        font-size: 2.5rem;
        margin-bottom: 1rem;
        color: var(--primary-color);
        transition: transform 0.2s ease;
    }
    .nav-card:hover .nav-card-icon {
        transform: scale(1.1);
    }
    .nav-card .nav-card-title {
        font-size: 1.1rem;
        font-weight: 600;
    }
    .nav-card .nav-card-desc {
        font-size: 0.85rem;
        color: #6b7280;
    }
</style>
@endsection

@section('content')
{{-- 1. Welcome Banner --}}
<div class="welcome-banner mb-4">
    <div class="row align-items-center">
        <div class="col-md-8">
            <h3 class="mb-1">Halo, {{ Auth::user()->name ?? 'Admin' }}!</h3>
            <p class="mb-3 mb-md-0">Kelola semua data dan lihat hasil perhitungan dengan mudah melalui menu di bawah ini.</p>
        </div>
        <div class="col-md-4 text-md-end">
            <a href="{{ route('hasilakhir') }}" class="btn btn-light">
                <i class="fas fa-trophy me-2"></i>Lihat Hasil Akhir
            </a>
        </div>
    </div>
</div>

{{-- 2. Stat Cards --}}
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-icon bg-primary-light">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-info">
                {{-- Controller harus mengirim variabel $jumlahPelamar --}}
                <div class="stat-number">{{ $jumlahPelamar ?? 0 }}</div>
                <div class="stat-label">Total Pelamar</div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-icon bg-success-light">
                <i class="fas fa-list-check"></i>
            </div>
            <div class="stat-info">
                 {{-- Controller harus mengirim variabel $jumlahKriteria --}}
                <div class="stat-number">{{ $jumlahKriteria ?? 0 }}</div>
                <div class="stat-label">Total Kriteria</div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-icon bg-warning-light">
                <i class="fas fa-star"></i>
            </div>
            <div class="stat-info">
                 {{-- Controller harus mengirim variabel $jumlahPenilaian --}}
                <div class="stat-number">{{ $jumlahPenilaian ?? 0 }}</div>
                <div class="stat-label">Data Penilaian Masuk</div>
            </div>
        </div>
    </div>
</div>

{{-- 3. Navigation Cards --}}
<hr class="my-4">
<h4 class="mb-4 fw-bold">Menu Navigasi</h4>
<div class="row g-4">
    @php
        $cards = [
            ['route' => 'kriteria.index', 'label' => 'Data Kriteria', 'icon' => 'fa-list-check', 'desc' => 'Atur kriteria dan bobot untuk penilaian.'],
            ['route' => 'subkriteria.index', 'label' => 'Data Sub Kriteria', 'icon' => 'fa-layer-group', 'desc' => 'Kelola detail dan nilai untuk setiap kriteria.'],
            ['route' => 'pelamar.index', 'label' => 'Data Pelamar', 'icon' => 'fa-user-check', 'desc' => 'Lihat dan kelola data semua pelamar terdaftar.'],
            ['route' => 'penilaian.index', 'label' => 'Data Penilaian', 'icon' => 'fa-clipboard-check', 'desc' => 'Input dan edit data penilaian untuk setiap pelamar.'],
            ['route' => 'perhitungan.index', 'label' => 'Proses Perhitungan', 'icon' => 'fa-calculator', 'desc' => 'Lihat tahapan proses perhitungan metode SAW.'],
            ['route' => 'hasilakhir', 'label' => 'Hasil Akhir', 'icon' => 'fa-chart-line', 'desc' => 'Lihat papan peringkat final hasil seleksi.'],
        ];
    @endphp

    @foreach ($cards as $card)
    <div class="col-12 col-sm-6 col-lg-4">
        <a href="{{ route($card['route']) }}" class="nav-card">
            <div class="nav-card-icon">
                <i class="fas {{ $card['icon'] }}"></i>
            </div>
            <h5 class="nav-card-title">{{ $card['label'] }}</h5>
            <p class="nav-card-desc">{{ $card['desc'] }}</p>
        </a>
    </div>
    @endforeach
</div>
@endsection
