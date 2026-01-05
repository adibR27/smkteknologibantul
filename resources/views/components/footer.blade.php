<footer class="mt-12 bg-blue-900 text-white">
    <!-- FOOTER CONTENT -->
    <div class="mx-auto max-w-7xl px-4 py-12">
        <div class="grid grid-cols-1 gap-8 md:grid-cols-4">

            <!-- KOLOM 1: About Sekolah -->
            <div>
                <h3 class="mb-4 flex items-center gap-2 text-xl font-bold">
                    @if ($globalKonfigurasi && $globalKonfigurasi->logo)
                        <img src="{{ asset('storage/' . $globalKonfigurasi->logo) }}"
                            alt="{{ $globalKonfigurasi->nama_sekolah ?? 'Logo' }}" class="h-8 w-8 rounded object-contain">
                    @else
                        <i class="fas fa-graduation-cap"></i>
                    @endif
                    {{ $globalKonfigurasi->nama_sekolah ?? 'SMK Teknologi Bantul' }}
                </h3>
                <p class="text-sm leading-relaxed text-blue-100">
                    {{ $globalKonfigurasi->deskripsi ?? 'Sekolah Menengah Kejuruan yang berfokus pada teknologi dan inovasi untuk menghasilkan tenaga kerja profesional dan berdaya saing tinggi.' }}
                </p>
            </div>

            <!-- KOLOM 2: Quick Links -->
            <div>
                <h4 class="mb-4 text-lg font-bold">Menu Cepat</h4>
                <ul class="space-y-2 text-blue-100">
                    <li>
                        <a href="{{ route('home') }}" class="transition hover:text-white">
                            <i class="fas fa-chevron-right mr-2"></i>Beranda
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('visi-misi') }}" class="transition hover:text-white">
                            <i class="fas fa-chevron-right mr-2"></i>Visi & Misi
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('artikel.index') }}" class="transition hover:text-white">
                            <i class="fas fa-chevron-right mr-2"></i>Artikel
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('galeri.index') }}" class="transition hover:text-white">
                            <i class="fas fa-chevron-right mr-2"></i>Galeri
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dokumen.index') }}" class="transition hover:text-white">
                            <i class="fas fa-chevron-right mr-2"></i>Dokumen
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('kontak.index') }}" class="transition hover:text-white">
                            <i class="fas fa-chevron-right mr-2"></i>Kontak
                        </a>
                    </li>
                </ul>
            </div>

            <!-- KOLOM 3: Contact Info  -->
            <div>
                <h4 class="mb-4 text-lg font-bold">Hubungi Kami</h4>
                <ul class="space-y-3 text-sm text-blue-100">
                    @if ($globalKonfigurasi && $globalKonfigurasi->no_telepon)
                        <li class="flex items-start gap-2">
                            <i class="fas fa-phone mt-1 text-blue-300"></i>
                            <a href="tel:{{ $globalKonfigurasi->no_telepon }}" class="transition hover:text-white">
                                {{ $globalKonfigurasi->no_telepon }}
                            </a>
                        </li>
                    @endif

                    @if ($globalKonfigurasi && $globalKonfigurasi->email)
                        <li class="flex items-start gap-2">
                            <i class="fas fa-envelope mt-1 text-blue-300"></i>
                            <a href="mailto:{{ $globalKonfigurasi->email }}" class="transition hover:text-white">
                                {{ $globalKonfigurasi->email }}
                            </a>
                        </li>
                    @endif

                    @if ($globalKonfigurasi && $globalKonfigurasi->alamat)
                        <li class="flex items-start gap-2">
                            <i class="fas fa-map-marker-alt mt-1 text-blue-300"></i>
                            <span>{{ $globalKonfigurasi->alamat }}</span>
                        </li>
                    @endif
                </ul>
            </div>

            <!-- KOLOM 4: Social Media -->
            <div>
                <h4 class="mb-4 text-lg font-bold">Ikuti Kami</h4>
                <p class="mb-4 text-sm text-blue-100">
                    Follow kami di media sosial untuk update terbaru
                </p>

                @if ($globalMediaSosial && $globalMediaSosial->count() > 0)
                    <div class="flex flex-wrap gap-3">
                        @foreach ($globalMediaSosial as $media)
                            <a href="{{ $media->link_url }}" target="_blank" rel="noopener noreferrer"
                                title="{{ $media->platform }}"
                                class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-700 transition hover:bg-white hover:text-blue-900">
                                <i class="{{ $media->icon }}"></i>
                            </a>
                        @endforeach
                    </div>
                @else
                    <!-- Fallback jika belum ada media sosial -->
                    <div class="flex gap-3">
                        <a href="#"
                            class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-700 transition hover:bg-white hover:text-blue-900">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#"
                            class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-700 transition hover:bg-white hover:text-blue-900">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#"
                            class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-700 transition hover:bg-white hover:text-blue-900">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                @endif
            </div>

        </div>

        <!-- DIVIDER -->
        <hr class="my-8 border-blue-700">

        <!-- BOTTOM: COPYRIGHT -->
        <div class="flex justify-center text-center text-sm text-blue-100">
            <p>
                &copy; {{ date('Y') }} {{ $globalKonfigurasi->nama_sekolah ?? 'SMK Teknologi Bantul' }}.
                All rights reserved.
            </p>
        </div>
    </div>
</footer>
