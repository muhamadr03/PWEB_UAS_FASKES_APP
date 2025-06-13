@extends('layouts.app_public') {{-- Menggunakan layout master app_public --}}

@section('content') {{-- Bagian konten dari layout --}}
<div class="container py-4">
    <h1 class="mb-4 text-center">Direktori Fasilitas Kesehatan</h1>

    <form action="{{ route('faskes.search') }}" method="GET" class="mb-5 p-4 border rounded bg-light">
        <div class="row g-3">
            <div class="col-md-4">
                <label for="keyword" class="form-label visually-hidden">Cari Faskes</label>
                <input type="text" name="keyword" id="keyword" class="form-control" placeholder="Cari nama atau alamat faskes..." value="{{ request('keyword') }}">
            </div>
            <div class="col-md-3">
                <label for="provinsi_id" class="form-label visually-hidden">Pilih Provinsi</label>
                <select name="provinsi_id" id="provinsi_id" class="form-select">
                    <option value="">-- Pilih Provinsi --</option>
                    @foreach ($provinsis as $provinsi)
                        <option value="{{ $provinsi->id }}" {{ request('provinsi_id') == $provinsi->id ? 'selected' : '' }}>
                            {{ $provinsi->nama }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="jenis_faskes_id" class="form-label visually-hidden">Pilih Jenis Faskes</label>
                <select name="jenis_faskes_id" id="jenis_faskes_id" class="form-select">
                    <option value="">-- Pilih Jenis Faskes --</option>
                    @foreach ($jenisFaskes as $jenis)
                        <option value="{{ $jenis->id }}" {{ request('jenis_faskes_id') == $jenis->id ? 'selected' : '' }}>
                            {{ $jenis->nama }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Cari</button>
            </div>
        </div>
    </form>

    @if(session('error')) {{-- Menampilkan pesan error dari controller --}}
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="row">
        {{-- Loop melalui data faskes yang diterima dari controller --}}
        @forelse ($faskes as $item)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-primary">{{ $item->nama }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">{{ $item->jenisFaskes->nama }} - {{ $item->kategori->nama }}</h6>
                        <p class="card-text mb-1"><i class="bi bi-geo-alt-fill"></i> {{ $item->alamat }}</p>
                        <p class="card-text"><small class="text-secondary">{{ $item->kabkota->nama ?? 'N/A' }}, {{ $item->kabkota->provinsi->nama ?? 'N/A' }}</small></p>
                        @if($item->rating)
                            <p class="card-text">Rating: <span class="badge bg-warning text-dark">{{ $item->rating }} / 5</span></p>
                        @endif
                        @if($item->website)
                            <p class="card-text"><a href="{{ $item->website }}" target="_blank" class="text-decoration-none">Kunjungi Website</a></p>
                        @endif
                        {{-- Link ke halaman detail faskes (opsional) --}}
                        {{-- Jika Anda mengaktifkan rute faskes.show dan membuat faskes_detail.blade.php --}}
                        {{-- <a href="{{ route('faskes.show', $item->id) }}" class="btn btn-sm btn-outline-info mt-2">Lihat Detail</a> --}}
                    </div>
                </div>
            </div>
        @empty {{-- Jika tidak ada data faskes yang ditemukan --}}
            <div class="col-12">
                <p class="alert alert-warning text-center">Tidak ada fasilitas kesehatan ditemukan sesuai kriteria Anda.</p>
            </div>
        @endforelse
    </div>

    {{-- Menampilkan link paginasi --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $faskes->links('pagination::bootstrap-5') }}
    </div>

</div>
@endsection