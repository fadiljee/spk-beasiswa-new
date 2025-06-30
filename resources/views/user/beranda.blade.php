@extends('user.layout')

@section('title', 'INTACT Base Indonesia - Sistem Informasi Beasiswa')

@push('styles')
<style>
    /* Hero Section */
    #hero {
        padding-top: 150px; padding-bottom: 80px; background: var(--light-bg);
    }
    .hero-image { position: relative; }
    .hero-image img { border-radius: 1.5rem; }
    .hero-image .card { position: absolute; backdrop-filter: blur(10px); background: rgba(255,255,255,0.8); border: 1px solid rgba(255,255,255,0.2); animation: float 6s ease-in-out infinite; }
    @keyframes float { 0%, 100% { transform: translateY(0px); } 50% { transform: translateY(-20px); } }

    /* Partners Section */
    #partners { background: #fff; }
    .partner-logo { max-height: 60px; filter: grayscale(100%); transition: all 0.3s ease; }
    .partner-logo:hover { filter: grayscale(0%); transform: scale(1.1); }

    /* Programs Section */
    #programs { background: var(--light-bg); }
    .program-card { border: 1px solid var(--border-color); border-radius: 1rem; transition: all 0.3s ease; }
    .program-card:hover { transform: translateY(-8px); box-shadow: var(--shadow-lg); }
    .program-image-wrapper {
        height: 180px;
        background-color: #fff;
        padding: 1rem;
        border-bottom: 1px solid var(--border-color);
        /* --- PERBAIKAN UNTUK LOGO DI TENGAH --- */
        display: flex;
        justify-content: center;
        align-items: center;
        /* --- AKHIR PERBAIKAN --- */
    }
    .program-image {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }

    /* Benefits Section */
    .benefit-item .icon { width: 50px; height: 50px; background: var(--primary-light); color: var(--primary-color); }

    /* Testimonials Section */
    #testimonials { background: var(--light-bg); }
    .testimonial-card { background: #fff; border-radius: 1rem; border: 1px solid var(--border-color); }
    .testimonial-img { width: 70px; height: 70px; border-radius: 50%; border: 3px solid var(--primary-color); }
    .testimonial-quote { font-style: italic; color: var(--muted-text); }
    .testimonial-rating { color: var(--secondary-color); }

    /* FAQ Section */
    #faq .accordion-item { border: 1px solid var(--border-color); border-radius: 0.5rem !important; margin-bottom: 1rem; }
    #faq .accordion-button { font-weight: 600; color: var(--dark-text); }
    #faq .accordion-button:not(.collapsed) { background-color: var(--primary-light); color: var(--primary-color); box-shadow: none; }
    #faq .accordion-button:focus { box-shadow: none; }

    /* Timeline Section */
    .timeline-container { position: relative; }
    .timeline-container::before { content: ''; position: absolute; top: 25px; left: 24px; bottom: 25px; width: 4px; background: var(--border-color); border-radius: 2px; }
    .timeline-item { position: relative; margin-bottom: 40px; padding-left: 70px; }
    .timeline-icon { position: absolute; left: 0; top: 0; width: 50px; height: 50px; background: var(--primary-color); color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; }

</style>
@endpush

@section('content')

{{-- Hero Section (Isi tetap sama, style dari layout) --}}
<section id="hero">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <h1 class="display-4 fw-bolder mb-4" style="line-height: 1.3;">Buka Gerbang Pendidikan Kelas Dunia di <span style="color: var(--primary-color);">Taiwan</span></h1>
                <p class="lead text-muted mb-4">INTACT Base Indonesia adalah jembatan Anda menuju beasiswa penuh dan karir global melalui program kolaborasi industri dan akademik.</p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="#apply" class="btn btn-custom-primary">Daftar Sekarang</a>
                    <a href="#programs" class="btn btn-custom-outline">Lihat Program</a>
                </div>
            </div>
            <div class="col-lg-6 d-none d-lg-block" data-aos="fade-left">
                <div class="hero-image">
                    <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?q=80&w=2070&auto=format&fit=crop" alt="Students in Taiwan" class="img-fluid shadow-lg">
                    <div class="card p-3 shadow-lg" style="bottom: 10%; left: -10%;"><div class="d-flex align-items-center"><div class="icon bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 40px; height: 40px;"><i class="bi bi-check-lg"></i></div><span class="fw-semibold">Beasiswa Penuh</span></div></div>
                    <div class="card p-3 shadow-lg" style="top: 10%; right: -10%; animation-delay: 1s;"><div class="d-flex align-items-center"><div class="icon bg-warning text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 40px; height: 40px;"><i class="bi bi-briefcase-fill"></i></div><span class="fw-semibold">Jaminan Karir</span></div></div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Statistics Section (Isi tetap sama, style dari layout) --}}
