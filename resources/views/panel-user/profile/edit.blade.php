@extends('panel-user.layout')

@section('title', 'Edit Profil')
@section('page-title', 'Edit Profil')
@section('page-subtitle', 'Perbarui informasi personal dan keamanan akun Anda.')


{{-- Style diadaptasi dari form pendaftaran untuk diterapkan di sini --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet" />
<style>
    .profile-form-card {
        background: #ffffff;
        border-radius: 16px;
        padding: 2.5rem;
        box-shadow: var(--card-shadow);
        border: 1px solid var(--border-color);
    }

    .form-header {
        text-align: center;
        margin-bottom: 2.5rem;
    }
    .form-header .avatar {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        margin: 0 auto 1rem;
        border: 4px solid #fff;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    .form-header .name {
        font-family: 'Poppins', sans-serif;
        font-weight: 600;
        font-size: 1.5rem;
        color: var(--text-dark);
    }
    .form-header .email {
        color: #6c757d;
    }

    .form-section {
        margin-bottom: 2rem;
    }

    .section-title {
        font-family: 'Poppins', sans-serif;
        font-size: 1.2rem;
        font-weight: 600;
        color: #495057;
        margin-bottom: 1.5rem;
        padding-bottom: 0.5rem;
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
    .field-note {
        color: #6c757d;
        font-size: 0.8rem;
        font-weight: 400;
        margin-left: 0.5rem;
    }
    .form-control:focus {
        border-color: var(--user-primary-color);
        box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.15);
    }

    .btn-submit {
        background: var(--user-primary-color);
        border: none;
        padding: 0.8rem 2.5rem;
        font-weight: 600;
        font-size: 1rem;
        border-radius: 8px;
        color: white;
        transition: all 0.2s ease;
    }
    .btn-submit:hover {
        opacity: 0.9;
        transform: translateY(-2px);
    }
</style>

@section('content')
<div class="profile-form-card">
    @if(session('success'))
    <div class="alert alert-success d-flex align-items-center" role="alert">
        <i class="fas fa-check-circle me-2"></i>
        <div>{{ session('success') }}</div>
    </div>
    @endif

   

    <form action="{{ route('profile.update') }}" method="POST" id="profileForm">
        @csrf
        @method('PUT')

        @php
        // STRUKTUR DINAMIS DARI KODE ASLI ANDA DIPERTAHANKAN
        $fields = [
            'personal' => [
                'title' => 'Informasi Personal',
                'icon' => 'bi-person-circle',
                'inputs' => [
                    ['label' => 'Nama Lengkap', 'name' => 'nama', 'type' => 'text', 'required' => true, 'placeholder' => 'Masukkan nama lengkap Anda'],
                    ['label' => 'Alamat Email', 'name' => 'email', 'type' => 'email', 'required' => true, 'placeholder' => 'contoh@email.com'],
                    ['label' => 'Nomor Induk Mahasiswa', 'name' => 'nim', 'type' => 'text', 'required' => true, 'placeholder' => 'Masukkan NIM Anda'],
                    ['label' => 'Program Studi', 'name' => 'jurusan', 'type' => 'text', 'required' => false, 'placeholder' => 'Contoh: Teknik Informatika'],
                ]
            ],
            'security' => [
                'title' => 'Keamanan Akun',
                'icon' => 'bi-shield-lock-fill',
                'inputs' => [
                    ['label' => 'Password Baru', 'name' => 'password', 'type' => 'password', 'required' => false, 'note' => 'Kosongkan jika tidak ingin mengubah', 'placeholder' => 'Masukkan password baru'],
                    ['label' => 'Konfirmasi Password', 'name' => 'password_confirmation', 'type' => 'password', 'required' => false, 'placeholder' => 'Konfirmasi password baru'],
                ]
            ]
        ];
        @endphp

        @foreach ($fields as $section)
            <div class="form-section">
                <h4 class="section-title">
                    <i class="bi {{ $section['icon'] }}"></i>
                    {{ $section['title'] }}
                </h4>
                <div class="row g-3">
                    @foreach ($section['inputs'] as $field)
                        <div class="col-md-{{ count($section['inputs']) > 2 && ($field['name'] === 'nim' || $field['name'] === 'jurusan') ? '6' : '12' }} {{ $field['name'] === 'name' || $field['name'] === 'email' ? 'col-md-6' : ''}} ">
                            <label for="{{ $field['name'] }}" class="form-label">
                                {{ $field['label'] }}
                                @if (!empty($field['note']))
                                    <span class="field-note">({{ $field['note'] }})</span>
                                @endif
                            </label>
                            <input
                                type="{{ $field['type'] }}"
                                name="{{ $field['name'] }}"
                                id="{{ $field['name'] }}"
                                class="form-control @error($field['name']) is-invalid @enderror"
                                value="{{ old($field['name'], $user->{$field['name']} ?? '') }}"
                                @if ($field['required']) required @endif
                                placeholder="{{ $field['placeholder'] ?? '' }}"
                                autocomplete="{{ $field['type'] === 'password' ? 'new-password' : 'off' }}"
                            >
                            @error($field['name'])
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach

        <div class="text-end mt-4">
            <button type="submit" class="btn btn-primary btn-submit" id="submitBtn">
                <i class="fas fa-save me-2"></i>
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
{{-- Script fungsional dari kode asli Anda dipertahankan --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('profileForm');
    const submitBtn = document.getElementById('submitBtn');

    // Validasi konfirmasi password
    const password = document.getElementById('password');
    const passwordConfirm = document.getElementById('password_confirmation');
    if (password && passwordConfirm) {
        const validatePasswords = () => {
            if (password.value && password.value !== passwordConfirm.value) {
                passwordConfirm.setCustomValidity('Konfirmasi password tidak cocok.');
                passwordConfirm.classList.add('is-invalid');
            } else {
                passwordConfirm.setCustomValidity('');
                passwordConfirm.classList.remove('is-invalid');
            }
        };
        password.addEventListener('input', validatePasswords);
        passwordConfirm.addEventListener('input', validatePasswords);
    }

    // Tampilkan loading state saat form disubmit
    if(form) {
        form.addEventListener('submit', function(e) {
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Menyimpan...';
            submitBtn.disabled = true;
        });
    }

    // Hilangkan notifikasi sukses setelah beberapa detik
    const successAlert = document.querySelector('.alert-success');
    if (successAlert) {
        setTimeout(() => {
            new bootstrap.Alert(successAlert).close();
        }, 5000);
    }
});
</script>
@endpush
