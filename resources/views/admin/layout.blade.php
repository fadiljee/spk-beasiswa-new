<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - SPK SAW</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    {{-- Page-specific styles --}}
    @yield('styles')
    @stack('styles')

    <style>
        :root {
            --sidebar-bg: #111827; /* Darker, more sophisticated */
            --sidebar-link-color: #9ca3af;
            --sidebar-link-hover-bg: #1f2937;
            --sidebar-link-active-bg: #374151;
            --primary-color: #4f46e5;
            --primary-light: #eef2ff;
            --text-dark: #1f2937;
            --text-light: #f9fafb;
            --body-bg: #f3f4f6;
            --border-color: #e5e7eb;
            --card-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--body-bg);
            display: flex;
        }

        /* --- Sidebar --- */
        .sidebar {
            width: 260px;
            height: 100vh;
            background: var(--sidebar-bg);
            color: var(--text-light);
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s ease-in-out;
            z-index: 1030;
        }

        .sidebar-header {
            padding: 1.5rem;
            text-align: center;
            border-bottom: 1px solid #374151;
        }

        .sidebar-header h3 {
            font-weight: 600;
            font-size: 1.5rem;
            color: #fff;
        }

        .sidebar-nav {
            flex-grow: 1;
            overflow-y: auto;
            padding: 1rem 0;
        }
        .sidebar-nav::-webkit-scrollbar { display: none; } /* Hide scrollbar */

        .nav-section-title {
            padding: 0 1rem 0.5rem;
            font-size: 0.7rem;
            font-weight: 700;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            margin: 0.25rem 0.75rem;
            color: var(--sidebar-link-color);
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .nav-link:hover {
            background: var(--sidebar-link-hover-bg);
            color: #fff;
        }

        .nav-link.active {
            background: var(--primary-color);
            color: #fff;
            font-weight: 500;
        }

        .nav-link i.nav-icon {
            width: 20px;
            text-align: center;
            margin-right: 0.75rem;
            font-size: 0.9rem;
        }

        .submenu { padding-left: 2rem; }
        .submenu .nav-link {
            font-size: 0.9rem;
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
        }
        .submenu .nav-link.active { background: none; color: #fff; font-weight: 600; }

        /* --- User Profile Section --- */
        .sidebar-footer {
            padding: 1rem;
            border-top: 1px solid #374151;
        }
        .user-profile .dropdown-toggle {
            display: flex;
            align-items: center;
            text-decoration: none;
            padding: 0.5rem;
            border-radius: 8px;
        }
        .user-profile .dropdown-toggle:hover { background-color: var(--sidebar-link-hover-bg); }
        .user-profile img { width: 40px; height: 40px; border-radius: 50%; object-fit: cover; }
        .user-profile .user-info { margin-left: 0.75rem; }
        .user-profile .user-name { color: #fff; font-weight: 600; font-size: 0.9rem; }
        .user-profile .user-role { color: var(--sidebar-link-color); font-size: 0.8rem; }
        .user-profile .dropdown-menu {
             background-color: #1f2937;
             border: 1px solid #374151;
        }
        .user-profile .dropdown-item {
             color: var(--sidebar-link-color);
             display: flex; align-items: center; gap: 0.5rem;
        }
        .user-profile .dropdown-item:hover {
             background-color: #374151; color: #fff;
        }

        /* --- Main Content --- */
        .main-wrapper {
            margin-left: 260px;
            width: calc(100% - 260px);
            transition: margin-left 0.3s ease-in-out;
        }

        /* Topbar */
        .topbar {
            background: #fff;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .page-title-container h4 {
            font-size: 1.25rem; font-weight: 600; margin-bottom: 0;
        }
        .page-title-container small { color: #6b7280; }

        .sidebar-toggle {
            display: none;
            background: none; border: none; font-size: 1.25rem;
        }

        /* Content Body */
        .content-body { padding: 1.5rem; }

        /* Responsive */
        @media (max-width: 992px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.active { transform: translateX(0); }
            .main-wrapper { margin-left: 0; width: 100%; }
            .sidebar-toggle { display: block; }
        }

    </style>
</head>
<body>

    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h3><i class="fas fa-chart-pie me-2"></i>SPK SAW</h3>
        </div>

        <nav class="sidebar-nav">
            <div class="mb-4">
                <div class="nav-section-title">Menu Utama</div>
                <a href="{{ route('dashboardadmin') }}" class="nav-link">
                    <i class="fas fa-home-alt nav-icon"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.beasiswa.index') }}" class="nav-link">
                    <i class="fas fa-info-circle nav-icon"></i>
                    <span>Kelola Informasi</span>
                </a>
            </div>

            <div class="mb-4">
                <div class="nav-section-title">Manajemen Data</div>
                <a href="{{ route('kriteria.index') }}" class="nav-link"><i class="fas fa-list-ul nav-icon"></i><span>Data Kriteria</span></a>
                <a href="{{ route('subkriteria.index') }}" class="nav-link"><i class="fas fa-indent nav-icon"></i><span>Data Sub Kriteria</span></a>
                <a href="{{ route('pelamar.index') }}" class="nav-link"><i class="fas fa-users nav-icon"></i><span>Data Pelamar</span></a>
                <a href="{{ route('penilaian.index') }}" class="nav-link"><i class="fas fa-star nav-icon"></i><span>Data Penilaian</span></a>
            </div>

            <div class="mb-4">
                <div class="nav-section-title">Analisis & Hasil</div>
                <a href="{{ route('perhitungan.index') }}" class="nav-link"><i class="fas fa-calculator nav-icon"></i><span>Data Perhitungan</span></a>
                <a href="{{ route('hasilakhir') }}" class="nav-link"><i class="fas fa-trophy nav-icon"></i><span>Hasil Akhir</span></a>
            </div>
             <div class="mb-4">
                <div class="nav-section-title">Manajemen User</div>
                <a href="{{ route('dataMahasiswa.index') }}" class="nav-link"><i class="fas fa-user-cog nav-icon"></i><span>Data User</span></a>
            </div>
        </nav>

        <div class="sidebar-footer">
            <div class="user-profile dropdown">
                <a href="#" class="dropdown-toggle text-white" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'Admin') }}&background=4f46e5&color=fff" alt="User Avatar">
                    <div class="user-info">
                        <span class="user-name d-block">{{ Auth::user()->name ?? 'Admin' }}</span>
                        <span class="user-role d-block">{{ Auth::user()->role ?? 'Administrator' }}</span>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark">
                    <li>
                        <a class="dropdown-item" href="#" id="logout-btn">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
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
                 <button class="sidebar-toggle" id="sidebar-toggle"><i class="fas fa-bars"></i></button>
                <div class="page-title-container ms-3">
                    <h4 class="mb-0">@yield('page-title', 'Dashboard')</h4>
                    <small>@yield('page-subtitle', 'Ringkasan informasi sistem')</small>
                </div>
            </div>
        </header>

        <main class="content-body">
            @yield('content')
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // --- Active Link Highlighter ---
            const currentUrl = window.location.href;
            document.querySelectorAll('.nav-link').forEach(link => {
                if (link.href === currentUrl) {
                    link.classList.add('active');
                }
            });

            // --- Sidebar Toggle ---
            const sidebarToggle = document.getElementById('sidebar-toggle');
            const sidebar = document.getElementById('sidebar');
            const mainWrapper = document.getElementById('main-wrapper');

            sidebarToggle.addEventListener('click', () => {
                sidebar.classList.toggle('active');
            });

            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function(event) {
                 if (window.innerWidth <= 992 && !sidebar.contains(event.target) && !sidebarToggle.contains(event.target)) {
                     sidebar.classList.remove('active');
                 }
            });

            // --- Logout with SweetAlert ---
            const logoutBtn = document.getElementById('logout-btn');
            if(logoutBtn) {
                logoutBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Anda yakin ingin logout?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: 'var(--primary-color)',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Ya, Logout!',
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

    {{-- Page-specific scripts --}}
    @yield('scripts')
    @stack('scripts')
</body>
</html>
