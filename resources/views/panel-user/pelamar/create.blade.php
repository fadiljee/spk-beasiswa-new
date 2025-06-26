@extends('panel-user.layout')

@section('title', 'Pendaftaran Beasiswa')
@section('page-title', 'Formulir Pendaftaran Beasiswa')
@section('page-subtitle', 'Lengkapi semua data yang diperlukan di bawah ini.')

{{-- Semua style khusus halaman ini dipindahkan ke sini --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet" />
<style>
    .form-card {
        background: #fff;
        border-radius: 12px;
        padding: 2.5rem;
        box-shadow: var(--card-shadow);
        border: 1px solid var(--border-color);
    }

    .form-section {
        margin-bottom: 2.5rem;
    }
    .form-section:last-child {
        margin-bottom: 0;
    }

    .section-title {
        font-family: 'Poppins', sans-serif;
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 1.5rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid var(--border-color);
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .section-title i {
        color: var(--user-primary-color);
    }

    .form-label {
        font-weight: 500;
        color: #495057;
        margin-bottom: 0.5rem;
        font-size: 0.9rem;
    }

    .form-control, .form-select {
        border-radius: 8px;
        padding: 0.75rem 1rem;
        border: 1px solid #ced4da;
    }

    /* --- PERBAIKAN DIMULAI DI SINI --- */
    .form-select {
        color: #000; /* Memastikan teks yang terpilih di dalam select box berwarna hitam */
    }

    .form-select option {
        color: #000; /* Memastikan teks opsi di dropdown berwarna hitam */
        background: #fff; /* Memberi latar belakang putih untuk menghindari transparan */
    }
    /* --- PERBAIKAN SELESAI --- */


    .form-control:focus, .form-select:focus {
        border-color: var(--user-primary-color);
        box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.15);
    }

    .file-upload {
        position: relative;
        border: 2px dashed var(--border-color);
        border-radius: 8px;
        padding: 2rem;
        text-align: center;
        transition: all 0.2s ease;
        background: #f8f9fa;
        cursor: pointer;
    }

    .file-upload:hover {
        border-color: var(--user-primary-color);
        background: #f1f3f5;
    }

    .file-upload input[type="file"] {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        opacity: 0; cursor: pointer;
    }

    .file-upload-icon { font-size: 2rem; color: var(--user-primary-color); margin-bottom: 0.5rem; }
    .file-upload-text { font-weight: 500; }
    .file-upload-hint { font-size: 0.85rem; color: #6c757d; }

    .btn-submit {
      width: 100%;
      font-weight: 600;
      padding: 0.8rem;
      font-size: 1.1rem;
      border-radius: 8px;
    }

    .modal-header {
        background-color: var(--user-primary-color);
        color: #fff;
    }

    .btn-confirm {
        background-color: var(--user-primary-color);
        color: #fff;
    }
</style>

@section('content')
<div class="form-card">
    {{-- Notifikasi Error Global dari Laravel --}}
    @if ($errors->any())
        <div class="alert alert-danger mb-4">
            <h5 class="alert-heading"><i class="fas fa-exclamation-triangle me-2"></i>Terjadi Kesalahan!</h5>
            <p>Harap periksa kembali isian Anda. Ada beberapa data yang belum valid.</p>
        </div>
    @endif

    <form id="registrationForm" action="{{ route('pelamar.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-section">
            <h3 class="section-title"><i class="bi bi-person-circle"></i>Informasi Pribadi</h3>
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control @error('nama_lengkap') is-invalid @enderror" value="{{ old('nama_lengkap') }}" required placeholder="Masukkan nama lengkap">
                    @error('nama_lengkap')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required placeholder="contoh@email.com">
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" value="{{ old('tempat_lahir') }}" required placeholder="Kota tempat lahir">
                    @error('tempat_lahir')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror" value="{{ old('tanggal_lahir') }}" required>
                    @error('tanggal_lahir')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>

        <div class="form-section">
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror" required>
                        <option value="" disabled selected>-- Pilih --</option>
                        <option value="Laki-laki" @if(old('jenis_kelamin') == 'Laki-laki') selected @endif>Laki-laki</option>
                        <option value="Perempuan" @if(old('jenis_kelamin') == 'Perempuan') selected @endif>Perempuan</option>
                    </select>
                    @error('jenis_kelamin')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label for="nomor_whatsapp" class="form-label">Nomor WhatsApp</label>
                    <input type="tel" name="nomor_whatsapp" id="nomor_whatsapp" class="form-control @error('nomor_whatsapp') is-invalid @enderror" value="{{ old('nomor_whatsapp') }}" required placeholder="08xxxxxxxxxx">
                    @error('nomor_whatsapp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-12">
                    <label for="alamat" class="form-label">Alamat Lengkap</label>
                    <textarea name="alamat" id="alamat" rows="3" class="form-control @error('alamat') is-invalid @enderror" required placeholder="Masukkan alamat lengkap">{{ old('alamat') }}</textarea>
                    @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>

         <div class="mb-4">
      <label for="universitas_beasiswa_id_1" class="form-label">Universitas Pilihan Beasiswa 1</label>
      <select name="universitas_beasiswa_id_1" id="universitas_beasiswa_id_1" class="form-select @error('universitas_beasiswa_id_1') is-invalid @enderror" required>
        <option value="" disabled selected>-- Pilih Universitas --</option>
        @foreach($universitas as $uni)
          <option value="{{ $uni->id }}" {{ old('universitas_beasiswa_id_1') == $uni->id ? 'selected' : '' }}>
            {{ $uni->nama_universitas }}
          </option>
        @endforeach
      </select>
      @error('universitas_beasiswa_id_1')<div class="text-danger">{{ $message }}</div>@enderror
    </div>

    <div class="mb-4">
      <label for="universitas_beasiswa_id_2" class="form-label">Universitas Pilihan Beasiswa 2 (Opsional)</label>
      <select name="universitas_beasiswa_id_2" id="universitas_beasiswa_id_2" class="form-select @error('universitas_beasiswa_id_2') is-invalid @enderror">
        <option value="" disabled selected>-- Pilih Universitas --</option>
        @foreach($universitas as $uni)
          <option value="{{ $uni->id }}" {{ old('universitas_beasiswa_id_2') == $uni->id ? 'selected' : '' }}>
            {{ $uni->nama_universitas }}
          </option>
        @endforeach
      </select>
      @error('universitas_beasiswa_id_2')<div class="text-danger">{{ $message }}</div>@enderror
    </div>

        <div class="form-section">
            <h3 class="section-title"><i class="bi bi-mortarboard-fill"></i>Informasi Akademik</h3>
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="asal_universitas" class="form-label">Asal Universitas</label>
                    <input type="text" name="asal_universitas" id="asal_universitas" class="form-control @error('asal_universitas') is-invalid @enderror" value="{{ old('asal_universitas') }}" required placeholder="Nama universitas asal">
                    @error('asal_universitas')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label for="jurusan" class="form-label">Jurusan</label>
                    <input type="text" name="jurusan" id="jurusan" class="form-control @error('jurusan') is-invalid @enderror" value="{{ old('jurusan') }}" required placeholder="Contoh: Teknik Informatika">
                    @error('jurusan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-12">
                    <label for="ipk" class="form-label">IPK (Indeks Prestasi Kumulatif)</label>
                    <input type="number" name="ipk" id="ipk" class="form-control @error('ipk') is-invalid @enderror" value="{{ old('ipk') }}" required placeholder="Contoh: 3.50" step="0.01" min="0" max="4">
                    @error('ipk')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>

        <div class="form-section">
            <h3 class="section-title"><i class="bi bi-cloud-arrow-up-fill"></i>Upload Dokumen (PDF, max 2MB)</h3>
            <div class="row g-3">
                <div class="col-md-4">
                    <label for="cv" class="form-label">Curriculum Vitae (CV)</label>
                    <div class="file-upload">
                        <input type="file" name="cv" id="cv" class="@error('cv') is-invalid @enderror" accept=".pdf" required>
                        <div class="file-upload-content">
                            <i class="bi bi-file-person-fill file-upload-icon"></i>
                            <div class="file-upload-text">Klik untuk upload</div>
                        </div>
                    </div>
                    @error('cv')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label for="transkrip_nilai" class="form-label">Transkrip Nilai</label>
                    <div class="file-upload">
                        <input type="file" name="transkrip_nilai" id="transkrip_nilai" class="@error('transkrip_nilai') is-invalid @enderror" accept=".pdf" required>
                        <div class="file-upload-content">
                            <i class="bi bi-file-text-fill file-upload-icon"></i>
                            <div class="file-upload-text">Klik untuk upload</div>
                        </div>
                    </div>
                    @error('transkrip_nilai')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label for="ijazah" class="form-label">Ijazah</label>
                    <div class="file-upload">
                        <input type="file" name="ijazah" id="ijazah" class="@error('ijazah') is-invalid @enderror" accept=".pdf" required>
                        <div class="file-upload-content">
                            <i class="bi bi-award-fill file-upload-icon"></i>
                            <div class="file-upload-text">Klik untuk upload</div>
                        </div>
                    </div>
                    @error('ijazah')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>

        <div class="mt-4 text-center">
            <button type="button" class="btn btn-primary btn-lg btn-submit" data-bs-toggle="modal" data-bs-target="#confirmModal">
                <i class="bi bi-send-fill me-2"></i>Kirim Pendaftaran
            </button>
        </div>
    </form>
</div>

<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="border-radius: 12px;">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmModalLabel"><i class="bi bi-check-circle-fill me-2"></i>Konfirmasi Pendaftaran</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body py-4">
        <p>Pastikan semua data yang Anda masukkan sudah benar. Data tidak dapat diubah setelah dikirim.</p>
      </div>
      <div class="modal-footer border-0">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-confirm" id="submitConfirmBtn">Ya, Kirim Sekarang</button>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('input[type="file"]').forEach(input => {
        input.addEventListener('change', function(e) {
            const file = e.target.files[0];
            const textDiv = e.target.nextElementSibling.querySelector('.file-upload-text');
            if (file) {
                textDiv.textContent = file.name;
            } else {
                textDiv.textContent = 'Klik untuk upload';
            }
        });
    });

    const submitBtn = document.getElementById('submitConfirmBtn');
    if(submitBtn) {
        submitBtn.addEventListener('click', function () {
            document.getElementById('registrationForm').submit();
        });
    }
});
</script>
@endpush
