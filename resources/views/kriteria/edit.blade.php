@extends('admin.layout')

@section('title', 'Edit Kriteria')

@section('content')
<div class="content-wrapper">
  <section class="content">
    <div class="container-fluid py-4">

      <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
          <h5 class="mb-0">Edit Kriteria</h5>
        </div>
        <div class="card-body">
          <form action="{{ route('kriteria.update', $kriteria->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
              <label for="kode_kriteria">Kode Kriteria</label>
              <input type="text" name="kode_kriteria" id="kode_kriteria" class="form-control" value="{{ $kriteria->kode_kriteria }}" required>
            </div>

            <div class="form-group">
              <label for="nama_kriteria">Nama Kriteria</label>
              <input type="text" name="nama_kriteria" id="nama_kriteria" class="form-control" value="{{ $kriteria->nama_kriteria }}" required>
            </div>

            <div class="form-group">
              <label for="bobot">Bobot</label>
              <input type="number" name="bobot" id="bobot" class="form-control" value="{{ $kriteria->bobot }}" min="0" max="100"  required>
            </div>

            <div class="form-group">
              <label for="jenis">Jenis</label>
              <select name="jenis" id="jenis" class="form-control" required>
                <option value="Benefit" {{ $kriteria->jenis == 'Benefit' ? 'selected' : '' }}>Benefit</option>
                <option value="Cost" {{ $kriteria->jenis == 'Cost' ? 'selected' : '' }}>Cost</option>
              </select>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Perbarui</button>
          </form>
        </div>
      </div>

    </div>
  </section>
</div>
@endsection
