@extends('admin.layout')

@section('title', 'Edit Beasiswa')

@section('content')
<div class="container-fluid py-4">

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

  {{-- Modern Card for Edit Scholarship --}}
  <div class="modern-card">
    <div class="modern-card-header">
      <h5 class="modern-card-title">
        <i class="fas fa-graduation-cap"></i>
        Edit Beasiswa
      </h5>
    </div>
    <div class="modern-card-body">
      <form action="{{ route('admin.beasiswa.update', $beasiswa->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
          <label for="nama_universitas" class="form-label">Nama Universitas</label>
          <input type="text" class="form-control @error('nama_universitas') is-invalid @enderror" id="nama_universitas" name="nama_universitas" value="{{ old('nama_universitas', $beasiswa->nama_universitas) }}" required>
          @error('nama_universitas')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="deskripsi" class="form-label">Deskripsi</label>
          <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" required>{{ old('deskripsi', $beasiswa->deskripsi) }}</textarea>
          @error('deskripsi')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="persyaratan" class="form-label">Persyaratan</label>
          <textarea class="form-control @error('persyaratan') is-invalid @enderror" id="persyaratan" name="persyaratan" required>{{ old('persyaratan', $beasiswa->persyaratan) }}</textarea>
          @error('persyaratan')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="periode_akademik" class="form-label">Periode Akademik</label>
          <input type="text" class="form-control @error('periode_akademik') is-invalid @enderror" id="periode_akademik" name="periode_akademik" value="{{ old('periode_akademik', $beasiswa->periode_akademik) }}" required>
          @error('periode_akademik')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="statistik_penerimaan" class="form-label">Statistik Penerimaan</label>
          <textarea class="form-control @error('statistik_penerimaan') is-invalid @enderror" id="statistik_penerimaan" name="statistik_penerimaan" required>{{ old('statistik_penerimaan', $beasiswa->statistik_penerimaan) }}</textarea>
          @error('statistik_penerimaan')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3">
          <label for="logo" class="form-label">Logo Universitas</label>
          <input type="file" class="form-control @error('logo') is-invalid @enderror" id="logo" name="logo">
          @error('logo')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror

          @if ($beasiswa->logo)
            <div class="mt-2">
              <img src="{{ asset('storage/logo/' . $beasiswa->logo) }}" alt="Logo {{ $beasiswa->nama_universitas }}" width="100" height="100">
            </div>
          @endif
        </div>

        <div class="mb-3 text-center">
          <button type="submit" class="modern-btn">
            <i class="fas fa-save"></i>
            Update Beasiswa
          </button>
        </div>
      </form>
    </div>
  </div>

</div>
@endsection
