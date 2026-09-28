<x-app-main title="Profil Pengguna">

    <!-- GSAP INLINE -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

    <main class="p-6 bg-gradient-to-br from-gray-50 to-green-50 min-h-screen">

        <div class="max-w-4xl mx-auto">

            <!-- HEADER PROFIL -->
            <div
                class="gsap-header opacity-0 translate-y-10 bg-gradient-to-r from-buttonhover to-button rounded-3xl shadow-xl p-6 mb-10 text-white relative overflow-hidden">

                <!-- Dekorasi -->
                <div class="absolute -top-10 -right-10 w-48 h-48 bg-white/10 rounded-full blur-2xl"></div>

                <div class="flex flex-col md:flex-row items-center justify-between relative z-10">

                    <!-- Avatar & Nama -->
                    <div class="flex items-center gap-4 mb-4 md:mb-0">
                        <div
                            class="gsap-avatar w-20 h-20 bg-white/20 rounded-full flex items-center justify-center shadow-inner backdrop-blur-md">
                            <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 12a5 5 0 1 0 0-10 5 5 0 0 0 0 10Zm0 2c-4.42 0-8 3.58-8 8h16c0-4.42-3.58-8-8-8Z" />
                            </svg>
                        </div>

                        <div>
                            <h1 class="text-3xl font-bold tracking-tight">{{ ucfirst($profiles->name) }}</h1>
                            <p class="text-green-100 opacity-90">{{ ucfirst($profiles->role) }}</p>
                        </div>
                    </div>

                    <!-- Tanggal Join -->
                    <div class="text-center md:text-right bg-white/10 px-4 py-2 rounded-xl backdrop-blur-md">
                        <p class="text-sm text-green-100">Bergabung sejak</p>
                        <p class="font-semibold">{{ $profiles->created_at->format('d F Y') }}</p>
                    </div>
                </div>
            </div>

            <!-- GRID -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- SIDEBAR -->
                <div class="lg:col-span-1 space-y-6">

                    <div
                        class="gsap-sidebar-item opacity-0 -translate-x-10 bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Menu Profil</h3>
                        <nav class="space-y-2">

                            <a href="#"
                                class="flex items-center gap-3 p-3 rounded-xl bg-green-50 text-button hover:bg-buttonhover hover:text-white transition-all">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <span>Informasi Pribadi</span>
                            </a>

                        </nav>
                    </div>

                    @if ($profiles->role == 'kader')
                        <div
                            class="gsap-sidebar-item opacity-0 -translate-x-10 bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Statistik</h3>

                            <div class="space-y-4">

                                <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                                    <span class="text-gray-600">Peserta</span>
                                    <span class="font-semibold text-button">{{ $totalPeserta }}</span>
                                </div>

                                <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                                    <span class="text-gray-600">Pemeriksaan</span>
                                    <span class="font-semibold text-button">{{ $pemeriksaans->count() }}</span>
                                </div>

                            </div>
                        </div>
                    @endif

                </div>

                <!-- MAIN CONTENT -->
                <div class="lg:col-span-2">

                    <div
                        class="gsap-content opacity-0 translate-y-10 bg-white rounded-2xl shadow-lg p-6 border border-gray-100">

                        <div class="flex justify-between items-center mb-6 pb-4 border-b border-gray-200">
                            <h2 class="text-xl font-bold text-gray-800">Informasi Pribadi</h2>
                        </div>

                        <div class="space-y-6">

                            <!-- Nama -->
                            <div
                                class="info-card grid grid-cols-1 md:grid-cols-3 gap-4 p-3 rounded-xl hover:bg-gray-50 border">
                                <div class="text-sm font-medium text-gray-600">Nama Lengkap</div>
                                <div class="md:col-span-2 text-gray-900 font-medium">{{ ucfirst($profiles->name) }}
                                </div>
                            </div>

                            <!-- Email -->
                            <div
                                class="info-card grid grid-cols-1 md:grid-cols-3 gap-4 p-3 rounded-xl hover:bg-gray-50 border">
                                <div class="text-sm font-medium text-gray-600">Alamat Email</div>
                                <div class="md:col-span-2 text-gray-900 font-medium">{{ $profiles->email }}</div>
                            </div>

                            <!-- Peran -->
                            <div
                                class="info-card grid grid-cols-1 md:grid-cols-3 gap-4 p-3 rounded-xl hover:bg-gray-50 border">
                                <div class="text-sm font-medium text-gray-600">Peran</div>
                                <div class="md:col-span-2">
                                    {{-- kondisi warna --}}
                                    @if ($profiles->role == 'kader')
                                        <span class="px-3 py-1 rounded-full bg-button text-white font-semibold text-sm">
                                            {{ ucfirst($profiles->role) }}
                                        </span>
                                    @else
                                        <span
                                            class="px-3 py-1 rounded-full bg-buttonhover text-white font-semibold text-sm">
                                            {{ ucfirst($profiles->role) }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Created -->
                            <div
                                class="info-card grid grid-cols-1 md:grid-cols-3 gap-4 p-3 rounded-xl hover:bg-gray-50 border">
                                <div class="text-sm font-medium text-gray-600">Bergabung Pada</div>
                                <div class="md:col-span-2 text-gray-900">
                                    {{ $profiles->created_at->format('d F Y, H:i') }}</div>
                            </div>

                            <!-- Updated -->
                            <div
                                class="info-card grid grid-cols-1 md:grid-cols-3 gap-4 p-3 rounded-xl hover:bg-gray-50 border">
                                <div class="text-sm font-medium text-gray-600">Terakhir Diperbarui</div>
                                <div class="md:col-span-2 text-gray-900">
                                    {{ $profiles->updated_at->format('d F Y, H:i') }}</div>
                            </div>

                        </div>

                    </div>

                </div>
            </div>

        </div>

    </main>

    <!-- GSAP ANIMASI -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {

            const tl = gsap.timeline({
                defaults: {
                    ease: "power3.out"
                }
            });

            tl.to(".gsap-header", {
                    y: 0,
                    opacity: 1,
                    duration: 1
                })
                .from(".gsap-avatar", {
                    scale: 0,
                    rotation: -90,
                    duration: 0.6,
                    ease: "elastic.out(1, 0.5)"
                }, "-=0.6")
                .to(".gsap-sidebar-item", {
                    x: 0,
                    opacity: 1,
                    duration: 0.6,
                    stagger: 0.15
                }, "-=0.5")
                .to(".gsap-content", {
                    y: 0,
                    opacity: 1,
                    duration: 0.6
                }, "-=0.6")
                .from(".info-card", {
                    y: 20,
                    opacity: 0,
                    duration: 0.4,
                    stagger: 0.08
                }, "-=0.5");

        });
    </script>

</x-app-main>
