@extends('admin.layout')

@section('title', 'Data Pelamar')

{{-- Tambahkan section untuk custom CSS jika layout Anda menyediakannya --}}

<style>
    /* Style untuk Card Header yang lebih fungsional */
    .card-header-flex {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap; /* Agar responsif di layar kecil */
        gap: 1rem;
    }

    /* Style untuk tabel yang lebih modern */
    .table thead th {
        background-color: #f8f9fa;
        border-bottom-width: 2px;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
    }
    .table td, .table th {
        vertical-align: middle;
    }

    /* Badge untuk universitas */
    .uni-badge {
        background-color: #4580bb;
        color: #495057;
        font-weight: 500;
        padding: 0.4em 0.7em;
        font-size: 0.8rem;
    }

    /* Tombol aksi yang lebih rapi */
    .action-buttons .btn {
        width: 38px;
        height: 38px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    /* Menjaga form hapus tidak memengaruhi layout */
    .delete-form {
        display: inline-block;
        margin-left: 0.25rem;
    }
</style>


@section('content')
<div class="content-wrapper">
  <section class="content">
    <div class="container-fluid py-4">

      <div class="card shadow-sm">
        <div class="card-header card-header-flex">
          <h3 class="card-title mb-0">Data Pelamar</h3>
          <div class="card-tools d-flex align-items-center">
            <form action="{{ route('pelamar.index') }}" method="GET" class="me-3">
              <div class="input-group input-group-sm" style="width: 250px;">
                <input type="text" name="search" class="form-control float-right" placeholder="Cari Nama atau Universitas..." value="{{ request('search') }}">
                <div class="input-group-append">
                  <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </div>
            </form>

          </div>
        </div>

        <div class="card-body table-responsive p-0">
          <table class="table table-hover text-nowrap">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Pelamar</th>
                <th>Asal Universitas</th>
                <th>Universitas Pilihan</th>
                <th style="width: 120px;">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse($pelamars as $key => $pelamar)
                <tr>
                  <td>{{ $pelamars->firstItem() + $key }}</td>
                  <td>{{ $pelamar->nama_lengkap }}</td>
                  <td>{{ $pelamar->asal_universitas ?? '-' }}</td>
                  <td>
                    @foreach($pelamar->beasiswas as $uni)
                      <span class="badge uni-badge me-1" title="{{ $uni->nama_universitas }}">
                        {{ Str::limit($uni->nama_universitas, 25) }}
                      </span>
                    @endforeach
                  </td>
                  <td class="action-buttons">
                    <a href="{{ route('pelamar.show', $pelamar->id) }}" class="btn btn-info btn-sm" title="Lihat Detail">
                      <i class="fas fa-eye"></i>
                    </a>

                    {{-- Form Hapus dengan class untuk target JS --}}
                    <form action="{{ route('pelamar.destroy', $pelamar->id) }}" method="POST" class="delete-form">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                        <i class="fas fa-trash-alt"></i>
                      </button>
                    </form>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="5" class="text-center py-4">
                    <p class="mb-0">Tidak ada data pelamar yang ditemukan.</p>
                    @if(request('search'))
                      <small>Coba gunakan kata kunci lain atau <a href="{{ route('pelamar.index') }}">tampilkan semua data</a>.</small>
                    @endif
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        {{-- Footer Card untuk Paginasi --}}
        @if ($pelamars->hasPages())
        <div class="card-footer clearfix">
            {{ $pelamars->appends(request()->query())->links() }}
        </div>
        @endif
      </div>
    </div>
  </section>
</div>
@endsection

{{-- Tambahkan section untuk custom JS jika layout Anda menyediakannya --}}
@push('scripts')
{{-- SweetAlert2 CDN --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  $(function () {
    // Inisialisasi Tooltip Bootstrap (jika belum ada di layout utama)
    $('[data-bs-toggle="tooltip"]').tooltip();

    // Script untuk konfirmasi hapus menggunakan SweetAlert2
    $('.delete-form').on('submit', function(e) {
      e.preventDefault();
      var form = this;

      Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Anda tidak akan bisa mengembalikan data ini!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          form.submit();
        }
      })
    });
  });
</script>
@endpush
