<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Direktori Faskes</title>

    <!-- Google Fonts: Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <!-- CSS Kustom Anda (custom-landing-styles.css) -->
    <link rel="stylesheet" href="{{ asset('css/custom-landing-styles.css') }}">

    <style>
        /* Gaya dasar untuk body, memastikan terpusat dan tidak scroll */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f2f5;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            overflow: hidden;
            background: linear-gradient(to right, #e0f7fa, #bbdefb); /* Background gradien biru muda */
        }
        /* Penyesuaian agar tidak tertekan (gepeng) dan lebih kecil */
        .card {
            max-width: 400px; /* Perkecil lebar maksimal card */
            width: 90%; /* Ambil lebar 90% dari container */
        }
        .card-body {
            padding: 2rem; /* Kurangi padding card body */
        }
        .text-center.mb-5 {
            margin-bottom: 2.5rem !important; /* Kurangi margin bottom judul */
        }
        .form-label {
            font-size: 0.9rem; /* Sedikit perkecil ukuran font label */
            margin-bottom: 0.1rem; /* Kurangi margin bottom label */
        }
        .input-group-lg > .form-control,
        .input-group-lg > .input-group-text {
            padding: 0.6rem 0.75rem; /* Sedikit kurangi padding input */
            font-size: 0.9rem; /* Sedikit kurangi ukuran font input */
            border-radius: 0.3rem; /* Sesuaikan border radius agar tidak terlalu besar */
        }
        .form-check-label {
            font-size: 0.85rem; /* Sedikit perkecil ukuran font remember me */
        }
        .btn-lg {
            padding: 0.7rem 1.25rem; /* Sedikit kurangi padding tombol */
            font-size: 1rem; /* Sedikit kurangi ukuran font tombol */
            border-radius: 0.35rem; /* Sesuaikan border radius tombol */
        }
        .text-muted.mt-4.mb-0 {
            margin-top: 1.5rem !important; /* Kurangi margin top teks bawah */
            font-size: 0.85rem; /* Sedikit perkecil ukuran font teks bawah */
        }
        .invalid-feedback {
            font-size: 0.8rem; /* Perkecil ukuran font pesan error */
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-5"> {{-- Ukuran kolom disesuaikan agar proporsional --}}
            <div class="card shadow-lg bg-white rounded-4 border-0 animate__animated animate__fadeInUp">
                <div class="card-body">
                    <div class="text-center mb-5">
                        <!-- Anda bisa menambahkan logo Faskes di sini jika ingin -->
                        <!-- <img src="{{ asset('images/logo/faskes_logo.png') }}" alt="Logo Faskes" class="mb-3" style="height: 60px;"> -->
                        <h2 class="card-title fw-bold text-dark display6 mb-2" style="font-size: 1.75rem;">Direktori <span class="text-primary">Faskes</span></h2>
                        <p class="text-muted lead mb-0" style="font-size: 0.9rem;">Selamat datang kembali! Silakan masuk.</p>
                    </div>

                    <!-- Session Status (Pesan dari server) -->
                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show mb-3 rounded-pill text-center" role="alert" style="font-size: 0.8rem;">
                            {{ session('status') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: 0.7rem;"></button>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show mb-3 rounded-pill text-center" role="alert" style="font-size: 0.8rem;">
                            <ul class="mb-0 list-unstyled">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="font-size: 0.7rem;"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email Address -->
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold text-muted">Email Address</label>
                            <div class="input-group input-group-md border-primary rounded-pill overflow-hidden shadow-sm-sm">
                                <span class="input-group-text bg-white border-0 text-primary" style="font-size: 0.9rem;"><i class="bi bi-envelope-fill"></i></span>
                                <input id="email" class="form-control border-0 @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="contoh@domain.com">
                            </div>
                            @error('email')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold text-muted">Password</label>
                            <div class="input-group input-group-md border-primary rounded-pill overflow-hidden shadow-sm-sm">
                                <span class="input-group-text bg-white border-0 text-primary" style="font-size: 0.9rem;"><i class="bi bi-lock-fill"></i></span>
                                <input id="password" class="form-control border-0 @error('password') is-invalid @enderror" type="password" name="password" required autocomplete="current-password" placeholder="••••••••">
                            </div>
                            @error('password')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Remember Me & Forgot Password -->
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember_me">
                                <label class="form-check-label text-sm text-muted" for="remember_me">
                                    Ingat Saya
                                </label>
                            </div>
                            @if (Route::has('password.request'))
                                <a class="text-decoration-none text-sm text-primary fw-semibold hover-underline" href="{{ route('password.request') }}">
                                    Lupa Password?
                                </a>
                            @endif
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid mt-3">
                            <button type="submit" class="btn btn-primary btn-md rounded-pill animate__animated animate__pulse animate__infinite shadow-sm">
                                Login
                            </button>
                        </div>

                        <p class="text-center text-muted mt-3 mb-0">
                            Belum punya akun? <a href="{{ route('register') }}" class="text-primary text-decoration-none fw-semibold">Daftar di sini.</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" xintegrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
