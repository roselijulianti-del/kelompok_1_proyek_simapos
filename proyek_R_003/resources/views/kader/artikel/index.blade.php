<x-app-main title="Manajemen Artikel">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>

    <div class="p-4 md:p-8 min-h-screen">

        <div class="gsap-header opacity-0 -translate-y-5 flex flex-row justify-between items-center mb-6 md:mb-8 gap-3">
            <div>
                <h2 class="text-xl md:text-3xl font-extrabold text-gray-900 flex items-center gap-2 md:gap-3">
                    <span
                        class="w-10 h-10 rounded-xl bg-posyanduu/10 text-posyanduu flex items-center justify-center text-lg md:text-xl">
                        <i class="fas fa-newspaper"></i>
                    </span>
                    Daftar Artikel
                </h2>
                <p class="text-gray-500 mt-1 text-sm ml-12 hidden md:block">Kelola konten informasi untuk pengguna.</p>
            </div>

            <a href="{{ route('kader.artikel.create') }}"
                class="group bg-gradient-to-r from-posyanduu to-teal-600 text-white px-4 py-2.5 md:px-6 md:py-3 rounded-xl hover:shadow-lg hover:shadow-teal-500/30 transition-all duration-300 flex items-center gap-2 font-medium text-sm md:text-base">
                <i class="fas fa-plus group-hover:rotate-90 transition-transform duration-300"></i>
                <span class="hidden sm:inline">Tambah Artikel</span>
                <span class="sm:hidden">Tambah</span>
            </a>
        </div>

        @if (session('success'))
            <div
                class="gsap-header opacity-0 mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-r-lg shadow-sm flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="bg-green-100 p-2 rounded-full text-green-600">
                        <i class="fas fa-check"></i>
                    </div>
                    <p class="text-green-700 font-medium text-sm md:text-base">{{ session('success') }}</p>
                </div>
                <button onclick="this.parentElement.remove()" class="text-green-500 hover:text-green-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif

        <div class="grid grid-cols-1 gap-4 md:hidden">
            @forelse ($artikels as $item)
                <div
                    class="gsap-row opacity-0 translate-y-5 bg-white p-4 rounded-2xl shadow-sm border border-gray-100 flex gap-4">
                    <div class="w-24 h-24 flex-shrink-0 rounded-xl overflow-hidden bg-gray-100 border border-gray-100">
                        <img src="{{ asset('storage/' . $item->gambar) }}" class="w-full h-full object-cover"
                            alt="Thumbnail">
                    </div>

                    <div class="flex-1 flex flex-col justify-between">
                        <div>
                            <h3 class="font-bold text-gray-800 text-sm leading-snug line-clamp-2 mb-1">
                                {{ $item->judul }}
                            </h3>

                            <div class="flex flex-wrap items-center gap-2 mt-1">
                                @php
                                    $isBalita = $item->kategori == 'Balita';
                                    $badgeClass = $isBalita ? 'bg-blue-50 text-blue-600' : 'bg-pink-50 text-pink-600';
                                @endphp
                                <span class="text-[10px] px-2 py-0.5 rounded font-bold {{ $badgeClass }}">
                                    {{ $item->kategori }}
                                </span>
                                <span class="text-[10px] text-gray-400 flex items-center gap-1">
                                    <i class="far fa-clock"></i> {{ $item->created_at->format('d M Y') }}
                                </span>
                            </div>
                        </div>

                        <div class="flex justify-end gap-2 mt-3 pt-2 border-t border-gray-50">
                            <a href="{{ route('kader.artikel.edit', $item->id) }}"
                                class="flex-1 text-center bg-yellow-50 text-yellow-600 py-1.5 rounded-lg text-xs font-semibold">
                                <i class="fas fa-edit mr-1"></i> Edit
                            </a>
                            <form action="{{ route('kader.artikel.destroy', $item->id) }}" method="POST" class="flex-1"
                                onsubmit="return confirm('Hapus artikel ini?');">
                                @csrf @method('DELETE')
                                <button type="submit"
                                    class="w-full bg-red-50 text-red-600 py-1.5 rounded-lg text-xs font-semibold">
                                    <i class="fas fa-trash-alt mr-1"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-10 bg-white rounded-xl border border-dashed border-gray-300">
                    <i class="fas fa-newspaper text-gray-300 text-4xl mb-3"></i>
                    <p class="text-gray-500 text-sm font-medium">Belum ada artikel.</p>
                </div>
            @endforelse
        </div>

        <div
            class="hidden md:block bg-white rounded-2xl shadow-xl shadow-gray-200/50 overflow-hidden border border-gray-100">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr
                            class="bg-gray-50/50 border-b border-gray-100 text-gray-500 text-xs uppercase tracking-wider">
                            <th class="px-6 py-4 font-bold">Artikel</th>
                            <th class="px-6 py-4 font-bold">Kategori</th>
                            <th class="px-6 py-4 font-bold">Penulis & Tanggal</th>
                            <th class="px-6 py-4 font-bold text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($artikels as $item)
                            <tr
                                class="gsap-row opacity-0 translate-y-5 hover:bg-gray-50/80 transition-colors duration-200 group">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="relative w-16 h-16 flex-shrink-0 rounded-lg overflow-hidden shadow-sm border border-gray-200 group-hover:shadow-md transition-shadow">
                                            <img src="{{ asset('storage/' . $item->gambar) }}"
                                                class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500"
                                                alt="Thumbnail">
                                        </div>
                                        <div>
                                            <h3
                                                class="font-bold text-gray-800 group-hover:text-posyanduu transition-colors line-clamp-1 text-base">
                                                {{ $item->judul }}
                                            </h3>
                                            <span class="text-xs text-gray-400">ID: #{{ $item->id }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $isBalita = $item->kategori == 'Balita';
                                        $badgeClass = $isBalita
                                            ? 'bg-blue-50 text-blue-600 border-blue-100'
                                            : 'bg-pink-50 text-pink-600 border-pink-100';
                                        $iconClass = $isBalita ? 'fa-baby' : 'fa-female';
                                    @endphp
                                    <span
                                        class="px-3 py-1.5 rounded-full text-xs font-bold border {{ $badgeClass }} inline-flex items-center gap-1.5">
                                        <i class="fas {{ $iconClass }}"></i>
                                        {{ $item->kategori }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-col">
                                        <span class="text-sm font-semibold text-gray-700 flex items-center gap-2">
                                            <i class="far fa-user text-gray-400 text-xs"></i> {{ $item->penulis }}
                                        </span>
                                        <span class="text-xs text-gray-500 flex items-center gap-2 mt-1">
                                            <i class="far fa-clock text-gray-400 text-xs"></i>
                                            {{ $item->created_at->format('d M Y') }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-3">
                                        <a href="{{ route('kader.artikel.edit', $item->id) }}"
                                            class="w-9 h-9 rounded-lg bg-yellow-50 text-yellow-600 flex items-center justify-center hover:bg-yellow-500 hover:text-white transition-all duration-200 shadow-sm hover:shadow-yellow-200"
                                            title="Edit Artikel">
                                            <i class="fas fa-edit text-sm"></i>
                                        </a>
                                        <form action="{{ route('kader.artikel.destroy', $item->id) }}" method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?');">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                class="w-9 h-9 rounded-lg bg-red-50 text-red-600 flex items-center justify-center hover:bg-red-500 hover:text-white transition-all duration-200 shadow-sm hover:shadow-red-200"
                                                title="Hapus Artikel">
                                                <i class="fas fa-trash-alt text-sm"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div
                                            class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                                            <i class="fas fa-folder-open text-3xl text-gray-300"></i>
                                        </div>
                                        <h3 class="text-lg font-bold text-gray-800">Belum ada artikel</h3>
                                        <p class="text-gray-500 text-sm mt-1">Mulai dengan menambahkan artikel baru.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4 px-2">
            {{ $artikels->links() }}
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const tl = gsap.timeline({
                defaults: {
                    ease: "power3.out"
                }
            });

            // Animasi Header
            tl.to(".gsap-header", {
                    y: 0,
                    opacity: 1,
                    duration: 0.8,
                    stagger: 0.1
                })
                .to(".gsap-row", {
                    y: 0,
                    opacity: 1,
                    duration: 0.6,
                    stagger: 0.1
                }, "-=0.4");
        });
    </script>
</x-app-main>
