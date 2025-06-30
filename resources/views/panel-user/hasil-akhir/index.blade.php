@extends('panel-user.layout')

@section('title', 'Hasil Akhir Peringkat')
@section('page-title', 'Papan Peringkat Final')
@section('page-subtitle', 'Lihat posisi Anda dalam peringkat akhir seleksi.')

@section('content')
<style>
    /* === Menggunakan basis desain yang sama dengan halaman Admin === */
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

    :root {
        --font-family: 'Inter', 'Poppins', sans-serif;
        --primary-color: #4F46E5; /* Indigo */
        --text-primary: #111827; /* Gray 900 */
        --text-secondary: #6B7280; /* Gray 500 */
        --bg-main: #F9FAFB; /* Gray 50 */
        --bg-card: #FFFFFF;
        --border-color: #E5E7EB; /* Gray 200 */

        --success-bg: #D1FAE5;
        --success-text: #065F46;
        --success-border: #10B981;

        /* Warna Medali */
        --gold-medal: #fbbF24;
        --silver-medal: #9ca3af;
        --bronze-medal: #d97706;
    }

    body {
        font-family: var(--font-family) !important;
        background-color: var(--bg-main) !important;
    }

    /* === Container Utama (Card) === */
    .leaderboard-container {
        max-width: 900px;
        margin: 40px auto;
        background-color: var(--bg-card);
        border-radius: 16px;
        border: 1px solid var(--border-color);
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.05);
        overflow: hidden;
    }

    .leaderboard-header {
        padding: 1.5rem 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid var(--border-color);
    }
    .header-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--text-primary);
    }

    .btn-print {
        background-color: var(--primary-color);
        color: white;
        padding: 0.6rem 1rem;
        border-radius: 8px;
        border: none;
        font-weight: 500;
        font-size: 0.9rem;
        transition: background-color 0.2s ease;
    }
    .btn-print:hover {
        background-color: #4338CA;
    }

    /* === Tabel Peringkat === */
    .ranking-table {
        width: 100%;
        border-collapse: collapse;
    }
    .ranking-table th,
    .ranking-table td {
        padding: 1rem 1.5rem;
        text-align: left;
        vertical-align: middle;
    }
    .ranking-table thead th {
        color: var(--text-secondary);
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        background-color: #F9FAFB;
    }
    .ranking-table tbody tr {
        border-top: 1px solid var(--border-color);
        transition: background-color 0.2s ease;
    }
    .ranking-table tbody tr:hover {
        background-color: #F3F4F6; /* Gray 100 */
    }

    .user-highlight {
        background-color: #E0E7FF !important; /* Indigo 100 */
        border-left: 4px solid var(--primary-color);
        border-right: 4px solid var(--primary-color);
    }

    .rank-cell { font-size: 1.25rem; font-weight: 700; color: var(--text-primary); }
    .medal-icon { font-size: 2rem; }
    .rank-1 .medal-icon { color: var(--gold-medal); }
    .rank-2 .medal-icon { color: var(--silver-medal); }
    .rank-3 .medal-icon { color: var(--bronze-medal); }

    .applicant-info { display: flex; align-items: center; gap: 1rem; }
    .applicant-avatar { width: 40px; height: 40px; border-radius: 50%; object-fit: cover; }
    .applicant-name { font-weight: 600; color: var(--text-primary); }

    .score-badge { display: inline-block; padding: 0.4rem 1rem; border-radius: 20px; font-size: 0.95rem; font-weight: 600; background-color: #EEF2FF; color: var(--primary-color); }
    .status-badge { display: inline-flex; align-items: center; gap: 0.4rem; padding: 0.4rem 0.8rem; border-radius: 8px; font-weight: 600; font-size: 0.85rem; background-color: var(--success-bg); color: var(--success-text); border: 1px solid var(--success-border); }

    .empty-state { text-align: center; padding: 4rem 2rem; }
    .empty-state-title { font-size: 1.1rem; font-weight: 600; margin-top: 1rem; }
    .empty-state-subtitle { color: var(--text-secondary); }

    /* === PERUBAHAN: CSS UNTUK PAGINASI === */
    .pagination-container {
        padding: 1.5rem 2rem;
        background-color: #F9FAFB;
        border-top: 1px solid var(--border-color);
    }
    .pagination {
        justify-content: center;
        margin-bottom: 0;
    }
    .page-item .page-link {
        border-radius: 8px !important;
        margin: 0 3px;
        border: 1px solid var(--border-color);
        color: var(--text-secondary);
        font-weight: 500;
    }
    .page-item .page-link:hover {
        background-color: #F3F4F6;
        border-color: #D1D5DB;
    }
    .page-item.active .page-link {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
        color: white;
        z-index: 1;
    }
    .page-item.disabled .page-link {
        color: #D1D5DB;
        background-color: #fff;
        border-color: var(--border-color);
    }

</style>

<div class="leaderboard-container">
    <div class="leaderboard-header">
        <h5 class="header-title mb-0">Papan Peringkat Final</h5>
        <a href="{{ route('perhitungan.hasil_akhir.pdf') }}" target="_blank" class="btn btn-print">
            <i class="fas fa-print me-1"></i> Cetak Hasil
        </a>
    </div>

    <div class="table-responsive">
        <table class="table ranking-table mb-0">
            <thead>
                <tr>
                    <th class="text-center" style="width: 15%;">Peringkat</th>
                    <th class="text-start">Pelamar</th>
                    <th class="text-center" style="width: 20%;">Nilai Akhir</th>
                    <th class="text-center" style="width: 20%;">Status</th>
                </tr>
            </thead>
            <tbody>
                {{-- PERUBAHAN: Variabel $hasilAkhir sekarang adalah objek paginasi --}}
                @forelse ($hasilAkhir as $data)
                    @php
                        // Logika ini tetap sama
                        $pelamar = \App\Models\DataPelamar::where('nama_lengkap', $data['pelamar'])->first();

                        // PERUBAHAN: Logika untuk nomor peringkat yang benar
                        $peringkat = ($hasilAkhir->currentPage() - 1) * $hasilAkhir->perPage() + $loop->iteration;
                    @endphp

                    <tr class="
                        rank-{{ $peringkat }}
                        {{ (auth()->check() && auth()->user()->name == $data['pelamar']) ? 'user-highlight' : '' }}
                    ">
                        <td class="text-center rank-cell">
                            @if ($peringkat <= 3)
                                <i class="fas fa-medal medal-icon"></i>
                            @else
                                {{ $peringkat }}
                            @endif
                        </td>
                        <td>
                            <div class="applicant-info">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($data['pelamar']) }}&background=E0E7FF&color=4338CA&font-size=0.4"
                                     alt="Avatar" class="applicant-avatar">
                                <span class="applicant-name">{{ $data['pelamar'] }}</span>
                            </div>
                        </td>
                        <td class="text-center">
                            <span class="score-badge">
                                {{ number_format($data['V'] ?? $data['skor'], 2) }}
                            </span>
                        </td>
                        <td class="text-center">
                            @if ($pelamar?->status_lulus == 'lulus')
                                <span class="status-badge">
                                    <i class="fas fa-check-circle"></i> Lulus
                                </span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">
                            <div class="empty-state">
                                <i class="fas fa-info-circle fs-2 text-muted"></i>
                                <h6 class="empty-state-title">Hasil Peringkat Belum Diumumkan</h6>
                                <p class="empty-state-subtitle small">Silakan cek kembali nanti.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- PERUBAHAN: Menambahkan navigasi paginasi di sini --}}
    @if ($hasilAkhir->hasPages())
    <div class="pagination-container">
        {{ $hasilAkhir->links('pagination::bootstrap-5') }}
    </div>
    @endif

</div>
@endsection
