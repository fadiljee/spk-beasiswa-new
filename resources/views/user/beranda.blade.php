@extends('user.layout')

@section('title', 'INTACT Base Indonesia - Sistem Informasi Beasiswa')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,500;0,9..144,600;0,9..144,700;1,9..144,500&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=IBM+Plex+Mono:wght@400;500&display=swap" rel="stylesheet">
<style>
    /* =========================================================
       TOKEN SYSTEM — "Boarding Pass" concept
       A visa/boarding-pass motif runs through the page: this is
       a program that literally moves a person from Jakarta to
       Taiwan, so the visual language borrows from travel
       documents — stubs, perforations, route codes, stamps.
       ========================================================= */
    :root{
        --sch-navy: #0E1A33;
        --sch-navy-soft: #172548;
        --sch-paper: #F6F5F1;
        --sch-paper-2: #FFFFFF;
        --sch-ink: #1A2133;
        --sch-muted: #5B6472;
        --sch-border: #E3E0D6;
        --sch-gold: #C79A4B;
        --sch-gold-deep: #9C7530;
        --sch-jade: #0E6E63;
        --sch-jade-light: #E4F1EE;
        --font-display: 'Fraunces', serif;
        --font-body: 'Plus Jakarta Sans', sans-serif;
        --font-mono: 'IBM Plex Mono', monospace;
    }

    #hero, #partners, #programs, #benefits, #testimonials, #apply, #contact, #stats {
        font-family: var(--font-body);
        color: var(--sch-ink);
    }
    h1, h2, h3, h4, h5, .display-serif { font-family: var(--font-display); }
    .eyebrow {
        font-family: var(--font-mono);
        font-size: 0.72rem;
        letter-spacing: 0.18em;
        text-transform: uppercase;
        color: var(--sch-gold-deep);
        font-weight: 500;
    }
    .eyebrow.on-dark { color: var(--sch-gold); }

    /* ---------- Section rhythm ---------- */
    #hero { padding-top: 150px; padding-bottom: 90px; background: var(--sch-paper); }
    #partners { background: var(--sch-paper-2); }
    #programs { background: var(--sch-paper); }
    #benefits { background: var(--sch-paper-2); }
    #testimonials { background: var(--sch-paper); }
    #apply { background: var(--sch-paper-2); }

    .section-title.display-serif { font-weight: 600; color: var(--sch-navy); font-size: clamp(1.9rem, 3vw, 2.6rem); }
    .section-subtitle { color: var(--sch-muted); max-width: 620px; margin-left: auto; margin-right: auto; }

    /* =========================================================
       HERO — boarding pass signature card
       ========================================================= */
    #hero .hero-copy .eyebrow { display: inline-flex; align-items: center; gap: 8px; margin-bottom: 18px; }
    #hero .hero-copy .eyebrow::before { content:''; width: 22px; height: 1px; background: var(--sch-gold-deep); display: inline-block; }
    #hero h1 {
        font-weight: 600;
        font-size: clamp(2.3rem, 4vw, 3.4rem);
        line-height: 1.18;
        color: var(--sch-navy);
        letter-spacing: -0.01em;
    }
    #hero h1 em { font-style: italic; color: var(--sch-jade); font-weight: 500; }
    #hero .lead { color: var(--sch-muted); font-family: var(--font-body); font-size: 1.08rem; max-width: 480px; }

    .btn-custom-primary {
        background: var(--sch-navy); border: 1px solid var(--sch-navy); color: #fff;
        font-family: var(--font-body); font-weight: 600; padding: 0.85rem 1.6rem; border-radius: 999px;
        transition: all .25s ease;
    }
    .btn-custom-primary:hover { background: var(--sch-jade); border-color: var(--sch-jade); color: #fff; transform: translateY(-2px); }
    .btn-custom-outline {
        background: transparent; border: 1px solid var(--sch-navy); color: var(--sch-navy);
        font-family: var(--font-body); font-weight: 600; padding: 0.85rem 1.6rem; border-radius: 999px;
        transition: all .25s ease;
    }
    .btn-custom-outline:hover { background: var(--sch-navy); color: #fff; transform: translateY(-2px); }

    /* the boarding pass itself */
    .boarding-pass {
        background: var(--sch-navy);
        border-radius: 20px;
        color: #fff;
        position: relative;
        box-shadow: 0 30px 60px -20px rgba(14,26,51,0.45);
        overflow: hidden;
    }
    .boarding-pass .bp-top {
        padding: 2rem 2rem 1.5rem 2rem;
        background-image:
            radial-gradient(circle at top right, rgba(199,154,75,0.18), transparent 55%);
    }
    .boarding-pass .bp-route {
        display: flex; align-items: center; justify-content: space-between; margin-top: 1.4rem;
    }
    .boarding-pass .bp-city { font-family: var(--font-display); font-size: 1.6rem; font-weight: 600; }
    .boarding-pass .bp-code { font-family: var(--font-mono); font-size: 0.72rem; color: rgba(255,255,255,0.55); letter-spacing: 0.08em; margin-top: 2px; }
    .boarding-pass .bp-plane { color: var(--sch-gold); font-size: 1.3rem; opacity: 0.9; }
    .boarding-pass .bp-plane::after{
        content:''; display:block; height:1px; width: 100%;
        background: repeating-linear-gradient(90deg, rgba(255,255,255,0.35) 0 6px, transparent 6px 12px);
        margin-top: 10px;
    }
    .boarding-pass .bp-perforation {
        position: relative; height: 0; border-top: 2px dashed rgba(255,255,255,0.22); margin: 0 0;
    }
    .boarding-pass .bp-perforation::before, .boarding-pass .bp-perforation::after {
        content:''; position:absolute; top:-14px; width: 28px; height: 28px; background: var(--sch-paper); border-radius: 50%;
    }
    .boarding-pass .bp-perforation::before { left: -14px; }
    .boarding-pass .bp-perforation::after { right: -14px; }
    .boarding-pass .bp-bottom { padding: 1.6rem 2rem 2rem 2rem; display: flex; gap: 2rem; flex-wrap: wrap; }
    .boarding-pass .bp-field .eyebrow.on-dark { font-size: 0.62rem; margin-bottom: 4px; display:block; }
    .boarding-pass .bp-field .val { font-family: var(--font-body); font-weight: 600; font-size: 0.95rem; }
    .boarding-pass .bp-stamp {
        position: absolute; top: 26px; right: 26px;
        width: 62px; height: 62px; border: 2px solid rgba(199,154,75,0.6); border-radius: 50%;
        display: flex; align-items: center; justify-content: center; transform: rotate(-12deg);
        font-family: var(--font-mono); font-size: 0.55rem; letter-spacing: 0.05em; text-align: center;
        color: var(--sch-gold); line-height: 1.2;
    }

    /* =========================================================
       PARTNERS
       ========================================================= */
    .partner-logo { max-height: 46px; filter: grayscale(100%); opacity: 0.55; transition: all 0.3s ease; }
    .partner-logo:hover { filter: grayscale(0%); opacity: 1; transform: scale(1.06); }
    #partners .eyebrow { display:block; text-align:center; margin-bottom: 1.6rem; }

    /* =========================================================
       STATS — styled like a ticket stub row
       ========================================================= */
    #stats { background: var(--sch-navy); padding: 2.6rem 0; }
    #stats .stat-block { text-align: center; border-left: 1px dashed rgba(255,255,255,0.18); }
    #stats .col-6:first-child .stat-block, #stats .col-md-3:first-child .stat-block { border-left: none; }
    #stats .stat-num { font-family: var(--font-display); font-weight: 600; font-size: clamp(1.8rem, 3vw, 2.4rem); color: var(--sch-gold); }
    #stats .stat-label { font-family: var(--font-mono); font-size: 0.72rem; letter-spacing: 0.08em; text-transform: uppercase; color: rgba(255,255,255,0.65); margin-top: 4px; }

    /* =========================================================
       PROGRAMS
       ========================================================= */
    .program-card {
        background: var(--sch-paper-2);
        border: 1px solid var(--sch-border);
        border-radius: 1.1rem;
        transition: all 0.3s ease;
        overflow: hidden;
    }
    .program-card:hover { transform: translateY(-6px); box-shadow: 0 24px 40px -20px rgba(14,26,51,0.25); border-color: var(--sch-gold); }
    .program-image-wrapper {
        height: 170px; background: var(--sch-paper); padding: 1.2rem;
        border-bottom: 1px solid var(--sch-border);
        display: flex; justify-content: center; align-items: center;
    }
    .program-image { max-width: 100%; max-height: 100%; object-fit: contain; }
    .program-card .card-title { font-family: var(--font-display); font-weight: 600; color: var(--sch-navy); }
    .program-card .btn-outline-dark {
        border-color: var(--sch-navy); color: var(--sch-navy); font-weight: 600; border-radius: 999px;
        font-family: var(--font-body); transition: all .25s ease;
    }
    .program-card .btn-outline-dark:hover { background: var(--sch-navy); border-color: var(--sch-navy); }

    /* =========================================================
       BENEFITS — quiet grid, no false sequence numbering
       ========================================================= */
    .benefit-item {
        background: var(--sch-paper-2); border: 1px solid var(--sch-border); border-radius: 1rem;
        height: 100%; transition: border-color .25s ease;
    }
    .benefit-item:hover { border-color: var(--sch-jade); }
    .benefit-item .icon { width: 52px; height: 52px; background: var(--sch-jade-light); color: var(--sch-jade); border-radius: 14px; }
    .benefit-item h5 { font-family: var(--font-display); color: var(--sch-navy); font-weight: 600; }

    /* =========================================================
       TESTIMONIALS
       ========================================================= */
    .testimonial-card { background: var(--sch-paper-2); border-radius: 1.1rem; border: 1px solid var(--sch-border); }
    .testimonial-img { width: 56px; height: 56px; border-radius: 50%; border: 2px solid var(--sch-gold); }
    .testimonial-quote { font-family: var(--font-display); font-style: italic; color: var(--sch-ink); font-size: 1.02rem; line-height: 1.55; }
    .testimonial-rating { color: var(--sch-gold); font-size: 0.85rem; }
    .testimonial-card h6 { font-family: var(--font-body); font-weight: 700; color: var(--sch-navy); }

    /* =========================================================
       TIMELINE — boarding-pass stubs on a flight path
       (this IS a real ordered sequence, so numbering is earned)
       ========================================================= */
    .timeline-container { position: relative; }
    .timeline-container::before {
        content: ''; position: absolute; top: 30px; left: 29px; bottom: 30px; width: 2px;
        background: repeating-linear-gradient(180deg, var(--sch-border) 0 8px, transparent 8px 16px);
    }
    .timeline-item { position: relative; margin-bottom: 36px; padding-left: 78px; }
    .timeline-icon {
        position: absolute; left: 0; top: 0; width: 60px; height: 60px; background: var(--sch-navy); color: var(--sch-gold);
        border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem;
        border: 1px solid var(--sch-navy-soft);
    }
    .timeline-item .step-eyebrow { font-family: var(--font-mono); font-size: 0.68rem; letter-spacing: 0.1em; color: var(--sch-gold-deep); text-transform: uppercase; }
    .timeline-content h5 { font-family: var(--font-display); font-weight: 600; color: var(--sch-navy); }

    /* =========================================================
       CONTACT
       ========================================================= */
    #contact { background: var(--sch-navy) !important; padding: 4.5rem 0; }
    #contact .section-title { font-family: var(--font-display); font-weight: 600; }
    #contact a { color: var(--sch-gold) !important; }
    #contact a:hover { color: #fff !important; }

    @media (max-width: 991px) {
        #stats .stat-block { border-left: none; margin-bottom: 1rem; }
    }
</style>
@endpush

@section('content')

{{-- Hero Section --}}
<section id="hero">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="hero-copy">
                    <span class="eyebrow">Program Beasiswa &middot; Indonesia menuju Taiwan</span>
                    <h1 class="mb-4">Buka Gerbang Pendidikan Kelas Dunia di <em>Taiwan</em></h1>
                    <p class="lead mb-4">INTACT Base Indonesia adalah jembatan Anda menuju beasiswa penuh dan karir global melalui program kolaborasi industri dan akademik.</p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="#apply" class="btn btn-custom-primary">Daftar Sekarang</a>
                        <a href="#programs" class="btn btn-custom-outline">Lihat Program</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <div class="boarding-pass">
                    <div class="bp-stamp">LULUS<br>SELEKSI</div>
                    <div class="bp-top">
                        <span class="eyebrow on-dark">Kartu Keberangkatan Mahasiswa</span>
                        <div class="bp-route">
                            <div>
                                <div class="bp-city">Jakarta</div>
                                <div class="bp-code">CGK &middot; INDONESIA</div>
                            </div>
                            <div class="bp-plane"><i class="bi bi-airplane-fill"></i></div>
                            <div class="text-end">
                                <div class="bp-city">Taipei</div>
                                <div class="bp-code">TPE &middot; TAIWAN</div>
                            </div>
                        </div>
                    </div>
                    <div class="bp-perforation"></div>
                    <div class="bp-bottom">
                        <div class="bp-field">
                            <span class="eyebrow on-dark">Beasiswa</span>
                            <div class="val">Penuh, hingga 2 Tahun</div>
                        </div>
                        <div class="bp-field">
                            <span class="eyebrow on-dark">Tunjangan</span>
                            <div class="val">Min. NTD 10.000/bln</div>
                        </div>
                        <div class="bp-field">
                            <span class="eyebrow on-dark">Status</span>
                            <div class="val">Jaminan Magang &amp; Karir</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Statistics Section --}}
