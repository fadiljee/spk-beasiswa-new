@extends('admin.layout')

@section('title', 'Edit Pelamar')

@section('content')
<div class="content-wrapper">
  <section class="content">
    <div class="container-fluid py-4">
      <h4>Edit Pelamar</h4>

      <form action="{{ route('pelamar.update', $pelamar->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
          <label for="nama_pelamar">Nama Pelamar</label>
          <input type="text" name="nama_pelamar" class="form-control" value="{{ $pelamar->nama_pelamar }}" required>
        </div>

        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" name="email" class="form-control" value="{{ $pelamar->email }}" required>
        </div>

        <div class="form-group">
          <label for="jurusan">Jurusan</label>
          <input type="text" name="jurusan" class="form-control" value="{{ $pelamar->jurusan }}" required>
        </div>

        <div class="form-group">
          <label for="alamat">Alamat</label>
          <textarea name="alamat" class="form-control">{{ $pelamar->alamat }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Perbarui</button>
      </form>
    </div>
  </section>
</div>
@endsection
