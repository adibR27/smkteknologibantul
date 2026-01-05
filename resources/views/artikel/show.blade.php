@extends('layouts.app')

@section('title', $artikel->judul)

@section('content')
    <!-- Breadcrumb -->
    <section class="bg-gray-100 py-4">
        <div class="container mx-auto px-4">
            <nav class="flex text-sm text-gray-600">
                <a href="{{ route('home') }}" class="hover:text-blue-600">
                    <i class="fas fa-home mr-1"></i>Beranda
                </a>
                <span class="mx-2">/</span>
                <a href="{{ route('artikel.index') }}" class="hover:text-blue-600">Artikel</a>
                <span class="mx-2">/</span>
                <span class="text-blue-600">{{ Str::limit($artikel->judul, 30) }}</span>
            </nav>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
                <!-- Article Content (Kiri) -->
                <article class="lg:col-span-2">
                    <div class="rounded-xl bg-white p-8 shadow-lg">
                        <!-- Kategori Badge -->
                        <div class="mb-4">
                            <span
                                class="inline-block rounded-full bg-blue-100 px-4 py-2 text-sm font-semibold text-blue-800">
                                <i class="fas fa-tag mr-1"></i>{{ ucfirst($artikel->kategori) }}
                            </span>
                        </div>

                        <!-- Title -->
                        <h1 class="mb-4 text-3xl font-bold text-gray-800 md:text-4xl">
                            {{ $artikel->judul }}
                        </h1>

                        <!-- Meta Info -->
                        <div class="mb-6 flex flex-wrap items-center gap-4 border-b pb-4 text-sm text-gray-600">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-user text-blue-600"></i>
                                <span>{{ $artikel->penulis->nama_lengkap ?? 'Admin' }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fas fa-calendar text-blue-600"></i>
                                <span>{{ $artikel->tanggal_publish?->format('d F Y') }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="fas fa-eye text-blue-600"></i>
                                <span>{{ number_format($artikel->views) }} views</span>
                            </div>
                        </div>

                        <!-- Featured Image -->
                        @if ($artikel->gambar_utama)
                            <div class="mb-8 overflow-hidden rounded-xl">
                                <img src="{{ asset('storage/' . $artikel->gambar_utama) }}" alt="{{ $artikel->judul }}"
                                    class="w-full object-cover">
                            </div>
                        @endif

                        <!-- Content -->
                        <div class="prose prose-lg max-w-none">
                            {!! $artikel->konten !!}
                        </div>

                        <!-- Share Section -->
                        <div class="mt-8 border-t pt-6">
                            <h4 class="mb-4 text-lg font-bold text-gray-800">
                                <i class="fas fa-share-alt mr-2"></i>Bagikan Artikel
                            </h4>
                            <div class="flex flex-wrap gap-3">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('artikel.show', $artikel->slug)) }}"
                                    target="_blank"
                                    class="flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2 text-white transition hover:bg-blue-700">
                                    <i class="fab fa-facebook-f"></i>
                                    <span>Facebook</span>
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('artikel.show', $artikel->slug)) }}&text={{ urlencode($artikel->judul) }}"
                                    target="_blank"
                                    class="flex items-center gap-2 rounded-lg bg-sky-500 px-4 py-2 text-white transition hover:bg-sky-600">
                                    <i class="fab fa-twitter"></i>
                                    <span>Twitter</span>
                                </a>
                                <a href="https://wa.me/?text={{ urlencode($artikel->judul . ' - ' . route('artikel.show', $artikel->slug)) }}"
                                    target="_blank"
                                    class="flex items-center gap-2 rounded-lg bg-green-500 px-4 py-2 text-white transition hover:bg-green-600">
                                    <i class="fab fa-whatsapp"></i>
                                    <span>WhatsApp</span>
                                </a>
                                <button onclick="copyToClipboard()"
                                    class="flex items-center gap-2 rounded-lg bg-gray-600 px-4 py-2 text-white transition hover:bg-gray-700">
                                    <i class="fas fa-link"></i>
                                    <span>Copy Link</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Related Articles -->
                    @if ($relatedArtikels->count() > 0)
                        <div class="mt-8 rounded-xl bg-white p-8 shadow-lg">
                            <h3 class="mb-6 text-2xl font-bold text-gray-800">
                                <i class="fas fa-newspaper mr-2 text-blue-600"></i>Artikel Terkait
                            </h3>
                            <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                                @foreach ($relatedArtikels as $related)
                                    <a href="{{ route('artikel.show', $related->slug) }}"
                                        class="group overflow-hidden rounded-xl bg-white shadow-md transition hover:shadow-xl">
                                        @if ($related->gambar_utama)
                                            <img src="{{ asset('storage/' . $related->gambar_utama) }}"
                                                alt="{{ $related->judul }}"
                                                class="h-40 w-full object-cover transition-transform duration-300 group-hover:scale-110">
                                        @else
                                            <div
                                                class="flex h-40 w-full items-center justify-center bg-gradient-to-br from-blue-100 to-blue-200">
                                                <i class="fas fa-image text-4xl text-blue-400"></i>
                                            </div>
                                        @endif
                                        <div class="p-4">
                                            <h4 class="mb-2 font-bold text-gray-800 transition group-hover:text-blue-600">
                                                {{ Str::limit($related->judul, 60) }}
                                            </h4>
                                            <p class="text-sm text-gray-600">
                                                {{ $related->tanggal_publish?->format('d M Y') }}
                                            </p>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </article>

                <!-- Sidebar (Kanan) -->
                <aside class="lg:col-span-1">
                    <!-- Author Info -->
                    <div class="mb-8 rounded-xl bg-white p-6 shadow-lg">
                        <h4 class="mb-4 text-lg font-bold text-gray-800">
                            <i class="fas fa-user-edit mr-2 text-blue-600"></i>Penulis
                        </h4>
                        <div class="flex items-center gap-4">
                            <div class="flex h-16 w-16 items-center justify-center rounded-full bg-blue-100">
                                <i class="fas fa-user text-2xl text-blue-600"></i>
                            </div>
                            <div>
                                <h5 class="font-bold text-gray-800">
                                    {{ $artikel->penulis->nama_lengkap ?? 'Administrator' }}
                                </h5>
                                <p class="text-sm text-gray-600">Penulis Artikel</p>
                            </div>
                        </div>
                    </div>

                    <!-- Article Info -->
                    <div class="mb-8 rounded-xl bg-gradient-to-br from-blue-50 to-blue-100 p-6 shadow-lg">
                        <h4 class="mb-4 text-lg font-bold text-gray-800">
                            <i class="fas fa-info-circle mr-2 text-blue-600"></i>Informasi Artikel
                        </h4>
                        <div class="space-y-3 text-sm">
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">Kategori:</span>
                                <span class="font-semibold text-blue-700">{{ ucfirst($artikel->kategori) }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">Tanggal:</span>
                                <span
                                    class="font-semibold text-gray-800">{{ $artikel->tanggal_publish?->format('d M Y') }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">Dibaca:</span>
                                <span class="font-semibold text-gray-800">{{ number_format($artikel->views) }}x</span>
                            </div>
                        </div>
                    </div>


                </aside>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        /* Prose styling untuk konten artikel */
        .prose {
            color: #374151;
        }

        .prose h1,
        .prose h2,
        .prose h3,
        .prose h4 {
            color: #1f2937;
            font-weight: 700;
            margin-top: 1.5em;
            margin-bottom: 0.75em;
        }

        .prose p {
            margin-bottom: 1.25em;
            line-height: 1.75;
        }

        .prose a {
            color: #2563eb;
            text-decoration: underline;
        }

        .prose a:hover {
            color: #1d4ed8;
        }

        .prose img {
            border-radius: 0.5rem;
            margin: 1.5em 0;
        }

        .prose ul,
        .prose ol {
            margin: 1.25em 0;
            padding-left: 1.5em;
        }

        .prose li {
            margin: 0.5em 0;
        }

        .prose blockquote {
            border-left: 4px solid #3b82f6;
            padding-left: 1em;
            font-style: italic;
            color: #6b7280;
            margin: 1.5em 0;
        }

        .prose table {
            width: 100%;
            border-collapse: collapse;
            margin: 1.5em 0;
        }

        .prose th,
        .prose td {
            border: 1px solid #e5e7eb;
            padding: 0.75em;
        }

        .prose th {
            background-color: #f3f4f6;
            font-weight: 600;
        }

        /* Responsive Video Embed */
        .prose iframe {
            max-width: 100%;
            height: auto;
            aspect-ratio: 16 / 9;
            border-radius: 0.5rem;
            margin: 1.5em 0;
        }

        /* Container untuk video agar responsive */
        .prose .video-container {
            position: relative;
            padding-bottom: 56.25%;
            /* 16:9 aspect ratio */
            height: 0;
            overflow: hidden;
            margin: 1.5em 0;
        }

        .prose .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
    </style>
@endpush

@push('scripts')
    <script>
        function copyToClipboard() {
            const url = window.location.href;
            navigator.clipboard.writeText(url).then(() => {
                alert('Link berhasil disalin!');
            }).catch(err => {
                console.error('Failed to copy: ', err);
            });
        }
    </script>
@endpush
