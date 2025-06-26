@extends('admin.layout')

@section('content')

<div class="content-wrapper"> 
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">

          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Edit Data Mahasiswa</h3>
            </div>

            {{-- Error message --}}
            @if($errors->any())
              <ul style="color:red;">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            @endif

            <form action="{{ route('updateDataMahasiswa', $mahasiswa->id) }}" method="POST">
              @csrf
              @method('PUT')
              <div class="card-body">
                <div class="form-group">
                  <label>Nama</label>
                  <input type="text" class="form-control" name="nama" value="{{ old('nama', $mahasiswa->nama) }}" placeholder="Masukkan Nama">
                </div>
                <div class="form-group">
                  <label>NIM</label>
                  <input type="text" class="form-control" name="nim" value="{{ old('nim', $mahasiswa->nim) }}" placeholder="Masukkan NIM">
                </div>
                <div class="form-group">
                  <label>Jurusan</label>
                  <input type="text" class="form-control" name="jurusan" value="{{ old('jurusan', $mahasiswa->jurusan) }}" placeholder="Masukkan Jurusan">
                </div>
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" class="form-control" name="email" value="{{ old('email', $mahasiswa->email) }}" placeholder="Masukkan Email">
                </div>
              </div>

              <div class="card-footer">
                <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                <a href="{{ route('dataMahasiswa') }}" class="btn btn-secondary">Kembali</a>
              </div>
            </form>
          </div>

        </div>
      </div>
    </div>
  </section>
</div>

@endsection
