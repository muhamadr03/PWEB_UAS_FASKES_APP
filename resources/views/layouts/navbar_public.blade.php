<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container">
    <a class="navbar-brand" href="{{ url('/') }}">Direktori Faskes</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ms-auto">
    <li class="nav-item">
    <a class="nav-link" href="{{ url('/') }}">Home</a>
    </li>
    @guest {{-- Tampilkan jika pengguna belum login --}}
    <li class="nav-item">
    <a class="nav-link" href="{{ route('login') }}">Login</a>
    </li>
    {{-- Fitur Register biasanya tidak dibuka untuk user publik di proyek UAS --}}
    {{-- <li class="nav-item">
    <a class="nav-link" href="{{ route('register') }}">Register</a>
    </li> --}}
    @else {{-- Tampilkan jika pengguna sudah login --}}
    @if(Auth::user()->role === 'admin') {{-- Tampilkan link admin hanya jika role adalah admin --}}
    <li class="nav-item">
    <a class="nav-link" href="{{ url('/admin') }}">Admin Panel</a>
    </li>
    @endif
    <li class="nav-item dropdown">
    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
    {{ Auth::user()->name }}
    </a>
    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
    <a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a>
    <a class="dropdown-item" href="{{ route('logout') }}"
    onclick="event.preventDefault();
    document.getElementById('logout-form').submit();">
    Logout
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