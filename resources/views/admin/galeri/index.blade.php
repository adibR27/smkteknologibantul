@extends('admin.layouts.app')

@section('title', 'Galeri')
@section('page-title', 'Galeri')
@section('page-subtitle', 'Kelola galeri foto kegiatan sekolah')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-2xl font-bold text-gray-800">Daftar Galeri</h3>
                <p class="mt-1 text-sm text-gray-600">Total: {{ $galeri->total() }} foto</p>
            </div>
            <a href="{{ route('admin.galeri.create') }}"
                class="inline-flex items-center rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300">
                <i class="fas fa-plus mr-2"></i>
                Tambah Foto
            </a>
        </div>

        <!-- Galeri Grid -->
        <div class="rounded-lg bg-white p-6 shadow-sm">
            @if ($galeri->count() > 0)
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                    @foreach ($galeri as $item)
                        <div
                            class="group relative overflow-hidden rounded-lg bg-gray-100 shadow-md transition hover:shadow-xl">
                            <!-- Image -->
                            <div class="aspect-square cursor-pointer overflow-hidden"
                                onclick="openModal({{ $item->id }})">
                                <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->caption ?? 'Galeri' }}"
                                    class="h-full w-full object-cover transition duration-300 group-hover:scale-110">
                            </div>

                            <!-- Overlay on Hover -->
                            <div
                                class="absolute inset-0 flex items-end bg-gradient-to-t from-black/70 via-black/20 to-transparent opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                                <div class="w-full p-4">
                                    <!-- Caption -->
                                    @if ($item->caption)
                                        <p class="mb-2 line-clamp-2 text-sm text-white">{{ $item->caption }}</p>
                                    @endif

                                    <!-- Date & Uploader -->
                                    <div class="mb-3 flex items-center justify-between text-xs text-gray-300">
                                        <span>
                                            <i class="far fa-calendar mr-1"></i>
                                            {{ $item->tanggal_kegiatan ? $item->tanggal_kegiatan->format('d M Y') : '-' }}
                                        </span>
                                        @if ($item->uploader)
                                            <span>
                                                <i class="far fa-user mr-1"></i>
                                                {{ $item->uploader->nama_lengkap }}
                                            </span>
                                        @endif
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="flex gap-2">
                                        <button onclick="openModal({{ $item->id }})"
                                            class="flex-1 rounded bg-blue-600 px-3 py-1.5 text-center text-xs font-medium text-white transition hover:bg-blue-700">
                                            <i class="fas fa-eye mr-1"></i> Lihat
                                        </button>
                                        <a href="{{ route('admin.galeri.edit', $item->id) }}"
                                            class="flex-1 rounded bg-yellow-500 px-3 py-1.5 text-center text-xs font-medium text-white transition hover:bg-yellow-600">
                                            <i class="fas fa-edit mr-1"></i> Edit
                                        </a>
                                        <button onclick="confirmDelete({{ $item->id }})"
                                            class="flex-1 rounded bg-red-600 px-3 py-1.5 text-center text-xs font-medium text-white transition hover:bg-red-700">
                                            <i class="fas fa-trash mr-1"></i> Hapus
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Info Badge -->
                            <div class="absolute left-2 top-2">
                                <span class="rounded-full bg-white/90 px-2 py-1 text-xs font-medium text-gray-700">
                                    {{ $item->created_at->format('d M Y') }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-6">
                    {{ $galeri->links() }}
                </div>
            @else
                <!-- Empty State -->
                <div class="py-12 text-center">
                    <div class="mx-auto mb-4 flex h-20 w-20 items-center justify-center rounded-full bg-gray-100">
                        <i class="fas fa-image text-3xl text-gray-400"></i>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-gray-800">Belum Ada Foto</h3>
                    <p class="mb-6 text-gray-600">Mulai tambahkan foto kegiatan sekolah ke galeri</p>
                    <a href="{{ route('admin.galeri.create') }}"
                        class="inline-flex items-center rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-blue-700">
                        <i class="fas fa-plus mr-2"></i>
                        Tambah Foto
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Image Preview Modal -->
    <div id="imageModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/90" onclick="closeModal()">
        <div class="relative max-h-screen w-full max-w-5xl p-4" onclick="event.stopPropagation()">
            <!-- Close Button -->
            <button onclick="closeModal()"
                class="absolute right-6 top-6 z-10 flex h-10 w-10 items-center justify-center rounded-full bg-white/10 text-white backdrop-blur-sm transition hover:bg-white/20">
                <i class="fas fa-times text-xl"></i>
            </button>

            <!-- Image Content -->
            <div class="rounded-lg bg-white">
                <div class="grid md:grid-cols-3">
                    <!-- Image -->
                    <div class="md:col-span-2">
                        <img id="modalImage" src="" alt=""
                            class="h-full w-full rounded-l-lg object-contain">
                    </div>

                    <!-- Info Sidebar -->
                    <div class="border-t p-6 md:border-l md:border-t-0">
                        <h3 class="mb-4 text-lg font-bold text-gray-800">Detail Foto</h3>

                        <div id="modalCaption" class="mb-4"></div>

                        <div class="space-y-3 text-sm">
                            <div>
                                <label class="block text-xs font-medium text-gray-500">Tanggal Kegiatan</label>
                                <div class="mt-1 flex items-center text-gray-700">
                                    <i class="far fa-calendar mr-2 text-blue-600"></i>
                                    <span id="modalTanggal">-</span>
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-medium text-gray-500">Diupload Oleh</label>
                                <div class="mt-1 flex items-center text-gray-700">
                                    <i class="far fa-user mr-2 text-blue-600"></i>
                                    <span id="modalUploader">-</span>
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-medium text-gray-500">Tanggal Upload</label>
                                <div class="mt-1 flex items-center text-gray-700">
                                    <i class="far fa-clock mr-2 text-blue-600"></i>
                                    <span id="modalCreated">-</span>
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="mt-6 space-y-2">
                            <a id="modalDownload" href="" download
                                class="flex w-full items-center justify-center rounded-lg bg-green-600 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-green-700">
                                <i class="fas fa-download mr-2"></i>Download
                            </a>
                            <a id="modalEdit" href=""
                                class="flex w-full items-center justify-center rounded-lg bg-yellow-500 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-yellow-600">
                                <i class="fas fa-edit mr-2"></i>Edit
                            </a>
                            <button id="modalDelete" onclick="confirmDelete(0)"
                                class="flex w-full items-center justify-center rounded-lg bg-red-600 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-red-700">
                                <i class="fas fa-trash mr-2"></i>Hapus
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50">
        <div class="mx-4 w-full max-w-md rounded-lg bg-white p-6 shadow-xl">
            <div class="mb-4 flex items-center text-red-600">
                <i class="fas fa-exclamation-triangle mr-3 text-2xl"></i>
                <h3 class="text-lg font-semibold">Konfirmasi Hapus</h3>
            </div>
            <p class="mb-6 text-gray-600">Apakah Anda yakin ingin menghapus foto ini? Tindakan ini tidak dapat dibatalkan.
            </p>
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="flex justify-end gap-3">
                    <button type="button" onclick="closeDeleteModal()"
                        class="rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 transition hover:bg-gray-50">
                        Batal
                    </button>
                    <button type="submit"
                        class="rounded-lg bg-red-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-red-700">
                        Ya, Hapus
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Data galeri
        const galeriData = @json($galeri->items());

        function openModal(id) {
            const item = galeriData.find(g => g.id === id);
            if (!item) return;

            document.getElementById('modalImage').src = `/storage/${item.gambar}`;
            document.getElementById('modalImage').alt = item.caption || 'Galeri';

            // Caption
            const captionDiv = document.getElementById('modalCaption');
            if (item.caption) {
                captionDiv.innerHTML =
                    `<div class="rounded-lg bg-gray-50 p-3"><p class="text-sm text-gray-700">${item.caption}</p></div>`;
            } else {
                captionDiv.innerHTML = '';
            }

            // Info
            document.getElementById('modalTanggal').textContent = item.tanggal_kegiatan ?
                new Date(item.tanggal_kegiatan).toLocaleDateString('id-ID', {
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric'
                }) :
                '-';
            document.getElementById('modalUploader').textContent = item.uploader?.nama_lengkap || '-';
            document.getElementById('modalCreated').textContent = new Date(item.created_at).toLocaleDateString('id-ID', {
                day: 'numeric',
                month: 'long',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });

            // Actions
            document.getElementById('modalDownload').href = `/storage/${item.gambar}`;
            document.getElementById('modalEdit').href = `/admin/galeri/${item.id}/edit`;
            document.getElementById('modalDelete').onclick = () => confirmDelete(item.id);

            document.getElementById('imageModal').classList.remove('hidden');
            document.getElementById('imageModal').classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            document.getElementById('imageModal').classList.add('hidden');
            document.getElementById('imageModal').classList.remove('flex');
            document.body.style.overflow = 'auto';
        }

        function confirmDelete(id) {
            closeModal(); // Close image modal first
            const deleteModal = document.getElementById('deleteModal');
            const form = document.getElementById('deleteForm');
            form.action = `/admin/galeri/${id}`;
            deleteModal.classList.remove('hidden');
            deleteModal.classList.add('flex');
        }

        function closeDeleteModal() {
            const modal = document.getElementById('deleteModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        // Close modal when clicking outside
        document.getElementById('deleteModal')?.addEventListener('click', function(e) {
            if (e.target === this) {
                closeDeleteModal();
            }
        });

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
                closeDeleteModal();
            }
        });
    </script>
@endpush
