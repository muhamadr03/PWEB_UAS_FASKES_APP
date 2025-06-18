<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Direktori Fasilitas Kesehatan</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <link rel="stylesheet" href="{{ asset('css/custom-landing-styles.css') }}">
    @stack('styles')
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f2f5; /* Latar belakang lebih netral */
        }
    </style>
</head>
<body>

    @include('layouts.navbar_public')

    <main> {{-- Hapus py-4 karena padding sudah diatur di masing-masing section --}}
        @yield('content')
    </main>

    <footer class="bg-dark text-white py-4 mt-auto"> {{-- mt-auto untuk push footer ke bawah --}}
        <div class="container text-center">
            <div class="row">
                <div class="col-md-6 mb-3 mb-md-0">
                    <h5 class="fw-bold text-primary">Direktori Faskes</h5>
                    <p class="text-secondary small">Temukan fasilitas kesehatan dengan mudah.</p>
                </div>
                <div class="col-md-6">
                    <h5 class="fw-bold text-primary">Hubungi Kami</h5>
                    <ul class="list-unstyled small text-secondary">
                        <li>Email: info@faskes.com</li>
                        <li>Telepon: (021) 123-4567</li>
                    </ul>
                </div>
            </div>
            <hr class="border-secondary my-3">
            <p class="mb-0 text-secondary small">&copy; {{ date('Y') }} Direktori Faskes. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    @stack('scripts')
</body>
</html>