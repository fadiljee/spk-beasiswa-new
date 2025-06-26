@extends('user.layout')

@section('title', 'SPK BEASISWA')

@section('content')
<main class="container my-5" style="max-width: 800px;">
   {{-- Logo Universitas --}}
  <div class="text-center mb-4">
    <img src="{{ asset('storage/logo/' . $beasiswa->logo) }}" alt="{{ $beasiswa->nama_universitas }}"
         style="max-height: 120px; max-width: 100%; object-fit: contain; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);" />
  </div>

  {{-- Nama Universitas --}}

  <h1 class="section-title text-dark mb-4 text-center">{{ $beasiswa->nama_universitas }}</h1>

  <div class="accordion" id="beasiswaAccordion">

    <div class="accordion-item mb-3">
      <h2 class="accordion-header" id="headingDeskripsi">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDeskripsi" aria-expanded="false" aria-controls="collapseDeskripsi">
          Deskripsi
        </button>
      </h2>
      <div id="collapseDeskripsi" class="accordion-collapse collapse" aria-labelledby="headingDeskripsi" data-bs-parent="#beasiswaAccordion">
        <div class="accordion-body">
          {!! nl2br(e($beasiswa->deskripsi)) !!}
        </div>
      </div>
    </div>

    <div class="accordion-item mb-3">
      <h2 class="accordion-header" id="headingPersyaratan">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePersyaratan" aria-expanded="false" aria-controls="collapsePersyaratan">
          Persyaratan
        </button>
      </h2>
      <div id="collapsePersyaratan" class="accordion-collapse collapse" aria-labelledby="headingPersyaratan" data-bs-parent="#beasiswaAccordion">
        <div class="accordion-body">
          {!! nl2br(e($beasiswa->persyaratan)) !!}
        </div>
      </div>
    </div>

    <div class="accordion-item mb-3">
      <h2 class="accordion-header" id="headingPeriode">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePeriode" aria-expanded="false" aria-controls="collapsePeriode">
          Periode Akademik
        </button>
      </h2>
      <div id="collapsePeriode" class="accordion-collapse collapse" aria-labelledby="headingPeriode" data-bs-parent="#beasiswaAccordion">
        <div class="accordion-body">
          {{ $beasiswa->periode_akademik }}
        </div>
      </div>
    </div>

    <div class="accordion-item mb-3">
      <h2 class="accordion-header" id="headingStatistik">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseStatistik" aria-expanded="false" aria-controls="collapseStatistik">
          Statistik Penerimaan
        </button>
      </h2>
      <div id="collapseStatistik" class="accordion-collapse collapse" aria-labelledby="headingStatistik" data-bs-parent="#beasiswaAccordion">
        <div class="accordion-body">
          {!! nl2br(e($beasiswa->statistik_penerimaan)) !!}
        </div>
      </div>
    </div>

  </div>

  <div class="btn-container mt-4 text-center">
    <a href="{{ route('user.beranda') }}" class="btn btn-dark btn-lg px-5 shadow-sm">Kembali ke Beranda</a>
  </div>
</main>

<!-- Jangan lupa pastikan bootstrap JS dan CSS sudah include -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<style>
  .accordion-button:focus {
    box-shadow: none;
  }

</style>
@endsection
