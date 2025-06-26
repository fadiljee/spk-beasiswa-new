@extends('admin.layout')

@section('title', 'Manajemen Pengguna')
@section('page-title', 'Manajemen Pengguna')
@section('page-subtitle', 'Kelola data mahasiswa atau pengguna sistem.')

@section('styles')
{{-- CSS dipindahkan ke sini agar sesuai dengan struktur layout --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<style>
  :root {
    --primary-color: #4f46e5;
    --primary-light: #eef2ff;
    --danger-color: #ef4444;
    --danger-light: #fee2e2;
    --warning-color: #f59e0b;
    --warning-light: #fef3c7;
    --text-dark: #1f2937;
    --text-muted: #6b7280;
    --bg-light: #f8fafc;
    --border-color: #e5e7eb;
    --card-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
  }

  .main-card {
    border: none;
    border-radius: 12px;
    box-shadow: var(--card-shadow);
    overflow: hidden;
  }

  .main-card-header {
    background-color: #fff;
    padding: 1.25rem 1.5rem;
    border-bottom: 1px solid var(--border-color);
  }

  .custom-table thead th {
    background-color: #f9fafb;
    color: var(--text-muted);
    font-size: 0.8rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-weight: 600;
    padding: 1rem;
    border-bottom: 2px solid var(--border-color);
  }

  .custom-table tbody tr:hover { background-color: var(--bg-light); }
  .custom-table td { padding: 0.75rem 1rem; vertical-align: middle; border-bottom: 1px solid var(--border-color); }
  .custom-table tbody tr:last-child td { border-bottom: none; }

  .user-info { display: flex; align-items: center; }
  .user-avatar { width: 40px; height: 40px; border-radius: 50%; object-fit: cover; margin-right: 1rem; }
  .user-name { font-weight: 600; color: var(--text-dark); }
  .user-email { color: var(--text-muted); font-size: 0.85rem; }

  .action-btn {
    width: 36px; height: 36px; border-radius: 8px;
    display: inline-flex; align-items: center; justify-content: center;
    border: none; transition: all 0.2s ease;
  }
  .btn-view { background-color: #e0e7ff; color: #4338ca; }
  .btn-view:hover { background-color: #4338ca; color: #fff; }
  .btn-edit { background-color: var(--warning-light); color: var(--warning-color); }
  .btn-edit:hover { background-color: var(--warning-color); color: #fff; }
  .btn-delete { background-color: var(--danger-light); color: var(--danger-color); }
  .btn-delete:hover { background-color: var(--danger-color); color: #fff; }

  .empty-state { padding: 3rem; text-align: center; color: var(--text-muted); }
  .empty-state i { font-size: 3rem; margin-bottom: 1rem; color: #d1d5db; }
</style>
@endsection

@section('content')
<div class="card main-card">
  <div class="card-header main-card-header d-flex flex-wrap justify-content-between align-items-center gap-2">
    {{-- Form Pencarian Server-Side --}}
    <form action="{{ route('dataMahasiswa.index') }}" method="GET" class="flex-grow-1">
      <div class="input-group">
        <span class="input-group-text bg-light border-light"><i class="fas fa-search"></i></span>
        <input type="text" name="search" class="form-control border-light" placeholder="Cari mahasiswa..." value="{{ request('search') }}">
      </div>
    </form>
    <div class="d-flex align-items-center">
      <a href="{{ route('dataMahasiswa.index') }}" class="btn btn-outline-secondary me-2">Reset</a>
      <a href="{{ route('dataMahasiswa.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Tambah Pengguna
      </a>
    </div>
  </div>

  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table custom-table w-100" id="mahasiswaTable">
        <thead>
          <tr>
            <th class="text-center">#</th>
            <th>Nama Lengkap</th>
            <th>NIM</th>
            <th>Jurusan</th>
            <th class="text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($mahasiswa as $index => $mhs)
            <tr>
              <td class="text-center">{{ $mahasiswa->firstItem() + $index }}</td>
              <td>
                <div class="user-info">
                  <img src="https://ui-avatars.com/api/?name={{ urlencode($mhs->nama) }}&background=eef2ff&color=4f46e5" alt="Avatar" class="user-avatar">
                  <div>
                    <div class="user-name">{{ $mhs->nama }}</div>
                    <a href="mailto:{{ $mhs->email }}" class="user-email">{{ $mhs->email }}</a>
                  </div>
                </div>
              </td>
              <td>{{ $mhs->nim }}</td>
              <td>{{ $mhs->jurusan }}</td>
              <td class="text-center">
                
                <a href="{{ route('dataMahasiswa.edit', $mhs->id) }}" class="action-btn btn-edit" data-bs-toggle="tooltip" title="Edit Data"><i class="fas fa-edit"></i></a>
                <button type="button" class="action-btn btn-delete delete-btn" data-id="{{ $mhs->id }}" data-nama="{{ $mhs->nama }}" data-bs-toggle="tooltip" title="Hapus Data">
                  <i class="fas fa-trash-alt"></i>
                </button>
                <form id="delete-form-{{ $mhs->id }}" action="{{ route('dataMahasiswa.destroy', $mhs->id) }}" method="POST" class="d-none">
                  @csrf
                  @method('DELETE')
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="5">
                 <div class="empty-state">
                    <i class="fas fa-folder-open"></i>
                    <p>
                        @if (request('search'))
                            Pengguna dengan kata kunci "{{ request('search') }}" tidak ditemukan.
                        @else
                            Belum ada data pengguna.
                        @endif
                    </p>
                 </div>
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  {{-- Pagination Links --}}
  @if ($mahasiswa->hasPages())
  <div class="card-footer bg-white">
    {{-- Menambahkan `appends` agar parameter search tetap ada saat pindah halaman --}}
    {{ $mahasiswa->appends(request()->input())->links('pagination::bootstrap-5') }}
  </div>
  @endif
</div>
@endsection


@section('scripts')
{{-- Script untuk SweetAlert dan Tooltip (Script Search dihapus) --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
  // 1. Inisialisasi Bootstrap Tooltip
  const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
  tooltipTriggerList.map(function (tooltipTriggerEl) { return new bootstrap.Tooltip(tooltipTriggerEl); });

  // 2. Konfirmasi Hapus dengan SweetAlert2
  document.querySelectorAll('.delete-btn').forEach(button => {
    button.addEventListener('click', function () {
      const mhsId = this.dataset.id;
      const mhsNama = this.dataset.nama;

      Swal.fire({
        title: 'Anda Yakin?',
        html: `Data pengguna "<strong>${mhsNama}</strong>" akan dihapus secara permanen.`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: 'var(--danger-color)',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          document.getElementById(`delete-form-${mhsId}`).submit();
        }
      });
    });
  });
});
</script>
@endsection
