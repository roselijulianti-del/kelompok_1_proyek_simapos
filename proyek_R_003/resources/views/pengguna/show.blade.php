<x-app-main title="Detail Jadwal">

    {{-- Background Decoration --}}
    <div class="fixed inset-0 -z-10 overflow-hidden pointer-events-none">
        <div
            class="absolute top-0 right-0 w-[500px] h-[500px] bg-indigo-100/40 rounded-full blur-3xl mix-blend-multiply filter animate-blob">
        </div>
        <div
            class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-pink-100/40 rounded-full blur-3xl mix-blend-multiply filter animate-blob animation-delay-2000">
        </div>
    </div>

    {{-- PERBAIKAN 1: Hapus 'ml-5' agar mobile rata tengah --}}
    <main class="min-h-screen w-full p-4 md:p-8 flex justify-center items-center ml-5">

        <div class="w-full max-w-4xl relative">

            <div class="gsap-item opacity-0 -translate-x-10 relative mb-4 md:absolute md:mb-0 md:-left-16 md:top-0 z-20">
                <a href="{{ route('pengguna.dashboard') }}"
                    class="group flex items-center justify-center w-12 h-12 bg-white rounded-full shadow-lg text-slate-400 hover:text-indigo-600 hover:scale-110 transition-all duration-300">
                    <i class="fas fa-arrow-left text-lg group-hover:-translate-x-1 transition-transform"></i>
                </a>
            </div>

            <div
                class="gsap-card opacity-0 translate-y-10 bg-white/90 backdrop-blur-xl rounded-[2.5rem] shadow-2xl border border-white/50 overflow-hidden relative">

                <div
                    class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500">
                </div>

                <div class="p-6 md:p-12"> {{-- Sedikit penyesuaian padding mobile --}}

                    <div
                        class="flex flex-col md:flex-row gap-6 md:gap-10 items-start mb-10 border-b border-slate-100 pb-10">
                        <div class="flex-shrink-0">
                            <div
                                class="w-20 h-20 md:w-28 md:h-28 bg-gradient-to-br from-indigo-50 to-white rounded-3xl shadow-xl shadow-indigo-100/50 border border-indigo-50 flex flex-col items-center justify-center text-center group hover:scale-105 transition-transform duration-300">
                                <span
                                    class="text-[10px] md:text-xs font-bold text-indigo-500 uppercase tracking-widest mb-1">
                                    {{ \Carbon\Carbon::parse($jadwal->waktu_mulai)->translatedFormat('M') }}
                                </span>
                                <span class="text-3xl md:text-5xl font-black text-slate-800 leading-none">
                                    {{ \Carbon\Carbon::parse($jadwal->waktu_mulai)->translatedFormat('d') }}
                                </span>
                                <span class="text-[10px] md:text-xs font-medium text-slate-400 mt-1">
                                    {{ \Carbon\Carbon::parse($jadwal->waktu_mulai)->translatedFormat('Y') }}
                                </span>
                            </div>
                        </div>

                        <div class="flex-1 pt-1">
                            <div class="flex flex-wrap items-center gap-2 mb-3">
                                <span
                                    class="px-3 py-1 rounded-full bg-indigo-100 text-indigo-600 text-[10px] md:text-xs font-bold uppercase tracking-wider">
                                    Event Posyandu
                                </span>
                                <span
                                    class="px-3 py-1 rounded-full bg-slate-100 text-slate-500 text-[10px] md:text-xs font-bold uppercase tracking-wider">
                                    {{ \Carbon\Carbon::parse($jadwal->waktu_mulai)->translatedFormat('l') }}
                                </span>
                            </div>
                            <h1 class="text-2xl md:text-4xl font-extrabold text-slate-800 leading-tight mb-3">
                                {{ $jadwal->keterangan }}
                            </h1>
                            <p class="text-slate-500 text-sm md:text-lg leading-relaxed">
                                Mohon hadir tepat waktu untuk kelancaran kegiatan pemeriksaan kesehatan.
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                        <div
                            class="gsap-item opacity-0 translate-y-5 bg-slate-50 rounded-3xl p-6 md:p-8 border border-slate-100 hover:border-indigo-200 transition-colors duration-300">
                            <h3 class="flex items-center text-lg font-bold text-slate-800 mb-6">
                                <i class="far fa-clock text-indigo-500 mr-3 text-xl"></i> Durasi Kegiatan
                            </h3>

                            <div class="relative pl-4 ml-2 border-l-2 border-dashed border-indigo-200 space-y-8">
                                <div class="relative group">
                                    <div
                                        class="absolute -left-[25px] top-1.5 w-4 h-4 rounded-full bg-indigo-500 ring-4 ring-indigo-100 group-hover:ring-indigo-200 transition-all">
                                    </div>
                                    <div>
                                        <p class="text-[10px] font-bold text-indigo-500 uppercase tracking-wide mb-1">
                                            Waktu Mulai</p>
                                        <p class="text-2xl font-bold text-slate-700">
                                            {{ \Carbon\Carbon::parse($jadwal->waktu_mulai)->format('H:i') }} <span
                                                class="text-sm font-normal text-slate-400">WIB</span>
                                        </p>
                                    </div>
                                </div>

                                <div class="relative group">
                                    <div
                                        class="absolute -left-[25px] top-1.5 w-4 h-4 rounded-full bg-pink-400 ring-4 ring-pink-100 group-hover:ring-pink-200 transition-all">
                                    </div>
                                    <div>
                                        <p class="text-[10px] font-bold text-pink-400 uppercase tracking-wide mb-1">
                                            Waktu Selesai</p>
                                        <p class="text-2xl font-bold text-slate-700">
                                            {{ \Carbon\Carbon::parse($jadwal->waktu_selesai)->format('H:i') }} <span
                                                class="text-sm font-normal text-slate-400">WIB</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="gsap-item opacity-0 translate-y-5 flex flex-col h-full">
                            <div
                                class="flex-1 bg-gradient-to-br from-white to-indigo-50/50 rounded-3xl p-6 md:p-8 border border-slate-100 hover:shadow-lg hover:shadow-indigo-100/50 transition-all duration-300 group">
                                <h3 class="flex items-center text-lg font-bold text-slate-800 mb-6">
                                    <i class="fas fa-map-pin text-pink-500 mr-3 text-xl"></i> Tempat Pelaksanaan
                                </h3>

                                <div class="flex items-start gap-4 md:gap-5">
                                    <div
                                        class="w-12 h-12 md:w-14 md:h-14 rounded-2xl bg-white shadow-md flex items-center justify-center text-xl md:text-2xl text-indigo-600 flex-shrink-0 border border-indigo-50 group-hover:scale-110 group-hover:rotate-6 transition-transform duration-300">
                                        <i class="fas fa-building"></i>
                                    </div>

                                    <div>
                                        <p class="text-lg md:text-2xl font-bold text-slate-800 leading-snug">
                                            {{ $jadwal->lokasi }}
                                        </p>
                                        <p class="mt-2 text-slate-500 text-xs md:text-sm leading-relaxed">
                                            Pastikan Anda datang ke lokasi yang tertera di atas.
                                        </p>
                                    </div>
                                </div>

                                <div class="mt-6 pt-4 border-t border-indigo-100">
                                    <div
                                        class="flex items-center text-xs font-medium text-indigo-400 bg-indigo-50 w-fit px-3 py-1.5 rounded-lg">
                                        <i class="fas fa-check-circle mr-1.5"></i> Lokasi Terkonfirmasi
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>

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
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const tl = gsap.timeline({
                defaults: {
                    ease: "power3.out"
                }
            });
            tl.to(".gsap-card", {
                y: 0,
                opacity: 1,
                duration: 0.8,
                ease: "back.out(1.1)"
            });
            tl.to(".gsap-item", {
                x: 0,
                y: 0,
                opacity: 1,
                stagger: 0.2,
                duration: 0.6
            }, "-=0.5");
        });
    </script>

</x-app-main>
