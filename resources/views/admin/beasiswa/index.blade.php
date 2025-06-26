@extends('admin.layout')
@section('title', 'Data Beasiswa')
@section('page-title', 'Data Beasiswa')
@section('page-subtitle', 'Kelola informasi beasiswa dan universitas')

@section('content')
<style>
  /* Modern Alert Styles */
  .modern-alert {
    border: none;
    border-radius: 12px;
    padding: 1rem 1.5rem;
    margin-bottom: 2rem;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
    border-left: 4px solid #28a745;
  }

  .modern-alert .alert-content {
    display: flex;
    align-items: center;
    gap: 0.75rem;
  }

  .modern-alert .alert-icon {
    width: 24px;
    height: 24px;
    background: #28a745;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 0.875rem;
  }

  /* Modern Card Styles */
  .modern-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    border: 1px solid #e2e8f0;
    overflow: hidden;
    transition: all 0.3s ease;
  }

  .modern-card:hover {
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
    transform: translateY(-2px);
  }

  .modern-card-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 1.5rem 2rem;
    display: flex;
    justify-content: between;
    align-items: center;
  }

  .modern-card-title {
    font-size: 1.25rem;
    font-weight: 600;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 0.75rem;
  }

  .modern-card-title i {
    font-size: 1.1rem;
  }

  .modern-btn {
    background: rgba(255, 255, 255, 0.2);
    color: white;
    border: 1px solid rgba(255, 255, 255, 0.3);
    padding: 0.5rem 1rem;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.2s ease;
    backdrop-filter: blur(10px);
  }

  .modern-btn:hover {
    background: rgba(255, 255, 255, 0.3);
    color: white;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
  }

  .modern-card-body {
    padding: 0;
  }

  /* Modern Table Styles */
  .modern-table-container {
    overflow-x: auto;
    background: white;
  }

  .modern-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    font-size: 0.9rem;
  }

  .modern-table thead {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
  }

  .modern-table th {
    padding: 1.25rem 1rem;
    font-weight: 600;
    color: #2d3748;
    text-align: left;
    border-bottom: 2px solid #e2e8f0;
    white-space: nowrap;
    position: sticky;
    top: 0;
    background: inherit;
    z-index: 10;
  }

  .modern-table th:first-child {
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
  }

  .modern-table th:last-child {
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
  }

  .modern-table td {
    padding: 1rem;
    border-bottom: 1px solid #f1f5f9;
    vertical-align: middle;
    color: #4a5568;
  }

  .modern-table tbody tr {
    transition: all 0.2s ease;
  }

  .modern-table tbody tr:hover {
    background: #f8fafc;
    transform: scale(1.001);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
  }

  .modern-table tbody tr:last-child td {
    border-bottom: none;
  }

  /* Logo Styles */
  .logo-container {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    background: #f8fafc;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .logo-container img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .no-logo {
    color: #a0aec0;
    font-size: 0.8rem;
    text-align: center;
  }

  /* Content Badge */
  .content-preview {
    max-width: 200px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    color: #4a5568;
    font-size: 0.875rem;
  }

  .content-preview:hover {
    color: #2d3748;
    cursor: help;
  }

  /* Action Buttons */
  .action-buttons {
    display: flex;
    gap: 0.5rem;
    justify-content: center;
  }

  .action-btn {
    width: 36px;
    height: 36px;
    border-radius: 8px;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.875rem;
    transition: all 0.2s ease;
    cursor: pointer;
  }

  .action-btn.edit {
    background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
    color: white;
  }

  .action-btn.edit:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(251, 191, 36, 0.4);
  }

  .action-btn.delete {
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    color: white;
  }

  .action-btn.delete:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4);
  }

  /* Empty State */
  .empty-state {
    text-align: center;
    padding: 3rem 2rem;
    color: #a0aec0;
  }

  .empty-state i {
    font-size: 3rem;
    margin-bottom: 1rem;
    color: #e2e8f0;
  }

  .empty-state h4 {
    color: #4a5568;
    font-weight: 600;
    margin-bottom: 0.5rem;
  }

  .empty-state p {
    margin: 0;
    font-size: 0.9rem;
  }

  /* Number Badge */
  .number-badge {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 0.875rem;
  }

  /* University Name Styling */
  .university-name {
    font-weight: 600;
    color: #2d3748;
    font-size: 0.95rem;
  }

  /* Period Badge */
  .period-badge {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 500;
    white-space: nowrap;
  }

  /* Responsive adjustments */
  @media (max-width: 768px) {
    .modern-card-header {
      flex-direction: column;
      gap: 1rem;
      text-align: center;
    }

    .modern-table th,
    .modern-table td {
      padding: 0.75rem 0.5rem;
      font-size: 0.8rem;
    }

    .content-preview {
      max-width: 120px;
    }

    .action-buttons {
      flex-direction: column;
    }
  }
