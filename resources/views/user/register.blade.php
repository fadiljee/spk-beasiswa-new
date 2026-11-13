<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Buat Akun | INTACT Base Indonesia</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,600;9..144,700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    :root {
      --sch-navy:       #0E1A33;
      --sch-paper:      #F6F5F1;
      --sch-paper-2:    #FFFFFF;
      --sch-ink:        #1A2133;
      --sch-muted:      #5B6472;
      --sch-border:     #E3E0D6;
      --sch-jade:       #0E6E63;

      --font-display: 'Fraunces', serif;
      --font-body:    'Plus Jakarta Sans', sans-serif;
    }

    body {
      font-family: var(--font-body);
      background-color: var(--sch-paper);
      color: var(--sch-ink);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding: 32px 16px;
    }

    .register-shell {
      width: 100%;
      max-width: 480px;
    }

    .back-home {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      font-size: 0.875rem;
      font-weight: 600;
      color: var(--sch-muted);
      text-decoration: none;
      margin-bottom: 16px;
      transition: color 0.2s ease;
    }
    .back-home:hover {
      color: var(--sch-navy);
    }

    .register-card {
      background: var(--sch-paper-2);
      border: 1px solid var(--sch-border);
      border-radius: 16px;
      padding: 36px 32px;
      box-shadow: 0 12px 32px -12px rgba(14, 26, 51, 0.14);
    }

    .register-brand {
      font-family: var(--font-display);
      font-weight: 700;
      font-size: 1.5rem;
      color: var(--sch-navy);
      margin-bottom: 4px;
    }

    .register-subtitle {
      font-size: 0.9rem;
      color: var(--sch-muted);
      margin-bottom: 24px;
    }

    .form-label {
      font-size: 0.85rem;
      font-weight: 600;
      color: var(--sch-ink);
      margin-bottom: 6px;
    }

    .input-wrap {
      position: relative;
    }

    .input-icon {
      position: absolute;
      left: 14px;
      top: 50%;
      transform: translateY(-50%);
      color: var(--sch-muted);
      pointer-events: none;
      font-size: 1rem;
    }

    .form-control {
      height: 46px;
      border-radius: 10px;
      padding-left: 42px;
      padding-right: 42px;
      background-color: var(--sch-paper-2);
      border: 1px solid var(--sch-border);
      color: var(--sch-ink);
      font-size: 0.94rem;
      transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .form-control:focus {
      border-color: var(--sch-jade);
      box-shadow: 0 0 0 3px rgba(14, 110, 99, 0.14);
      color: var(--sch-ink);
    }

    .form-control::placeholder {
      color: #8A93A2;
    }

    .toggle-password {
      position: absolute;
      right: 8px;
      top: 50%;
      transform: translateY(-50%);
      border: none;
      background: transparent;
      color: var(--sch-muted);
      width: 34px;
      height: 34px;
      border-radius: 8px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
    }
    .toggle-password:hover {
      color: var(--sch-navy);
      background-color: rgba(14, 26, 51, 0.06);
    }

    .btn-register {
      background-color: var(--sch-navy);
      border: 1px solid var(--sch-navy);
      color: #fff;
      font-weight: 600;
      font-size: 0.95rem;
      padding: 0.72rem 1.25rem;
      border-radius: 10px;
      transition: background-color 0.2s ease, border-color 0.2s ease;
    }
    .btn-register:hover {
      background-color: var(--sch-jade);
      border-color: var(--sch-jade);
      color: #fff;
    }

    .btn-back {
      background-color: transparent;
      border: 1px solid var(--sch-border);
      color: var(--sch-navy);
      font-weight: 600;
      font-size: 0.95rem;
      padding: 0.72rem 1.25rem;
      border-radius: 10px;
      text-align: center;
      text-decoration: none;
      transition: background-color 0.2s ease, border-color 0.2s ease;
    }
    .btn-back:hover {
      background-color: var(--sch-paper);
      border-color: var(--sch-navy);
      color: var(--sch-navy);
    }

    .alert-register-danger {
      background-color: #FEF2F2;
      border: 1px solid #FECACA;
      color: #991B1B;
      border-radius: 10px;
      padding: 12px 14px;
      font-size: 0.875rem;
      margin-bottom: 20px;
    }
    .alert-register-danger ul {
      margin: 0;
      padding-left: 18px;
    }

    .register-footer {
      text-align: center;
      margin-top: 20px;
      font-size: 0.8rem;
      color: var(--sch-muted);
    }

    @media (max-width: 576px) {
      .register-card { padding: 28px 22px; }
    }

    @media (prefers-reduced-motion: reduce) {
      *, *::before, *::after { transition: none !important; }
    }
  </style>
</head>
<body>
  <div class="register-shell">
    <a href="{{ route('user.beranda') }}" class="back-home">
      <i class="bi bi-arrow-left"></i>
      <span>Kembali ke Beranda</span>
    </a>

    <div class="register-card">
      <h1 class="register-brand">Buat Akun</h1>
      <p class="register-subtitle">INTACT Base Indonesia &middot; Beasiswa Taiwan</p>

      <form action="{{ route('registerproses') }}" method="POST">
        @csrf

        @if ($errors->any())
          <div class="alert-register-danger" role="alert">
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <div class="mb-3">
          <label for="nama" class="form-label">Nama Lengkap</label>
          <div class="input-wrap">
            <i class="bi bi-person input-icon" aria-hidden="true"></i>
            <input
              type="text"
              id="nama"
              name="nama"
              class="form-control"
              placeholder="Masukkan nama lengkap"
              value="{{ old('nama') }}"
              autocomplete="name"
              required
              autofocus
            >
          </div>
        </div>

        <div class="mb-3">
          <label for="nim" class="form-label">Nomor Induk Mahasiswa (NIM)</label>
          <div class="input-wrap">
            <i class="bi bi-person-badge input-icon" aria-hidden="true"></i>
            <input
              type="text"
              id="nim"
              name="nim"
              class="form-control"
              placeholder="Contoh: 210100001"
              value="{{ old('nim') }}"
              required
            >
          </div>
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <div class="input-wrap">
            <i class="bi bi-envelope input-icon" aria-hidden="true"></i>
            <input
              type="email"
              id="email"
              name="email"
              class="form-control"
              placeholder="nama@email.com"
              value="{{ old('email') }}"
              autocomplete="email"
              required
            >
          </div>
        </div>

        <div class="mb-3">
          <label for="jurusan" class="form-label">Jurusan</label>
          <div class="input-wrap">
            <i class="bi bi-book input-icon" aria-hidden="true"></i>
            <input
              type="text"
              id="jurusan"
              name="jurusan"
              class="form-control"
              placeholder="Contoh: Teknik Informatika"
              value="{{ old('jurusan') }}"
              required
            >
          </div>
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Kata Sandi</label>
          <div class="input-wrap">
            <i class="bi bi-lock input-icon" aria-hidden="true"></i>
            <input
              type="password"
              id="password"
              name="password"
              class="form-control"
              placeholder="Buat kata sandi"
              autocomplete="new-password"
              required
            >
            <button
              type="button"
              class="toggle-password"
              data-target="password"
              aria-label="Tampilkan atau sembunyikan kata sandi"
            >
              <i class="bi bi-eye"></i>
            </button>
          </div>
        </div>

        <div class="mb-4">
          <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi</label>
          <div class="input-wrap">
            <i class="bi bi-lock-fill input-icon" aria-hidden="true"></i>
            <input
              type="password"
              id="password_confirmation"
              name="password_confirmation"
              class="form-control"
              placeholder="Ulangi kata sandi"
              autocomplete="new-password"
              required
            >
            <button
              type="button"
              class="toggle-password"
              data-target="password_confirmation"
              aria-label="Tampilkan atau sembunyikan konfirmasi kata sandi"
            >
              <i class="bi bi-eye"></i>
            </button>
          </div>
        </div>

        <div class="d-grid gap-2">
          <button type="submit" class="btn btn-register">Daftar</button>
          <a href="{{ route('loginuser') }}" class="btn-back">Sudah punya akun? Masuk</a>
        </div>
      </form>
    </div>

    <p class="register-footer">
      &copy; {{ date('Y') }} INTACT Base Indonesia
    </p>
  </div>

  <script>
    document.querySelectorAll('.toggle-password').forEach((btn) => {
      btn.addEventListener('click', () => {
        const input = document.getElementById(btn.dataset.target);
        const icon = btn.querySelector('i');
        if (!input || !icon) return;
        const isHidden = input.type === 'password';
        input.type = isHidden ? 'text' : 'password';
        icon.className = isHidden ? 'bi bi-eye-slash' : 'bi bi-eye';
      });
    });
  </script>
</body>
</html>