<section id="stats">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-3 col-6"><div class="stat-block"><div class="stat-num">50+</div><div class="stat-label">Universitas Mitra</div></div></div>
            <div class="col-md-3 col-6"><div class="stat-block"><div class="stat-num">95%</div><div class="stat-label">Tingkat Keberhasilan</div></div></div>
            <div class="col-md-3 col-6"><div class="stat-block"><div class="stat-num">1000+</div><div class="stat-label">Mahasiswa Ditempatkan</div></div></div>
            <div class="col-md-3 col-6"><div class="stat-block"><div class="stat-num">15+</div><div class="stat-label">Negara Asal</div></div></div>
        </div>
    </div>
</section>

{{-- Programs Section --}}
<section id="programs" class="section-padding">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="eyebrow">Destinasi</span>
            <h2 class="section-title display-serif mt-2">Kampus Tujuan Tersedia</h2>
            <p class="section-subtitle mt-2">Temukan berbagai kesempatan studi di universitas-universitas terbaik Taiwan.</p>
        </div>
        <div class="row g-4">
            @foreach ($beasiswa as $b)
            <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 100 }}">
                <div class="card program-card w-100">
                    <div class="program-image-wrapper"><img src="{{ $b->logo_url }}" alt="Logo {{ $b->nama_universitas }}" class="program-image"></div>
                    <div class="card-body p-4 d-flex flex-column">
                        <h5 class="card-title fw-bold">{{ $b->nama_universitas }}</h5>
                        <p class="card-text text-muted mb-4 flex-grow-1">{{ Str::limit($b->deskripsi, 100) }}</p>
                        <div class="mt-auto"><a href="{{ route('beasiswa.show', $b->id) }}" class="btn btn-outline-dark w-100">Pelajari Lebih Lanjut</a></div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center mt-5">{{ $beasiswa->links() }}</div>
    </div>
