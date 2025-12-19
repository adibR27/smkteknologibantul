@extends('layouts.app')

@section('title', 'Beranda - SMK Teknologi Bantul')

@section('content')
<!-- 1. Carousel -->
@include('components.carousel', ['carousel' => $carousel])

<!-- 2. Sambutan Kepala Sekolah -->
@include('components.sambutan-kepala-sekolah', ['kepalaSekolah' => $kepalaSekolah])

<!-- 3. Jurusan -->
<section class="jurusan-section py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2>Program Jurusan Kami</h2>
            <p class="text-muted">Pilih jurusan yang sesuai dengan minat dan bakat Anda</p>
        </div>

        <div class="row g-4">
            @forelse($jurusan as $item)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm hover-shadow-lg transition">
                    @if($item->gambar)
                    <img src="{{ asset('storage/' . $item->gambar) }}" class="card-img-top" alt="{{ $item->nama_jurusan }}" style="height: 250px; object-fit: cover;">
                    @else
                    <div class="bg-secondary d-flex align-items-center justify-content-center" style="height: 250px;">
                        <i class="fas fa-graduation-cap fa-3x text-white"></i>
                    </div>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->nama_jurusan }}</h5>
                        <p class="card-text text-muted small">{{ Str::limit($item->deskripsi, 100) }}</p>
                    </div>
                    <div class="card-footer bg-white border-top">
                        <a href="{{ route('jurusan.show', $item->id) }}" class="btn btn-sm btn-outline-primary">Lihat Detail</a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <i class="fas fa-info-circle me-2"></i>Belum ada data jurusan
                </div>
            </div>
            @endforelse
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('jurusan.index') }}" class="btn btn-primary">Lihat Semua Jurusan</a>
        </div>
    </div>
</section>

<!-- 4. Artikel Terbaru -->
<section class="artikel-section py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2>Artikel & Berita Terkini</h2>
            <p class="text-muted">Informasi terbaru dari SMK Teknologi Bantul</p>
        </div>

        <div class="row g-4">
            @forelse($artikel->take(3) as $item)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm hover-shadow-lg transition">
                    @if($item->gambar_utama)
                    <img src="{{ asset('storage/' . $item->gambar_utama) }}" class="card-img-top" alt="{{ $item->judul }}" style="height: 200px; object-fit: cover;">
                    @else
                    <div class="bg-secondary d-flex align-items-center justify-content-center" style="height: 200px;">
                        <i class="fas fa-newspaper fa-3x text-white"></i>
                    </div>
                    @endif
                    <div class="card-body">
                        <span class="badge bg-primary mb-2">{{ ucfirst($item->kategori) }}</span>
                        <h5 class="card-title">{{ $item->judul }}</h5>
                        <p class="card-text text-muted small">{{ Str::limit(strip_tags($item->konten), 100) }}</p>
                        <small class="text-muted">
                            <i class="fas fa-calendar me-1"></i>{{ $item->tanggal_publish?->format('d M Y') ?? 'Belum dipublikasi' }}
                        </small>
                    </div>
                    <div class="card-footer bg-white border-top">
                        <a href="{{ route('artikel.show', $item->slug) }}" class="btn btn-sm btn-outline-primary">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <i class="fas fa-info-circle me-2"></i>Belum ada artikel
                </div>
            </div>
            @endforelse
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('artikel.index') }}" class="btn btn-primary">Baca Semua Artikel</a>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section py-5 bg-primary text-white">
    <div class="container text-center">
        <h2 class="mb-4">Tertarik Bergabung dengan Kami?</h2>
        <p class="lead mb-4">Daftarkan diri Anda sekarang dan jadilah bagian dari SMK Teknologi Bantul</p>
        <a href="{{ route('kontak.index') }}" class="btn btn-light btn-lg">Hubungi Kami</a>
    </div>
</section>

<style>
    .hover-shadow-lg {
        transition: box-shadow 0.3s ease, transform 0.3s ease;
    }

    .hover-shadow-lg:hover {
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
        transform: translateY(-5px);
    }
</style>
@endsection