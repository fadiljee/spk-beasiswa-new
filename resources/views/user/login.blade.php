<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login | Sistem Pendukung Keputusan</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    /* === Base & Glassmorphism Background === */
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #1d2b64 0%, #0C91A6 100%);
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      padding: 20px;
      overflow: hidden;
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    /* === Container & Card === */
    .login-container {
      width: 100%;
      max-width: 450px;
      animation: fadeIn 0.8s ease-out forwards;
    }

    .login-card {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      border-radius: 20px;
      border: 1px solid rgba(255, 255, 255, 0.2);
      box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
      padding: 40px;
      animation: slideUp 0.6s ease-out forwards;
      color: #fff;
    }

    /* === Logo & Header === */
    .logo-container {
      text-align: center;
      margin-bottom: 30px;
      opacity: 0;
      animation: fadeIn 0.5s ease-out 0.3s forwards;
    }

    .logo {
      width: 80px;
      height: 80px;
      margin-bottom: 15px;
      background: rgba(255, 255, 255, 0.15);
      border-radius: 50%;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      color: #fff;
      font-size: 32px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
    }

    .logo-text {
      font-weight: 700;
      font-size: 1.8rem;
      color: #fff;
      margin-bottom: 5px;
    }

    .logo-subtext {
      color: rgba(255, 255, 255, 0.8);
      font-size: 1rem;
      font-weight: 400;
    }

    /* === Form Inputs === */
    .form-group {
      margin-bottom: 25px;
      position: relative;
      opacity: 0;
      animation: slideUp 0.5s ease-out forwards;
    }
    .form-group:nth-of-type(1) { animation-delay: 0.4s; }
    .form-group:nth-of-type(2) { animation-delay: 0.5s; }

    .form-control {
      height: 50px;
      border-radius: 10px;
      padding-left: 45px;
      background: rgba(255, 255, 255, 0.15);
      border: 1px solid rgba(255, 255, 255, 0.3);
      color: #fff;
      transition: all 0.3s ease;
      font-size: 15px;
    }

    .form-control:focus {
      background: rgba(255, 255, 255, 0.25);
      border-color: #fff;
      box-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
      outline: none;
    }

    .form-control::placeholder {
      color: rgba(255, 255, 255, 0.7);
    }

    .input-icon {
      position: absolute;
      left: 15px;
      top: 50%;
      transform: translateY(-50%);
      color: rgba(255, 255, 255, 0.7);
      transition: color 0.3s ease;
    }

    .form-control:focus ~ .input-icon {
      color: #fff;
    }

    /* === [FIX] Perbaikan Styling Tombol === */
    .btn {
      padding: 12px; /* Menggunakan padding agar tinggi fleksibel */
      border-radius: 10px;
      font-weight: 600;
      font-size: 16px;
      transition: all 0.3s ease;
      opacity: 0;
      animation: fadeIn 0.5s ease-out forwards;
      /* Dihapus: `height` dan `margin-top` agar diatur oleh d-grid */
    }

    /* Primary Button (Login) */
    .btn-login {
      background-color: #ffffff;
      color: #0C91A6;
      border: 2px solid #ffffff; /* Border dibuat sama dengan background */
      animation-delay: 0.7s;
    }

    .btn-login:hover {
      background-color: #f0f0f0;
      border-color: #f0f0f0;
      color: #0b7d8f;
      transform: translateY(-2px);
      box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }

    /* Secondary Button (Register) */
    .btn-register {
      background-color: transparent;
      border: 2px solid rgba(255, 255, 255, 0.5); /* Dibuat 2px agar tebalnya sama */
      color: #fff;
      animation-delay: 0.8s;
    }

    .btn-register:hover {
      background-color: rgba(255, 255, 255, 0.1);
      border-color: #fff;
    }

    /* === Alert & Links === */
    .alert-danger {
      background-color: rgba(220, 53, 69, 0.3);
      border: 1px solid rgba(220, 53, 69, 0.5);
      color: #fff;
      border-radius: 8px;
      padding: 15px;
      margin-bottom: 25px;
    }

    .forgot-password {
      text-align: center;
      margin-top: 25px;
      opacity: 0;
      animation: fadeIn 0.5s ease-out 0.9s forwards;
    }

    .forgot-password a {
      color: rgba(255, 255, 255, 0.8);
      text-decoration: none;
      transition: color 0.3s ease;
      font-size: 14px;
    }

    .forgot-password a:hover {
      color: #fff;
      text-decoration: underline;
    }

    .footer-text {
      text-align: center;
      margin-top: 30px;
      color: rgba(255, 255, 255, 0.6);
      font-size: 13px;
      opacity: 0;
      animation: fadeIn 0.5s ease-out 1s forwards;
    }

    /* === Animations === */
    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }

    @keyframes slideUp {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    /* Responsive adjustments */
    @media (max-width: 576px) {
      .login-card { padding: 30px 20px; }
      .logo { width: 70px; height: 70px; font-size: 28px; }
    }
  </style>
</head>
<body>
  <div class="login-container">
    <div class="login-card">
      <div class="logo-container">
        <div class="logo">
          <i class="fas fa-brain"></i>
        </div>
        <h1 class="logo-text">SPK Login</h1>
        <p class="logo-subtext">Sistem Pendukung Keputusan</p>
      </div>

      <form action="{{ route('proseslogin') }}" method="POST">
        @csrf

        @if ($errors->any())
          <div class="alert alert-danger">
            {{ $errors->first() }}
          </div>
        @endif

        <div class="form-group">
          <input type="text" class="form-control" name="nim" placeholder="Nomor Induk Mahasiswa" value="{{ old('nim') }}" required>
          <i class="fas fa-user input-icon"></i>
        </div>

        <div class="form-group">
          <input type="password" class="form-control" name="password" placeholder="Password" required>
          <i class="fas fa-lock input-icon"></i>
        </div>

        <div class="d-grid gap-3">
          <button type="submit" class="btn btn-login">
            <i class="fas fa-sign-in-alt me-2"></i> Masuk
          </button>
          <a href="{{ route('register.user') }}" class="btn btn-register">
            Buat Akun Baru
          </a>
        </div>
      </form>


      <div class="footer-text">
        &copy; 2025 SPK. All rights reserved.
      </div>
    </div>
  </div>
</body>
</html>
