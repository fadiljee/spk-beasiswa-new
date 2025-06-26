@extends('admin.layout')

@section('title', 'Edit Penilaian')

@section('content')
<div class="content-wrapper">
  <section class="content">
    <div class="container-fluid py-4">
      <h4>Edit Penilaian untuk {{ $pelamar->nama_pelamar }}</h4>

      <form action="{{ route('penilaian.update', ['pelamar_id' => $pelamar->id, 'subkriteria_id' => $subkriteria->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
          <label for="nilai">Nilai</label>
          <input type="number" name="nilai" class="form-control" value="{{ $penilaian->nilai }}" required min="1" max="100">
        </div>

        <button type="submit" class="btn btn-primary mt-3">Perbarui Nilai</button>
      </form>
    </div>
  </section>
</div>
@endsection
