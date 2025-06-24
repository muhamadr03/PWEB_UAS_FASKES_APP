@extends('layouts.app_public')

@section('content')
{{-- Hero Section --}}
<section class="py-5 bg-hero-gradient text-white d-flex align-items-center min-vh-100">
    <div class="container text-center animate__animated animate__fadeInDown">
        <h1 class="display-3 fw-bold text-shadow-md mb-4">
            Selamat Datang di <br><span class="text-warning">Direktori Fasilitas Kesehatan</span>
        </h1>
        <p class="lead mb-5 text-shadow-md">
            Jelajahi ribuan fasilitas kesehatan, klinik, dan rumah sakit di seluruh Indonesia. Temukan yang terbaik, tepat di ujung jari Anda.
        </p>
        <div class="d-grid gap-3 d-sm-flex justify-content-sm-center animate__animated animate__zoomIn animate__delay-1s">
            <a class="btn btn-primary btn-lg rounded-pill px-5 py-3 shadow-sm-sm" href="{{ route('faskes.index') }}" role="button">
                <i class="bi bi-search me-2"></i> Jelajahi Faskes Sekarang
            </a>
            <a class="btn btn-outline-light btn-lg rounded-pill px-5 py-3 shadow-sm-sm ms-sm-3" href="#about-us-section" role="button">
                <i class="bi bi-info-circle me-2"></i> Pelajari Lebih Lanjut
            </a>
        </div>
    </div>
</section>

{{-- Section Tentang Website Ini (Fitur Unggulan) --}}
<section class="py-5" id="about-us-section" style="background: linear-gradient(135deg, rgba(204, 255, 229, 0.3) 0%, rgba(179, 229, 252, 0.3) 100%);">
    <div class="container py-4">
        <h2 class="display-5 text-center fw-bold text-dark mb-5 animate__animated animate__fadeInUp">
            <span class="text-primary">Tentang</span> Direktori Faskes Indonesia
        </h2>
        <p class="lead text-center text-secondary mb-5 animate__animated animate__fadeInUp animate__delay-0.2s">
            Platform ini hadir sebagai solusi terpadu untuk memudahkan masyarakat Indonesia dalam menemukan informasi detail mengenai berbagai fasilitas kesehatan. Misi kami adalah menyediakan akses yang cepat, akurat, dan komprehensif ke data rumah sakit, klinik, puskesmas, dan apotek di seluruh pelosok negeri.
        </p>
        <div class="row text-center g-4 animate__animated animate__fadeInUp animate__delay-0.4s">
            <div class="col-md-4">
                <div class="card h-100 shadow-lg border-0 rounded-4 p-4 card-hover bg-white">
                    <div class="card-body">
                        <i class="bi bi-hospital-fill fs-1 text-info mb-4"></i>
                        <h5 class="fw-bold mb-3">Informasi Terstruktur</h5>
                        <p class="text-muted mb-0">Kami mengumpulkan dan menyajikan data fasilitas kesehatan secara terstruktur, termasuk alamat lengkap, nomor telepon, jenis layanan, dan kategori spesialisasi.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow-lg border-0 rounded-4 p-4 card-hover bg-white">
                    <div class="card-body">
                        <i class="bi bi-geo-alt-fill fs-1 text-success mb-4"></i>
                        <h5 class="fw-bold mb-3">Pencarian Berbasis Lokasi</h5>
                        <p class="text-muted mb-0">Temukan fasilitas kesehatan terdekat dengan fitur pencarian berdasarkan lokasi geografis, memudahkan Anda dalam kondisi darurat maupun kebutuhan rutin.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow-lg border-0 rounded-4 p-4 card-hover bg-white">
                    <div class="card-body">
                        <i class="bi bi-search fs-1 text-primary mb-4"></i>
                        <h5 class="fw-bold mb-3">Filter dan Kategorisasi</h5>
                        <p class="text-muted mb-0">Saring hasil pencarian berdasarkan jenis fasilitas kesehatan, kategori layanan, atau kata kunci tertentu untuk menemukan informasi yang paling relevan bagi Anda.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mt-5 animate__animated animate__fadeInUp animate__delay-0.6s">
            <div class="col-lg-8 text-center">
                <p class="text-secondary">
                    Dengan Direktori Faskes Indonesia, kami berharap dapat meningkatkan transparansi dan aksesibilitas informasi kesehatan, membantu Anda membuat keputusan yang lebih baik untuk kesejahteraan diri dan keluarga. Jelajahi sekarang dan temukan fasilitas kesehatan terbaik di sekitar Anda!
                </p>
            </div>
        </div>
    </div>
</section>

