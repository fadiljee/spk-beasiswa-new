@extends('admin.layout')

@section('title', 'Hasil Akhir & Perankingan')
@section('page-title', 'Hasil Akhir & Perankingan')

@section('content')
<style>
    /* === Google Font & Global Reset === */
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

    :root {
        --font-family: 'Inter', 'Poppins', sans-serif;
        --primary-color: #4F46E5; /* Indigo */
        --primary-hover: #4338CA;
        --text-primary: #111827; /* Gray 900 */
        --text-secondary: #6B7280; /* Gray 500 */
        --bg-main: #F9FAFB; /* Gray 50 */
        --bg-card: #FFFFFF;
        --border-color: #E5E7EB; /* Gray 200 */
        --highlight-bg: #F0FDF4; /* Green 50 */
        --highlight-border: #22C55E; /* Green 500 */

        --success-bg: #D1FAE5;
        --success-text: #065F46;
        --danger-bg: #FEE2E2;
        --danger-text: #991B1B;
        --neutral-bg: #F3F4F6;
        --neutral-text: #374151;
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }

    body {
        font-family: var(--font-family) !important;
        background-color: var(--bg-main) !important;
        color: var(--text-primary);
    }

    /* === Main Container (Card) === */
    .dashboard-container {
        max-width: 1200px;
        margin: 50px auto;
        background-color: var(--bg-card);
        border-radius: 16px;
        border: 1px solid var(--border-color);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    .dashboard-content { padding: 2rem 2.5rem; }

    /* === Header === */
    .dashboard-header {
        padding: 1.5rem 2.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1.5rem;
        border-bottom: 1px solid var(--border-color);
    }

    .header-title { font-size: 1.75rem; font-weight: 700; display: flex; align-items: center; gap: 0.8rem; }
    .header-title .emoji { font-size: 1.5em; }

    /* === Button Styles === */
    .btn { display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.75rem 1.25rem; border-radius: 10px; border: none; font-weight: 600; font-size: 0.95rem; cursor: pointer; transition: all 0.2s ease-in-out; }
    .btn-primary { background-color: var(--primary-color); color: white; }
    .btn-primary:hover { background-color: var(--primary-hover); transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
    .btn-secondary { background-color: var(--bg-card); color: var(--text-primary); border: 1px solid var(--border-color); }
    .btn-secondary:hover { background-color: #F9FAFB; border-color: #D1D5DB; }

    /* === Table Styling === */
    .ranking-table { width: 100%; border-collapse: collapse; }
    .ranking-table th, .ranking-table td { padding: 1.25rem 1rem; text-align: left; vertical-align: middle; }
    .ranking-table thead th { color: var(--text-secondary); font-size: 0.8rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 2px solid var(--border-color); }
    .ranking-table tbody tr { border-bottom: 1px solid var(--border-color); transition: background-color 0.2s ease; }
    .ranking-table tbody tr:last-child { border-bottom: none; }
    .ranking-table tbody tr:hover { background-color: var(--bg-main); }

    /* --- Special Cells & Components --- */
    .rank-cell { font-size: 1.1rem; font-weight: 700; color: var(--primary-color); }
    .name-cell { font-weight: 600; }
    .calculation-text { font-family: monospace; color: var(--text-secondary); font-size: 0.9rem; }
    .top-rank { background-color: var(--highlight-bg) !important; border-left: 4px solid var(--highlight-border); }

    /* --- Badges --- */
    .badge { display: inline-block; padding: 0.35rem 0.75rem; border-radius: 20px; font-size: 0.8rem; font-weight: 600; letter-spacing: 0.3px; }
    .badge-score { background-color: #eef2ff; color: var(--primary-color); }
    .badge-success { background-color: var(--success-bg); color: var(--success-text); }
    .badge-danger { background-color: var(--danger-bg); color: var(--danger-text); }
    .badge-neutral { background-color: var(--neutral-bg); color: var(--neutral-text); }

    /* --- Custom Form Select --- */
    .custom-select { appearance: none; -webkit-appearance: none; background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e"); background-position: right 0.5rem center; background-repeat: no-repeat; background-size: 1.5em 1.5em; padding-right: 2.5rem; border: 1px solid var(--border-color); border-radius: 8px; padding: 0.5rem 2.5rem 0.5rem 0.75rem; font-size: 0.9rem; width: 100%; transition: border-color 0.2s ease, box-shadow 0.2s ease; }
    .custom-select:hover { border-color: #D1D5DB; }
    .custom-select:focus { outline: none; border-color: var(--primary-color); box-shadow: 0 0 0 2px #eef2ff; }

    /* --- Empty State --- */
    .empty-state { text-align: center; padding: 5rem 2rem; }
    .empty-state svg { width: 60px; height: 60px; color: #D1D5DB; margin-bottom: 1.5rem; }
    .empty-state-title { font-size: 1.25rem; font-weight: 600; margin-bottom: 0.5rem; }
    .empty-state-subtitle { color: var(--text-secondary); max-width: 400px; margin: 0 auto; }

    /* === PENAMBAHAN: CSS UNTUK PAGINASI === */
    .pagination-container {
        padding: 1.5rem 2.5rem;
        background-color: #F9FAFB;
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
        background-color: white;
    }
    .page-item .page-link:hover {
        background-color: #F3F4F6;
        border-color: #D1D5DB;
        z-index: 2;
    }
    .page-item.active .page-link {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
        color: white;
        z-index: 3;
    }
    .page-item.disabled .page-link {
        color: #D1D5DB;
        background-color: #fff;
        border-color: var(--border-color);
    }
</style>

<div class="dashboard-container">
    <div class="dashboard-header">
        <div class="header-title">
            <span class="emoji">🏆</span>
            <div>
                <h1 class="header-title" style="font-size: 1.5rem; margin: 0;">Hasil Akhir & Perankingan</h1>
                <p style="font-size: 0.95rem; font-weight: 400; color: var(--text-secondary); margin-top: 0.25rem;">Manajemen status kelulusan berdasarkan nilai akhir.</p>
            </div>
        </div>
        <div class="leaderboard-actions">
            <a href="{{ route('hasilAkhir.pdf') }}" class="btn btn-secondary" target="_blank">
                <i class="fas fa-file-pdf"></i> Export ke PDF
            </a>
            <form action="{{ route('hasilAkhir.kirimEmail') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-primary" onclick="return confirm('Kirim hasil akhir ke semua pelamar?')">
                    <i class="fas fa-envelope"></i> Kirim ke Email Pelamar
                </button>
            </form>
            <form action="{{ route('hasilAkhir.kirimWa') }}" method="POST" style="display:inline;">
    @csrf
    <button type="submit" class="btn btn-success" onclick="return confirm('Kirim hasil akhir ke WhatsApp semua pelamar?')">
        <i class="fab fa-whatsapp"></i> Kirim ke WhatsApp Pelamar
    </button>
</form>
        </div>
    </div>

    <div class="dashboard-content">
        @if(session('success'))
            <div class="alert alert-success mb-4">{{ session('success') }}</div>
        @endif

        <form action="{{ route('hasilAkhir.simpanStatus') }}" method="POST">
        @csrf
        <div class="table-responsive">
            <table class="ranking-table">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 5%;">Rank</th>
                        <th>Nama Pelamar</th>
                        <th>Perhitungan</th>
                        <th>Nilai Akhir</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Tahun</th>
                        <th style="min-width: 150px;">Opsi Kelulusan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($hasilAkhir as $row)
                    @php
                        $pelamar = \App\Models\DataPelamar::where('nama_lengkap', $row['pelamar'])->first();
                    @endphp
                    <tr class="{{ $row['ranking'] == 1 ? 'top-rank' : '' }}">
                        <td class="rank-cell text-center">{{ $row['ranking'] }}</td>
                        <td class="name-cell">{{ $row['pelamar'] }}</td>
                        <td>
                            <span class="calculation-text">{{ $row['calculation'] }}</span>
                        </td>
                        <td>
                            <span class="badge badge-score">{{ number_format($row['V'], 2) }}</span>
                        </td>
                        <td class="text-center">
                            @if($pelamar?->status_lulus == 'lulus')
                                <span class="badge badge-success">Lulus</span>
                            @elseif($pelamar?->status_lulus == 'tidak_lulus')
                                <span class="badge badge-danger">Tidak Lulus</span>
                            @else
                                <span class="badge badge-neutral">Belum Ada</span>
                            @endif
                        </td>
                        <td class="text-center">
                             {{ $pelamar?->status_lulus == 'lulus' ? $pelamar->tahun_lulus : ($pelamar?->status_lulus == 'tidak_lulus' ? $pelamar->tahun_tidak_lulus : '-') }}
                        </td>
                        <td>
                            @if($pelamar)
                                <input type="hidden" name="pelamar_id[]" value="{{ $pelamar->id }}">
                                <select name="status_lulus[]" class="custom-select">
                                    <option value="" {{ $pelamar->status_lulus == null ? 'selected' : '' }}>Pilih Status</option>
                                    <option value="lulus" {{ $pelamar->status_lulus == 'lulus' ? 'selected' : '' }}>Lulus</option>
                                    <option value="tidak_lulus" {{ $pelamar->status_lulus == 'tidak_lulus' ? 'selected' : '' }}>Tidak Lulus</option>
                                </select>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7">
                            <div class="empty-state">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 15.75l-2.489-2.489m0 0a3.375 3.375 0 10-4.773-4.773 3.375 3.375 0 004.774 4.774zM21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                <h3 class="empty-state-title">Data Belum Ditemukan</h3>
                                <p class="empty-state-subtitle">Silakan proses data penilaian terlebih dahulu. Hasil perankingan akan muncul di sini setelah data siap.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-4">
            {{-- Menampilkan informasi jumlah data --}}
            <div class="text-muted" style="font-size: 0.9rem;">
                @if ($hasilAkhir->total() > 0)
                    Menampilkan {{ $hasilAkhir->firstItem() }} - {{ $hasilAkhir->lastItem() }} dari {{ $hasilAkhir->total() }} hasil
                @else
                    Tidak ada data untuk ditampilkan
                @endif
            </div>

            {{-- Tombol simpan hanya muncul jika ada data --}}
            @if($hasilAkhir->total() > 0)
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan Status Kelulusan
                </button>
            @endif
        </div>
        </form>
    </div>

    {{-- PENAMBAHAN: Navigasi Paginasi --}}
    @if ($hasilAkhir->hasPages())
    <div class="pagination-container">
        {{ $hasilAkhir->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>
@endsection
