@extends('panel-user.layout')

@section('title', 'Hasil Akhir Peringkat')
@section('page-title', 'Hasil Akhir Peringkat')
@section('page-subtitle', 'Lihat posisi Anda dalam peringkat akhir seleksi.')

<style>
    .leaderboard-card {
        background-color: #fff;
        border-radius: 12px;
        border: 1px solid var(--border-color);
        box-shadow: var(--card-shadow);
        overflow: hidden;
    }

    .leaderboard-header {
        padding: 1.25rem 1.5rem;
        background-color: #f8f9fa;
        border-bottom: 1px solid var(--border-color);
    }

    .custom-table thead th {
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-size: 0.85rem;
        background-color: #f8f9fa;
    }

    .custom-table td {
        padding: 1rem 1.5rem;
        vertical-align: middle;
    }

    /* Highlight untuk pengguna yang sedang login */
    .user-highlight {
        background-color: var(--primary-light) !important;
        border-left: 4px solid var(--user-primary-color);
        border-right: 4px solid var(--user-primary-color);
    }

    .pelamar-info { display: flex; align-items: center; gap: 1rem; }
    .pelamar-avatar { width: 40px; height: 40px; border-radius: 50%; }
    .pelamar-nama { font-weight: 600; }

    .skor-badge {
        font-size: 1rem;
        font-weight: 600;
        padding: 0.5rem 1rem;
        border-radius: 999px;
        background-color: #e9ecef;
        color: #212529;
    }

    .rank-cell { font-weight: 700; font-size: 1.25rem; }
    .rank-icon { font-size: 1.75rem; }
    .rank-1 .rank-icon { color: #ffd700; } /* Gold */
    .rank-2 .rank-icon { color: #c0c0c0; } /* Silver */
    .rank-3 .rank-icon { color: #cd7f32; } /* Bronze */
</style>

@section('content')
<div class="leaderboard-card">
    <div class="leaderboard-header d-flex flex-wrap justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold">Papan Peringkat Seleksi</h5>

        {{-- Pastikan route ini benar dan bisa diakses oleh user --}}
        <a href="{{ route('perhitungan.hasil_akhir.pdf') }}" target="_blank" class="btn btn-outline-primary">
            <i class="fas fa-print me-2"></i>Cetak Hasil
        </a>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover custom-table align-middle text-center mb-0">
                <thead>
                    <tr>
                        <th style="width: 15%;">Peringkat</th>
                        <th class="text-start">Nama Pelamar</th>
                        <th style="width: 25%;">Skor Akhir</th>
                    </tr>
                </thead>
                <tbody>
                    @php $currentUser = Auth::user(); @endphp
                    @forelse ($hasilAkhir as $index => $data)
                        {{-- Tambahkan class 'user-highlight' jika nama pelamar cocok dengan nama user yang login --}}
                        <tr class="rank-{{ $index + 1 }} @if($currentUser && $data['pelamar'] == $currentUser->name) user-highlight @endif">
                            <td class="rank-cell">
                                @if ($index < 3)
                                    <i class="fas fa-medal rank-icon"></i>
                                @else
                                    {{ $index + 1 }}
                                @endif
                            </td>
                            <td class="text-start">
                                <div class="pelamar-info">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($data['pelamar']) }}&background=e9ecef&color=212529"
                                         alt="Avatar" class="pelamar-avatar">
                                    <span class="pelamar-nama">{{ $data['pelamar'] }}</span>
                                    @if($currentUser && $data['pelamar'] == $currentUser->name)
                                        <span class="badge bg-primary">Ini Anda</span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                {{-- PERBAIKAN: Menggunakan key 'skor' bukan 'nilai' --}}
                                <span class="skor-badge">{{ number_format($data['skor'], 4) }}</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-5">
                                <i class="fas fa-info-circle fs-3 text-muted mb-3"></i>
                                <h6 class="text-muted">Hasil Peringkat Belum Tersedia</h6>
                                <p class="text-muted small">Silakan hubungi administrator atau tunggu pengumuman resmi.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
