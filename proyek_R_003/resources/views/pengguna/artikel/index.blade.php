<x-app-main title="Artikel & Berita">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>

    <main class="ml-2 md:ml-2 min-h-screen pb-10">

        <div
            class="gsap-header opacity-0 translate-y-5 mb-8 flex flex-col md:flex-row md:justify-between md:items-end gap-4">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800 flex items-center gap-3">
                    <div
                        class="w-10 h-10 rounded-lg bg-posyanduu text-white flex items-center justify-center shadow-lg shadow-teal-500/30">
                        <i class="fas fa-newspaper text-lg"></i>
                    </div>
                    <span>Pusat Informasi</span>
                </h1>
                <p class="text-gray-500 mt-2 text-sm md:text-base ml-1">
                    Update terbaru seputar kesehatan ibu, anak, dan kegiatan Posyandu.
                </p>
            </div>
        </div>

        @if ($heroArtikel)
            <div
                class="gsap-hero opacity-0 scale-95 mb-10 relative rounded-2xl overflow-hidden shadow-xl group h-64 md:h-80 w-full">
                <a href="{{ route('artikel.show', $heroArtikel->id) }}" class="absolute inset-0 z-10"></a>
                <img src="{{ asset('storage/' . $heroArtikel->gambar) }}" alt="{{ $heroArtikel->judul }}"
                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                <div
                    class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent flex flex-col justify-end p-6 md:p-8">
                    <span class="bg-posyanduu text-white text-xs font-bold px-3 py-1 rounded-full w-fit mb-3">
                        <i class="fas fa-star mr-1"></i> Terbaru
                    </span>
                    <h2 class="text-white text-xl md:text-3xl font-bold mb-2 leading-tight">{{ $heroArtikel->judul }}
                    </h2>
                    <p class="text-gray-200 text-sm md:text-base line-clamp-2 max-w-2xl">
                        {{ Str::limit(strip_tags($heroArtikel->isi), 150) }}
                    </p>
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8">

            {{-- PERUBAHAN: Menggunakan @forelse agar bisa menangani kondisi kosong --}}
            @forelse ($artikels as $artikel)
                @php
                    // Logika Warna Badge & Icon berdasarkan Kategori
                    $isBalita = $artikel->kategori == 'Balita';
                    $icon = $isBalita ? 'fa-baby' : 'fa-female';
                    $badgeClass = $isBalita ? 'text-posyanduu' : 'text-pink-500';
                    $hoverClass = $isBalita ? 'group-hover:text-posyanduu' : 'group-hover:text-pink-500';
                @endphp

                <article
                    class="gsap-card opacity-0 translate-y-10 group bg-white rounded-2xl border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-[0_8px_30px_rgb(0,0,0,0.08)] transition-all duration-300 overflow-hidden flex flex-col h-full">
                    <div class="relative h-56 overflow-hidden">
                        <div class="absolute top-4 left-4 z-10">
                            <span
                                class="bg-white/90 backdrop-blur-sm text-gray-800 text-xs font-bold px-3 py-1.5 rounded-lg shadow-sm flex items-center gap-1">
                                <i class="fas {{ $icon }} {{ $badgeClass }}"></i>
                                {{ $artikel->kategori }}
                            </span>
                        </div>
                        <img src="{{ asset('storage/' . $artikel->gambar) }}" alt="{{ $artikel->judul }}"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-black/10 group-hover:bg-black/0 transition-all duration-300">
                        </div>
                    </div>

                    <div class="p-6 flex flex-col flex-grow">
                        <div class="flex items-center text-xs text-gray-400 mb-3 gap-3">
                            <span class="flex items-center gap-1"><i class="far fa-calendar"></i>
                                {{ $artikel->created_at->format('d M Y') }}</span>
                            <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                            <span class="flex items-center gap-1"><i class="far fa-user"></i>
                                {{ $artikel->penulis }}</span>
                        </div>

                        <h3
                            class="text-xl font-bold text-gray-800 mb-3 leading-snug {{ $hoverClass }} transition-colors">
                            {{ $artikel->judul }}
                        </h3>

                        <p class="text-gray-600 text-sm leading-relaxed mb-6 line-clamp-3">
                            {{ Str::limit(strip_tags($artikel->isi), 120) }}
                        </p>

                        <div class="mt-auto pt-4 border-t border-gray-100 flex justify-between items-center">
                            <a href="{{ route('artikel.show', $artikel->id) }}"
                                class="text-sm font-semibold text-posyanduu flex items-center gap-2 group/btn">
                                Baca Selengkapnya
                                <i
                                    class="fas fa-arrow-right transform group-hover/btn:translate-x-1 transition-transform"></i>
                            </a>
                        </div>
                    </div>
                </article>


            @empty
                <div
                    class="gsap-card opacity-0 col-span-1 md:col-span-2 py-16 text-center bg-white rounded-2xl border-2 border-dashed border-gray-200 flex flex-col items-center justify-center">
                    <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-newspaper text-gray-300 text-4xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800">Belum ada artikel</h3>
                    <p class="text-gray-500 text-sm mt-1">Nantikan informasi terbaru dari kami.</p>
                </div>
            @endforelse
        </div>
        <div class="mt-10">
            {{ $artikels->links() }}
        </div>
    </main>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const tl = gsap.timeline({
                defaults: {
                    ease: "power3.out"
                }
            });

            tl.to(".gsap-header", {
                    opacity: 1,
                    y: 0,
                    duration: 0.8
                })
                .to(".gsap-hero", {
                    opacity: 1,
                    scale: 1,
                    duration: 0.8
                }, "-=0.4")
                .to(".gsap-card", {
                    opacity: 1,
                    y: 0,
                    duration: 0.6,
                    stagger: 0.2
                }, "-=0.4");
        });
    </script>

</x-app-main>
