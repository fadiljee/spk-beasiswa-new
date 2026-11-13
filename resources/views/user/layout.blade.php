<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'INTACT Base Indonesia')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,500;0,9..144,600;0,9..144,700;1,9..144,500&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=IBM+Plex+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        /* =========================================================
           DESIGN TOKENS — "Boarding Pass" System
           ========================================================= */
        :root {
            --sch-navy:        #0E1A33;
            --sch-navy-soft:   #172548;
            --sch-paper:       #F6F5F1;
            --sch-paper-2:     #FFFFFF;
            --sch-ink:         #1A2133;
            --sch-muted:       #5B6472;
            --sch-border:      #E3E0D6;
            --sch-gold:        #C79A4B;
            --sch-gold-deep:   #9C7530;
            --sch-jade:        #0E6E63;
            --sch-jade-light:  #E4F1EE;

            /* Legacy aliases so child views using var(--primary-color) still work */
            --primary-color:   #0E1A33;
            --secondary-color: #C79A4B;
            --light-bg:        #F6F5F1;
            --dark-text:       #1A2133;
            --muted-text:      #5B6472;
            --border-color:    #E3E0D6;
            --primary-light:   #E4F1EE;
            --shadow-md:       0 4px 6px -1px rgb(0 0 0 / 0.08), 0 2px 4px -2px rgb(0 0 0 / 0.06);
            --shadow-lg:       0 10px 30px -8px rgb(14 26 51 / 0.18);

            --font-display: 'Fraunces', serif;
            --font-body:    'Plus Jakarta Sans', sans-serif;
            --font-mono:    'IBM Plex Mono', monospace;
        }

        html { scroll-behavior: smooth; }
        body { font-family: var(--font-body); background-color: var(--sch-paper-2); color: var(--sch-ink); }
        h1, h2, h3, h4, h5, h6 { font-family: var(--font-display); }

        /* =========================================================
           REUSABLE COMPONENTS
           ========================================================= */
        .section-padding { padding: 88px 0; }

        .eyebrow {
            font-family: var(--font-mono);
            font-size: 0.72rem;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: var(--sch-gold-deep);
            font-weight: 500;
        }
        .eyebrow.on-dark { color: var(--sch-gold); }

        .section-title {
            font-family: var(--font-display);
            font-weight: 600;
            font-size: clamp(1.9rem, 3vw, 2.6rem);
            color: var(--sch-navy);
            margin-bottom: 1rem;
            letter-spacing: -0.01em;
        }
        .section-subtitle {
            font-size: 1.05rem;
            color: var(--sch-muted);
            margin-bottom: 3rem;
            max-width: 620px;
            margin-left: auto;
            margin-right: auto;
        }

        .btn-custom-primary {
            background: var(--sch-navy);
            border: 1px solid var(--sch-navy);
            color: #fff;
            font-family: var(--font-body);
            font-weight: 600;
            padding: 0.75rem 1.6rem;
            border-radius: 999px;
            transition: all .25s ease;
            text-decoration: none;
            display: inline-block;
        }
        .btn-custom-primary:hover {
            background: var(--sch-jade);
            border-color: var(--sch-jade);
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px -6px rgba(14,110,99,0.4);
        }
        .btn-custom-outline {
            background: transparent;
            border: 1.5px solid var(--sch-navy);
            color: var(--sch-navy);
            font-family: var(--font-body);
            font-weight: 600;
            padding: 0.75rem 1.6rem;
            border-radius: 999px;
            transition: all .25s ease;
            text-decoration: none;
            display: inline-block;
        }
        .btn-custom-outline:hover {
            background: var(--sch-navy);
            color: #fff;
            transform: translateY(-2px);
        }

        /* Pagination matching Boarding Pass tokens */
        .pagination {
            gap: 6px;
            flex-wrap: wrap;
        }
        .pagination .page-link {
            font-family: var(--font-body);
            font-weight: 600;
            font-size: 0.9rem;
            color: var(--sch-ink);
            background-color: var(--sch-paper-2);
            border: 1px solid var(--sch-border);
            border-radius: 10px !important;
            padding: 0.5rem 0.9rem;
            min-width: 40px;
            text-align: center;
            transition: background-color .2s ease, border-color .2s ease, color .2s ease;
        }
        .pagination .page-link:hover {
            background-color: var(--sch-jade-light);
            border-color: var(--sch-jade);
            color: var(--sch-jade);
        }
        .pagination .page-item.active .page-link {
            background-color: var(--sch-navy);
            border-color: var(--sch-navy);
            color: #fff;
        }
        .pagination .page-item.disabled .page-link {
            background-color: var(--sch-paper);
            border-color: var(--sch-border);
            color: var(--sch-muted);
            opacity: 0.65;
        }

        /* =========================================================
           NAVBAR
           ========================================================= */
        .navbar-custom {
            background: rgba(246,245,241,0.92);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--sch-border);
            padding: 0.85rem 0;
            transition: all 0.3s ease;
        }
        .navbar-custom.scrolled {
            background: rgba(255,255,255,0.97);
            box-shadow: 0 4px 20px -8px rgba(14,26,51,0.15);
        }
        .navbar-brand {
            font-family: var(--font-display);
            font-weight: 600;
            font-size: 1.25rem;
            color: var(--sch-navy) !important;
            letter-spacing: -0.01em;
        }
        .navbar-brand img { height: 38px; }
        .navbar-brand .brand-dot {
            display: inline-block;
            width: 6px; height: 6px;
            background: var(--sch-gold);
            border-radius: 50%;
            margin-left: 3px;
            vertical-align: middle;
            margin-bottom: 5px;
        }

        .navbar-nav .nav-link {
            font-family: var(--font-body);
            font-weight: 500;
            font-size: 0.9rem;
            color: var(--sch-muted) !important;
            margin: 0 0.2rem;
            padding: 0.45rem 0.85rem !important;
            border-radius: 999px;
            transition: all 0.2s ease;
        }
        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active {
            color: var(--sch-navy) !important;
            background: rgba(14,26,51,0.06);
        }
        .navbar-toggler {
            border: 1px solid var(--sch-border);
            border-radius: 8px;
            padding: 6px 10px;
        }
        .navbar-toggler:focus { box-shadow: none; }

        /* =========================================================
           FOOTER
           ========================================================= */
        .footer {
            background: var(--sch-navy);
            color: rgba(255,255,255,0.75);
            padding: 3.5rem 0 2.5rem;
            border-top: 1px solid rgba(255,255,255,0.08);
        }
        .footer .footer-brand {
            font-family: var(--font-display);
            font-weight: 600;
            font-size: 1.2rem;
            color: #fff;
            margin-bottom: 0.5rem;
        }
        .footer .footer-brand span { color: var(--sch-gold); }
        .footer p { color: rgba(255,255,255,0.55); font-size: 0.9rem; }
        .footer a { color: rgba(255,255,255,0.55); text-decoration: none; transition: color 0.2s ease; }
        .footer a:hover { color: var(--sch-gold); }
        .footer .footer-divider {
            border-color: rgba(255,255,255,0.1);
            margin: 2rem 0 1.5rem;
        }
        .footer .footer-mono {
            font-family: var(--font-mono);
            font-size: 0.68rem;
            letter-spacing: 0.08em;
            color: rgba(255,255,255,0.3);
            text-transform: uppercase;
        }

        /* =========================================================
           TIMELINE (shared — used in home and possibly other pages)
           ========================================================= */
        .timeline-container { position: relative; }
        .timeline-container::before {
            content: '';
            position: absolute;
            top: 30px; left: 29px; bottom: 30px;
            width: 2px;
            background: repeating-linear-gradient(
                180deg,
                var(--sch-border) 0 8px,
                transparent 8px 16px
            );
        }
        .timeline-item { position: relative; margin-bottom: 36px; padding-left: 78px; }
        .timeline-icon {
            position: absolute; left: 0; top: 0;
            width: 60px; height: 60px;
            background: var(--sch-navy); color: var(--sch-gold);
            border-radius: 16px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.3rem;
        }
        .timeline-content h5 { font-family: var(--font-display); font-weight: 600; color: var(--sch-navy); }
        .step-eyebrow {
            font-family: var(--font-mono);
            font-size: 0.68rem;
            letter-spacing: 0.1em;
            color: var(--sch-gold-deep);
            text-transform: uppercase;
            display: block;
            margin-bottom: 4px;
        }
    </style>
    @stack('styles')
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light navbar-custom fixed-top" id="mainNavbar">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('user.beranda') }}">
                INTACT Base<span class="brand-dot"></span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('user.beranda') }}">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('user.beranda') }}#programs">Program</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('user.beranda') }}#benefits">Benefit</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('user.beranda') }}#testimonials">Testimoni</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('user.beranda') }}#apply">Cara Daftar</a></li>
                </ul>
                @if (session('mahasiswa_id'))
                    <div class="dropdown ms-lg-3">
                        <button class="btn btn-custom-primary dropdown-toggle d-inline-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle"></i>
                            <span>{{ session('mahasiswa_nama', 'Peserta') }}</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                            <li>
                                <a class="dropdown-item" href="{{ route('pendafaran.user') }}">
                                    <i class="bi bi-speedometer2 me-2"></i>Dashboard Peserta
                                </a>
                            </li>
                            @if (config('beasiswa.pendaftaran_dibuka'))
                                <li>
                                    <a class="dropdown-item" href="{{ route('hasil-akhir') }}">
                                        <i class="bi bi-trophy me-2"></i>Lihat Hasil
                                    </a>
                                </li>
                            @endif
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('user.logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @elseif (session('loginStatus'))
                    <div class="dropdown ms-lg-3">
                        <button class="btn btn-custom-primary dropdown-toggle d-inline-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-shield-check"></i>
                            <span>Admin</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                            <li>
                                <a class="dropdown-item" href="{{ route('dashboardadmin') }}">
                                    <i class="bi bi-speedometer2 me-2"></i>Dashboard Admin
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a href="{{ route('loginuser') }}" class="btn btn-custom-primary ms-lg-3">Login / Daftar</a>
                @endif
            </div>
        </div>
    </nav>

    <main style="padding-top: 0;">
        @yield('content')
    </main>

    <footer class="footer">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 mb-3 mb-md-0">
                    <div class="footer-brand">INTACT Base<span>.</span></div>
                    <p class="mb-0">International Talent Circulation Base</p>
                    <p class="mb-0">Taiwan &mdash; Indonesia</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="mailto:idintactbase@gcloud.csu.edu.tw" class="d-block mb-1">idintactbase@gcloud.csu.edu.tw</a>
                    <span class="footer-mono">&copy; {{ date('Y') }} INTACT Base Indonesia &middot; All rights reserved</span>
                </div>
            </div>
            <hr class="footer-divider">
            <p class="text-center mb-0 footer-mono">CGK &rarr; TPE &nbsp;&middot;&nbsp; Jakarta to Taipei &nbsp;&middot;&nbsp; Buka Gerbang Pendidikan Dunia</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 750, once: true, offset: 40 });

        // Navbar scroll effect
        const navbar = document.getElementById('mainNavbar');
        window.addEventListener('scroll', () => {
            navbar.classList.toggle('scrolled', window.scrollY > 30);
        });

        // Active nav link highlight based on section in view
        const sections = document.querySelectorAll('section[id]');
        const navLinks = document.querySelectorAll('.navbar-nav .nav-link');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    navLinks.forEach(link => {
                        link.classList.remove('active');
                        if (link.getAttribute('href')?.includes('#' + entry.target.id)) {
                            link.classList.add('active');
                        }
                    });
                }
            });
        }, { threshold: 0.4 });
        sections.forEach(s => observer.observe(s));
    </script>
    @stack('scripts')
</body>
</html>