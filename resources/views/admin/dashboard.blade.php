@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Ringkasan data dan statistik website')

@section('content')
    <!-- Welcome Banner -->
    <div class="mb-6 rounded-xl bg-gradient-to-r from-blue-600 to-blue-800 p-8 text-white shadow-lg">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="mb-2 text-3xl font-bold">Selamat Datang, {{ Auth::guard('admin')->user()->nama_lengkap }}! 👋</h1>
                <p class="text-blue-100">Kelola konten website SMK Teknologi Bantul dengan mudah dan cepat.</p>
            </div>
            <div class="hidden lg:block">
                <i class="fas fa-chart-line text-6xl text-blue-300 opacity-50"></i>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="mb-6 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
        <!-- Artikel Card -->
        <div class="rounded-xl border-l-4 border-blue-500 bg-white p-6 shadow-sm transition hover:shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="mb-1 text-sm text-gray-500">Total Artikel</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $stats['artikel'] }}</p>
                    <p class="mt-2 text-xs text-green-600">
                        <i class="fas fa-arrow-up"></i> Artikel terpublikasi
                    </p>
                </div>
                <div class="flex h-14 w-14 items-center justify-center rounded-full bg-blue-100">
                    <i class="fas fa-newspaper text-2xl text-blue-600"></i>
                </div>
            </div>
        </div>

        <!-- Guru Card -->
        <div class="rounded-xl border-l-4 border-green-500 bg-white p-6 shadow-sm transition hover:shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="mb-1 text-sm text-gray-500">Total Guru</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $stats['guru'] }}</p>
                    <p class="mt-2 text-xs text-green-600">
                        <i class="fas fa-check"></i> Tenaga pengajar
                    </p>
                </div>
                <div class="flex h-14 w-14 items-center justify-center rounded-full bg-green-100">
                    <i class="fas fa-chalkboard-teacher text-2xl text-green-600"></i>
                </div>
            </div>
        </div>

        <!-- Alumni Card -->
        <div class="rounded-xl border-l-4 border-yellow-500 bg-white p-6 shadow-sm transition hover:shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="mb-1 text-sm text-gray-500">Total Alumni</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $stats['alumni'] }}</p>
                    <p class="mt-2 text-xs text-blue-600">
                        <i class="fas fa-graduation-cap"></i> Lulusan terdaftar
                    </p>
                </div>
                <div class="flex h-14 w-14 items-center justify-center rounded-full bg-yellow-100">
                    <i class="fas fa-user-graduate text-2xl text-yellow-600"></i>
                </div>
            </div>
        </div>

        <!-- Prestasi Card -->
        <div class="rounded-xl border-l-4 border-purple-500 bg-white p-6 shadow-sm transition hover:shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <p class="mb-1 text-sm text-gray-500">Total Prestasi</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $stats['prestasi'] }}</p>
                    <p class="mt-2 text-xs text-purple-600">
                        <i class="fas fa-trophy"></i> Pencapaian sekolah
                    </p>
                </div>
                <div class="flex h-14 w-14 items-center justify-center rounded-full bg-purple-100">
                    <i class="fas fa-award text-2xl text-purple-600"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Secondary Stats -->
    <div class="mb-6 grid grid-cols-2 gap-4 md:grid-cols-4">
        <div class="rounded-lg bg-white p-4 text-center shadow-sm">
            <i class="fas fa-book mb-2 text-2xl text-indigo-600"></i>
            <p class="text-2xl font-bold text-gray-800">{{ $stats['jurusan'] }}</p>
            <p class="text-xs text-gray-500">Jurusan</p>
        </div>
        <div class="rounded-lg bg-white p-4 text-center shadow-sm">
            <i class="fas fa-images mb-2 text-2xl text-pink-600"></i>
            <p class="text-2xl font-bold text-gray-800">{{ $stats['carousel'] }}</p>
            <p class="text-xs text-gray-500">Carousel</p>
        </div>
        <div class="rounded-lg bg-white p-4 text-center shadow-sm">
            <i class="fas fa-image mb-2 text-2xl text-teal-600"></i>
            <p class="text-2xl font-bold text-gray-800">{{ $stats['galeri'] }}</p>
            <p class="text-xs text-gray-500">Galeri</p>
        </div>
        <div class="rounded-lg bg-white p-4 text-center shadow-sm">
            <i class="fas fa-file-pdf mb-2 text-2xl text-red-600"></i>
            <p class="text-2xl font-bold text-gray-800">{{ $stats['dokumen'] }}</p>
            <p class="text-xs text-gray-500">Dokumen</p>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        <!-- Chart Section -->
        <div class="lg:col-span-2">
            <div class="rounded-xl bg-white p-6 shadow-sm">
                <div class="mb-6 flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-800">
                        <i class="fas fa-chart-line mr-2 text-blue-600"></i>
                        Artikel per Bulan
                    </h3>
                    <span class="text-sm text-gray-500">6 Bulan Terakhir</span>
                </div>
                <canvas id="artikelChart" class="w-full" height="80"></canvas>
            </div>

            <!-- Recent Articles -->
            <div class="mt-6 rounded-xl bg-white p-6 shadow-sm">
                <h3 class="mb-4 text-lg font-semibold text-gray-800">
                    <i class="fas fa-newspaper mr-2 text-blue-600"></i>
                    Artikel Terbaru
                </h3>
                @if ($recentArticles->count() > 0)
                    <div class="space-y-3">
                        @foreach ($recentArticles as $artikel)
                            <div class="flex items-start space-x-3 rounded-lg p-3 transition hover:bg-gray-50">
                                <div class="h-16 w-16 flex-shrink-0 rounded-lg bg-gray-200">
                                    @if ($artikel->gambar)
                                        <img src="{{ asset('storage/' . $artikel->gambar) }}" alt="{{ $artikel->judul }}"
                                            class="h-full w-full rounded-lg object-cover">
                                    @else
                                        <div class="flex h-full w-full items-center justify-center">
                                            <i class="fas fa-image text-gray-400"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="min-w-0 flex-1">
                                    <h4 class="truncate text-sm font-semibold text-gray-800">{{ $artikel->judul }}</h4>
                                    <p class="mt-1 text-xs text-gray-500">{{ $artikel->created_at->format('d M Y') }}</p>
                                </div>
                                <a href="#" class="text-blue-600 hover:text-blue-800">
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="py-8 text-center text-gray-400">
                        <i class="fas fa-inbox mb-3 text-4xl"></i>
                        <p>Belum ada artikel</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Quick Actions -->
            <div class="rounded-xl bg-white p-6 shadow-sm">
                <h3 class="mb-4 text-lg font-semibold text-gray-800">
                    <i class="fas fa-bolt mr-2 text-yellow-600"></i>
                    Quick Actions
                </h3>
                <div class="space-y-2">
                    <a href="{{ route('admin.artikel.create') }}"
                        class="flex items-center space-x-3 rounded-lg bg-blue-50 p-3 transition hover:bg-blue-100">
                        <i class="fas fa-plus-circle text-blue-600"></i>
                        <span class="text-sm font-medium text-blue-800">Buat Artikel Baru</span>
                    </a>
                    <a href="{{ route('admin.carousel.create') }}"
                        class="flex items-center space-x-3 rounded-lg bg-green-50 p-3 transition hover:bg-green-100">
                        <i class="fas fa-images text-green-600"></i>
                        <span class="text-sm font-medium text-green-800">Tambah Carousel</span>
                    </a>
                    <a href="{{ route('admin.jurusan.create') }}"
                        class="flex items-center space-x-3 rounded-lg bg-purple-50 p-3 transition hover:bg-purple-100">
                        <i class="fas fa-book text-purple-600"></i>
                        <span class="text-sm font-medium text-purple-800">Tambah Jurusan</span>
                    </a>
                    <a href="{{ route('admin.guru.create') }}"
                        class="flex items-center space-x-3 rounded-lg bg-yellow-50 p-3 transition hover:bg-yellow-100">
                        <i class="fas fa-user-plus text-yellow-600"></i>
                        <span class="text-sm font-medium text-yellow-800">Tambah Guru</span>
                    </a>
                </div>
            </div>

            <!-- Recent Activities -->
            <div class="rounded-xl bg-white p-6 shadow-sm">
                <h3 class="mb-4 text-lg font-semibold text-gray-800">
                    <i class="fas fa-history mr-2 text-gray-600"></i>
                    Aktivitas Terbaru
                </h3>
                @if ($recentActivities->count() > 0)
                    <div class="space-y-4">
                        @foreach ($recentActivities as $activity)
                            <div class="flex items-start space-x-3">
                                <div
                                    class="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-full bg-blue-100">
                                    <i class="fas fa-edit text-xs text-blue-600"></i>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <p class="text-xs font-medium text-gray-800">{{ $activity['action'] }}</p>
                                    <p class="truncate text-xs text-gray-500">{{ $activity['description'] }}</p>
                                    <p class="mt-1 text-xs text-gray-400">{{ $activity['time'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="py-8 text-center text-gray-400">
                        <i class="fas fa-clock mb-2 text-3xl"></i>
                        <p class="text-sm">Belum ada aktivitas</p>
                    </div>
                @endif
            </div>

            <!-- Tips Card -->
            <div class="rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 p-6 text-white shadow-sm">
                <div class="mb-3 flex items-start space-x-3">
                    <i class="fas fa-lightbulb text-2xl text-yellow-300"></i>
                    <div>
                        <h4 class="mb-1 font-semibold">Tips!</h4>
                        <p class="text-sm text-blue-100">Update artikel secara rutin untuk meningkatkan engagement website.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- Step 1: Kirim data dari Laravel ke JavaScript --}}
    <script>
        window.artikelData = {!! json_encode($artikelPerBulan) !!};
    </script>

    {{-- Step 2: Script Chart.js --}}
    <script>
        // Chart Configuration
        const ctx = document.getElementById('artikelChart').getContext('2d');

        // Ambil data dari window object
        const chartData = window.artikelData;

        // Proses data untuk chart
        const labels = chartData.map(item => {
            const [year, month] = item.bulan.split('-');
            const date = new Date(year, month - 1);
            return date.toLocaleDateString('id-ID', {
                month: 'short',
                year: 'numeric'
            });
        });
        const data = chartData.map(item => item.jumlah);

        // Buat Chart
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels.length > 0 ? labels : ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
                datasets: [{
                    label: 'Jumlah Artikel',
                    data: data.length > 0 ? data : [0, 0, 0, 0, 0, 0],
                    borderColor: 'rgb(59, 130, 246)',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: 'rgb(59, 130, 246)',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        padding: 12,
                        titleColor: '#fff',
                        bodyColor: '#fff',
                        displayColors: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        },
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    </script>
@endpush
