<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') - {{ $globalKonfigurasi->nama_sekolah ?? 'Admin SMK Teknologi Bantul' }}</title>

    <!-- Favicon Dinamis dari Database -->
    @if($globalKonfigurasi && $globalKonfigurasi->favicon)
        <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . $globalKonfigurasi->favicon) }}">
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('storage/' . $globalKonfigurasi->favicon) }}">
        <link rel="apple-touch-icon" href="{{ asset('storage/' . $globalKonfigurasi->favicon) }}">
    @else
        <!-- Fallback ke logo jika favicon tidak ada -->
        @if($globalKonfigurasi && $globalKonfigurasi->logo)
            <link rel="icon" type="image/png" href="{{ asset('storage/' . $globalKonfigurasi->logo) }}">
            <link rel="shortcut icon" type="image/png" href="{{ asset('storage/' . $globalKonfigurasi->logo) }}">
            <link rel="apple-touch-icon" href="{{ asset('storage/' . $globalKonfigurasi->logo) }}">
        @endif
    @endif
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @stack('styles')
</head>

<body class="bg-gray-50">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside id="sidebar"
            class="w-64 flex-shrink-0 overflow-y-auto bg-gradient-to-b from-blue-800 to-blue-900 text-white transition-all duration-300">
            <!-- Logo -->
            <div class="border-b border-blue-700 p-6">
                <div class="flex items-center space-x-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-white">
                        <img src="{{ asset('storage/' . $globalKonfigurasi->logo) }}" alt="Logo"
                            class="h-8 w-8 object-contain">
                    </div>
                    <div>
                        <h1 class="text-lg font-bold">SMK Teknologi</h1>
                        <p class="text-xs text-blue-200">Admin Panel</p>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="space-y-1 p-4">
                <!-- Dashboard -->
                <a href="{{ route('admin.dashboard') }}"
                    class="{{ request()->routeIs('admin.dashboard') ? 'bg-blue-700' : '' }} flex items-center space-x-3 rounded-lg px-4 py-3 transition hover:bg-blue-700">
                    <i class="fas fa-home w-5"></i>
                    <span>Dashboard</span>
                </a>

                <!-- Content Management -->
                <div class="px-4 pb-2 pt-4">
                    <p class="text-xs font-semibold uppercase text-blue-300">Konten</p>
                </div>

                <a href="{{ route('admin.carousel.index') }}"
                    class="{{ request()->routeIs('admin.carousel.*') ? 'bg-blue-700' : '' }} flex items-center space-x-3 rounded-lg px-4 py-3 transition hover:bg-blue-700">
                    <i class="fas fa-images w-5"></i>
                    <span>Carousel</span>
                </a>

                <a href="{{ route('admin.artikel.index') }}"
                    class="{{ request()->routeIs('admin.artikel.*') ? 'bg-blue-700' : '' }} flex items-center space-x-3 rounded-lg px-4 py-3 transition hover:bg-blue-700">
                    <i class="fas fa-newspaper w-5"></i>
                    <span>Artikel</span>
                </a>

                <a href="{{ route('admin.jurusan.index') }}"
                    class="{{ request()->routeIs('admin.jurusan.*') ? 'bg-blue-700' : '' }} flex items-center space-x-3 rounded-lg px-4 py-3 transition hover:bg-blue-700">
                    <i class="fas fa-book w-5"></i>
                    <span>Jurusan</span>
                </a>

                <a href="{{ route('admin.prestasi.index') }}"
                    class="{{ request()->routeIs('admin.prestasi.*') ? 'bg-blue-700' : '' }} flex items-center space-x-3 rounded-lg px-4 py-3 transition hover:bg-blue-700">
                    <i class="fas fa-trophy w-5"></i>
                    <span>Prestasi</span>
                </a>

                <!-- People -->
                <div class="px-4 pb-2 pt-4">
                    <p class="text-xs font-semibold uppercase text-blue-300">Data</p>
                </div>

                <a href="{{ route('admin.guru.index') }}"
                    class="{{ request()->routeIs('admin.guru.*') ? 'bg-blue-700' : '' }} flex items-center space-x-3 rounded-lg px-4 py-3 transition hover:bg-blue-700">
                    <i class="fas fa-chalkboard-teacher w-5"></i>
                    <span>Guru</span>
                </a>

                <a href="{{ route('admin.alumni.index') }}"
                    class="{{ request()->routeIs('admin.alumni.*') ? 'bg-blue-700' : '' }} flex items-center space-x-3 rounded-lg px-4 py-3 transition hover:bg-blue-700">
                    <i class="fas fa-user-graduate w-5"></i>
                    <span>Alumni</span>
                </a>

                <!-- Media -->
                <div class="px-4 pb-2 pt-4">
                    <p class="text-xs font-semibold uppercase text-blue-300">Media</p>
                </div>

                <a href="{{ route('admin.galeri.index') }}"
                    class="{{ request()->routeIs('admin.galeri.*') ? 'bg-blue-700' : '' }} flex items-center space-x-3 rounded-lg px-4 py-3 transition hover:bg-blue-700">
                    <i class="fas fa-image w-5"></i>
                    <span>Galeri</span>
                </a>

                <a href="{{ route('admin.dokumen.index') }}"
                    class="{{ request()->routeIs('admin.dokumen.*') ? 'bg-blue-700' : '' }} flex items-center space-x-3 rounded-lg px-4 py-3 transition hover:bg-blue-700">
                    <i class="fa-solid fa-folder-open w-5"></i>
                    <span>Dokumen</span>
                </a>

                <!-- Settings -->
                <div class="px-4 pb-2 pt-4">
                    <p class="text-xs font-semibold uppercase text-blue-300">Pengaturan</p>
                </div>

                <a href="{{ route('admin.visi-misi.index') }}"
                    class="{{ request()->routeIs('admin.visi-misi.*') ? 'bg-blue-700' : '' }} flex items-center space-x-3 rounded-lg px-4 py-3 transition hover:bg-blue-700">
                    <i class="fas fa-bullseye w-5"></i>
                    <span>Visi & Misi</span>
                </a>

                <a href="{{ route('admin.kepala-sekolah.index') }}"
                    class="{{ request()->routeIs('admin.kepala-sekolah.*') ? 'bg-blue-700' : '' }} flex items-center space-x-3 rounded-lg px-4 py-3 transition hover:bg-blue-700">
                    <i class="fas fa-user-tie w-5"></i>
                    <span>Kepala Sekolah</span>
                </a>

                <a href="{{ route('admin.konfigurasi.index') }}"
                    class="{{ request()->routeIs('admin.konfigurasi.*') ? 'bg-blue-700' : '' }} flex items-center space-x-3 rounded-lg px-4 py-3 transition hover:bg-blue-700">
                    <i class="fas fa-cog w-5"></i>
                    <span>Konfigurasi</span>
                </a>

                <a href="{{ route('admin.pengaduan.index') }}"
                    class="{{ request()->routeIs('admin.pengaduan.*') ? 'bg-blue-700' : '' }} flex items-center space-x-3 rounded-lg px-4 py-3 transition hover:bg-blue-700">
                    <i class="fas fa-envelope w-5"></i>
                    <span>Pengaduan</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex flex-1 flex-col overflow-hidden">
            <!-- Top Navbar -->
            <header class="border-b border-gray-200 bg-white shadow-sm">
                <div class="flex items-center justify-between px-6 py-4">
                    <div class="flex items-center space-x-4">
                        <button id="sidebarToggle" class="text-gray-500 hover:text-gray-700 lg:hidden">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800">@yield('page-title', 'Dashboard')</h2>
                            <p class="text-sm text-gray-500">@yield('page-subtitle', 'Kelola konten website')</p>
                        </div>
                    </div>

                    <div class="flex items-center space-x-4">


                        <!-- User Menu -->
                        <div class="flex items-center space-x-3 border-l pl-4">
                            <div class="text-right">
                                <p class="text-sm font-semibold text-gray-800">
                                    {{ Auth::guard('admin')->user()->nama_lengkap }}</p>
                                <p class="text-xs text-gray-500">Administrator</p>
                            </div>
                            <div class="relative">
                                <button id="userMenuButton"
                                    class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-600 font-semibold text-white transition hover:bg-blue-700">
                                    {{ strtoupper(substr(Auth::guard('admin')->user()->nama_lengkap, 0, 1)) }}
                                </button>
                                <div id="userMenuDropdown"
                                    class="absolute right-0 z-50 mt-2 hidden w-48 rounded-lg border border-gray-200 bg-white py-2 shadow-xl">
                                    <a href="#"
                                        class="block px-4 py-2 text-sm text-gray-700 transition hover:bg-gray-100">
                                        <i class="fas fa-user mr-2"></i> Profile
                                    </a>
                                    <a href="{{ route('admin.konfigurasi.index') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 transition hover:bg-gray-100">
                                        <i class="fas fa-cog mr-2"></i> Pengaturan
                                    </a>
                                    <hr class="my-2">
                                    <form action="{{ route('admin.logout') }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="w-full px-4 py-2 text-left text-sm text-red-600 transition hover:bg-gray-100">
                                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 overflow-y-auto bg-gray-50">
                <div class="p-6">
                    <!-- Alerts -->
                    @if (session('success'))
                        <div class="alert-message mb-6 rounded-r-lg border-l-4 border-green-500 bg-green-50 p-4">
                            <div class="flex items-center">
                                <i class="fas fa-check-circle mr-3 text-green-500"></i>
                                <p class="text-green-700">{{ session('success') }}</p>
                            </div>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert-message mb-6 rounded-r-lg border-l-4 border-red-500 bg-red-50 p-4">
                            <div class="flex items-center">
                                <i class="fas fa-exclamation-circle mr-3 text-red-500"></i>
                                <p class="text-red-700">{{ session('error') }}</p>
                            </div>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert-message mb-6 rounded-r-lg border-l-4 border-red-500 bg-red-50 p-4">
                            <div class="flex items-start">
                                <i class="fas fa-exclamation-circle mr-3 mt-1 text-red-500"></i>
                                <div>
                                    <p class="mb-2 font-semibold text-red-700">Terdapat kesalahan:</p>
                                    <ul class="list-inside list-disc space-y-1 text-sm text-red-600">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Page Content -->
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        // Sidebar Toggle for Mobile
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');

        sidebarToggle?.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
        });

        // Auto hide alerts after 5 seconds - DIPERBAIKI DENGAN SELECTOR YANG LEBIH SPESIFIK
        setTimeout(() => {
            // Gunakan class 'alert-message' untuk menandai alert yang boleh dihapus
            const alerts = document.querySelectorAll('.alert-message');
            alerts.forEach(alert => {
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);
    </script>
    <script>
        // User Menu Dropdown
        const userMenuButton = document.getElementById('userMenuButton');
        const userMenuDropdown = document.getElementById('userMenuDropdown');

        userMenuButton?.addEventListener('click', (e) => {
            e.stopPropagation();
            userMenuDropdown.classList.toggle('hidden');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', (e) => {
            if (!userMenuButton?.contains(e.target) && !userMenuDropdown?.contains(e.target)) {
                userMenuDropdown?.classList.add('hidden');
            }
        });
    </script>
    @stack('scripts')
</body>

</html>
