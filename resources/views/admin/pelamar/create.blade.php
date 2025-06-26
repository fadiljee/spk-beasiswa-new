@extends('admin.layout')

@section('title', 'Tambah Pelamar')

@section('content')
<div class="content-wrapper">
  <section class="content">
    <div class="container-fluid py-4">
      <h4>Tambah Pelamar</h4>

      <form action="{{ route('pelamar.store') }}" method="POST">
        @csrf

        <div class="form-group">
          <label for="nama_pelamar">Nama Pelamar</label>
          <input type="text" name="nama_pelamar" class="form-control" required>
        </div>

        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" name="email" class="form-control" required>
        </div>

        <div class="form-group">
          <label for="jurusan">Jurusan</label>
          <input type="text" name="jurusan" class="form-control" required>
        </div>

        <div class="form-group">
          <label for="alamat">Alamat</label>
          <textarea name="alamat" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
      </form>
    </div>
  </section>
</div>
@endsection
