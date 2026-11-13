<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Peserta') - INTACT Base</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,500;0,9..144,600;0,9..144,700&family=Plus+Jakarta+Sans:wght@400;500;600;700&family=IBM+Plex+Mono:wght@400;500&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    @stack('styles')

    <style>
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

            /* Compatibility aliases for child views */
            --primary-color:   #0E1A33;
            --primary-light:   #E4F1EE;
            --text-dark:       #1A2133;
            --text-light:      #F6F5F1;
            --body-bg:         #F6F5F1;
            --border-color:    #E3E0D6;
            --card-shadow:     0 10px 30px -12px rgba(14, 26, 51, 0.12);

            --font-display:    'Fraunces', serif;
            --font-body:       'Plus Jakarta Sans', sans-serif;
            --font-mono:       'IBM Plex Mono', monospace;
        }

        body {
            font-family: var(--font-body);
            background-color: var(--sch-paper);
            color: var(--sch-ink);
            display: flex;
            min-height: 100vh;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: var(--font-display);
            color: var(--sch-navy);
        }

        /* --- Sidebar (Boarding Pass Navy) --- */
        .sidebar {
            width: 268px;
            height: 100vh;
            background: var(--sch-navy);
            color: var(--text-light);
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s ease-in-out;
            z-index: 1030;
            border-right: 1px solid rgba(255, 255, 255, 0.08);
        }

        .sidebar-header {
            padding: 1.5rem 1.35rem 1.25rem;
            border-bottom: 1px dashed rgba(255, 255, 255, 0.16);
        }

        .sidebar-eyebrow {
            font-family: var(--font-mono);
            font-size: 0.68rem;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            color: var(--sch-gold);
            margin-bottom: 6px;
            display: block;
        }

        .sidebar-header h3 {
            font-family: var(--font-display);
            font-weight: 600;
            font-size: 1.35rem;
            color: #fff;
            margin-bottom: 0;
        }

        .sidebar-header h3 span {
            color: var(--sch-gold);
        }

        .sidebar-nav {
            flex-grow: 1;
            overflow-y: auto;
            padding: 1.15rem 0;
        }
        .sidebar-nav::-webkit-scrollbar { display: none; }

        .nav-section-title {
            padding: 0 1.25rem 0.5rem;
            font-family: var(--font-mono);
            font-size: 0.68rem;
            font-weight: 500;
            color: rgba(255, 255, 255, 0.48);
            text-transform: uppercase;
            letter-spacing: 0.14em;
        }

        .sidebar-nav .nav-link {
            display: flex;
            align-items: center;
            padding: 0.72rem 1rem;
            margin: 0.25rem 0.85rem;
            color: rgba(255, 255, 255, 0.76);
            text-decoration: none;
            border-radius: 10px;
            font-size: 0.92rem;
            font-weight: 500;
            transition: background-color 0.2s ease, color 0.2s ease;
        }

        .sidebar-nav .nav-link:hover {
            background: var(--sch-navy-soft);
            color: #fff;
        }

        .sidebar-nav .nav-link.active {
            background: var(--sch-jade);
            color: #fff;
            font-weight: 600;
        }

        .sidebar-nav .nav-link i.nav-icon {
            width: 20px;
            text-align: center;
            margin-right: 0.75rem;
            font-size: 0.95rem;
        }

        /* --- User Profile Section --- */
        .sidebar-footer {
            padding: 1rem;
            border-top: 1px dashed rgba(255, 255, 255, 0.16);
        }
        .user-profile .dropdown-toggle {
            display: flex;
            align-items: center;
            text-decoration: none;
            padding: 0.5rem;
            border-radius: 10px;
            transition: background-color 0.2s ease;
        }
        .user-profile .dropdown-toggle:hover {
            background-color: var(--sch-navy-soft);
        }
        .user-profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 1.5px solid var(--sch-gold);
        }
        .user-profile .user-info {
            margin-left: 0.75rem;
            text-align: left;
            min-width: 0;
        }
        .user-profile .user-name {
            color: #fff;
            font-weight: 600;
            font-size: 0.9rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .user-profile .user-role {
            font-family: var(--font-mono);
            color: var(--sch-gold);
            font-size: 0.72rem;
            letter-spacing: 0.06em;
        }
        .user-profile .dropdown-menu {
            background-color: var(--sch-navy-soft);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 12px;
        }
        .user-profile .dropdown-item {
            color: rgba(255, 255, 255, 0.84);
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.9rem;
        }
        .user-profile .dropdown-item:hover {
            background-color: rgba(255, 255, 255, 0.08);
            color: #fff;
        }

        /* --- Main Content --- */
        .main-wrapper {
            margin-left: 268px;
            width: calc(100% - 268px);
            transition: margin-left 0.3s ease-in-out;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .topbar {
            background: var(--sch-paper-2);
            padding: 1rem 1.75rem;
            border-bottom: 1px solid var(--sch-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
        }

        .page-title-container h4 {
            font-family: var(--font-display);
            font-size: 1.35rem;
            font-weight: 600;
            color: var(--sch-navy);
            margin-bottom: 2px;
        }
        .page-title-container small {
            color: var(--sch-muted);
            font-size: 0.85rem;
        }

        .topbar-home-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 0.48rem 1rem;
            border-radius: 999px;
            border: 1px solid var(--sch-border);
            background: var(--sch-paper);
            color: var(--sch-navy);
            font-size: 0.85rem;
            font-weight: 600;
            text-decoration: none;
            transition: background-color 0.2s ease, border-color 0.2s ease, color 0.2s ease;
        }
        .topbar-home-link:hover {
            background: var(--sch-navy);
            border-color: var(--sch-navy);
            color: #fff;
        }

        .sidebar-toggle {
            display: none;
            background: var(--sch-paper);
            border: 1px solid var(--sch-border);
            color: var(--sch-navy);
            width: 40px;
            height: 40px;
            border-radius: 10px;
            font-size: 1.15rem;
        }

        /* Shared Boarding Pass surface styles for child views */
        .card {
            background-color: var(--sch-paper-2);
            border: 1px solid var(--sch-border);
            border-radius: 16px;
            box-shadow: var(--card-shadow);
        }
        .card-header {
            background-color: var(--sch-paper-2);
            border-bottom: 1px solid var(--sch-border);
            font-family: var(--font-display);
            font-weight: 600;
            color: var(--sch-navy);
        }

        .btn-primary {
            background-color: var(--sch-navy);
            border-color: var(--sch-navy);
            font-weight: 600;
        }
        .btn-primary:hover, .btn-primary:focus {
            background-color: var(--sch-jade);
            border-color: var(--sch-jade);
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--sch-jade);
            box-shadow: 0 0 0 3px rgba(14, 110, 99, 0.14);
        }

        /* Pagination matching Boarding Pass tokens */
        .pagination {
            gap: 6px;
            flex-wrap: wrap;
        }
        .pagination .page-link {
            font-family: var(--font-body);
            font-weight: 600;
            font-size: 0.88rem;
            color: var(--sch-ink);
            background-color: var(--sch-paper-2);
            border: 1px solid var(--sch-border);
            border-radius: 10px !important;
            padding: 0.45rem 0.85rem;
            min-width: 38px;
            text-align: center;
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

        /* Responsive */
        @media (max-width: 992px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.active { transform: translateX(0); }
            .main-wrapper { margin-left: 0; width: 100%; }
            .sidebar-toggle { display: inline-flex; align-items: center; justify-content: center; }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { transition: none !important; }
        }
    </style>
</head>
<body>

    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <span class="sidebar-eyebrow">CGK &rarr; TPE &middot; PORTAL PESERTA</span>
            <h3>
                <a href="{{ route('user.beranda') }}" class="text-decoration-none text-white">
                    INTACT Base<span>.</span>
                </a>
            </h3>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-section-title">Menu Peserta</div>
            <a href="{{ route('pendafaran.user') }}" class="nav-link">
                <i class="fas fa-user-plus nav-icon"></i>
                <span>Pendaftaran</span>
            </a>
            @if (config('beasiswa.pendaftaran_dibuka'))
                <a href="{{ route('hasil-akhir') }}" class="nav-link">
                    <i class="fas fa-trophy nav-icon"></i>
                    <span>Lihat Hasil</span>
                </a>
            @endif
            <a href="{{ route('profile.edit') }}" class="nav-link">
                <i class="fas fa-user-cog nav-icon"></i>
                <span>Edit Profil</span>
            </a>
        </nav>

        <div class="sidebar-footer">
            @php($displayName = session('mahasiswa_nama', Auth::user()->name ?? 'Peserta'))
            <div class="user-profile dropdown w-100">
                <a href="#" class="dropdown-toggle text-white" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($displayName) }}&background=0E6E63&color=fff" alt="User Avatar">
                    <div class="user-info">
                        <span class="user-name d-block">{{ $displayName }}</span>
                        <span class="user-role d-block">{{ session('mahasiswa_nim', 'PESERTA BEASISWA') }}</span>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark">
                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="fas fa-user-edit me-2"></i> Edit Profil</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item text-danger" href="#" id="logout-btn">
                            <i class="fas fa-sign-out-alt me-2"></i> Logout
                        </a>
                        <form id="logout-form" action="{{ route('user.logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </aside>

    <div class="main-wrapper" id="main-wrapper">
        <header class="topbar">
            <div class="d-flex align-items-center">
                <button class="sidebar-toggle" id="sidebar-toggle" aria-label="Buka menu navigasi">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="page-title-container ms-3 ms-lg-0">
                    <h4 class="mb-0">@yield('page-title', 'Selamat Datang')</h4>
                    <small>@yield('page-subtitle', 'Portal Pendaftaran & Seleksi Beasiswa Taiwan')</small>
                </div>
            </div>
            <a href="{{ route('user.beranda') }}" class="topbar-home-link">
                <i class="bi bi-arrow-left"></i>
                <span class="d-none d-sm-inline">Beranda</span>
            </a>
        </header>

        <main class="p-4 flex-grow-1">
            @yield('content')
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('scripts')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const currentUrl = window.location.href;
            document.querySelectorAll('.sidebar-nav .nav-link').forEach(link => {
                if (link.href === currentUrl) {
                    link.classList.add('active');
                }
            });

            const sidebarToggle = document.getElementById('sidebar-toggle');
            const sidebar = document.getElementById('sidebar');
            if (sidebarToggle && sidebar) {
                sidebarToggle.addEventListener('click', () => sidebar.classList.toggle('active'));

                document.addEventListener('click', function(event) {
                    if (window.innerWidth <= 992 && !sidebar.contains(event.target) && !sidebarToggle.contains(event.target)) {
                        sidebar.classList.remove('active');
                    }
                });
            }

            const logoutBtn = document.getElementById('logout-btn');
            if (logoutBtn) {
                logoutBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Anda yakin ingin logout?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#0E1A33',
                        cancelButtonColor: '#5B6472',
                        confirmButtonText: 'Ya, Logout',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById('logout-form').submit();
                        }
                    });
                });
            }
        });
    </script>
</body>
</html>
