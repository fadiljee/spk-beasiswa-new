@extends('admin.layout')

@section('title', 'Hasil Akhir Peringkat')
@section('page-title', 'Hasil Akhir Peringkat')
@section('page-subtitle', 'Daftar final pelamar yang diurutkan berdasarkan skor tertinggi.')

{{-- Style khusus untuk halaman ini --}}
<style>
    .leaderboard-card {
        border: 1px solid var(--border-color);
        border-radius: 12px;
        box-shadow: var(--card-shadow);
        background-color: #fff;
        overflow: hidden;
    }

    .leaderboard-header {
        padding: 1.25rem 1.5rem;
        background-color: #f9fafb;
        border-bottom: 1px solid var(--border-color);
    }

    .custom-table thead th {
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 600;
        font-size: 0.85rem;
    }

    .custom-table tbody tr:hover {
        background-color: var(--primary-light);
    }

    .custom-table td {
        padding: 1rem 1.5rem;
    }

    .pelamar-info {
        display: flex;
        align-items: center;
    }

    .pelamar-avatar {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        object-fit: cover;
        margin-right: 1rem;
        background-color: var(--primary-light);
    }

    .pelamar-nama {
        font-weight: 600;
        color: var(--text-dark);
    }

    .skor-badge {
        font-size: 1rem;
        font-weight: 600;
        padding: 0.5rem 1rem;
        border-radius: 999px;
        background-color: var(--primary-light);
        color: var(--primary-color);
    }

    .rank-cell {
        font-weight: 700;
        font-size: 1.1rem;
    }

    /* Medali untuk Top 3 */
    .rank-icon {
        font-size: 1.75rem;
    }
    .rank-1 .rank-icon { color: #ffd700; } /* Gold */
    .rank-2 .rank-icon { color: #c0c0c0; } /* Silver */
    .rank-3 .rank-icon { color: #cd7f32; } /* Bronze */
</style>

@section('content')
<div class="leaderboard-card">
    <div class="leaderboard-header d-flex flex-wrap justify-content-between align-items-center">
      <h5 class="mb-0 fw-bold">Papan Peringkat Final</h5>

      {{-- Ganti 'perhitungan.hasil_akhir.pdf' dengan route yang benar jika berbeda --}}
      <a href="{{ route('perhitungan.hasil_akhir.pdf') }}" target="_blank" class="btn btn-primary">
        <i class="fas fa-print me-2"></i>Cetak Hasil
      </a>
    </div>

    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table custom-table align-middle mb-0">
          <thead>
            <tr class="text-center">
              <th style="width: 10%;">Peringkat</th>
              <th class="text-start">Pelamar</th>
              <th style="width: 25%;">Skor Akhir</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($hasilAkhir as $index => $data)
              <tr class="rank-{{ $index + 1 }}">
                <td class="text-center rank-cell">
                  {{-- Tampilkan ikon medali untuk top 3 --}}
                  @if ($index < 3)
                    <i class="fas fa-medal rank-icon"></i>
                  @else
                    {{ $index + 1 }}
                  @endif
                </td>
                <td class="text-start">
                  <div class="pelamar-info">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($data['pelamar']) }}&background=eef2ff&color=4f46e5"
                         alt="Avatar" class="pelamar-avatar">
                    <span class="pelamar-nama">{{ $data['pelamar'] }}</span>
                  </div>
                </td>
              
               <td class="text-center">
                <span class="skor-badge">
                    {{ rtrim(rtrim(number_format($data['skor'], 3), '0'), '.') }}
                </span>
            </td>
              </tr>
            @empty
              <tr>
                <td colspan="3" class="text-center py-5">
                  <i class="fas fa-info-circle fs-3 text-muted mb-3"></i>
                  <h6 class="text-muted">Data Hasil Peringkat Belum Tersedia</h6>
                  <p class="text-muted small">Silakan lengkapi data penilaian terlebih dahulu.</p>
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

    <!-- Tombol Kirim Hasil via Email dan WhatsApp -->
    <div class="d-flex justify-content-between mt-4">
        <form action="{{ route('kirim.email') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-outline-primary">
                <i class="fas fa-envelope me-2"></i>Kirim Hasil via Email
            </button>
        </form>

        <form action="{{ route('kirim.whatsapp') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-outline-success">
                <i class="fab fa-whatsapp me-2"></i>Kirim Hasil via WhatsApp
            </button>
        </form>
    </div>
</div>
@endsection
