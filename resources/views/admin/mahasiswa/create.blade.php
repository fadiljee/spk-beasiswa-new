@extends('admin.layout')

@section('content')

<div class="content-wrapper"> 

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Form Tambah Mahasiswa</h3>
            </div>

            @if (session('success'))
              <p style="color: green">{{ session('success') }}</p>
            @endif

            @if($errors->any())
              <ul style="color:red;">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            @endif
            
            <form action="{{ route('prosesDataMahasiswa') }}" method="POST">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <label>Nama</label>
                  <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama">
                </div>
                <div class="form-group">
                  <label>NIM</label>
                  <input type="text" class="form-control" name="nim" placeholder="Masukkan NIM">
                </div>
                <div class="form-group">
                  <label>Jurusan</label>
                  <input type="text" class="form-control" name="jurusan" placeholder="Masukkan Jurusan">
                </div>
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" class="form-control" name="email" placeholder="Masukkan Email">
                </div>
              </div>

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
            </form>
          </div>
        </div>

        {{-- Tabel Data Mahasiswa --}}
        {{-- <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Data Mahasiswa</h3>
            </div>
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Nama</th>
                  <th>NIM</th>
                  <th>Jurusan</th>
                  <th>Email</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($mahasiswa as $mhs)
                  <tr>
                    <td>{{ $mhs->id }}</td>
                    <td>{{ $mhs->nama }}</td>
                    <td>{{ $mhs->nim }}</td>
                    <td>{{ $mhs->jurusan }}</td>
                    <td>{{ $mhs->email }}</td>
                    <td>
                      <a href="{{ route('mahasiswa.edit', $mhs->id) }}">Edit</a>
                      <form action="{{ route('mahasiswa.destroy', $mhs->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                      </form>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div> --}}

      </div>
    </div>
  </section>

</div>

@endsection