<section id="stats" class="section-padding">
    <div class="container">
        <div class="row g-4 text-center">
            <div class="col-md-3 col-6" data-aos="fade-up"><h2 class="display-4 fw-bold" style="color: var(--primary-color);">50+</h2><p class="text-muted fs-5 mb-0">Universitas Mitra</p></div>
            <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="100"><h2 class="display-4 fw-bold" style="color: #16a34a;">95%</h2><p class="text-muted fs-5 mb-0">Tingkat Keberhasilan</p></div>
            <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="200"><h2 class="display-4 fw-bold" style="color: var(--secondary-color);">1000+</h2><p class="text-muted fs-5 mb-0">Mahasiswa Ditempatkan</p></div>
            <div class="col-md-3 col-6" data-aos="fade-up" data-aos-delay="300"><h2 class="display-4 fw-bold" style="color: #0ea5e9;">15+</h2><p class="text-muted fs-5 mb-0">Negara Asal</p></div>
        </div>
    </div>
</section>

{{-- Programs Section (Isi tetap sama, style dari layout) --}}
<section id="programs" class="section-padding">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title">Kampus Tujuan Tersedia</h2>
            <p class="section-subtitle">Temukan berbagai kesempatan studi di universitas-universitas terbaik Taiwan.</p>
        </div>
        <div class="row g-4">
            @foreach ($beasiswa as $b)
            <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 100 }}">
                <div class="card program-card w-100">
                    <div class="program-image-wrapper"><img src="{{ url('storage/logo/' . $b->logo) }}" alt="Logo {{ $b->nama_universitas }}" class="program-image"></div>
                    <div class="card-body p-4 d-flex flex-column">
                        <h5 class="card-title fw-bold text-dark">{{ $b->nama_universitas }}</h5>
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
<section id="benefits" class="section-padding" style="background: var(--light-bg);">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title">Benefit Eksklusif Program</h2>
            <p class="section-subtitle">Dukungan komprehensif untuk menjamin kesuksesan akademik dan karir Anda.</p>
        </div>
        <div class="row g-4 justify-content-center">
            <div class="col-md-6 col-lg-5" data-aos="fade-right">
                <div class="benefit-item p-4">
                    <div class="d-flex align-items-center mb-3"><div class="icon rounded-circle d-flex align-items-center justify-content-center me-3"><i class="bi bi-cash-coin fs-2"></i></div><h5 class="fw-bold mb-0">Beasiswa & Tunjangan</h5></div>
                    <p class="text-muted">Biaya kuliah ditanggung penuh hingga 2 tahun ditambah tunjangan hidup bulanan minimal NTD 10.000 selama masa studi.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-5" data-aos="fade-left">
                <div class="benefit-item p-4">
                    <div class="d-flex align-items-center mb-3"><div class="icon rounded-circle d-flex align-items-center justify-content-center me-3"><i class="bi bi-briefcase-fill fs-2"></i></div><h5 class="fw-bold mb-0">Jaminan Magang & Karir</h5></div>
                    <p class="text-muted">Kesempatan magang di perusahaan dengan gaji sesuai UMR Taiwan, serta komitmen kerja setelah lulus.</p>
                </div>
            </div>
             <div class="col-md-6 col-lg-5" data-aos="fade-right">
                <div class="benefit-item p-4">
                    <div class="d-flex align-items-center mb-3"><div class="icon rounded-circle d-flex align-items-center justify-content-center me-3"><i class="bi bi-airplane-fill fs-2"></i></div><h5 class="fw-bold mb-0">Dukungan Keberangkatan</h5></div>
                    <p class="text-muted">Bantuan biaya tiket pesawat sekali jalan ke Taiwan dan biaya administrasi pada saat kedatangan pertama kali.</p>
                </div>
            </div>
             <div class="col-md-6 col-lg-5" data-aos="fade-left">
                <div class="benefit-item p-4">
                    <div class="d-flex align-items-center mb-3"><div class="icon rounded-circle d-flex align-items-center justify-content-center me-3"><i class="bi bi-translate fs-2"></i></div><h5 class="fw-bold mb-0">Persyaratan Bahasa Fleksibel</h5></div>
                    <p class="text-muted">Dukungan untuk program berbahasa Mandarin (TOCFL) dan Inggris (TOEFL/IELTS/TOEIC) sesuai standar.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Testimonials Section --}}
<section id="testimonials" class="section-padding">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title">Apa Kata Kampus?</h2>
            <p class="section-subtitle">Dengarkan pandangan dari mitra universitas kami tentang kolaborasi dengan INTACT.</p>
        </div>
        <div class="row g-4">
            @php
            // Konten diubah menjadi testimoni dari perwakilan kampus
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
                            {{-- Avatar akan menggunakan inisial dari nama kampus/departemen --}}
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($testimonial['name']) }}&background=1e40af&color=fff&font-size=0.4" class="testimonial-img me-3" alt="Logo {{ $testimonial['position'] }}">
                            <div>
                                <h6 class="fw-bold mb-0">{{ $testimonial['name'] }}</h6>
                                {{-- Mengganti 'major' dengan 'position' --}}
                                <small class="text-muted">{{ $testimonial['position'] }}</small>
                            </div>
                        </div>
                        <p class="testimonial-quote">"{{ $testimonial['quote'] }}"</p>
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

