<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'INTACT Base Indonesia')</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&family=Inter:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        /* THEME & GLOBAL STYLES */
        :root {
            --primary-color: #1e40af; /* Deep Blue */
            --secondary-color: #f59e0b; /* Amber/Gold */
            --light-bg: #f8fafc;
            --dark-text: #111827;
            --muted-text: #6b7280;
            --border-color: #e5e7eb;
            --gradient-primary: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
        }
        html { scroll-behavior: smooth; }
        body { font-family: 'Inter', sans-serif; background-color: #fff; color: var(--dark-text); }
        h1, h2, h3, h4, h5, h6 { font-family: 'Poppins', sans-serif; font-weight: 700; }

        /* REUSABLE COMPONENTS */
        .section-padding { padding: 80px 0; }
        .section-title { font-size: 2.8rem; font-weight: 800; color: var(--primary-color); margin-bottom: 1rem; }
        .section-subtitle { font-size: 1.2rem; color: var(--muted-text); margin-bottom: 3rem; max-width: 700px; margin-left: auto; margin-right: auto;}
        .btn-custom-primary { background: var(--secondary-color); color: var(--dark-text); font-weight: 600; border: none; border-radius: 50px; padding: 0.8rem 2.5rem; box-shadow: var(--shadow-md); transition: all 0.3s ease; }
        .btn-custom-primary:hover { transform: translateY(-3px); box-shadow: var(--shadow-lg); background: #fca510; color: #fff; }
        .btn-custom-outline { border: 2px solid var(--primary-color); color: var(--primary-color); font-weight: 600; border-radius: 50px; padding: 0.8rem 2.5rem; transition: all 0.3s ease; }
        .btn-custom-outline:hover { background: var(--primary-color); color: #fff; transform: translateY(-3px); }

        /* NAVBAR */
        .navbar-custom { background: #fff; box-shadow: var(--shadow-md); transition: all 0.3s ease; padding: 1rem 0; }
        .navbar-brand { font-weight: 700; color: var(--primary-color) !important; }
        .navbar-brand img { height: 40px; }
        .navbar-nav .nav-link { font-weight: 600; color: var(--dark-text) !important; margin: 0 0.5rem; padding: 0.5rem 1rem !important; border-radius: 0.5rem; transition: all 0.3s ease; }
        .navbar-nav .nav-link:hover, .navbar-nav .nav-link.active { color: var(--primary-color) !important; }

        /* FOOTER */
        .footer { background: var(--dark-text); color: #fff; padding: 3rem 0; }
        .footer h5 { color: var(--secondary-color); font-weight: 600; }
        .footer p, .footer a { color: rgba(255, 255, 255, 0.7); text-decoration: none; transition: color 0.2s ease; }
        .footer a:hover { color: #fff; }

        /* TIMELINE STYLE (Digabungkan ke sini) */
        .timeline-container { position: relative; }
        .timeline-container::before { content: ''; position: absolute; top: 25px; left: 24px; bottom: 25px; width: 4px; background: var(--border-color); border-radius: 2px; }
        .timeline-item { position: relative; margin-bottom: 40px; padding-left: 70px; }
        .timeline-icon { position: absolute; left: 0; top: 0; width: 50px; height: 50px; background: var(--primary-color); color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; }
        .timeline-content { padding-left: 1rem; }
    </style>
    @stack('styles')
</head>
<body>

     <nav class="navbar navbar-expand-lg navbar-light navbar-custom fixed-top" id="mainNavbar">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center fs-4" href="{{ route('user.beranda') }}">
                <img src="{{ asset('img/icon.png') }}" alt="INTACT Base Logo" class="me-2">
                INTACT Base
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    {{-- PENYEMPURNAAN: Link diubah agar berfungsi dari semua halaman --}}
                    <li class="nav-item"><a class="nav-link" href="{{ route('user.beranda') }}">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('user.beranda') }}#programs">Program</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('user.beranda') }}#benefits">Benefit</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('user.beranda') }}#testimonials">Testimoni</a></li>
                    
                    <li class="nav-item"><a class="nav-link" href="{{ route('user.beranda') }}#apply">Cara Daftar</a></li>
                </ul>
                <a href="{{ route('loginuser') }}" class="btn btn-custom-primary">Login / Daftar</a>
            </div>
        </div>
    </nav>

    {{-- PERBAIKAN UTAMA: Menambahkan padding-top agar konten tidak tertutup navbar --}}
    <main style="padding-top: 5rem;">
        @yield('content')
    </main>

    <footer class="footer">
        <div class="container text-center">
            <p class="mb-2">&copy; {{ date('Y') }} INTACT Base Indonesia. All Rights Reserved.</p>
            <p class="small text-white-50">International Talent Circulation Base (Taiwan - Indonesia)</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 800, once: true, offset: 50 });
    </script>
    @stack('scripts')
</body>
</html>
