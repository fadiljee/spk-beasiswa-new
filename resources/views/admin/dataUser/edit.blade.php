@extends('admin.layout')

@section('title', 'Edit Mahasiswa')

@section('content')
<div class="content-wrapper">
  <section class="content">
    <div class="container-fluid py-4">

      <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
          <h5 class="mb-0">Edit Mahasiswa</h5>
        </div>
        <div class="card-body">

          @if ($errors->any())
            <div class="alert alert-danger">
              <ul class="mb-0">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <form action="{{ route('dataMahasiswa.update', $mhs->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
              <label for="nama" class="form-label">Nama</label>
              <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $mhs->nama) }}" required>
            </div>

            <div class="mb-3">
              <label for="nim" class="form-label">NIM</label>
              <input type="text" class="form-control" id="nim" name="nim" value="{{ old('nim', $mhs->nim) }}" required>
            </div>

            <div class="mb-3">
              <label for="jurusan" class="form-label">Jurusan</label>
              <input type="text" class="form-control" id="jurusan" name="jurusan" value="{{ old('jurusan', $mhs->jurusan) }}" required>
            </div>

            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $mhs->email) }}" required>
            </div>

            <div class="mb-3">
              <label for="password" class="form-label">Password <small>(kosongkan jika tidak ingin diubah)</small></label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Isi jika ingin ganti password">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('dataMahasiswa.index') }}" class="btn btn-secondary ms-2">Batal</a>
          </form>

        </div>
      </div>

    </div>
  </section>
</div>
@endsection
