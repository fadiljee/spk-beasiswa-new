@extends('admin.layout')

@section('title', 'Tambah Subkriteria')

@section('content')
<div class="content-wrapper">
  <section class="content">
    <div class="container-fluid py-4">
      <h4>Tambah Subkriteria</h4>
      <form action="{{ route('subkriteria.store') }}" method="POST">  <!-- Route store tanpa parameter kriteria_id -->
        @csrf
        <div class="form-group">
          <label for="kriteria_id">Kode Kriteria</label>
          <select name="kriteria_id" id="kriteria_id" class="form-control" required>
            <option value="">Pilih Kode Kriteria</option>
            @foreach($kriterias as $kriteria)
              <option value="{{ $kriteria->id }}">{{ $kriteria->kode_kriteria }} - {{ $kriteria->nama_kriteria }}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label for="nama">Nama Subkriteria</label>
          <input type="text" name="nama" class="form-control" required>
        </div>

        <div class="form-group">
          <label for="nilai">Nilai</label>
          <input type="number" name="nilai" class="form-control" min="0" max="100" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
      </form>
    </div>
  </section>
</div>
@endsection