{{-- Section Tim Pengembang --}}
<section class="py-5 bg-white border-top">
    <div class="container py-4">
        <h2 class="display-5 text-center fw-bold text-dark mb-5 animate__animated animate__fadeInUp">
            <span class="text-info">Tim</span> Pengembang Kami
        </h2>
        <div class="row g-4 justify-content-center animate__animated animate__fadeInUp animate__delay-0.5s">

            {{-- Anggota 1 --}}
            <div class="col-md-3 col-sm-6 text-center">
                <div class="card h-100 shadow-sm border-0 rounded-4 p-3 card-hover">
                    <img src="https://via.placeholder.com/180/007bff/FFFFFF?text=Rizky" class="rounded-circle mb-3 mx-auto shadow-sm" alt="Rizky Ramadhan" width="180" height="180">
                    <h5 class="fw-bold mb-1">Muhamad Rojali</h5>
                    <p class="text-muted small mb-3">Ketua</p>
                    <div class="d-flex justify-content-center gap-3">
                        <a href="https://github.com/rizkyramadhan" target="_blank" class="text-dark social-icon-hover"><i class="bi bi-github fs-4"></i></a>
                        <a href="https://instagram.com/rizkyramadhan" target="_blank" class="text-danger social-icon-hover"><i class="bi bi-instagram fs-4"></i></a>
                        <a href="https://wa.me/6281234567890" target="_blank" class="text-success social-icon-hover"><i class="bi bi-whatsapp fs-4"></i></a>
                        <a href="https://linkedin.com/in/rizkyramadhan" target="_blank" class="text-primary social-icon-hover"><i class="bi bi-linkedin fs-4"></i></a>
                    </div>
                </div>
            </div>

            {{-- Anggota 2 --}}
            <div class="col-md-3 col-sm-6 text-center">
                <div class="card h-100 shadow-sm border-0 rounded-4 p-3 card-hover">
                    <img src="https://via.placeholder.com/180/17a2b8/FFFFFF?text=Maulana" class="rounded-circle mb-3 mx-auto shadow-sm" alt="Maulana Rafi" width="180" height="180">
                    <h5 class="fw-bold mb-1">Muhamad Bili Gunawan</h5>
                    <p class="text-muted small mb-3">Anggota</p>
                    <div class="d-flex justify-content-center gap-3">
                        <a href="https://github.com/maulanarafi" target="_blank" class="text-dark social-icon-hover"><i class="bi bi-github fs-4"></i></a>
                        <a href="https://instagram.com/maulanarafi" target="_blank" class="text-danger social-icon-hover"><i class="bi bi-instagram fs-4"></i></a>
                        <a href="https://wa.me/6281234567891" target="_blank" class="text-success social-icon-hover"><i class="bi bi-whatsapp fs-4"></i></a>
                        <a href="https://linkedin.com/in/maulanarafi" target="_blank" class="text-primary social-icon-hover"><i class="bi bi-linkedin fs-4"></i></a>
                    </div>
                </div>
            </div>

            {{-- Anggota 3 --}}
            <div class="col-md-3 col-sm-6 text-center">
                <div class="card h-100 shadow-sm border-0 rounded-4 p-3 card-hover">
                    <img src="https://via.placeholder.com/180/28a745/FFFFFF?text=Dewi" class="rounded-circle mb-3 mx-auto shadow-sm" alt="Dewi Anjani" width="180" height="180">
                    <h5 class="fw-bold mb-1">Linda Agistina Handani</h5>
                    <p class="text-muted small mb-3">Anggota</p>
                    <div class="d-flex justify-content-center gap-3">
                        <a href="https://github.com/dewi.anjani" target="_blank" class="text-dark social-icon-hover"><i class="bi bi-github fs-4"></i></a>
                        <a href="https://instagram.com/dewi.anjani" target="_blank" class="text-danger social-icon-hover"><i class="bi bi-instagram fs-4"></i></a>
                        <a href="https://wa.me/6281234567892" target="_blank" class="text-success social-icon-hover"><i class="bi bi-whatsapp fs-4"></i></a>
                        <a href="https://linkedin.com/in/dewi.anjani" target="_blank" class="text-primary social-icon-hover"><i class="bi bi-linkedin fs-4"></i></a>
                    </div>
                </div>
            </div>

            {{-- Anggota 4 --}}
            <div class="col-md-3 col-sm-6 text-center">
                <div class="card h-100 shadow-sm border-0 rounded-4 p-3 card-hover">
                    <img src="https://via.placeholder.com/180/ffc107/FFFFFF?text=Fikri" class="rounded-circle mb-3 mx-auto shadow-sm" alt="Fikri Alamsyah" width="180" height="180">
                    <h5 class="fw-bold mb-1">Shifa Nur Fauziyyah</h5>
                    <p class="text-muted small mb-3">Anggota</p>
                    <div class="d-flex justify-content-center gap-3">
                        <a href="https://github.com/ShifaFzyh" target="_blank" class="text-dark social-icon-hover"><i class="bi bi-github fs-4"></i></a>
                        <a href="www.instagram.com/shaa.nur_05" target="_blank" class="text-danger social-icon-hover"><i class="bi bi-instagram fs-4"></i></a>
                        <a href="https://www.linkedin.com/in/shifa-nur-fauziyyah-977a5532b/" target="_blank" class="text-primary social-icon-hover"><i class="bi bi-linkedin fs-4"></i></a>
                    </div>
                </div>
            </div>

            {{-- Anggota 5 --}}
            <div class="col-md-3 col-sm-6 text-center mt-4 mx-auto">
                <div class="card h-100 shadow-sm border-0 rounded-4 p-3 card-hover">
                    <img src="https://via.placeholder.com/180/6c757d/FFFFFF?text=Nabila" class="rounded-circle mb-3 mx-auto shadow-sm" alt="Nabila Syafira" width="180" height="180">
                    <h5 class="fw-bold mb-1">Riza Alfira Nasution</h5>
                    <p class="text-muted small mb-3">Anggota</p>
                    <div class="d-flex justify-content-center gap-3">
                        <a href="https://github.com/nabilasyafira" target="_blank" class="text-dark social-icon-hover"><i class="bi bi-github fs-4"></i></a>
                        <a href="https://instagram.com/nabilasyafira" target="_blank" class="text-danger social-icon-hover"><i class="bi bi-instagram fs-4"></i></a>
                        <a href="https://wa.me/6281234567894" target="_blank" class="text-success social-icon-hover"><i class="bi bi-whatsapp fs-4"></i></a>
                        <a href="https://linkedin.com/in/nabilasyafira" target="_blank" class="text-primary social-icon-hover"><i class="bi bi-linkedin fs-4"></i></a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- Section Ulasan Pengunjung --}}
