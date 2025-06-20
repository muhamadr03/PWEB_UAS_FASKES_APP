@extends('layouts.app_public')

@section('content')
<section class="py-5 bg-light-blue-gradient min-vh-75 d-flex align-items-center"> {{-- min-vh-75 untuk tinggi minimal, d-flex & align-items-center untuk tengah --}}
    <div class="container py-5">
        <div class="row justify-content-center text-center mb-5">
            <div class="col-lg-10">
                <h1 class="display-3 fw-bold text-dark mb-4 animate__animated animate__fadeInDown">
                    Direktori Fasilitas Kesehatan Terkemuka
                </h1>
                <p class="lead text-secondary-dark mb-5 animate__animated animate__fadeInUp animate__delay-0.5s">
                    Jelajahi ribuan fasilitas kesehatan, klinik, dan rumah sakit di seluruh Indonesia. Temukan yang terbaik, tepat di ujung jari Anda.
                </p>
            </div>
        </div>

        {{-- Form Pencarian dan Filter --}}
        <div class="card shadow-lg p-4 p-md-5 bg-white rounded-5 border-0 animate__animated animate__zoomIn animate__delay-0.7s">
            <div class="card-body">
                <h5 class="card-title text-primary fw-bold mb-4 pb-3 border-bottom border-primary-subtle">
                    <i class="bi bi-search me-2 text-primary"></i> Temukan Faskes Pilihan Anda
                </h5>
                <form action="{{ route('faskes.search') }}" method="GET">
                    <div class="row g-4 align-items-end">

                        {{-- Kolom Keyword --}}
                        <div class="col-md-4">
                            <label for="keyword" class="form-label text-muted small mb-1">Cari berdasarkan Nama atau Alamat</label>
                            <div class="input-group input-group-lg shadow-sm-sm">
                                <span class="input-group-text bg-white border-primary text-primary rounded-start"><i class="bi bi-hospital-fill"></i></span>
                                <input type="text" name="keyword" id="keyword"
                                       class="form-control border-primary rounded-end focus-ring focus-ring-primary"
                                       placeholder="Cari faskes..." value="{{ request('keyword') }}">
                            </div>
                        </div>

                        {{-- Kolom Pilih Provinsi --}}
                        <div class="col-md-3">
                            <label for="provinsi_id" class="form-label text-muted small mb-1">Pilih Provinsi</label>
                            <select name="provinsi_id" id="provinsi_id"
                                    class="form-select form-select-lg border-primary shadow-sm-sm text-dark focus-ring focus-ring-primary">
                                <option value="">-- Semua Provinsi --</option>
                                @foreach ($provinsis as $provinsi)
                                    <option value="{{ $provinsi->id }}" {{ request('provinsi_id') == $provinsi->id ? 'selected' : '' }}>
                                        {{ $provinsi->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Kolom Pilih Jenis Faskes --}}
                        <div class="col-md-3">
                            <label for="jenis_faskes_id" class="form-label text-muted small mb-1">Pilih Jenis Faskes</label>
                            <select name="jenis_faskes_id" id="jenis_faskes_id"
                                    class="form-select form-select-lg border-primary shadow-sm-sm text-dark focus-ring focus-ring-primary">
                                <option value="">-- Semua Jenis --</option>
                                @foreach ($jenisFaskes as $jenis)
                                    <option value="{{ $jenis->id }}" {{ request('jenis_faskes_id') == $jenis->id ? 'selected' : '' }}>
                                        {{ $jenis->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Tombol Cari --}}
                        <div class="col-md-2">
                            <button type="submit"
                                    class="btn btn-primary btn-lg w-100 shadow-md d-flex align-items-center justify-content-center text-white rounded-pill animate__animated animate__pulse animate__infinite animate__delay-1s">
                                <i class="bi bi-search me-2"></i> Cari
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<div class="container py-5">
    {{-- Pesan Error/Peringatan --}}
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-5 animate__animated animate__fadeIn" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Daftar Kartu Faskes --}}
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @forelse ($faskes as $item)
            <div class="col">
                <div class="card h-100 shadow-lg border-0 rounded-4 overflow-hidden card-hover animate__animated animate__fadeInUp animate__delay-{{ $loop->index * 0.1 }}s"> {{-- Delay animasi per kartu --}}
                    <div class="card-header bg-gradient-primary text-white py-3 border-0">
                        <h5 class="mb-0 fw-bold">{{ $item->nama }}</h5>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h6 class="card-subtitle mb-3 text-muted small">
                            <i class="bi bi-building-fill me-1 text-info"></i> {{ $item->jenisFaskes->nama }}
                            <span class="mx-1 text-secondary">|</span>
                            <i class="bi bi-tags-fill me-1 text-success"></i> {{ $item->kategori->nama }}
                        </h6>

                        <p class="card-text text-dark mb-2">
                            <i class="bi bi-geo-alt-fill me-2 text-primary"></i> {{ $item->alamat }}
                        </p>
                        <p class="card-text text-black-50 mb-3 small ms-4">
                            {{ $item->kabkota->nama ?? 'N/A' }}, {{ $item->kabkota->provinsi->nama ?? 'N/A' }}
                        </p>

                        @if($item->rating)
                            <p class="card-text text-info fw-semibold mb-2">
                                <i class="bi bi-star-fill text-warning me-1"></i> Rating:
                                <span class="badge bg-warning text-dark rounded-pill ms-1 py-1 px-2">{{ $item->rating }} / 5</span>
                            </p>
                        @endif 

                        <div class="mt-auto pt-3 border-top d-flex justify-content-between align-items-center">
                            <div>
                                @if($item->website)
                                    <a href="{{ $item->website }}" target="_blank" class="card-link btn btn-outline-primary btn-sm rounded-pill d-flex align-items-center justify-content-center px-3 py-2">
                                        <i class="bi bi-globe me-2"></i> Website
                                    </a>
                                @endif
                            </div>
                            <div class="d-flex">
                                <a href="{{ route('faskes.show', $item->id) }}"
                                   class="btn btn-primary btn-sm rounded-pill d-flex align-items-center justify-content-center px-3 py-2">
                                    <i class="bi bi-info-circle-fill me-2"></i> Detail
                                </a>
                                @if($item->latitude && $item->longitude)
                                    <a href="https://www.google.com/maps/search/?api=1&query={{ $item->latitude }},{{ $item->longitude }}&q={{ urlencode($item->nama) }}" target="_blank"
                                       class="btn btn-outline-info btn-sm rounded-pill d-flex align-items-center justify-content-center px-3 py-2 ms-2">
                                        <i class="bi bi-map-fill me-2"></i> Peta
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-warning text-center p-4 rounded-4 border-0 shadow-sm animate__animated animate__fadeIn" role="alert">
                    <h4 class="alert-heading"><i class="bi bi-exclamation-circle-fill me-2"></i>Ups, Tidak Ditemukan!</h4>
                    <p class="mb-0">Tidak ada fasilitas kesehatan yang cocok dengan kriteria pencarian Anda. Coba filter lainnya.</p>
                </div>
            </div>
        @endforelse
    </div>

    {{-- Menampilkan link paginasi --}}
    <div class="d-flex justify-content-center mt-5 animate__animated animate__fadeInUp">
        {{ $faskes->links('pagination::bootstrap-5') }}
    </div>

</div>
@endsection