{{-- FAQ Section --}}
{{-- <section id="faq" class="section-padding" style="background: var(--light-bg);">
    <div class="container">
         <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title">Pertanyaan Umum (FAQ)</h2>
            <p class="section-subtitle">Temukan jawaban cepat untuk pertanyaan yang paling sering diajukan.</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8" data-aos="fade-up">
                <div class="accordion" id="faqAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header"><button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#q1">Apa saja syarat utama untuk mendaftar?</button></h2>
                        <div id="q1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion"><div class="accordion-body">Syarat utama umumnya adalah ijazah pendidikan terakhir, transkrip nilai dengan IPK yang memenuhi, sertifikat kemampuan bahasa (Inggris atau Mandarin), dan dokumen identitas seperti paspor. Setiap universitas mungkin memiliki syarat tambahan.</div></div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#q2">Apakah ada batasan usia untuk mendaftar?</button></h2>
                        <div id="q2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion"><div class="accordion-body">Umumnya tidak ada batasan usia yang ketat, namun beberapa program atau universitas mungkin memiliki preferensi untuk pendaftar di usia produktif. Selalu periksa detail persyaratan pada program yang Anda minati.</div></div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#q3">Bagaimana proses seleksinya?</button></h2>
                        <div id="q3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion"><div class="accordion-body">Proses seleksi meliputi beberapa tahap: 1. Seleksi administrasi kelengkapan dokumen. 2. Peninjauan akademik oleh pihak universitas. 3. Wawancara online (jika diperlukan). Hasil akhir akan diumumkan melalui email dan portal pendaftaran.</div></div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#q4">Apakah saya bisa bekerja paruh waktu selama studi?</button></h2>
                        <div id="q4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion"><div class="accordion-body">Ya, pemerintah Taiwan mengizinkan mahasiswa internasional untuk bekerja paruh waktu hingga 20 jam per minggu selama masa studi dan penuh selama liburan semester, sesuai dengan peraturan yang berlaku.</div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}

{{-- Application Process Section (Isi tetap sama, style dari layout) --}}
<section id="apply" class="section-padding">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title">Proses Pendaftaran Mudah</h2>
            <p class="section-subtitle">Ikuti 5 langkah berikut untuk memulai perjalanan Anda.</p>
        </div>
        <div class="timeline-container">
            @php $steps = [['icon' => 'bi-search', 'title' => 'Langkah 1: Pilih Program', 'desc' => 'Eksplorasi universitas dan program yang tersedia, pastikan Anda memenuhi semua kriteria.'],['icon' => 'bi-folder-check', 'title' => 'Langkah 2: Siapkan Dokumen', 'desc' => 'Kumpulkan dokumen yang diperlukan seperti ijazah, transkrip, dan sertifikat bahasa.'],['icon' => 'bi-send', 'title' => 'Langkah 3: Kirim Aplikasi', 'desc' => 'Daftarkan diri dan unggah semua dokumen melalui portal pendaftaran online kami.'],['icon' => 'bi-hourglass-top', 'title' => 'Langkah 4: Proses Seleksi', 'desc' => 'Aplikasi Anda akan ditinjau oleh tim kami dan pihak universitas. Tunggu hasilnya.'],['icon' => 'bi-airplane', 'title' => 'Langkah 5: Persiapan Keberangkatan', 'desc' => 'Setelah diterima, proses visa pelajar Anda dan bersiaplah untuk terbang!']]; @endphp
            @foreach($steps as $step)
            <div class="timeline-item" data-aos="fade-up">
                <div class="timeline-icon"><i class="bi {{ $step['icon'] }}"></i></div>
                <div class="timeline-content">
                    <h5 class="fw-bold">{{ $step['title'] }}</h5>
                    <p class="text-muted mb-0">{{ $step['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-5" data-aos="fade-up"><a href="{{ route('loginuser') }}" class="btn btn-custom-primary">Mulai Pendaftaran Sekarang!</a></div>
    </div>
</section>

{{-- Contact Section (Isi tetap sama, style dari layout) --}}
<section id="contact" class="section-padding" style="background: var(--dark-text);">
    <div class="container" data-aos="fade-up">
        <div class="text-center text-white">
            <h2 class="section-title text-white">Butuh Bantuan?</h2>
            <p class="section-subtitle text-white-50">Jangan ragu untuk menghubungi tim kami jika Anda memiliki pertanyaan.</p>
            <p class="fs-4 mb-1"><a href="mailto:idintactbase@gcloud.csu.edu.tw" class="text-decoration-none fw-semibold" style="color: var(--secondary-color);">idintactbase@gcloud.csu.edu.tw</a></p>
        </div>
    </div>
</section>

@endsection
