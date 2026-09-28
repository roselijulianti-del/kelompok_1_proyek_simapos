<x-app-main title="Jadwal Kegiatan">

    {{-- 1. Animated Background Blobs (Agar tidak kosong) --}}
    <div class="fixed inset-0 -z-10 overflow-hidden pointer-events-none">
        <div
            class="absolute top-10 left-10 w-72 h-72 bg-purple-300/30 rounded-full blur-3xl mix-blend-multiply filter animate-blob">
        </div>
        <div
            class="absolute top-10 right-10 w-72 h-72 bg-yellow-200/30 rounded-full blur-3xl mix-blend-multiply filter animate-blob animation-delay-2000">
        </div>
        <div
            class="absolute -bottom-8 left-20 w-72 h-72 bg-pink-300/30 rounded-full blur-3xl mix-blend-multiply filter animate-blob animation-delay-4000">
        </div>
    </div>

    <main class="relative px-4 py-8 md:px-8 min-h-screen">

        <!-- Header Section -->
        <div id="headerBox" class="text-center mb-12 opacity-0 translate-y-10">
            <span
                class="inline-block py-1 px-3 rounded-full bg-white text-button text-xs font-bold tracking-wider mb-2 border border-indigo-200 uppercase">
                Posyandu Events
            </span>
            <h1 class="text-4xl md:text-5xl font-extrabold text-slate-800 tracking-tight mb-4">
                Agenda & <span
                    class="text-transparent bg-clip-text bg-gradient-to-r from-posyanduu to-posyanduDark">Jadwal
                    Kegiatan</span>
            </h1>
            <p class="text-slate-500 text-lg max-w-2xl mx-auto">
                Jangan lewatkan kegiatan penting posyandu untuk memantau kesehatan ibu dan buah hati.
            </p>
        </div>

        <!-- Grid Container -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8 max-w-7xl mx-auto" id="jadwalGrid">

            @forelse ($jadwals as $jadwal)
                <!-- Card Item -->
                <div
                    class="jadwal-card group relative bg-white/80 backdrop-blur-md rounded-[2rem] p-6 shadow-xl border border-white/50 hover:border-posyanduu transition-all duration-300 cursor-default opacity-0">

                    <!-- Decorative Gradient Top -->
                    <div
                        class="absolute top-0 left-0 w-full h-24 bg-gradient-to-br from-indigo-50 to-purple-50 rounded-t-[2rem] -z-10 opacity-50 group-hover:opacity-100 transition-opacity">
                    </div>

                    <!-- Date Badge (Floating) -->
                    <div
                        class="absolute top-6 right-6 flex flex-col items-center justify-center w-16 h-16 bg-white rounded-2xl shadow-lg border border-indigo-50 group-hover:scale-110 transition-transform duration-300">
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-wide">
                            {{ \Carbon\Carbon::parse($jadwal->waktu_mulai)->translatedFormat('M') }}
                        </span>
                        <span
                            class="text-2xl font-extrabold text-transparent bg-clip-text bg-gradient-to-br from-posyanduu to-posyanduDark">
                            {{ \Carbon\Carbon::parse($jadwal->waktu_mulai)->translatedFormat('d') }}
                        </span>
                    </div>

                    <!-- Content -->
                    <div class="mt-4">
                        <!-- Icon Category -->
                        <div
                            class="w-12 h-12 rounded-xl bg-white text-posyanduu flex items-center justify-center text-xl mb-4 group-hover:rotate-12 transition-transform duration-300 shadow-sm">
                            <i class="fas fa-calendar-alt"></i>
                        </div>

                        <h3
                            class="text-xl font-bold text-slate-800 mb-2 line-clamp-2 group-hover:text-posyanduu transition-colors">
                            {{ $jadwal->keterangan }}
                        </h3>

                        <div class="space-y-3 mt-4 mb-6">
                            <!-- Waktu -->
                            <div class="flex items-center text-slate-600 bg-slate-50 p-2 rounded-lg">
                                <div
                                    class="w-8 h-8 rounded-full bg-white flex items-center justify-center text-orange-400 shadow-sm mr-3">
                                    <i class="far fa-clock"></i>
                                </div>
                                <span class="text-sm font-medium">
                                    {{ \Carbon\Carbon::parse($jadwal->waktu_mulai)->format('H:i') }} -
                                    {{ \Carbon\Carbon::parse($jadwal->waktu_selesai)->format('H:i') }} WIB
                                </span>
                            </div>

                            <!-- Lokasi -->
                            <div class="flex items-center text-slate-600 bg-slate-50 p-2 rounded-lg">
                                <div
                                    class="w-8 h-8 rounded-full bg-white flex items-center justify-center text-red-400 shadow-sm mr-3">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <span class="text-sm font-medium line-clamp-1">
                                    {{ $jadwal->lokasi }}
                                </span>
                            </div>
                        </div>

                        <!-- Button -->
                        <a href="{{ route('pengguna.show', $jadwal->slug) }}"
                            class="block w-full py-3 px-4 bg-white border-2 border-slate-100 rounded-xl text-center text-slate-600 font-bold text-sm hover:bg-posyanduu hover:border-posyanduu hover:text-white hover:shadow-lg hover:shadow-buttonhover transition-all duration-300 group-hover:-translate-y-1">
                            Lihat Detail Acara <i class="fas fa-arrow-right ml-2 text-xs"></i>
                        </a>
                    </div>
                </div>
            @empty
                <!-- Empty State -->
                <div class="col-span-full flex flex-col items-center justify-center py-20 text-center">
                    <div class="relative">
                        <div class="absolute inset-0 bg-blue-200 rounded-full blur-xl opacity-20 animate-pulse"></div>
                        <i class="fa-solid fa-calendar-day text-8xl text-slate-300 relative z-10"></i>
                    </div>
                    <h3 class="mt-6 text-xl font-bold text-slate-600">Belum Ada Agenda</h3>
                    <p class="text-slate-400 mt-2 max-w-md">Saat ini belum ada jadwal kegiatan posyandu yang akan
                        datang. Silakan cek kembali nanti.</p>
                </div>
            @endforelse

        </div>
    </main>

    <!-- Style Animasi Blob -->
    <style>
        @keyframes blob {
            0% {
                transform: translate(0px, 0px) scale(1);
            }

            33% {
                transform: translate(30px, -50px) scale(1.1);
            }

            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }

            100% {
                transform: translate(0px, 0px) scale(1);
            }
        }

        .animate-blob {
            animation: blob 7s infinite;
        }

        .animation-delay-2000 {
            animation-delay: 2s;
        }

        .animation-delay-4000 {
            animation-delay: 4s;
        }
    </style>

    <!-- GSAP Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const tl = gsap.timeline({
                defaults: {
                    ease: "power3.out"
                }
            });

            // 1. Header Animation
            tl.to("#headerBox", {
                y: 0,
                opacity: 1,
                duration: 1
            });

            // 2. Cards Animation (Staggered)
            if (document.querySelectorAll(".jadwal-card").length > 0) {
                tl.to(".jadwal-card", {
                    opacity: 1,
                    y: 0,
                    duration: 0.8,
                    stagger: 0.15, // Efek muncul berurutan
                    ease: "back.out(1.7)" // Efek sedikit memantul saat muncul
                }, "-=0.5");
            }

            // 3. Efek 3D Tilt saat Hover (Membuat kartu bergerak mengikuti mouse)
            const cards = document.querySelectorAll('.jadwal-card');

            cards.forEach(card => {
                card.addEventListener('mousemove', (e) => {
                    const rect = card.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;

                    // Rotasi ringan
                    const xRotation = (y - rect.height / 2) / 20;
                    const yRotation = (x - rect.width / 2) / 20;

                    gsap.to(card, {
                        duration: 0.5,
                        rotationX: -xRotation,
                        rotationY: yRotation,
                        scale: 1.02,
                        transformPerspective: 1000,
                        ease: "power2.out"
                    });
                });

                card.addEventListener('mouseleave', () => {
                    gsap.to(card, {
                        duration: 0.5,
                        rotationX: 0,
                        rotationY: 0,
                        scale: 1,
                        ease: "power2.out"
                    });
                });
            });
        });
    </script>
</x-app-main>
