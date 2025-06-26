@extends('admin.layout')

@section('title', 'Data Mahasiswa')

@section('content')
<div class="content-wrapper">
  <section class="content">
    <div class="container-fluid py-4">

      {{-- Flash Message --}}
      @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      {{-- Card Full Width --}}
      <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Data Mahasiswa</h5>
          <a href="{{ route('createDataMahasiswa') }}" class="btn btn-light btn-sm">
            <i class="fas fa-plus-circle"></i> Tambah Mahasiswa
          </a>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-hover w-100">
              <thead class="table-secondary">
                <tr>
                  <th>ID</th>
                  <th>Nama</th>
                  <th>NIM</th>
                  <th>Jurusan</th>
                  <th>Email</th>
                  <th class="text-center">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($mahasiswa as $mhs)
                  <tr>
                    <td>{{ $mhs->id }}</td>
                    <td>{{ $mhs->nama }}</td>
                    <td>{{ $mhs->nim }}</td>
                    <td>{{ $mhs->jurusan }}</td>
                    <td>{{ $mhs->email }}</td>
                    <td class="text-center">
                      <a href="{{ route('editDataMahasiswa', $mhs->id) }}" class="btn btn-sm btn-warning me-1">
                        <i class="fas fa-edit"></i>
                      </a>
                      <form action="{{ route('deleteDataMahasiswa', $mhs->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
                          <i class="fas fa-trash-alt"></i>
                        </button>
                      </form>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="6" class="text-center">Belum ada data mahasiswa.</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div>
  </section>
</div>
@endsection
