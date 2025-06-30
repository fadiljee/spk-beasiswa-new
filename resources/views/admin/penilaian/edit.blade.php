@extends('admin.layout')

@section('title', 'Edit Penilaian')
@section('page-title', 'Formulir Penilaian')
@section('page-subtitle', 'Edit penilaian untuk pelamar: ' . $pelamar->nama_lengkap)

@section('styles')
<style>
    .form-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
    }
    .form-card-header {
        background-color: #fff;
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid #e5e7eb;
        border-left: 5px solid #0d6efd;
    }
    .form-label {
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.5rem;
    }
    .form-control:disabled, .form-control[readonly] {
        background-color: #e9ecef;
        opacity: 1;
        cursor: not-allowed;
    }
    .card-footer {
        background-color: #f9fafb;
        border-top: 1px solid #e5e7eb;
    }
    .kriteria-group {
        border: 1px solid #dee2e6;
        border-radius: 8px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        background-color: #fdfdff;
    }
    .kriteria-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #0d6efd;
        margin-bottom: 1rem;
    }

    /* === PENDEKATAN FINAL (CSS + JAVASCRIPT) === */
    .subkriteria-select:required:invalid {
        color: #6c757d;
        opacity: 1;
    }

    .subkriteria-select.has-value {
        color: #212529 !important;
        -webkit-text-fill-color: #212529 !important;
        opacity: 1 !important;
    }
</style>
@endsection

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card form-card">
    <div class="card-header form-card-header">
        <h5 class="card-title mb-0 fw-bold">Detail Penilaian</h5>
        <p class="text-muted mb-0 mt-1">Ubah penilaian untuk setiap kriteria di bawah ini.</p>
    </div>

    {{-- Form diubah untuk proses UPDATE --}}
    <form action="{{ route('penilaian.update', $pelamar->id) }}" method="POST">
        @csrf
        @method('PUT') {{-- Metode PUT untuk update --}}

        <div class="card-body">
            @if($kriterias->isEmpty())
                <div class="alert alert-warning text-center">
                    Belum ada data kriteria. Silakan tambahkan kriteria terlebih dahulu.
                </div>
            @else
                @foreach($kriterias as $kriteria)
                <div class="kriteria-group">
                    <h6 class="kriteria-title"><i class="fas fa-list-ul me-2"></i>{{ $kriteria->nama_kriteria }}</h6>
                    <div class="row g-3 align-items-center">
                        <div class="col-md-7">
                            <label for="subkriteria-{{ $kriteria->id }}" class="form-label visually-hidden">Pilih Opsi</label>
                            <select name="penilaian[{{ $kriteria->id }}][subkriteria_id]"
                                    id="subkriteria-{{ $kriteria->id }}"
                                    class="form-select form-select-lg subkriteria-select"
                                    data-kriteria-id="{{ $kriteria->id }}"
                                    required>
                                <option value="" disabled>-- Pilih Opsi {{ $kriteria->nama_kriteria }} --</option>
                                @foreach($kriteria->subkriteria as $sub)
                                    {{-- LOGIKA UNTUK MEMILIH OPSI YANG SUDAH ADA --}}
                                    <option value="{{ $sub->id }}" data-nilai="{{ $sub->nilai }}"
                                        @if(isset($penilaianTersimpan[$kriteria->id]) && $penilaianTersimpan[$kriteria->id] == $sub->id)
                                            selected
                                        @endif
                                    >
                                        {{ $sub->nama_subkriteria }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-5">
                            <label for="nilai-display-{{ $kriteria->id }}" class="form-label visually-hidden">Nilai</label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text"><i class="fas fa-star"></i></span>
                                <input type="text"
                                       id="nilai-display-{{ $kriteria->id }}"
                                       class="form-control nilai-display"
                                       placeholder="Nilai"
                                       readonly>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
        <div class="card-footer text-end">
            <a href="{{ route('penilaian.index') }}" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-primary" @if($kriterias->isEmpty()) disabled @endif>
                <i class="fas fa-save me-2"></i>Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const subkriteriaSelects = document.querySelectorAll('.subkriteria-select');

    subkriteriaSelects.forEach(select => {
        // Fungsi untuk meng-update nilai dan style
        const updateSelectDisplay = (targetSelect) => {
            if (targetSelect.value) {
                targetSelect.classList.add('has-value');
            } else {
                targetSelect.classList.remove('has-value');
            }

            const kriteriaId = targetSelect.dataset.kriteriaId;
            const nilaiDisplay = document.getElementById(`nilai-display-${kriteriaId}`);
            const selectedOption = targetSelect.options[targetSelect.selectedIndex];

            // Pastikan selectedOption ada sebelum mencoba mengakses dataset
            const nilai = selectedOption && selectedOption.dataset.nilai ? selectedOption.dataset.nilai : '';

            if (nilaiDisplay) {
                nilaiDisplay.value = nilai;
            }
        };

        // Tambahkan event listener untuk setiap perubahan
        select.addEventListener('change', (event) => {
            updateSelectDisplay(event.target);
        });

        // PENTING: Panggil fungsi ini saat halaman dimuat untuk
        // mengisi nilai dari data yang sudah terpilih (selected).
        updateSelectDisplay(select);
    });
});
</script>
@endsection
