@extends('layouts.app')

@section('title', $jurusan->nama_jurusan . ' - ' . ($globalKonfigurasi->nama_sekolah ?? 'SMK Teknologi Bantul'))

@section('content')
    <!-- Breadcrumb -->
    <section class="bg-gradient-to-r from-gray-50 to-gray-100 py-4">
        <div class="container mx-auto px-4">
            <nav class="flex items-center space-x-2 text-sm text-gray-600">
                <a href="{{ route('home') }}" class="transition hover:text-blue-600">
                    <i class="fas fa-home"></i> Beranda
                </a>

                <i class="fas fa-chevron-right text-xs"></i>
                <span class="font-semibold text-blue-600">{{ $jurusan->nama_jurusan }}</span>
            </nav>
        </div>
    </section>

    <!-- Hero Section with Image -->
    <section class="relative overflow-hidden bg-gradient-to-br from-blue-900 via-blue-800 to-blue-700 py-20 text-white">
        <!-- Decorative Elements -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute -left-20 -top-20 h-64 w-64 rounded-full bg-white blur-3xl"></div>
            <div class="absolute -bottom-20 -right-20 h-80 w-80 rounded-full bg-white blur-3xl"></div>
        </div>

        <div class="container relative mx-auto px-4">
            <div class="grid grid-cols-1 items-center gap-12 lg:grid-cols-2">
                <!-- Text Content -->
                <div class="animate__animated animate__fadeInLeft space-y-6">
                    <div class="inline-block rounded-full bg-white/10 px-4 py-2 backdrop-blur-sm">
                        <span class="text-sm font-semibold">Program Keahlian</span>
                    </div>
                    <h1 class="text-4xl font-bold leading-tight md:text-5xl lg:text-6xl">
                        {{ $jurusan->nama_jurusan }}
                    </h1>
                    <p class="text-lg text-blue-100">
                        Bergabunglah dengan program keahlian yang mempersiapkan Anda untuk masa depan yang cerah
                    </p>
                    <div class="flex flex-wrap gap-4 pt-4">
                        <a href="#deskripsi"
                            class="inline-flex items-center rounded-lg bg-white px-8 py-4 font-semibold text-blue-600 shadow-lg transition hover:bg-blue-50 hover:shadow-xl">
                            <i class="fas fa-info-circle mr-2"></i>
                            Lihat Detail
                        </a>
                    </div>
                </div>

                <!-- Image -->
                <div class="animate__animated animate__fadeInRight">
                    @if ($jurusan->gambar)
                        <div class="relative">
                            <div class="absolute -inset-4 rounded-3xl bg-white/20 blur-2xl"></div>
                            <img src="{{ asset('storage/' . $jurusan->gambar) }}" alt="{{ $jurusan->nama_jurusan }}"
                                class="relative w-full rounded-2xl shadow-2xl ring-4 ring-white/20">
                        </div>
                    @else
                        <div class="flex h-96 w-full items-center justify-center rounded-2xl bg-white/10 backdrop-blur-sm">
                            <i class="fas fa-book text-9xl text-white opacity-30"></i>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section id="deskripsi" class="bg-white py-20">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 gap-12 lg:grid-cols-3">
                <!-- Main Content Area -->
                <div class="lg:col-span-2">
                    <!-- Deskripsi -->
                    <div class="mb-16">
                        <div class="mb-8 flex items-center gap-3">
                            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-100 text-blue-600">
                                <i class="fas fa-info-circle text-xl"></i>
                            </div>
                            <h2 class="text-3xl font-bold text-gray-800">
                                Deskripsi Jurusan
                            </h2>
                        </div>
                        <div class="prose prose-lg max-w-none leading-relaxed text-gray-700">
                            {!! $jurusan->deskripsi !!}
                        </div>
                    </div>

                    <!-- Fasilitas Jurusan -->
                    @if ($jurusan->fasilitas_jurusan)
                        <div
                            class="mb-16 overflow-hidden rounded-2xl bg-gradient-to-br from-blue-50 to-blue-100/50 p-8 shadow-sm">
                            <div class="mb-8 flex items-center gap-3">
                                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-600 text-white">
                                    <i class="fa-solid fa-gears text-xl"></i>
                                </div>
                                <h3 class="text-2xl font-bold text-gray-800">
                                    Fasilitas Jurusan
                                </h3>
                            </div>
                            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                @foreach (explode(',', $jurusan->fasilitas_jurusan) as $fasilitas)
                                    <div
                                        class="flex items-start space-x-3 rounded-lg bg-white p-4 shadow-sm transition hover:shadow-md">
                                        <div
                                            class="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-full bg-green-500 text-white">
                                            <i class="fas fa-check text-sm"></i>
                                        </div>
                                        <p class="flex-1 pt-1 font-medium text-gray-800">{{ trim($fasilitas) }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Prospek Karir -->
                    <div class="mb-16">
                        <div class="mb-8 flex items-center gap-3">
                            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-100 text-blue-600">
                                <i class="fas fa-briefcase text-xl"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-800">
                                Prospek Karir
                            </h3>
                        </div>
                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                            <div
                                class="group flex items-center space-x-4 rounded-xl border-2 border-gray-200 bg-white p-5 transition hover:border-blue-600 hover:shadow-lg">
                                <div
                                    class="flex h-14 w-14 items-center justify-center rounded-xl bg-blue-50 text-blue-600 transition group-hover:bg-blue-600 group-hover:text-white">
                                    <i class="fas fa-building text-2xl"></i>
                                </div>
                                <span class="font-semibold text-gray-700">Staff Perusahaan</span>
                            </div>
                            <div
                                class="group flex items-center space-x-4 rounded-xl border-2 border-gray-200 bg-white p-5 transition hover:border-blue-600 hover:shadow-lg">
                                <div
                                    class="flex h-14 w-14 items-center justify-center rounded-xl bg-blue-50 text-blue-600 transition group-hover:bg-blue-600 group-hover:text-white">
                                    <i class="fas fa-laptop-code text-2xl"></i>
                                </div>
                                <span class="font-semibold text-gray-700">Teknisi Profesional</span>
                            </div>
                            <div
                                class="group flex items-center space-x-4 rounded-xl border-2 border-gray-200 bg-white p-5 transition hover:border-blue-600 hover:shadow-lg">
                                <div
                                    class="flex h-14 w-14 items-center justify-center rounded-xl bg-blue-50 text-blue-600 transition group-hover:bg-blue-600 group-hover:text-white">
                                    <i class="fas fa-user-tie text-2xl"></i>
                                </div>
                                <span class="font-semibold text-gray-700">Wirausaha</span>
                            </div>
                            <div
                                class="group flex items-center space-x-4 rounded-xl border-2 border-gray-200 bg-white p-5 transition hover:border-blue-600 hover:shadow-lg">
                                <div
                                    class="flex h-14 w-14 items-center justify-center rounded-xl bg-blue-50 text-blue-600 transition group-hover:bg-blue-600 group-hover:text-white">
                                    <i class="fas fa-graduation-cap text-2xl"></i>
                                </div>
                                <span class="font-semibold text-gray-700">Melanjutkan Kuliah</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <!-- Share Social Media -->
                    <div class="sticky top-24 rounded-2xl bg-gradient-to-br from-gray-50 to-gray-100 p-6 shadow-md">
                        <h3 class="mb-6 flex items-center text-lg font-bold text-gray-800">
                            <div
                                class="mr-3 flex h-10 w-10 items-center justify-center rounded-lg bg-blue-100 text-blue-600">
                                <i class="fas fa-share-alt"></i>
                            </div>
                            Bagikan
                        </h3>
                        <div class="flex flex-wrap gap-3">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
                                target="_blank"
                                class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-600 text-white shadow-md transition hover:bg-blue-700 hover:shadow-lg">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($jurusan->nama_jurusan) }}"
                                target="_blank"
                                class="flex h-12 w-12 items-center justify-center rounded-xl bg-sky-500 text-white shadow-md transition hover:bg-sky-600 hover:shadow-lg">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="https://wa.me/?text={{ urlencode($jurusan->nama_jurusan . ' - ' . request()->url()) }}"
                                target="_blank"
                                class="flex h-12 w-12 items-center justify-center rounded-xl bg-green-500 text-white shadow-md transition hover:bg-green-600 hover:shadow-lg">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Jurusan Lainnya -->
    @if ($jurusanLainnya->count() > 0)
        <section class="bg-gradient-to-b from-gray-50 to-white py-20">
            <div class="container mx-auto px-4">
                <div class="mb-12 text-center">
                    <h2 class="mb-4 text-4xl font-bold text-gray-800">
                        Program Jurusan Lainnya
                    </h2>
                    <p class="text-lg text-gray-600">Jelajahi program keahlian lainnya yang tersedia</p>
                </div>
                <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($jurusanLainnya as $item)
                        <div
                            class="group overflow-hidden rounded-2xl bg-white shadow-md transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl">
                            <div class="relative h-56 overflow-hidden">
                                @if ($item->gambar)
                                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama_jurusan }}"
                                        class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                                    </div>
                                @else
                                    <div
                                        class="flex h-full w-full items-center justify-center bg-gradient-to-br from-blue-400 to-blue-600">
                                        <i class="fas fa-book text-7xl text-white opacity-40"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="p-6">
                                <h3 class="mb-3 text-xl font-bold text-gray-800 transition group-hover:text-blue-600">
                                    {{ $item->nama_jurusan }}
                                </h3>
                                <p class="mb-4 leading-relaxed text-gray-600">
                                    {{ Str::limit(strip_tags($item->deskripsi), 80) }}
                                </p>
                                <a href="{{ route('jurusan.show', $item->id) }}"
                                    class="inline-flex items-center font-semibold text-blue-600 transition hover:gap-3 hover:text-blue-700">
                                    Lihat Detail
                                    <i class="fas fa-arrow-right ml-2 transition-all"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

@endsection

@push('scripts')
    <script>
        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
@endpush