</style>

<div class="container-fluid">
  {{-- Flash Message --}}
  @if (session('success'))
  <div class="modern-alert alert-dismissible fade show" role="alert">
    <div class="alert-content">
      <div class="alert-icon">
        <i class="fas fa-check"></i>
      </div>
      <div>
        <strong>Berhasil!</strong> {{ session('success') }}
      </div>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif

  {{-- Main Card --}}
  <div class="modern-card">
    <div class="modern-card-header">
      <h5 class="modern-card-title">
        <i class="fas fa-graduation-cap"></i>
        Data Beasiswa
      </h5>
      <a href="{{ route('admin.beasiswa.create') }}" class="modern-btn">
        <i class="fas fa-plus-circle"></i>
        Tambah Beasiswa
      </a>
    </div>

    <div class="modern-card-body">
      <div class="modern-table-container">
        <table class="modern-table">
          <thead>
            <tr>
              <th style="width: 60px;">No.</th>
              <th style="min-width: 180px;">Nama Universitas</th>
              <th style="min-width: 200px;">Deskripsi</th>
              <th style="min-width: 200px;">Persyaratan</th>
              <th style="min-width: 140px;">Periode Akademik</th>
              <th style="min-width: 180px;">Statistik Penerimaan</th>
              <th style="width: 80px;">Logo</th>
              <th style="width: 120px;" class="text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($beasiswa as $index => $b)
            <tr>
              <td>
                <div class="number-badge">{{ $index + 1 }}</div>
              </td>
              <td>
                <div class="university-name">{{ $b->nama_universitas }}</div>
              </td>
              <td>
                <div class="content-preview" title="{{ $b->deskripsi }}">
                  {{ \Illuminate\Support\Str::limit($b->deskripsi, 50) }}
                </div>
              </td>
              <td>
                <div class="content-preview" title="{{ $b->persyaratan }}">
                  {{ \Illuminate\Support\Str::limit($b->persyaratan, 50) }}
                </div>
              </td>
              <td>
                <div class="period-badge">{{ $b->periode_akademik }}</div>
              </td>
              <td>
                <div class="content-preview" title="{{ $b->statistik_penerimaan }}">
                  {{ \Illuminate\Support\Str::limit($b->statistik_penerimaan, 50) }}
                </div>
              </td>
              <td>
                <div class="logo-container">
                  @if ($b->logo)
                    <img src="{{ asset('storage/logo/' . $b->logo) }}" alt="Logo {{ $b->nama_universitas }}">
                  @else
                    <div class="no-logo">
                      <i class="fas fa-image"></i><br>
                      No Logo
                    </div>
                  @endif
                </div>
              </td>
              <td>
                <div class="action-buttons">
                  <a href="{{ route('admin.beasiswa.edit', $b->id) }}" class="action-btn edit" title="Edit">
                    <i class="fas fa-edit"></i>
                  </a>
                  <form action="{{ route('admin.beasiswa.destroy', $b->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="action-btn delete" title="Hapus" onclick="return confirm('Yakin ingin menghapus beasiswa {{ $b->nama_universitas }}?')">
                      <i class="fas fa-trash-alt"></i>
                    </button>
                  </form>
                </div>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="8">
                <div class="empty-state">
                  <i class="fas fa-graduation-cap"></i>
                  <h4>Belum Ada Data Beasiswa</h4>
                  <p>Silakan tambahkan data beasiswa pertama Anda</p>
                </div>
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script>
  // Enhanced confirmation dialog
  document.querySelectorAll('.action-btn.delete').forEach(button => {
    button.addEventListener('click', function(e) {
      e.preventDefault();
      const form = this.closest('form');
      const universityName = this.getAttribute('title').replace('Hapus', '').trim();

      if (confirm(`Apakah Anda yakin ingin menghapus beasiswa ini?\n\nData yang dihapus tidak dapat dikembalikan.`)) {
        form.submit();
      }
    });
  });

  // Add tooltip functionality for truncated content
  document.querySelectorAll('.content-preview').forEach(element => {
    element.addEventListener('mouseenter', function() {
      const fullText = this.getAttribute('title');
      if (fullText && fullText.length > 50) {
        this.style.position = 'relative';
      }
    });
  });
</script>

@endsection
