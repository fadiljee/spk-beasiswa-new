<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register | Sistem Pendukung Keputusan</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap">
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">

  <style>
    /* === Base & Background === */
    body {
      font-family: 'Poppins', sans-serif;
      /* Gradient Background */
      background: linear-gradient(135deg, #1d2b64 0%, #0C91A6 100%);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
      overflow: hidden; /* Mencegah scroll pada body */
    }

    /* === Login Box & Animation === */
    .register-box {
      width: 100%;
      max-width: 450px; /* Sedikit lebih lebar untuk kenyamanan */
      animation: fadeInUp 0.8s ease-out;
    }

    @keyframes fadeInUp {
      from { transform: translateY(40px); opacity: 0; }
      to { transform: translateY(0); opacity: 1; }
    }

    /* === Glassmorphism Card Effect === */
    .card {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px); /* For Safari */
      border-radius: 20px;
      border: 1px solid rgba(255, 255, 255, 0.2);
      box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
      overflow: hidden; /* Penting untuk border-radius */
    }

    .card-body {
      padding: 40px;
      color: #fff;
    }

    /* === Header/Title === */
    .register-logo {
      text-align: center;
      margin-bottom: 25px;
    }

    .register-logo h2 {
      margin: 0;
      font-weight: 700;
      font-size: 2.2rem;
      color: #fff;
      text-shadow: 0 2px 4px rgba(0,0,0,0.2);
    }

    .register-box-msg {
      color: rgba(255, 255, 255, 0.8);
      margin-bottom: 30px;
      font-size: 1rem;
    }

    /* === Modern Input Fields === */
    .input-group .form-control {
      background: rgba(255, 255, 255, 0.15);
      border: 1px solid rgba(255, 255, 255, 0.3);
      color: #fff;
      border-radius: 8px !important;
      transition: all 0.3s ease;
    }

    .input-group .form-control:focus {
      background: rgba(255, 255, 255, 0.25);
      border-color: #fff;
      box-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
    }

    .input-group .form-control::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
      color: rgba(255, 255, 255, 0.7);
      opacity: 1; /* Firefox */
    }

    .input-group-text {
      background: transparent;
      border: none;
      color: #fff;
    }

    /* === Action Buttons === */
    .btn {
      border-radius: 8px;
      padding: 10px;
      font-weight: 600;
      transition: all 0.3s ease;
    }

    /* Primary Button (Register) */
    .btn-primary {
      background-color: #ffffff;
      border-color: #ffffff;
      color: #0C91A6;
    }

    .btn-primary:hover {
      background-color: #f0f0f0;
      border-color: #f0f0f0;
      color: #0b7d8f;
      transform: translateY(-2px);
      box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }

    /* Secondary Button (Back) */
    .btn-secondary {
      background-color: transparent;
      border: 1px solid rgba(255, 255, 255, 0.5);
      color: #fff;
    }

    .btn-secondary:hover {
      background-color: rgba(255, 255, 255, 0.1);
      border-color: #fff;
    }

    /* === Error Alert Styling === */
    .alert-danger {
      background-color: rgba(220, 53, 69, 0.3);
      border: 1px solid rgba(220, 53, 69, 0.5);
      color: #fff;
      border-radius: 8px;
    }
    .alert-danger ul {
      margin: 0;
      padding-left: 20px;
    }

  </style>
</head>
<body class="hold-transition">
<div class="register-box">

  <div class="card">
    <div class="card-body">
      <div class="register-logo">
        <h2><b>Buat Akun</b></h2>
      </div>
      <p class="register-box-msg text-center">Silakan isi data diri Anda</p>

      <form action="{{ route('registerproses') }}" method="POST">
        @csrf

        @if ($errors->any())
          <div class="alert alert-danger mb-3">
            <ul class="mb-0">
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <div class="input-group mb-3">
          <input type="text" class="form-control" name="nama" placeholder="Nama Lengkap" value="{{ old('nama') }}" required>
          <div class="input-group-append">
            <div class="input-group-text"><span class="fas fa-user"></span></div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="text" class="form-control" name="nim" placeholder="NIM" value="{{ old('nim') }}" required>
          <div class="input-group-append">
            <div class="input-group-text"><span class="fas fa-id-card"></span></div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}" required>
          <div class="input-group-append">
            <div class="input-group-text"><span class="fas fa-envelope"></span></div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="text" class="form-control" name="jurusan" placeholder="Jurusan" value="{{ old('jurusan') }}" required>
          <div class="input-group-append">
            <div class="input-group-text"><span class="fas fa-book"></span></div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text"><span class="fas fa-lock"></span></div>
          </div>
        </div>

        <div class="input-group mb-4">
          <input type="password" class="form-control" name="password_confirmation" placeholder="Konfirmasi Password" required>
          <div class="input-group-append">
            <div class="input-group-text"><span class="fas fa-lock"></span></div>
          </div>
        </div>

        <div class="row mt-4">
          <div class="col-6">
            <a href="{{ route('loginuser') }}" class="btn btn-secondary btn-block">Kembali</a>
          </div>
          <div class="col-6">
            <button type="submit" class="btn btn-primary btn-block">Daftar</button>
          </div>
        </div>
      </form>

    </div>
    </div>
  </div>
<script src="../../plugins/jquery/jquery.min.js"></script>
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../dist/js/adminlte.min.js"></script>
</body>
</html>
