<section class="sambutan-section py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-4">Sambutan Kepala Sekolah</h2>

        @forelse($kepalaSekolah as $data)
        <div class="row align-items-center">
            <!-- Foto -->
            <div class="col-md-4 mb-4 mb-md-0">
                @if($data->foto)
                <img src="{{ asset('storage/' . $data->foto) }}" alt="{{ $data->nama }}" class="img-fluid rounded shadow">
                @else
                <div class="bg-secondary rounded d-flex align-items-center justify-content-center" style="height: 400px;">
                    <i class="fas fa-user fa-5x text-white"></i>
                </div>
                @endif
            </div>

            <!-- Sambutan -->
            <div class="col-md-8">
                <h4 class="mb-2">{{ $data->nama }}</h4>
                <p class="text-muted mb-3">Kepala Sekolah</p>
                <p class="text-justify">{{ $data->sambutan }}</p>
                <a href="{{ route('sambutan') }}" class="btn btn-primary btn-sm">Baca Selengkapnya</a>
            </div>
        </div>
        @empty
        <div class="alert alert-info text-center">
            <i class="fas fa-info-circle me-2"></i>Sambutan kepala sekolah belum tersedia
        </div>
        @endforelse
    </div>
</section>