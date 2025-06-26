@extends('admin.layout')

@section('title', 'Tambah Kriteria')

@section('content')
<div class="content-wrapper">
  <section class="content">
    <div class="container-fluid py-4">

      <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
          <h5 class="mb-0">Tambah Kriteria</h5>
        </div>
        <div class="card-body">
          <form action="{{ route('kriteria.store') }}" method="POST">
            @csrf
            <div class="form-group">
              <label for="kode_kriteria">Kode Kriteria</label>
              <input type="text" name="kode_kriteria" id="kode_kriteria" class="form-control" required>
            </div>

            <div class="form-group">
              <label for="nama_kriteria">Nama Kriteria</label>
              <input type="text" name="nama_kriteria" id="nama_kriteria" class="form-control" required>
            </div>

            <div class="form-group">
              <label for="bobot">Bobot</label>
              <input type="number" name="bobot" id="bobot" class="form-control" min="0" max="100" step="0.01" required>
            </div>

            <div class="form-group">
              <label for="jenis">Jenis</label>
              <select name="jenis" id="jenis" class="form-control" required>
                <option value="Benefit">Benefit</option>
                <option value="Cost">Cost</option>
              </select>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
          </form>
        </div>
      </div>

    </div>
  </section>
</div>
@endsection
