<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-3 fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand fw-bold fs-4 text-primary animate__animated animate__fadeInLeft" href="{{ route('welcome') }}">
            Direktori <span class="text-info">Faskes</span>
        </a>
        <button class="navbar-toggler animate__animated animate__fadeInRight" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto py-2 py-lg-0">
                <li class="nav-item me-lg-3">
                    <a class="nav-link px-3 active" href="{{ route('welcome') }}">Home</a>
                </li>
                <li class="nav-item me-lg-3">
                    <a class="nav-link px-3" href="{{ route('faskes.index') }}">Daftar Faskes</a>
                </li>
                <li class="nav-item me-lg-3">
                    <a class="nav-link px-3" href="{{ route('welcome') }}#about-us-section">Tentang Kami</a> {{-- <<< UBAH INI --}}
                </li>
                @guest
                    <li class="nav-item ms-lg-3">
                        <a class="btn btn-primary rounded-pill px-4 py-2 text-white shadow-sm" href="{{ route('login') }}">
                            <i class="bi bi-person-circle me-2"></i> Login
                        </a>
                    </li>
                    {{-- Tambahkan tombol Register di sini --}}
                    @if (Route::has('register'))
                        <li class="nav-item ms-2">
                            <a class="btn btn-outline-primary rounded-pill px-4 py-2 shadow-sm" href="{{ route('register') }}">
                                <i class="bi bi-person-plus-fill me-2"></i> Register
                            </a>
                        </li>
                    @endif
                @else
                    {{-- Item navigasi untuk user biasa atau admin --}}
                    @if(Auth::user()->role === 'admin')
                        <li class="nav-item ms-lg-3">
                            <a class="btn btn-info rounded-pill px-4 py-2 text-white shadow-sm" href="{{ url('/admin') }}">
                                <i class="bi bi-gear-fill me-2"></i> Admin Panel
                            </a>
                        </li>
                    @endif
                    <li class="nav-item dropdown ms-lg-3">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-dark fw-semibold" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <i class="bi bi-person-fill me-2"></i> {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="bi bi-person-circle me-2"></i> Profile</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right me-2"></i> Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

{{-- Padding atas untuk Fixed Navbar --}}
<div style="height: 72px;"></div>

{{-- Script untuk efek navbar saat scroll --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mainNav = document.getElementById('mainNav');
        if (mainNav) {
            window.addEventListener('scroll', function() {
                if (window.scrollY > 50) { // Setelah scroll 50px
                    mainNav.classList.add('navbar-scrolled');
                } else {
                    mainNav.classList.remove('navbar-scrolled');
                }
            });
        }
    });
</script>