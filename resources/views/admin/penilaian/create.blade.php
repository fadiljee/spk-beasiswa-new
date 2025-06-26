@extends('admin.layout')

@section('title', 'Input Penilaian')
@section('page-title', 'Formulir Penilaian')
@section('page-subtitle', 'Input penilaian untuk pelamar: ' . $pelamar->nama_lengkap)

@section('styles')
<style>
    .form-card {
        border: none;
        border-radius: 12px;
        box-shadow: var(--card-shadow);
    }
    .form-card-header {
        background-color: #fff;
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid var(--border-color);
        border-left: 5px solid var(--primary-color);
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
        border-top: 1px solid var(--border-color);
    }
</style>
@endsection

@section('content')
<div class="card form-card">
    <div class="card-header form-card-header">
        <h5 class="card-title mb-0 fw-bold">Detail Penilaian</h5>
    </div>
    <form action="{{ route('penilaian.store') }}" method="POST">
        @csrf
        <input type="hidden" name="pelamar_id" value="{{ $pelamar->id }}">

        <div class="card-body">
            <div class="row g-3">
                {{-- Dropdown Kriteria --}}
                <div class="col-md-6">
                    <label for="kriteria_id" class="form-label"><i class="fas fa-list-ul me-2"></i>Pilih Kriteria</label>
                    <select name="kriteria_id" id="kriteria_id" class="form-select form-select-lg" required>
                        <option value="" selected disabled>-- Pilih Kriteria --</option>
                        @foreach($kriterias as $kriteria)
                            <option value="{{ $kriteria->id }}">{{ $kriteria->nama_kriteria }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Dropdown Subkriteria --}}
                <div class="col-md-6">
                    <label for="subkriteria_id" class="form-label"><i class="fas fa-indent me-2"></i>Pilih Subkriteria</label>
                    <select name="subkriteria_id" id="subkriteria_id" class="form-select form-select-lg" required disabled>
                        <option value="" selected disabled>-- Pilih Kriteria Terlebih Dahulu --</option>
                    </select>
                </div>

                {{-- Nilai Subkriteria (otomatis) --}}
                <div class="col-12">
                    <label for="nilai_display" class="form-label"><i class="fas fa-star me-2"></i>Nilai</label>
                    <input type="text" id="nilai_display" class="form-control form-control-lg" placeholder="Nilai akan muncul di sini" readonly>
                    <input type="hidden" name="nilai" id="nilai_hidden">
                </div>
            </div>
        </div>

        <div class="card-footer text-end">
            <a href="{{ route('penilaian.index') }}" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save me-2"></i>Simpan Penilaian
            </button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Cache elemen DOM
    const kriteriaSelect = document.getElementById('kriteria_id');
    const subkriteriaSelect = document.getElementById('subkriteria_id');
    const nilaiDisplay = document.getElementById('nilai_display');
    const nilaiHidden = document.getElementById('nilai_hidden');

    // Definisikan base URL untuk fetch
    const baseUrl = "{{ url('/') }}";

    kriteriaSelect.addEventListener('change', function() {
        const kriteriaId = this.value;

        // Reset dan tampilkan status loading
        subkriteriaSelect.disabled = true;
        subkriteriaSelect.innerHTML = '<option value="">Memuat data...</option>';
        nilaiDisplay.value = '';
        nilaiHidden.value = '';

        if (!kriteriaId) {
            subkriteriaSelect.innerHTML = '<option value="" selected disabled>-- Pilih Kriteria Terlebih Dahulu --</option>';
            return;
        }

        // Fetch subkriteria dari server
        fetch(`${baseUrl}/get-subkriteria/${kriteriaId}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                subkriteriaSelect.disabled = false;
                subkriteriaSelect.innerHTML = '<option value="" selected disabled>-- Pilih Subkriteria --</option>';

                if (data.length > 0) {
                    data.forEach(subkriteria => {
                        const option = document.createElement('option');
                        option.value = subkriteria.id;
                        option.textContent = subkriteria.nama;
                        // Simpan nilai di data attribute untuk diambil nanti
                        option.dataset.nilai = subkriteria.nilai;
                        subkriteriaSelect.appendChild(option);
                    });
                } else {
                    subkriteriaSelect.innerHTML = '<option value="" disabled>-- Tidak ada subkriteria --</option>';
                }
            })
            .catch(error => {
                console.error('Fetch Error:', error);
                subkriteriaSelect.innerHTML = '<option value="" disabled>-- Gagal memuat data --</option>';
            });
    });

    // Event listener untuk mengupdate nilai saat subkriteria dipilih
    subkriteriaSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const nilai = selectedOption.dataset.nilai || ''; // Ambil nilai dari data attribute

        nilaiDisplay.value = nilai;
        nilaiHidden.value = nilai;
    });
});
</script>
@endsection
