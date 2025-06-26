@extends('admin.layout')

@section('title', 'Data Penilaian')

@section('styles')
{{-- Link CSS untuk DataTables agar stylingnya sesuai dengan Bootstrap 5 --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<style>
    /* Menyesuaikan tampilan DataTables agar lebih rapi */
    #penilaianTable_wrapper .row:first-child {
        padding-bottom: 1rem;
    }
    .dataTables_filter input {
        margin-left: 0.5em;
        display: inline-block;
        width: auto;
    }
    .dataTables_length select {
        margin-left: 0.5em;
        margin-right: 0.5em;
        display: inline-block;
        width: auto;
    }
</style>
@endsection

@section('content')
<div class="content-wrapper">
    {{-- 1. Content Header (Page header) untuk konsistensi layout AdminLTE --}}
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Penilaian</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        {{-- <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li> --}}
                        <li class="breadcrumb-item active">Data Penilaian</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            {{-- 2. Pesan Sukses (Alert) --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- 3. Card untuk menampung tabel data --}}
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">Daftar Pelamar untuk Dinilai</h3>
                    {{-- Tombol Aksi Tambahan (jika diperlukan, contoh: tambah pelamar baru) --}}
                    {{-- <a href="{{ route('pelamar.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-1"></i> Tambah Pelamar
                    </a> --}}
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="penilaianTable">
                            <thead class="table-dark">
                                <tr>
                                    <th class="text-center" style="width: 5%;">No</th>
                                    <th>Nama Lengkap Pelamar</th>
                                    {{-- <th >Jurusan</th> --}}
                                    <th class="text-center" style="width: 20%;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pelamar as $pelamarItem)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $pelamarItem->nama_lengkap }}</td>
                                        {{-- <td>{{ $pelamarItem->jurusan }}</td> --}}
                                        <td class="text-center">
                                            <a href="{{ route('penilaian.create', ['pelamar_id' => $pelamarItem->id]) }}" class="btn btn-primary btn-sm">
                                                <i class="fas fa-pencil-alt me-1"></i> Input Nilai
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        {{-- 4. Pesan jika data kosong, disesuaikan dengan jumlah kolom --}}
                                        <td colspan="3" class="text-center text-muted py-4">
                                            <i class="fas fa-exclamation-circle fa-2x mb-2"></i>
                                            <p>Belum ada data pelamar yang tersedia.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
{{-- Pastikan jQuery sudah dimuat sebelum skrip ini --}}
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        // 5. Inisialisasi DataTables dengan opsi Bahasa Indonesia
        $('#penilaianTable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json"
            }
        });
    });
</script>
@endpush
