@extends('admin.layout')

@section('title', 'Edit Subkriteria')

@section('content')
<div class="content-wrapper">
  <section class="content">
    <div class="container-fluid py-4">
      <h4>Edit Subkriteria</h4>
      
      <form action="{{ route('subkriteria.update', $subkriteria->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
          <label for="kriteria_id">Kode Kriteria</label>
          <select name="kriteria_id" id="kriteria_id" class="form-control" required>
            <option value="">Pilih Kriteria</option>
            @foreach($kriterias as $kriteria)
              <option value="{{ $kriteria->id }}" {{ $subkriteria->kriteria_id == $kriteria->id ? 'selected' : '' }}>
                {{ $kriteria->kode_kriteria }} - {{ $kriteria->nama_kriteria }}
              </option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label for="nama">Nama Sub Kriteria</label>
          <input type="text" name="nama" class="form-control" value="{{ $subkriteria->nama }}" required>
        </div>

        <div class="form-group">
          <label for="nilai">Nilai</label>
          <input type="number" name="nilai" class="form-control" value="{{ $subkriteria->nilai }}" min="1" max="100" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Perbarui</button>
      </form>
    </div>
  </section>
</div>
@endsection
