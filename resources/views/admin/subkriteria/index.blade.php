@extends('admin.layout')
@section('title', 'Data Sub Kriteria')


<style>
    .gradient-bg {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .card-modern {
        border: none;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .card-modern:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .card-header-modern {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border: none;
        padding: 25px;
        position: relative;
    }

    .card-header-modern::before {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, #667eea, #764ba2);
    }

    .btn-modern {
        border-radius: 50px;
        padding: 10px 25px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        border: none;
    }

    .btn-modern:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }

    .btn-gradient {
        background: linear-gradient(45deg, #667eea, #764ba2);
        color: white;
    }

    .btn-gradient:hover {
        background: linear-gradient(45deg, #764ba2, #667eea);
        color: white;
    }

    .table-modern {
        border: none;
        margin-bottom: 0;
    }

    .table-modern thead th {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border: none;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-size: 0.8rem;
        color: #495057;
        padding: 15px;
    }

    .table-modern tbody tr {
        transition: all 0.3s ease;
        border: none;
    }

    .table-modern tbody tr:hover {
        background-color: #f8f9fa;
        transform: scale(1.01);
    }

    .table-modern tbody td {
        border: none;
        padding: 15px;
        vertical-align: middle;
        border-bottom: 1px solid #f1f3f4;
    }

    .form-modern {
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        border-radius: 20px;
        padding: 30px;
        margin-top: 25px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        border: 2px dashed #e9ecef;
        transition: all 0.3s ease;
    }

    .form-modern:hover {
        border-color: #667eea;
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.1);
    }

    .form-control-modern {
        border: 2px solid #e9ecef;
        border-radius: 15px;
        padding: 12px 20px;
        transition: all 0.3s ease;
        background-color: #ffffff;
    }

    .form-control-modern:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }

    .badge-modern {
        padding: 8px 16px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.75em;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .badge-value {
        background: linear-gradient(45deg, #28a745, #20c997);
        color: white;
    }

    .page-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 40px 0;
        margin-bottom: 30px;
        border-radius: 0 0 30px 30px;
    }

    .stats-card {
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        border: none;
        border-radius: 20px;
        padding: 25px;
        text-align: center;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        margin-bottom: 30px;
    }

    .stats-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
    }

    .action-buttons .btn {
        margin: 0 3px;
        border-radius: 50%;
        width: 35px;
        height: 35px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .action-buttons .btn:hover {
        transform: scale(1.1);
    }

    .kriteria-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .kriteria-info {
        display: flex;
        align-items: center;
    }

    .kriteria-icon {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: linear-gradient(45deg, #667eea, #764ba2);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
    }

    .empty-state {
        text-align: center;
        padding: 40px 20px;
        color: #6c757d;
    }

    .empty-state i {
        font-size: 3rem;
        margin-bottom: 15px;
        opacity: 0.5;
    }

    .form-header {
        text-align: center;
        margin-bottom: 25px;
    }

    .form-header i {
        font-size: 2rem;
        color: #667eea;
        margin-bottom: 10px;
    }

    .sub-count {
        background: linear-gradient(45deg, #17a2b8, #6f42c1);
        color: white;
        border-radius: 50%;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 0.8rem;
    }

    .masonry-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(500px, 1fr));
        gap: 25px;
    }

    @media (max-width: 768px) {
        .masonry-grid {
            grid-template-columns: 1fr;
        }

        .kriteria-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .sub-count {
            margin-top: 10px;
        }
    }

    .loading {
        opacity: 0.7;
        pointer-events: none;
    }

    .loading .btn {
        position: relative;
    }

    .loading .btn::after {
        content: '';
        position: absolute;
        width: 20px;
        height: 20px;
        border: 2px solid transparent;
        border-top: 2px solid white;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>


@section('content')
<div class="content-wrapper">
    <!-- Page Header -->
    <div class="page-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h2 class="mb-0 fw-bold">
                        <i class="fas fa-sitemap me-3"></i>
                        Manajemen Sub Kriteria
                    </h2>
                    <p class="mb-0 mt-2 opacity-75">Kelola sub kriteria untuk setiap kriteria penilaian</p>
                </div>
                <div class="col-md-4 text-end">
                    <a href="{{ route('subkriteria.create') }}" class="btn btn-modern btn-gradient">
                        <i class="fas fa-plus-circle me-2"></i>
                        Tambah Sub Kriteria
                    </a>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            {{-- Flash Message --}}
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" style="border-radius: 15px; border: none; box-shadow: 0 5px 15px rgba(40, 167, 69, 0.2);" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            {{-- Stats Overview --}}
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="stats-card">
                        <i class="fas fa-list text-primary mb-3" style="font-size: 2rem;"></i>
                        <h4 class="fw-bold text-primary">{{ $kriterias->count() }}</h4>
                        <p class="text-muted mb-0">Total Kriteria</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card">
                        <i class="fas fa-sitemap text-success mb-3" style="font-size: 2rem;"></i>
                        <h4 class="fw-bold text-success">{{ $kriterias->sum(function($k) { return $k->subkriteria->count(); }) }}</h4>
                        <p class="text-muted mb-0">Total Sub Kriteria</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card">
                        <i class="fas fa-calculator text-info mb-3" style="font-size: 2rem;"></i>
                        <h4 class="fw-bold text-info">{{ number_format($kriterias->flatMap->subkriteria->avg('nilai'), 1) }}</h4>
                        <p class="text-muted mb-0">Rata-rata Nilai</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card">
                        <i class="fas fa-chart-bar text-warning mb-3" style="font-size: 2rem;"></i>
                        <h4 class="fw-bold text-warning">{{ $kriterias->flatMap->subkriteria->max('nilai') ?? 0 }}</h4>
                        <p class="text-muted mb-0">Nilai Tertinggi</p>
                    </div>
                </div>
            </div>

            {{-- Main Content --}}
            @if($kriterias->count() > 0)
            <div class="masonry-grid">
                @foreach($kriterias as $kriteria)
                <div class="card card-modern">
                    <div class="card-header-modern">
                        <div class="kriteria-header">
                            <div class="kriteria-info">
                                <div class="kriteria-icon">
                                    <i class="fas fa-clipboard-list text-white"></i>
                                </div>
                                <div>
                                    <h5 class="mb-1 fw-bold">{{ $kriteria->nama_kriteria }}</h5>
                                    <p class="mb-0 text-muted">{{ $kriteria->kode_kriteria }}</p>
                                </div>
                            </div>
                            <div class="sub-count">
                                {{ $kriteria->subkriteria->count() }}
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        @if($kriteria->subkriteria->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-modern">
                                <thead>
                                    <tr>
                                        <th width="60"><i class="fas fa-hashtag me-1"></i>No</th>
                                        <th><i class="fas fa-tag me-1"></i>Nama Sub Kriteria</th>
                                        <th width="100"><i class="fas fa-star me-1"></i>Nilai</th>
                                        <th width="120" class="text-center"><i class="fas fa-cogs me-1"></i>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($kriteria->subkriteria as $sub)
                                    <tr>
                                        <td>
                                            <span class="badge bg-secondary">{{ $loop->iteration }}</span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="bg-light rounded-circle p-2 me-3">
                                                    <i class="fas fa-bookmark text-primary"></i>
                                                </div>
                                                <span class="fw-medium">{{ $sub->nama }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge badge-modern badge-value">
                                                {{ $sub->nilai }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <div class="action-buttons">
                                                <a href="{{ route('subkriteria.edit', $sub->id) }}"
                                                   class="btn btn-warning btn-sm"
                                                   title="Edit Sub Kriteria">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('subkriteria.destroy', $sub->id) }}"
                                                      method="POST"
                                                      class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="btn btn-danger btn-sm"
                                                            title="Hapus Sub Kriteria"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus sub kriteria ini?')">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <div class="empty-state">
                            <i class="fas fa-inbox"></i>
                            <p class="mb-0">Belum ada sub kriteria</p>
                        </div>
                        @endif

                        {{-- Quick Add Form --}}
                        <div class="form-modern">
                            <div class="form-header">
                                <i class="fas fa-plus-circle"></i>
                                <h6 class="fw-bold mb-0">Tambah Sub Kriteria Baru</h6>
                            </div>

                            <form action="{{ route('subkriteria.store') }}" method="POST" class="quick-add-form">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="nama_{{ $kriteria->id }}" class="form-label fw-medium">
                                            <i class="fas fa-tag me-1"></i>Nama Sub Kriteria
                                        </label>
                                        <input type="text"
                                               name="nama"
                                               id="nama_{{ $kriteria->id }}"
                                               class="form-control form-control-modern"
                                               placeholder="Masukkan nama sub kriteria"
                                               required>
                                    </div>
                                    {{-- PERUBAHAN 1: Kolom nilai diubah dari col-md-4 menjadi col-md-3 --}}
                                    <div class="col-md-3 mb-3">
                                        <label for="nilai_{{ $kriteria->id }}" class="form-label fw-medium">
                                            <i class="fas fa-star me-1"></i>Nilai
                                        </label>
                                        <input type="number"
                                               name="nilai"
                                               id="nilai_{{ $kriteria->id }}"
                                               class="form-control form-control-modern"
                                               min="1"
                                               max="100"
                                               placeholder="1-100"
                                               required>
                                    </div>
                                    {{-- PERUBAHAN 2: Kolom tombol diubah dari col-md-2 menjadi col-md-3 --}}
                                    <div class="col-md-3 mb-3 d-flex align-items-end">
                                        <input type="hidden" name="kriteria_id" value="{{ $kriteria->id }}">
                                        <button type="submit" class="btn btn-modern btn-gradient w-100">
                                            <i class="fas fa-save me-1"></i>
                                            Simpan
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="card card-modern">
                <div class="card-body text-center py-5">
                    <i class="fas fa-exclamation-triangle text-warning mb-3" style="font-size: 4rem;"></i>
                    <h4 class="fw-bold">Belum Ada Kriteria</h4>
                    <p class="text-muted mb-4">Anda perlu membuat kriteria terlebih dahulu sebelum menambah sub kriteria</p>
                    <a href="{{ route('kriteria.create') }}" class="btn btn-modern btn-gradient">
                        <i class="fas fa-plus-circle me-2"></i>
                        Buat Kriteria Baru
                    </a>
                </div>
            </div>
            @endif
        </div>
    </section>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animate cards on page load
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        });

        // Observe all cards
        document.querySelectorAll('.card-modern, .stats-card').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'all 0.6s ease';
            observer.observe(card);
        });

        // Form submission with loading state
        document.querySelectorAll('.quick-add-form').forEach(form => {
            form.addEventListener('submit', function() {
                const submitBtn = this.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;

                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Menyimpan...';
                submitBtn.disabled = true;

                // Reset form after submission (in case of errors)
                setTimeout(() => {
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }, 3000);
            });
        });

        // Delete confirmation with better UX
        document.querySelectorAll('form[method="POST"]').forEach(form => {
            form.addEventListener('submit', function(e) {
                if (this.querySelector('button[type="submit"]').getAttribute('title')?.includes('Hapus')) {
                    e.preventDefault();

                    const confirmModal = document.createElement('div');
                    confirmModal.innerHTML = `
                        <div class="modal fade" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content" style="border-radius: 20px; border: none;">
                                    <div class="modal-header border-0">
                                        <h5 class="modal-title fw-bold">
                                            <i class="fas fa-exclamation-triangle text-warning me-2"></i>
                                            Konfirmasi Hapus
                                        </h5>
                                    </div>
                                    <div class="modal-body">
                                        <p class="mb-0">Apakah Anda yakin ingin menghapus sub kriteria ini? Tindakan ini tidak dapat dibatalkan.</p>
                                    </div>
                                    <div class="modal-footer border-0">
                                        <button type="button" class="btn btn-secondary btn-modern" data-bs-dismiss="modal">
                                            Batal
                                        </button>
                                        <button type="button" class="btn btn-danger btn-modern" id="confirmDelete">
                                            <i class="fas fa-trash-alt me-1"></i>
                                            Ya, Hapus
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;

                    document.body.appendChild(confirmModal);
                    const modal = new bootstrap.Modal(confirmModal.querySelector('.modal'));
                    modal.show();

                    confirmModal.querySelector('#confirmDelete').addEventListener('click', () => {
                        modal.hide();
                        this.submit();
                    });

                    confirmModal.querySelector('.modal').addEventListener('hidden.bs.modal', () => {
                        document.body.removeChild(confirmModal);
                    });
                }
            });
        });

        // Auto-focus on form fields when card is hovered
        document.querySelectorAll('.form-modern input').forEach(input => {
            input.addEventListener('focus', function() {
                this.closest('.form-modern').style.borderColor = '#667eea';
                this.closest('.form-modern').style.boxShadow = '0 10px 25px rgba(102, 126, 234, 0.15)';
            });

            input.addEventListener('blur', function() {
                this.closest('.form-modern').style.borderColor = '#e9ecef';
                this.closest('.form-modern').style.boxShadow = '0 5px 15px rgba(0, 0, 0, 0.05)';
            });
        });
    });
</script>
@endpush
@endsection