<section class="py-5 bg-light border-top">
    <div class="container py-4">
        <h2 class="display-5 text-center fw-bold text-dark mb-5 animate__animated animate__fadeInUp">
            Apa Kata Mereka? <span class="text-success">Ulasan Pengunjung</span>
        </h2>
        <div class="row g-4 animate__animated animate__fadeInUp animate__delay-0.5s">

            {{-- Ulasan 1 --}}
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0 rounded-4 p-4 card-hover">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <img src="https://via.placeholder.com/60/007bff/FFFFFF?text=AP" class="rounded-circle me-3 shadow-sm" alt="Andi Pratama" width="60" height="60">
                            <div>
                                <h5 class="card-title mb-0 fw-bold">Sayyed Muhammad</h5>
                                <small class="text-muted">Pengguna Aktif</small>
                            </div>
                        </div>
                        <div class="mb-3 text-warning fs-5">
                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star"></i>
                        </div>
                        <p class="card-text text-muted fst-italic">"Website ini sangat membantu saya menemukan puskesmas terdekat saat keadaan darurat. Tampilannya juga simpel dan mudah dipahami."</p>
                    </div>
                </div>
            </div>

            {{-- Ulasan 2 --}}
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0 rounded-4 p-4 card-hover">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <img src="https://via.placeholder.com/60/17a2b8/FFFFFF?text=SM" class="rounded-circle me-3 shadow-sm" alt="Siti Marlina" width="60" height="60">
                            <div>
                                <h5 class="card-title mb-0 fw-bold">Faturahman</h5>
                                <small class="text-muted">Bapak Rumah Tangga</small>
                            </div>
                        </div>
                        <div class="mb-3 text-warning fs-5">
                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                        </div>
                        <p class="card-text text-muted fst-italic">"Sangat lengkap! Fitur pencariannya membantu sekali untuk tahu klinik dan apotek mana yang buka 24 jam."</p>
                    </div>
                </div>
            </div>

            {{-- Ulasan 3 --}}
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0 rounded-4 p-4 card-hover">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <img src="https://via.placeholder.com/60/28a745/FFFFFF?text=BN" class="rounded-circle me-3 shadow-sm" alt="Bagus Nugroho" width="60" height="60">
                            <div>
                                <h5 class="card-title mb-0 fw-bold">Bagus Nugroho</h5>
                                <small class="text-muted">Pelajar</small>
                            </div>
                        </div>
                        <div class="mb-3 text-warning fs-5">
                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star"></i>
                        </div>
                        <p class="card-text text-muted fst-italic">"Web ini cocok banget untuk warga daerah yang kesulitan akses informasi faskes. Semoga terus dikembangkan dan semakin banyak datanya."</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection