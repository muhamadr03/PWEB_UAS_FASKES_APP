@extends('layouts.app_public')

@section('content')
<div class="container py-5">
    <div class="card shadow-lg p-4 mb-4 bg-white rounded-5 border-0 animate__animated animate__fadeIn">
        <div class="card-body">
            <a href="{{ route('faskes.index') }}" class="btn btn-outline-secondary btn-sm mb-4 rounded-pill px-3 py-2">
                <i class="bi bi-arrow-left me-2"></i> Kembali ke Daftar Faskes
            </a>

            <h1 class="display-5 fw-bold text-primary mb-4 pb-3 border-bottom border-primary-subtle">
                {{ $faskes->nama }}
            </h1>

            <div class="row mb-4 g-4"> {{-- Menggunakan g-4 untuk jarak antar kolom --}}
                <div class="col-md-6">
                    <h5 class="fw-bold text-dark mb-3"><i class="bi bi-info-circle-fill me-2 text-primary"></i> Detail Informasi</h5>
                    <p class="lead text-dark mb-2">
                        <i class="bi bi-building-fill me-2 text-info"></i>
                        <strong>Jenis:</strong> <span class="fw-semibold">{{ $faskes->jenisFaskes->nama }}</span>
                    </p>
                    <p class="lead text-dark mb-2">
                        <i class="bi bi-tags-fill me-2 text-success"></i>
                        <strong>Kategori:</strong> <span class="fw-semibold">{{ $faskes->kategori->nama }}</span>
                    </p>
                    <p class="text-secondary mb-2">
                        <i class="bi bi-geo-alt-fill me-2 text-primary"></i>
                        <strong>Alamat:</strong> {{ $faskes->alamat }}
                    </p>
                    <p class="text-secondary mb-2 ms-4 small">
                        {{ $faskes->kabkota->nama ?? 'N/A' }}, {{ $faskes->kabkota->provinsi->nama ?? 'N/A' }}
                    </p>

                    @if($faskes->nama_pengelola)
                        <p class="text-secondary mb-2">
                            <i class="bi bi-person-fill me-2 text-dark"></i>
                            <strong>Pengelola:</strong> {{ $faskes->nama_pengelola }}
                        </p>
                    @endif

                    @if($faskes->website)
                        <p class="text-secondary mb-2">
                            <i class="bi bi-globe me-2 text-info"></i>
                            <strong>Website:</strong> <a href="{{ $faskes->website }}" target="_blank" class="text-primary text-decoration-none fw-semibold">{{ $faskes->website }} <i class="bi bi-box-arrow-up-right small"></i></a>
                        </p>
                    @endif

                    @if($faskes->email)
                        <p class="text-secondary mb-2">
                            <i class="bi bi-envelope-fill me-2 text-info"></i>
                            <strong>Email:</strong> <a href="mailto:{{ $faskes->email }}" class="text-primary text-decoration-none fw-semibold">{{ $faskes->email }}</a>
                        </p>
                    @endif

                    @if($faskes->rating)
                        <p class="text-info fw-semibold mb-2">
                            <i class="bi bi-star-fill text-warning me-1"></i>
                            Rating: <span class="badge bg-warning text-dark rounded-pill ms-1 py-1 px-2">{{ $faskes->rating }} / 5</span>
                        </p>
                    @endif
                </div>

                {{-- Bagian Peta Spesifik Faskes --}}
                <div class="col-md-6">
                    <h5 class="fw-bold text-dark mb-3"><i class="bi bi-map-fill me-2 text-primary"></i> Informasi Lokasi</h5>
                    @if($faskes->latitude && $faskes->longitude)
                        <div class="alert alert-success text-center p-4 rounded-3 border-0 shadow-sm-sm animate__animated animate__fadeIn">
                            <p class="mb-2"><strong>Koordinat:</strong><br>{{ $faskes->latitude }}, {{ $faskes->longitude }}</p>
                            <a href="https://www.google.com/maps/search/?api=1&query={{ $faskes->latitude }},{{ $faskes->longitude }}&q={{ urlencode($faskes->nama) }}" target="_blank" class="btn btn-info btn-sm rounded-pill d-flex align-items-center justify-content-center mx-auto" style="max-width: 200px;">
                                <i class="bi bi-geo-alt-fill me-2"></i> Buka di Google Maps
                            </a>
                        </div>
                    @else
                        <div class="alert alert-info text-center mt-4 w-100 rounded-3">
                            <i class="bi bi-exclamation-circle-fill me-2"></i> Koordinat lokasi tidak tersedia untuk faskes ini.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection