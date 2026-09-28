<x-app-main title="Edit Jadwal">
    <main class="min-h-screen w-full bg-slate-50/50 p-4 md:p-6 lg:p-8">

        {{-- Tombol Kembali --}}
        <div class="mb-6 gsap-back opacity-0 -translate-x-5">
            <a href="{{ route('pemeriksaan.index') }}?tab=jadwal"
                class="inline-flex items-center text-sm text-slate-500 hover:text-posyanduu transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Daftar Jadwal
            </a>
        </div>

        {{-- Card Container --}}
        <div
            class="gsap-card opacity-0 translate-y-10 bg-white rounded-2xl shadow-lg border border-slate-100 overflow-hidden w-full max-w-4xl mx-auto">

            {{-- Header Section --}}
            <div class="relative bg-gradient-to-r bg-posyanduu px-6 py-8 md:px-10">
                <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 rounded-full bg-white opacity-10 blur-xl">
                </div>
                <div class="absolute bottom-0 left-0 -mb-4 -ml-4 w-24 h-24 rounded-full bg-white opacity-10 blur-xl">
                </div>

                <div class="relative flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <div class="gsap-header-item opacity-0 translate-y-3 flex items-center gap-3 mb-2">
                            <span
                                class="bg-white/20 backdrop-blur-sm text-white text-xs font-semibold px-2.5 py-0.5 rounded border border-white/10">
                                KEGIATAN
                            </span>
                        </div>
                        <h1
                            class="gsap-header-item opacity-0 translate-y-3 text-3xl font-bold text-white tracking-tight">
                            Edit Jadwal Posyandu
                        </h1>
                        <p
                            class="gsap-header-item opacity-0 translate-y-3 text-blue-50 mt-2 text-sm md:text-base max-w-2xl">
                            Perbarui informasi kegiatan, lokasi, dan waktu pelaksanaan.
                        </p>
                    </div>

                    <div class="hidden md:block opacity-90 gsap-header-icon scale-75">
                        <div class="bg-white/10 backdrop-blur-md p-3 rounded-xl border border-white/20 shadow-inner">
                            {{-- Icon Calendar --}}
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Form Section --}}
            <div class="p-6 md:p-10 bg-white">
                <form action="{{ route('jadwal.update', $jadwal->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-8 gap-y-6">

                        {{-- Input Keterangan --}}
                        <div class="col-span-1 lg:col-span-2 gsap-input opacity-0 translate-y-5">
                            <label for="keterangan" class="block text-sm font-semibold text-slate-700 mb-2">
                                Keterangan Kegiatan
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    {{-- Icon Document --}}
                                    <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <input type="text" id="keterangan" name="keterangan"
                                    value="{{ old('keterangan', $jadwal->keterangan) }}"
                                    class="pl-10 w-full rounded-lg border-slate-300 focus:ring-2 focus:ring-posyanduu focus:border-posyanduu transition-all shadow-sm py-2.5"
                                    placeholder="Contoh: Pemberian Vitamin A" required>
                            </div>
                        </div>

                        {{-- Input Lokasi --}}
                        <div class="col-span-1 lg:col-span-2 gsap-input opacity-0 translate-y-5">
                            <label for="lokasi" class="block text-sm font-semibold text-slate-700 mb-2">
                                Lokasi Pelaksanaan
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    {{-- Icon Map Pin --}}
                                    <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <input type="text" id="lokasi" name="lokasi"
                                    value="{{ old('lokasi', $jadwal->lokasi) }}"
                                    class="pl-10 w-full rounded-lg border-slate-300 focus:ring-2 focus:ring-posyanduu focus:border-posyanduu transition-all shadow-sm py-2.5"
                                    placeholder="Contoh: Balai Desa Sukamaju" required>
                            </div>
                        </div>

                        {{-- Input Waktu Mulai --}}
                        <div class="col-span-1 gsap-input opacity-0 translate-y-5">
                            <label for="waktu_mulai" class="block text-sm font-semibold text-slate-700 mb-2">
                                Waktu Mulai
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    {{-- Icon Clock --}}
                                    <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <input type="datetime-local" id="waktu_mulai" name="waktu_mulai"
                                    value="{{ old('waktu_mulai', \Carbon\Carbon::parse($jadwal->waktu_mulai)->format('Y-m-d\TH:i')) }}"
                                    class="pl-10 w-full rounded-lg border-slate-300 focus:ring-2 focus:ring-posyanduu focus:border-posyanduu transition-all shadow-sm py-2.5"
                                    required>
                            </div>
                        </div>

                        {{-- Input Waktu Selesai --}}
                        <div class="col-span-1 gsap-input opacity-0 translate-y-5">
                            <label for="waktu_selesai" class="block text-sm font-semibold text-slate-700 mb-2">
                                Waktu Selesai
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    {{-- Icon Clock --}}
                                    <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <input type="datetime-local" id="waktu_selesai" name="waktu_selesai"
                                    value="{{ old('waktu_selesai', \Carbon\Carbon::parse($jadwal->waktu_selesai)->format('Y-m-d\TH:i')) }}"
                                    class="pl-10 w-full rounded-lg border-slate-300 focus:ring-2 focus:ring-posyanduu focus:border-posyanduu transition-all shadow-sm py-2.5"
                                    required>
                            </div>
                        </div>

                    </div>

                    {{-- Action Buttons --}}
                    <div
                        class="mt-8 pt-6 border-t border-slate-100 flex flex-col-reverse sm:flex-row justify-end gap-3 gsap-input opacity-0 translate-y-5">
                        <a href="{{ route('pemeriksaan.index') }}?tab=jadwal"
                            class="inline-flex justify-center items-center px-6 py-3 border border-slate-300 shadow-sm text-sm font-medium rounded-lg text-slate-700 bg-white hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-500 transition-all">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Batal
                        </a>
                        <button type="submit"
                            class="inline-flex justify-center items-center px-6 py-3 border border-transparent shadow-md text-sm font-medium rounded-lg text-white bg-gradient-to-r bg-posyanduu hover:brightness-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-posyanduu transition-all transform hover:-translate-y-0.5">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4">
                                </path>
                            </svg>
                            Update Jadwal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    {{-- Script GSAP --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const tl = gsap.timeline({
                defaults: {
                    ease: "power3.out",
                    duration: 0.8
                }
            });

            tl.to(".gsap-back", {
                    opacity: 1,
                    x: 0,
                    duration: 0.5
                })
                .to(".gsap-card", {
                    opacity: 1,
                    y: 0,
                    duration: 0.6
                }, "-=0.3")
                .to([".gsap-header-item", ".gsap-header-icon"], {
                    opacity: 1,
                    y: 0,
                    scale: 1,
                    stagger: 0.1,
                    duration: 0.5
                }, "-=0.2")
                .to(".gsap-input", {
                    opacity: 1,
                    y: 0,
                    stagger: 0.05,
                    duration: 0.5
                }, "-=0.3");
        });
    </script>
</x-app-main>
