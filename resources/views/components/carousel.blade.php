<section class="carousel-section">
    <div id="carouselHomepage" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselHomepage" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#carouselHomepage" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#carouselHomepage" data-bs-slide-to="2"></button>
        </div>
        <div class="carousel-inner">
            @forelse($carousel as $item)
            <div class="carousel-item {{ $loop->first ? 'active' : '' }}" style="height: 500px;">
                <img src="{{ asset('storage/' . $item->gambar) }}" class="d-block w-100 h-100 object-cover" alt="{{ $item->deskripsi }}">
                <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50">
                    <h5 class="fs-3">{{ $item->deskripsi }}</h5>
                </div>
            </div>
            @empty
            <div class="carousel-item active" style="height: 500px;">
                <div class="bg-light d-flex align-items-center justify-content-center h-100">
                    <p class="text-muted">Carousel belum ada data</p>
                </div>
            </div>
            @endforelse
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselHomepage" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselHomepage" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>
</section>