</section>

{{-- Benefits Section --}}
<section id="benefits" class="section-padding">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="eyebrow">Yang Anda Dapatkan</span>
            <h2 class="section-title display-serif mt-2">Benefit Eksklusif Program</h2>
            <p class="section-subtitle mt-2">Dukungan komprehensif untuk menjamin kesuksesan akademik dan karir Anda.</p>
        </div>
        <div class="row g-4 justify-content-center">
            <div class="col-md-6 col-lg-5" data-aos="fade-right">
                <div class="benefit-item p-4">
                    <div class="d-flex align-items-center mb-3"><div class="icon d-flex align-items-center justify-content-center me-3"><i class="bi bi-cash-coin fs-4"></i></div><h5 class="mb-0">Beasiswa &amp; Tunjangan</h5></div>
                    <p class="text-muted mb-0">Biaya kuliah ditanggung penuh hingga 2 tahun ditambah tunjangan hidup bulanan minimal NTD 10.000 selama masa studi.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-5" data-aos="fade-left">
                <div class="benefit-item p-4">
                    <div class="d-flex align-items-center mb-3"><div class="icon d-flex align-items-center justify-content-center me-3"><i class="bi bi-briefcase-fill fs-4"></i></div><h5 class="mb-0">Jaminan Magang &amp; Karir</h5></div>
                    <p class="text-muted mb-0">Kesempatan magang di perusahaan dengan gaji sesuai UMR Taiwan, serta komitmen kerja setelah lulus.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-5" data-aos="fade-right">
                <div class="benefit-item p-4">
                    <div class="d-flex align-items-center mb-3"><div class="icon d-flex align-items-center justify-content-center me-3"><i class="bi bi-airplane-fill fs-4"></i></div><h5 class="mb-0">Dukungan Keberangkatan</h5></div>
                    <p class="text-muted mb-0">Bantuan biaya tiket pesawat sekali jalan ke Taiwan dan biaya administrasi pada saat kedatangan pertama kali.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-5" data-aos="fade-left">
                <div class="benefit-item p-4">
                    <div class="d-flex align-items-center mb-3"><div class="icon d-flex align-items-center justify-content-center me-3"><i class="bi bi-translate fs-4"></i></div><h5 class="mb-0">Persyaratan Bahasa Fleksibel</h5></div>
                    <p class="text-muted mb-0">Dukungan untuk program berbahasa Mandarin (TOCFL) dan Inggris (TOEFL/IELTS/TOEIC) sesuai standar.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Testimonials Section --}}
