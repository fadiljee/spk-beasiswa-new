@extends('admin.layout')

@section('title', 'Matriks Keputusan')
@section('page-title', 'Matriks Keputusan SAW')
@section('page-subtitle', 'Perhitungan metode Simple Additive Weighting (SAW)')

{{-- Tambahkan Google Fonts di layout utama atau di sini --}}
@section('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
{{-- Pastikan Font Awesome sudah ter-load --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endsection

@section('content')
<style>
  :root {
    --primary-color: #4f46e5;
    --primary-gradient: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
    --success-gradient: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
    --warning-gradient: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    --info-gradient: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
    --bg-light: #f8fafc;
    --bg-white: #ffffff;
    --text-dark: #1f2937;
    --text-muted: #6b7280;
    --border-color: #e5e7eb;
    --card-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
    --card-shadow-hover: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -4px rgba(0, 0, 0, 0.1);
    --border-radius: 12px;
  }

  body {
    font-family: 'Poppins', sans-serif;
    background-color: var(--bg-light);
  }

  /* Process Steps */
  .process-flow {
    display: flex;
    justify-content: space-between;
    margin-bottom: 2.5rem;
  }

  .process-step {
    flex: 1;
    text-align: center;
    position: relative;
    padding: 0 1rem;
  }

  .process-step:not(:last-child)::after {
    content: '';
    position: absolute;
    top: 25px;
    left: 50%;
    width: 100%;
    transform: translateX(1.5rem);
    height: 2px;
    background: var(--border-color);
  }

  .step-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: var(--bg-white);
    border: 2px solid var(--border-color);
    color: var(--text-muted);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 0.75rem;
    font-size: 1.25rem;
    transition: all 0.3s ease;
    z-index: 1;
    position: relative;
  }

  .step-title {
    font-weight: 600;
    color: var(--text-dark);
    font-size: 1rem;
  }

  /* Active Step Styling */
  .process-step.active .step-icon {
    background: var(--primary-gradient);
    color: var(--bg-white);
    border-color: var(--primary-color);
  }

  /* Matrix Card */
  .matrix-card {
    background: var(--bg-white);
    border-radius: var(--border-radius);
    box-shadow: var(--card-shadow);
    border: 1px solid var(--border-color);
    margin-bottom: 2.5rem;
    overflow: hidden;
    transition: all 0.3s ease;
    opacity: 0;
    transform: translateY(20px);
  }

  .matrix-card.is-visible {
    opacity: 1;
    transform: translateY(0);
  }

  .matrix-card:hover {
    box-shadow: var(--card-shadow-hover);
    transform: translateY(-5px) scale(1.005);
  }

  .matrix-header {
    padding: 1.25rem 1.5rem;
    color: var(--bg-white);
    display: flex;
    align-items: center;
    gap: 1rem;
    border-bottom: 1px solid var(--border-color);
  }

  /* Header Variants */
  .matrix-header.decision { background: var(--info-gradient); }
  .matrix-header.normalized { background: var(--success-gradient); }
  .matrix-header.weighted { background: var(--warning-gradient); }
  .matrix-header.calculation { background: var(--primary-gradient); }

  .matrix-icon {
    font-size: 1.5rem;
    opacity: 0.8;
  }

  .matrix-title {
    margin: 0;
    font-size: 1.25rem;
    font-weight: 600;
  }

  .matrix-subtitle {
    margin: 0;
    font-size: 0.875rem;
    opacity: 0.9;
  }

  /* Table Styling */
  .matrix-body {
    padding: 0.5rem;
    overflow-x: auto;
  }

  .matrix-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    min-width: 700px;
  }

  .matrix-table th, .matrix-table td {
    padding: 1rem;
    text-align: center;
    vertical-align: middle;
  }

  .matrix-table thead th {
    color: var(--text-muted);
    font-size: 0.8rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-weight: 600;
    border-bottom: 2px solid var(--border-color);
    background: var(--bg-light);
  }

  .matrix-table tbody tr {
    transition: background-color 0.2s ease;
  }

  .matrix-table tbody tr:hover {
    background-color: #f9fafb;
  }

  .matrix-table td {
    color: var(--text-dark);
    border-bottom: 1px solid var(--border-color);
  }
  .matrix-table tbody tr:last-child td {
    border-bottom: none;
  }

  /* Cell Styles */
  .cell-no {
    font-weight: 600;
    color: var(--text-muted);
  }

  .cell-name {
    font-weight: 600;
    color: var(--text-dark);
    text-align: left !important;
  }

  .value-pill {
    padding: 0.25rem 0.75rem;
    border-radius: 999px;
    font-weight: 500;
    font-size: 0.875rem;
    display: inline-block;
    min-width: 60px;
  }

  .pill-normalized { background-color: #dcfce7; color: #15803d; }
  .pill-weighted { background-color: #fef3c7; color: #b45309; }

  .calculation-text {
    font-family: 'Courier New', monospace;
    font-size: 0.85rem;
    color: var(--text-muted);
    background: #f9fafb;
    padding: 0.5rem 0.75rem;
    border-radius: 6px;
    text-align: left;
    cursor: pointer;
    position: relative;
    border: 1px solid var(--border-color);
  }
  .calculation-text:hover::after {
    content: 'Click to Copy';
    position: absolute;
    bottom: -25px;
    left: 50%;
    transform: translateX(-50%);
    background: var(--text-dark);
    color: var(--bg-white);
    padding: 3px 8px;
    border-radius: 4px;
    font-size: 0.75rem;
  }

  .final-score {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--primary-color);
    padding: 0.5rem 1rem;
    border-radius: 8px;
    background-color: #eef2ff;
  }

  /* Highlight Top Rank */
  .top-rank {
    background-color: #f0fdf4 !important;
  }
  .top-rank .cell-name::before {
    content: '🏆 ';
    font-size: 1rem;
    margin-right: 4px;
  }
</style>


<div class="container-fluid py-4">

  {{-- Matriks Keputusan --}}
  <div class="matrix-card">
    <div class="matrix-header decision">
      <div class="matrix-icon"><i class="fas fa-table"></i></div>
      <div>
        <h4 class="matrix-title">Matriks Keputusan (X)</h4>
        <p class="matrix-subtitle">Data asli dari setiap pelamar berdasarkan kriteria.</p>
      </div>
    </div>
    <div class="matrix-body">
      <table class="matrix-table">
        <thead>
          <tr>
            <th>No</th>
            <th style="text-align: left;">Nama Pelamar</th>
            @foreach ($kriterias as $kriteria)
              <th>{{ $kriteria->nama_kriteria }}</th>
            @endforeach
          </tr>
        </thead>
        <tbody>
          @foreach ($matriksKeputusan as $pid => $data)
            <tr>
              <td class="cell-no">{{ $loop->iteration }}</td>
              <td class="cell-name">{{ $data['pelamar'] }}</td>
              @foreach ($kriterias as $kriteria)
                <td>{{ $data['nilai'][$kriteria->nama_kriteria] ?? '-' }}</td>
              @endforeach
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  {{-- Matriks Normalisasi --}}
  <div class="matrix-card">
    <div class="matrix-header normalized">
      <div class="matrix-icon"><i class="fas fa-balance-scale"></i></div>
      <div>
        <h4 class="matrix-title">Matriks Normalisasi (R)</h4>
        <p class="matrix-subtitle">Normalisasi data sesuai jenis kriteria (Benefit/Cost).</p>
      </div>
    </div>
    <div class="matrix-body">
      <table class="matrix-table">
        <thead>
          <tr>
            <th>No</th>
            <th style="text-align: left;">Nama Pelamar</th>
            @foreach ($kriterias as $kriteria)
              <th>{{ $kriteria->nama_kriteria }}</th>
            @endforeach
          </tr>
        </thead>
        <tbody>
          @foreach ($matriksKeputusan as $pid => $data)
            <tr>
              <td class="cell-no">{{ $loop->iteration }}</td>
              <td class="cell-name">{{ $data['pelamar'] }}</td>
              @foreach ($kriterias as $kriteria)
                <td>
                  <span class="value-pill pill-normalized">
                    {{ number_format($normalizedMatrix[$pid]['nilai'][$kriteria->nama_kriteria] ?? 0, 2) }}
                  </span>
                </td>
              @endforeach
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  {{-- Matriks Terbobot --}}
  <div class="matrix-card">
    <div class="matrix-header weighted">
      <div class="matrix-icon"><i class="fas fa-weight-hanging"></i></div>
      <div>
        <h4 class="matrix-title">Matriks Terbobot (W)</h4>
        <p class="matrix-subtitle">Perkalian nilai normalisasi dengan bobot (langsung dikali, tanpa dibagi 100).</p>
      </div>
    </div>
    <div class="matrix-body">
      <table class="matrix-table">
        <thead>
          <tr>
            <th>No</th>
            <th style="text-align: left;">Nama Pelamar</th>
            @foreach ($kriterias as $kriteria)
              <th>
                {{ $kriteria->nama_kriteria }}
                <span class="badge bg-primary">Bobot: {{ number_format($kriteria->bobot, 2, ',', '.') }}</span>
              </th>
            @endforeach
          </tr>
        </thead>
        <tbody>
          @foreach ($matriksKeputusan as $pid => $data)
            <tr>
              <td class="cell-no">{{ $loop->iteration }}</td>
              <td class="cell-name">{{ $data['pelamar'] }}</td>
              @foreach ($kriterias as $kriteria)
                <td>
                  <span class="value-pill pill-weighted">
                    {{ number_format($weightedMatrix[$pid]['nilai'][$kriteria->nama_kriteria] ?? 0, 2) }}
                  </span>
                </td>
              @endforeach
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  {{-- Nilai Preferensi (V) --}}
  <div class="matrix-card">
    <div class="matrix-header calculation">
      <div class="matrix-icon"><i class="fas fa-calculator"></i></div>
      <div>
        <h4 class="matrix-title">Menghitung Nilai Preferensi (V)</h4>
        <p class="matrix-subtitle">Penjumlahan seluruh nilai terbobot untuk setiap pelamar (sesuai Excel).</p>
      </div>
    </div>
    <div class="matrix-body">
      <table class="matrix-table">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Pelamar</th>
            <th>EPT</th>
            <th>IPK</th>
            <th>Jurusan</th>
            <th>Usia</th>
            <th>V</th>
            <th>Ranking</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($nilaiPreferensi as $i => $row)
          <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $row['pelamar'] }}</td>
            <td>{{ number_format($row['ept'], 2) }}</td>
            <td>{{ number_format($row['ipk'], 2) }}</td>
            <td>{{ number_format($row['jurusan'], 2) }}</td>
            <td>{{ number_format($row['usia'], 2) }}</td>
            <td><b>{{ number_format($row['V'], 2) }}</b></td>
            <td>{{ $row['ranking'] }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  {{-- Hasil Akhir dan Ranking --}}
<div class="matrix-card">
  <div class="matrix-header calculation">
    <div class="matrix-icon"><i class="fas fa-trophy"></i></div>
    <div>
      <h4 class="matrix-title">Hasil Akhir & Perankingan</h4>
      <p class="matrix-subtitle">Penjumlahan seluruh nilai preferensi (V) untuk ranking (sama seperti Excel).</p>
    </div>
  </div>
  <div class="matrix-body">
    <table class="matrix-table">
      <thead>
        <tr>
          <th>Rank</th>
          <th style="text-align:left;">Nama Pelamar</th>
          <th>Detail Perhitungan</th>
          <th>Nilai Akhir (V)</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($nilaiPreferensi as $row)
        <tr class="{{ $row['ranking'] === 1 ? 'top-rank' : '' }}">
          <td class="cell-no">{{ $row['ranking'] }}</td>
          <td class="cell-name">{{ $row['pelamar'] }}</td>
          <td>
            <div class="calculation-text">{{ $row['calculation'] }} = <b>{{ number_format($row['V'], 2) }}</b></div>
          </td>
          <td>
            <span class="final-score">{{ number_format($row['V'], 2) }}</span>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

</div>


<script>
document.addEventListener('DOMContentLoaded', function() {
    // 1. Animate cards on scroll
    const observer = new IntersectionObserver((entries, obs) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                obs.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.matrix-card').forEach(card => {
        observer.observe(card);
    });

    // 2. Copy calculation to clipboard
    document.querySelectorAll('.calculation-text').forEach(cell => {
        cell.addEventListener('click', function() {
            const textToCopy = this.textContent.trim();
            navigator.clipboard.writeText(textToCopy).then(() => {
                const originalText = this.innerHTML;
                this.innerHTML = 'Copied!';
                this.style.color = 'var(--primary-color)';
                setTimeout(() => {
                    this.innerHTML = originalText;
                    this.style.color = '';
                }, 1500);
            }).catch(err => {
                console.error('Failed to copy text: ', err);
            });
        });
    });
});
</script>
@endsection
