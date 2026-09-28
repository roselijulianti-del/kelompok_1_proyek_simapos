<x-app-main title="{{ $artikel->judul }}">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>

    <main class="ml-2 md:ml-2 min-h-screen pb-20">

        <div class="gsap-header opacity-0 -translate-y-5 mb-6">
            <a href="{{ route('artikel.index') }}"
                class="inline-flex items-center text-gray-500 hover:text-posyanduu transition-colors mb-4 group font-medium">
                <div
                    class="w-8 h-8 rounded-full bg-white border border-gray-200 flex items-center justify-center mr-2 group-hover:border-posyanduu group-hover:bg-posyanduu group-hover:text-white transition-all shadow-sm">
                    <i class="fas fa-arrow-left text-sm"></i>
                </div>
                Kembali ke Daftar Artikel
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

            <div class="lg:col-span-8">
                <article
                    class="bg-white rounded-3xl shadow-xl shadow-gray-100/50 overflow-hidden border border-gray-100">

                    <div class="gsap-image opacity-0 scale-95 relative h-64 md:h-96 w-full overflow-hidden">
                        <img src="{{ asset('storage/' . $artikel->gambar) }}" alt="{{ $artikel->judul }}"
                            class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>

                        <div class="absolute bottom-6 left-6 md:left-8">
                            <span
                                class="px-4 py-2 rounded-lg text-xs font-bold uppercase tracking-wider text-white backdrop-blur-md bg-white/20 border border-white/30 shadow-sm">
                                <i class="fas {{ $artikel->kategori == 'Balita' ? 'fa-baby' : 'fa-female' }} mr-1"></i>
                                {{ $artikel->kategori }}
                            </span>
                        </div>
                    </div>

                    <div class="gsap-content opacity-0 translate-y-5 p-6 md:p-10">

                        <h1 class="text-2xl md:text-4xl font-extrabold text-gray-800 leading-tight mb-4">
                            {{ $artikel->judul }}
                        </h1>

                        <div class="flex items-center gap-6 text-sm text-gray-500 mb-8 border-b border-gray-100 pb-6">
                            <div class="flex items-center gap-2">
                                <div
                                    class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-gray-400">
                                    <i class="fas fa-user"></i>
                                </div>
                                <span class="font-medium text-gray-700">{{ $artikel->penulis }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i class="far fa-calendar-alt text-posyanduu"></i>
                                <span>{{ $artikel->created_at->format('d F Y') }}</span>
                            </div>
                        </div>

                        <div class="text-gray-600 leading-loose text-lg space-y-4 text-justify">
                            {!! nl2br(e($artikel->isi)) !!}
                        </div>

                        <div class="mt-10 pt-6 border-t border-gray-100 flex items-center justify-between">
                            <span class="text-sm font-bold text-gray-400 uppercase tracking-wide">Bagikan artikel
                                ini:</span>
                            <div class="flex gap-3">
                                <button
                                    class="w-10 h-10 rounded-full bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition-all flex items-center justify-center">
                                    <i class="fab fa-facebook-f"></i>
                                </button>
                                <button
                                    class="w-10 h-10 rounded-full bg-green-50 text-green-600 hover:bg-green-600 hover:text-white transition-all flex items-center justify-center">
                                    <i class="fab fa-whatsapp"></i>
                                </button>
                                <button
                                    class="w-10 h-10 rounded-full bg-sky-50 text-sky-500 hover:bg-sky-500 hover:text-white transition-all flex items-center justify-center">
                                    <i class="fab fa-twitter"></i>
                                </button>
                            </div>
                        </div>

                    </div>
                </article>
            </div>

            <div class="lg:col-span-4 space-y-6">
                <div class="gsap-sidebar opacity-0 translate-x-5">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                        <i class="fas fa-book-open text-posyanduu"></i> Baca Juga
                    </h3>

                    <div class="flex flex-col gap-4">
                        @foreach ($rekomendasi as $item)
                            <a href="{{ route('artikel.show', $item->id) }}"
                                class="group bg-white p-3 rounded-xl shadow-sm border border-gray-100 hover:shadow-md hover:border-posyanduu/30 transition-all flex gap-3 items-center">
                                <div class="w-20 h-20 flex-shrink-0 rounded-lg overflow-hidden relative">
                                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}"
                                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                </div>
                                <div>
                                    <span
                                        class="text-[10px] font-bold uppercase text-posyanduu mb-1 block">{{ $item->kategori }}</span>
                                    <h4
                                        class="text-sm font-bold text-gray-700 leading-snug group-hover:text-posyanduu transition-colors line-clamp-2">
                                        {{ $item->judul }}
                                    </h4>
                                    <p class="text-xs text-gray-400 mt-1">{{ $item->created_at->diffForHumans() }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    <div
                        class="mt-8 bg-gradient-to-br from-posyanduu to-teal-600 rounded-2xl p-6 text-white text-center shadow-lg relative overflow-hidden">
                        <div class="absolute top-0 right-0 -mt-2 -mr-2 w-16 h-16 bg-white/20 rounded-full blur-xl">
                        </div>
                        <div class="absolute bottom-0 left-0 -mb-2 -ml-2 w-20 h-20 bg-black/10 rounded-full blur-xl">
                        </div>

                        <i class="fas fa-heartbeat text-4xl mb-3 text-white/90"></i>
                        <h3 class="font-bold text-lg mb-2">Jaga Kesehatan Keluarga</h3>
                        <p class="text-sm text-white/80 mb-4">Rutin ke Posyandu untuk memantau tumbuh kembang si kecil.
                        </p>
                        <a href="{{ url('/jadwall') }}"
                            class="inline-block bg-white text-posyanduu font-bold text-xs py-2 px-4 rounded-lg shadow-md hover:bg-gray-50 transition-colors">
                            Cek Jadwal
                        </a>
                    </div>
                </div>
            </div>

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
                    duration: 0.6
                })
                .to(".gsap-image", {
                    opacity: 1,
                    scale: 1,
                    duration: 0.8
                }, "-=0.3")
                .to(".gsap-content", {
                    opacity: 1,
                    y: 0,
                    duration: 0.8
                }, "-=0.5")
                .to(".gsap-sidebar", {
                    opacity: 1,
                    x: 0,
                    duration: 0.8
                }, "-=0.6");
        });
    </script>
</x-app-main>
