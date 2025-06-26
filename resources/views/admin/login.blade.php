<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login | SPK Modern</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    /* Variabel CSS untuk kemudahan kustomisasi */
    :root {
      --primary-color: #0C91A6;
      --primary-hover: #0a7a8c;
      --bg-gradient-start: #0C91A6;
      --bg-gradient-end: #3a7bd5;
      --text-color: #ffffff;
      --placeholder-color: rgba(255, 255, 255, 0.7);
      --input-bg: rgba(255, 255, 255, 0.15);
      --input-border: rgba(255, 255, 255, 0.3);
      --input-focus-border: #0C91A6;
      --error-bg: rgba(220, 53, 69, 0.2);
      --error-border: rgba(220, 53, 69, 0.5);
    }

    /* Basic Reset */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      background: linear-gradient(135deg, var(--bg-gradient-start), var(--bg-gradient-end));
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      overflow: hidden; /* Mencegah scrollbar dari animasi */
    }

    /* Kontainer Login dengan Efek Glassmorphism */
    .login-container {
      width: 100%;
      max-width: 420px;
      padding: 40px;
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(20px);
      border-radius: 20px;
      border: 1px solid rgba(255, 255, 255, 0.2);
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
      animation: fadeInUp 0.8s ease-out;
    }

    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* Header/Logo */
    .login-header {
      text-align: center;
      margin-bottom: 25px;
    }

    .login-header a {
      color: var(--text-color);
      font-size: 2rem;
      font-weight: 600;
      text-decoration: none;
      text-shadow: 0 2px 4px rgba(0,0,0,0.2);
    }
    .login-header a b {
      font-weight: 700;
    }

    .login-subheader {
      text-align: center;
      color: var(--placeholder-color);
      font-size: 1rem;
      margin-bottom: 30px;
      font-weight: 300;
    }

    /* Styling Grup Input */
    .input-group {
      position: relative;
      margin-bottom: 25px;
    }

    .input-icon {
      position: absolute;
      left: 15px;
      top: 50%;
      transform: translateY(-50%);
      color: var(--placeholder-color);
      font-size: 1.1rem;
    }

    .form-control {
      width: 100%;
      background: var(--input-bg);
      border: 1px solid var(--input-border);
      border-radius: 12px;
      padding: 15px 15px 15px 50px; /* Padding kiri untuk ikon */
      color: var(--text-color);
      font-size: 1rem;
      font-weight: 400;
      transition: all 0.3s ease;
    }

    .form-control::placeholder {
      color: var(--placeholder-color);
      font-weight: 300;
    }

    .form-control:focus {
      outline: none;
      border-color: var(--input-focus-border);
      background: rgba(255, 255, 255, 0.2);
      box-shadow: 0 0 10px rgba(12, 145, 166, 0.5);
    }

    /* Ikon Tampilkan/Sembunyikan Password */
    #togglePassword {
      position: absolute;
      right: 15px;
      top: 50%;
      transform: translateY(-50%);
      color: var(--placeholder-color);
      cursor: pointer;
      font-size: 1.1rem;
    }

    /* Tombol Submit */
    .btn-submit {
      width: 100%;
      padding: 15px;
      background-color: var(--primary-color);
      border: none;
      border-radius: 12px;
      font-size: 1.1rem;
      color: var(--text-color);
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .btn-submit:hover {
      background-color: var(--primary-hover);
      transform: translateY(-3px);
      box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    }

    .btn-submit:active {
      transform: translateY(-1px);
      box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    }

    /* Pesan Error */
    .alert-danger {
      padding: 12px 15px;
      background-color: var(--error-bg);
      border: 1px solid var(--error-border);
      border-radius: 8px;
      color: var(--text-color);
      font-size: 0.9rem;
      margin-bottom: 20px;
    }
    .alert-danger ul {
      margin: 0;
      padding-left: 18px;
    }

    /* Link Daftar */
    .register-link {
      text-align: center;
      color: var(--placeholder-color);
      font-size: 0.9rem;
      margin-top: 25px;
    }
    .register-link a {
      color: var(--text-color);
      text-decoration: none;
      font-weight: 600;
    }
    .register-link a:hover {
      text-decoration: underline;
    }

  </style>
</head>
<body>

<div class="login-container">

  <div class="login-header">
    <a href="#"><b>Sistem</b> Pendukung Keputusan</a>
  </div>

  <p class="login-subheader">Silakan login untuk melanjutkan</p>

  <form action="{{ route('loginproses') }}" method="post">
    @csrf

    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <div class="input-group">
      <i class="fas fa-envelope input-icon"></i>
      <input type="email" class="form-control" name="email" placeholder="Email" required value="{{ old('email') }}">
    </div>

    <div class="input-group">
      <i class="fas fa-lock input-icon"></i>
      <input type="password" id="password" class="form-control" name="password" placeholder="Password" required>
      <i class="fas fa-eye-slash" id="togglePassword"></i>
    </div>

    <button type="submit" class="btn-submit">Masuk</button>

   
  </form>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
  $(document).ready(function() {
    $('#togglePassword').on('click', function() {
      // Dapatkan input password
      const passwordField = $('#password');
      const passwordFieldType = passwordField.attr('type');

      // Ganti ikon
      $(this).toggleClass('fa-eye-slash fa-eye');

      // Ganti tipe input
      if (passwordFieldType === 'password') {
        passwordField.attr('type', 'text');
      } else {
        passwordField.attr('type', 'password');
      }
    });
  });
</script>

</body>
</html>
