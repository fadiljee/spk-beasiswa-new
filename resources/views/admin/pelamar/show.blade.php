@extends('admin.layout')
@section('title', 'Detail Pelamar')


<style>
    .profile-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 20px;
        color: white;
        margin-bottom: 30px;
        overflow: hidden;
        position: relative;
    }

    .profile-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 200"><path d="M0,100 C150,200 350,0 500,100 C650,200 850,0 1000,100 L1000,00 L0,0 Z" fill="rgba(255,255,255,0.1)"/></svg>');
        background-size: cover;
    }

    .profile-content {
        position: relative;
        z-index: 2;
        padding: 40px;
    }

    .profile-avatar {
        width: 100px;
        height: 100px;
        background: rgba(255,255,255,0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 48px;
        font-weight: bold;
        margin-bottom: 20px;
        border: 4px solid rgba(255,255,255,0.3);
        backdrop-filter: blur(10px);
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 25px;
        margin-bottom: 30px;
    }

    .info-card {
        background: #fff;
        border-radius: 16px;
        padding: 25px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.08);
        border: 1px solid rgba(0,0,0,0.05);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .info-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: linear-gradient(135deg, #667eea, #764ba2);
    }

    .info-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.12);
    }

    .info-item {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
        padding: 12px 0;
        border-bottom: 1px solid #f8f9fa;
    }

    .info-item:last-child {
        border-bottom: none;
        margin-bottom: 0;
    }

    .info-icon {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        color: white;
        font-size: 16px;
    }

    .info-content {
        flex: 1;
    }

    .info-label {
        font-size: 12px;
        color: #6c757d;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 2px;
    }

    .info-value {
        font-size: 16px;
        color: #2d3748;
        font-weight: 600;
        line-height: 1.4;
    }

    .uni-section {
        background: #fff;
        border-radius: 16px;
        padding: 25px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.08);
        border: 1px solid rgba(0,0,0,0.05);
        margin-bottom: 25px;
    }

    .section-title {
        font-size: 20px;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
    }

    .section-title::before {
        content: '';
        width: 4px;
        height: 24px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        border-radius: 2px;
        margin-right: 12px;
    }

    .uni-badge {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 500;
        margin: 5px 8px 5px 0;
        display: inline-block;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
    }

    .uni-badge:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
    }

    .documents-section {
        background: #fff;
        border-radius: 16px;
        padding: 25px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.08);
        border: 1px solid rgba(0,0,0,0.05);
        margin-bottom: 25px;
    }

    .document-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 15px 20px;
        background: #f8f9fa;
        border-radius: 12px;
        margin-bottom: 15px;
        transition: all 0.3s ease;
    }

    .document-item:hover {
        background: #e9ecef;
        transform: translateX(5px);
    }

    .document-info {
        display: flex;
        align-items: center;
    }

    .document-icon {
        width: 45px;
        height: 45px;
        background: linear-gradient(135deg, #667eea, #764ba2);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 18px;
        margin-right: 15px;
    }

    .document-details h6 {
        margin: 0;
        font-weight: 600;
        color: #2d3748;
        font-size: 16px;
    }

    .document-status {
        font-size: 12px;
        color: #6c757d;
        margin-top: 2px;
    }

    .btn-view {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        border: none;
        padding: 8px 20px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-view:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        color: white;
        text-decoration: none;
    }

    .btn-back {
        background: #6c757d;
        color: white;
        border: none;
        padding: 12px 30px;
        border-radius: 25px;
        font-size: 16px;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }

    .btn-back:hover {
        background: #5a6268;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(108, 117, 125, 0.3);
        color: white;
        text-decoration: none;
    }

    .status-unavailable {
        color: #dc3545;
        font-style: italic;
        font-size: 14px;
    }

    @media (max-width: 768px) {
        .info-grid {
            grid-template-columns: 1fr;
        }

        .profile-content {
            padding: 25px;
        }

        .profile-avatar {
            width: 80px;
            height: 80px;
            font-size: 36px;
        }

        .info-card {
            padding: 20px;
        }

        .document-item {
            flex-direction: column;
            text-align: center;
            gap: 15px;
        }
    }
</style>


@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid py-4">
            <!-- Profile Header -->
            <div class="profile-header">
                <div class="profile-content">
                    <div class="row align-items-center">
                        <div class="col-md-auto">
                            <div class="profile-avatar">
                                {{ strtoupper(substr($pelamar->nama_lengkap, 0, 1)) }}
                            </div>
                        </div>
                        <div class="col-md">
                            <h2 class="mb-2" style="font-weight: 700;">{{ $pelamar->nama_lengkap }}</h2>
                            <p class="mb-0" style="font-size: 18px; opacity: 0.9;">
                                <i class="fas fa-envelope me-2"></i>{{ $pelamar->email }}
                            </p>
                            <p class="mb-0" style="font-size: 16px; opacity: 0.8;">
                                <i class="fas fa-graduation-cap me-2"></i>{{ $pelamar->jurusan }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Information Grid -->
            <div class="info-grid">
                <!-- Personal Information -->
                <div class="info-card">
                    <h5 class="section-title">Informasi Personal</h5>

                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fas fa-venus-mars"></i>
                        </div>
                        <div class="info-content">
                            <div class="info-label">Jenis Kelamin</div>
                            <div class="info-value">{{ $pelamar->jenis_kelamin }}</div>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="info-content">
                            <div class="info-label">Tempat Lahir</div>
                            <div class="info-value">{{ $pelamar->tempat_lahir }}</div>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div class="info-content">
                            <div class="info-label">Tanggal Lahir</div>
                            <div class="info-value">{{ $pelamar->tanggal_lahir->format('d F Y') }}</div>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fab fa-whatsapp"></i>
                        </div>
                        <div class="info-content">
                            <div class="info-label">WhatsApp</div>
                            <div class="info-value">{{ $pelamar->nomor_whatsapp }}</div>
                        </div>
                    </div>
                </div>

                <!-- Academic Information -->
                <div class="info-card">
                    <h5 class="section-title">Informasi Akademik</h5>

                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fas fa-university"></i>
                        </div>
                        <div class="info-content">
                            <div class="info-label">Asal Universitas</div>
                            <div class="info-value">{{ $pelamar->asal_universitas ?? 'Tidak tersedia' }}</div>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fas fa-book"></i>
                        </div>
                        <div class="info-content">
                            <div class="info-label">Jurusan</div>
                            <div class="info-value">{{ $pelamar->jurusan }}</div>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <div class="info-content">
                            <div class="info-label">IPK</div>
                            <div class="info-value">{{ $pelamar->ipk ?? 'Tidak tersedia' }}</div>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fas fa-home"></i>
                        </div>
                        <div class="info-content">
                            <div class="info-label">Alamat</div>
                            <div class="info-value">{{ $pelamar->alamat }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- University Preferences -->
<div class="uni-section">
    <h5 class="section-title">Universitas Pilihan</h5>
    <div class="d-flex flex-wrap">
        @foreach($pelamar->beasiswas as $uni)
            <span class="uni-badge" title="{{ $uni->nama_universitas }}">
                <i class="fas fa-graduation-cap me-2"></i>
                {{ Str::limit($uni->nama_universitas, 30) }}
            </span>
        @endforeach
    </div>
</div>



            <!-- Documents Section -->
            <div class="documents-section">
                <h5 class="section-title">Dokumen Pendukung</h5>

                <div class="document-item">
                    <div class="document-info">
                        <div class="document-icon">
                            <i class="fas fa-file-pdf"></i>
                        </div>
                        <div class="document-details">
                            <h6>Curriculum Vitae (CV)</h6>
                            <div class="document-status">
                                @if($pelamar->cv_path)
                                    <span class="text-success">✓ Tersedia</span>
                                @else
                                    <span class="status-unavailable">✗ Tidak tersedia</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    @if($pelamar->cv_path)
                        <a href="{{ asset('storage/' . $pelamar->cv_path) }}" target="_blank" class="btn-view">
                            <i class="fas fa-eye"></i>
                            Lihat CV
                        </a>
                    @endif
                </div>

                <div class="document-item">
                    <div class="document-info">
                        <div class="document-icon">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <div class="document-details">
                            <h6>Transkrip Nilai</h6>
                            <div class="document-status">
                                @if($pelamar->transkrip_nilai_path)
                                    <span class="text-success">✓ Tersedia</span>
                                @else
                                    <span class="status-unavailable">✗ Tidak tersedia</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    @if($pelamar->transkrip_nilai_path)
                        <a href="{{ asset('storage/' . $pelamar->transkrip_nilai_path) }}" target="_blank" class="btn-view">
                            <i class="fas fa-eye"></i>
                            Lihat Transkrip
                        </a>
                    @endif
                </div>

                <div class="document-item">
                    <div class="document-info">
                        <div class="document-icon">
                            <i class="fas fa-certificate"></i>
                        </div>
                        <div class="document-details">
                            <h6>Ijazah</h6>
                            <div class="document-status">
                                @if($pelamar->ijazah_path)
                                    <span class="text-success">✓ Tersedia</span>
                                @else
                                    <span class="status-unavailable">✗ Tidak tersedia</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    @if($pelamar->ijazah_path)
                        <a href="{{ asset('storage/' . $pelamar->ijazah_path) }}" target="_blank" class="btn-view">
                            <i class="fas fa-eye"></i>
                            Lihat Ijazah
                        </a>
                    @endif
                </div>
            </div>

            <!-- Back Button -->
            <div class="text-center">
                <a href="{{ route('pelamar.index') }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i>
                    Kembali ke Daftar Pelamar
                </a>
            </div>
        </div>
    </section>
</div>
@endsection