<section id="testimonials" class="section-padding">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="eyebrow">Dipercaya Kampus Ternama</span>
            <h2 class="section-title display-serif mt-2">Apa Kata Kampus?</h2>
            <p class="section-subtitle mt-2">Dengarkan pandangan dari mitra universitas kami tentang kolaborasi dengan INTACT.</p>
        </div>
        <div class="row g-4">
            @php
            $testimonials = [
                [
                    'name' => 'Prof. Dr. Anugerah Pekerti',
                    'position' => 'Kepala Kantor Urusan Internasional, Universitas Indonesia',
                    'quote' => 'Kolaborasi dengan INTACT telah secara signifikan meningkatkan kualitas dan jumlah mahasiswa internasional kami dari Indonesia. Profesionalisme dan dukungan yang mereka berikan patut diacungi jempol.',
                    'rating' => 5
                ],
                [
                    'name' => 'Direktorat Kemitraan Global',
                    'position' => 'Institut Teknologi Bandung (ITB)',
                    'quote' => 'INTACT berhasil membekali calon mahasiswa dengan fundamental yang kuat. Lulusan program mereka tidak hanya unggul secara akademis, tetapi juga memiliki soft skill yang kami cari pada pemimpin masa depan.',
                    'rating' => 5
                ],
                [
                    'name' => 'Office of International Affairs',
                    'position' => 'National Taiwan University (NTU)',
                    'quote' => 'Kami memandang INTACT sebagai mitra strategis dalam menjaring talenta digital dari Indonesia. Program persiapan mereka terbukti sangat efektif dalam memastikan kesuksesan mahasiswa di lingkungan akademik global.',
                    'rating' => 5
                ]
            ];
            @endphp

            @foreach($testimonials as $testimonial)
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="card testimonial-card h-100 p-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($testimonial['name']) }}&background=0E1A33&color=C79A4B&font-size=0.4" class="testimonial-img me-3" alt="Logo {{ $testimonial['position'] }}">
                            <div>
                                <h6 class="mb-0">{{ $testimonial['name'] }}</h6>
                                <small class="text-muted">{{ $testimonial['position'] }}</small>
                            </div>
                        </div>
                        <p class="testimonial-quote">&ldquo;{{ $testimonial['quote'] }}&rdquo;</p>
                        <div class="testimonial-rating">
                            @for ($i = 0; $i < $testimonial['rating']; $i++) <i class="bi bi-star-fill"></i> @endfor
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Application Process Section --}}
<section id="apply" class="section-padding">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="eyebrow">Rute Keberangkatan</span>
            <h2 class="section-title display-serif mt-2">Proses Pendaftaran Mudah</h2>
            <p class="section-subtitle mt-2">Ikuti 5 langkah berikut untuk memulai perjalanan Anda.</p>
        </div>
        <div class="row justify-content-center">
        <div class="col-lg-8">
        <div class="timeline-container">
            @php $steps = [['icon' => 'bi-search', 'title' => 'Pilih Program', 'desc' => 'Eksplorasi universitas dan program yang tersedia, pastikan Anda memenuhi semua kriteria.'],['icon' => 'bi-folder-check', 'title' => 'Siapkan Dokumen', 'desc' => 'Kumpulkan dokumen yang diperlukan seperti ijazah, transkrip, dan sertifikat bahasa.'],['icon' => 'bi-send', 'title' => 'Kirim Aplikasi', 'desc' => 'Daftarkan diri dan unggah semua dokumen melalui portal pendaftaran online kami.'],['icon' => 'bi-hourglass-top', 'title' => 'Proses Seleksi', 'desc' => 'Aplikasi Anda akan ditinjau oleh tim kami dan pihak universitas. Tunggu hasilnya.'],['icon' => 'bi-airplane', 'title' => 'Persiapan Keberangkatan', 'desc' => 'Setelah diterima, proses visa pelajar Anda dan bersiaplah untuk terbang!']]; @endphp
            @foreach($steps as $step)
            <div class="timeline-item" data-aos="fade-up">
                <div class="timeline-icon"><i class="bi {{ $step['icon'] }}"></i></div>
                <div class="timeline-content">
                    <span class="step-eyebrow">Langkah {{ $loop->iteration }} / {{ $loop->count }}</span>
                    <h5 class="fw-bold mb-1">{{ $step['title'] }}</h5>
                    <p class="text-muted mb-0">{{ $step['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
        </div>
        </div>
        <div class="text-center mt-5" data-aos="fade-up"><a href="{{ route('loginuser') }}" class="btn btn-custom-primary">Mulai Pendaftaran Sekarang!</a></div>
    </div>
</section>

{{-- Contact Section --}}
<section id="contact">
    <div class="container" data-aos="fade-up">
        <div class="text-center text-white">
            <span class="eyebrow on-dark">Layanan Bantuan</span>
            <h2 class="section-title text-white mt-2">Butuh Bantuan?</h2>
            <p class="section-subtitle text-white-50 mt-2">Jangan ragu untuk menghubungi tim kami jika Anda memiliki pertanyaan.</p>
            <p class="fs-4 mb-0 mt-3"><a href="mailto:idintactbase@gcloud.csu.edu.tw" class="text-decoration-none fw-semibold">idintactbase@gcloud.csu.edu.tw</a></p>
        </div>
    </div>
</section>

@endsection