@extends('admin.layout')
@section('title', 'Data Kriteria')

@push('styles')
<style>
    .gradient-bg {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .card-modern {
        border: none;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .card-modern:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .btn-modern {
        border-radius: 50px;
        padding: 8px 20px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        border: none;
    }

    .btn-modern:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
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
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }

    .table-modern thead th {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border: none;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-size: 0.85rem;
        color: #495057;
        padding: 20px 15px;
    }

    .table-modern tbody tr {
        transition: all 0.3s ease;
        border: none;
    }

    .table-modern tbody tr:hover {
        background-color: #f8f9fa;
        transform: scale(1.02);
    }

    .table-modern tbody td {
        border: none;
        padding: 20px 15px;
        vertical-align: middle;
        border-bottom: 1px solid #f1f3f4;
    }

    .badge-modern {
        padding: 8px 16px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.8em;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .badge-benefit {
        background: linear-gradient(45deg, #28a745, #20c997);
        color: white;
    }

    .badge-cost {
        background: linear-gradient(45deg, #dc3545, #fd7e14);
        color: white;
    }

    .alert-modern {
        border: none;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        border-left: 4px solid #28a745;
    }

    .page-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 30px 0;
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
    }

    .stats-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
    }

    .action-buttons .btn {
        margin: 0 2px;
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

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #6c757d;
    }

    .empty-state i {
        font-size: 4rem;
        margin-bottom: 20px;
        opacity: 0.5;
    }
</style>
@endpush

@section('content')
<div class="content-wrapper">
    <!-- Page Header -->
    <div class="page-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h2 class="mb-0 fw-bold">
                        <i class="fas fa-list-alt me-3"></i>
                        Manajemen Kriteria
                    </h2>
                    <p class="mb-0 mt-2 opacity-75">Kelola kriteria penilaian sistem Anda</p>
                </div>
                <div class="col-md-6 text-end">
                    <a href="{{ route('kriteria.create') }}" class="btn btn-modern btn-gradient">
                        <i class="fas fa-plus-circle me-2"></i>
                        Tambah Kriteria
                    </a>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            {{-- Flash Message --}}
            @if (session('success'))
            <div class="alert alert-success alert-modern alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            {{-- Stats Cards --}}
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="stats-card">
                        <i class="fas fa-clipboard-list text-primary mb-3" style="font-size: 2rem;"></i>
                        <h4 class="fw-bold text-primary">{{ $kriteria->count() }}</h4>
                        <p class="text-muted mb-0">Total Kriteria</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card">
                        <i class="fas fa-arrow-up text-success mb-3" style="font-size: 2rem;"></i>
                        <h4 class="fw-bold text-success">{{ $kriteria->where('jenis', 'Benefit')->count() }}</h4>
                        <p class="text-muted mb-0">Benefit</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card">
                        <i class="fas fa-arrow-down text-danger mb-3" style="font-size: 2rem;"></i>
                        <h4 class="fw-bold text-danger">{{ $kriteria->where('jenis', 'Cost')->count() }}</h4>
                        <p class="text-muted mb-0">Cost</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card">
                        <i class="fas fa-percentage text-info mb-3" style="font-size: 2rem;"></i>
                        <h4 class="fw-bold text-info">{{ number_format($kriteria->sum('bobot'), 1) }}%</h4>
                        <p class="text-muted mb-0">Total Bobot</p>
                    </div>
                </div>
            </div>

            {{-- Main Card --}}
            <div class="card card-modern">
                <div class="card-body p-0">
                    @if($kriteria->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-modern mb-0">
                            <thead>
                                <tr>
                                    <th><i class="fas fa-code me-2"></i>Kode Kriteria</th>
                                    <th><i class="fas fa-tag me-2"></i>Nama Kriteria</th>
                                    <th><i class="fas fa-weight me-2"></i>Bobot</th>
                                    <th><i class="fas fa-exchange-alt me-2"></i>Jenis</th>
                                    <th class="text-center"><i class="fas fa-cogs me-2"></i>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kriteria as $item)
                                <tr>
                                    <td>
                                        <span class="badge bg-secondary fs-6">{{ $item->kode_kriteria }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-light rounded-circle p-2 me-3">
                                                <i class="fas fa-clipboard-list text-primary"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0 fw-bold">{{ $item->nama_kriteria }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="progress me-3" style="width: 80px; height: 8px;">
                                                <div class="progress-bar bg-info" style="width: {{ $item->bobot }}%"></div>
                                            </div>
                                            <span class="fw-bold">{{ $item->bobot }}%</span>
                                        </div>
                                    </td>
                                    <td>
                                        @if($item->jenis == 'Benefit')
                                            <span class="badge badge-modern badge-benefit text-black">
                                                <i class="fas fa-arrow-up me-1"></i>Benefit
                                            </span>
                                        @elseif($item->jenis == 'Cost')
                                            <span class="badge badge-modern badge-cost text-black">
                                                <i class="fas fa-arrow-down me-1"></i>Cost
                                            </span>
                                        @else
                                            <span class="badge badge-modern badge-unknown text-black">
                                                <i class="fas fa-question me-1"></i>Unknown
                                            </span>
                                        @endif
                                    </td>


                                    <td class="text-center">
                                        <div class="action-buttons">
                                            <a href="{{ route('kriteria.edit', $item->id) }}"
                                               class="btn btn-warning btn-sm"
                                               title="Edit Kriteria">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('kriteria.destroy', $item->id) }}"
                                                  method="POST"
                                                  class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="btn btn-danger btn-sm"
                                                        title="Hapus Kriteria"
                                                        onclick="return confirm('Yakin ingin menghapus kriteria ini?')">
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
                        <h4 class="fw-bold">Belum Ada Data Kriteria</h4>
                        <p class="mb-4">Mulai dengan menambahkan kriteria pertama Anda</p>
                        <a href="{{ route('kriteria.create') }}" class="btn btn-modern btn-gradient">
                            <i class="fas fa-plus-circle me-2"></i>
                            Tambah Kriteria Pertama
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>

@push('scripts')
<script>
    // Smooth animations on page load
    document.addEventListener('DOMContentLoaded', function() {
        // Animate cards on scroll
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        });

        // Observe all cards
        document.querySelectorAll('.stats-card, .card-modern').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'all 0.6s ease';
            observer.observe(card);
        });

        // Add loading animation to action buttons
        document.querySelectorAll('.action-buttons .btn').forEach(btn => {
            btn.addEventListener('click', function() {
                if (this.type === 'submit') {
                    const icon = this.querySelector('i');
                    icon.className = 'fas fa-spinner fa-spin';
                }
            });
        });
    });
</script>
@endpush
@endsection
