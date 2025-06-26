<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Sistem Pendukung Keputusan Beasiswa')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            padding-top: 56px;
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }
        .bg-custom {
            background-color: #0C91A6 !important;
        }
        .text-custom {
            color: white !important;
        }
        .btn-custom {
            background-color: transparent !important;
            color: white !important;
            border: 2px solid white !important;
            padding: 10px 20px;
            transition: all 0.3s ease;
        }
        .btn-custom:hover {
            background-color: white !important;
            color: #0C91A6 !important;
        }
        .section-title {
            text-align: center;
            font-weight: bold;
            margin-bottom: 20px;
            color: #0C91A6;
        }
        .logo-univ {
            height: 80px;
            display: block;
            margin: 0 auto 10px;
        }
        .info-box {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .beasiswa-desc {
            transition: all 0.3s ease;
            max-height: 0;
            overflow: hidden;
        }
        .beasiswa-desc p {
            margin-top: 10px;
        }
        .beasiswa-desc.show {
            max-height: 500px; /* Atur sesuai panjang deskripsi */
        }
    </style>
    @stack('styles')
</head>
<body>

    @include('partials.navbar')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
