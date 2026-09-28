<x-app-main title="Riwayat Pemeriksaan">
    {{-- Background Decoration --}}
    <div class="fixed inset-0 -z-10 overflow-hidden pointer-events-none">
        <div
            class="absolute top-0 left-0 w-96 h-96 bg-teal-200/30 rounded-full blur-3xl mix-blend-multiply filter animate-blob">
        </div>
        <div
            class="absolute top-0 right-0 w-96 h-96 bg-pink-200/30 rounded-full blur-3xl mix-blend-multiply filter animate-blob animation-delay-2000">
        </div>
        <div
            class="absolute -bottom-32 left-20 w-96 h-96 bg-blue-200/30 rounded-full blur-3xl mix-blend-multiply filter animate-blob animation-delay-4000">
        </div>
    </div>

    <main class="relative px-4 py-8 md:px-8">

        <!-- HEADER -->
        <div id="headerBox" class="mb-10 text-center md:text-left opacity-0 translate-y-10">
            <div class="inline-block p-3 rounded-2xl bg-white shadow-md mb-4">
                <i
                    class="fas fa-heartbeat text-4xl text-transparent bg-clip-text bg-gradient-to-r from-posyanduu to-posyanduDark"></i>
            </div>

            <h1 class="text-4xl font-extrabold text-slate-800 tracking-tight">
                Riwayat
                <span
                    class="text-transparent bg-clip-text bg-gradient-to-r from-posyanduu to-posyanduDark">
                    Kesehatan
                </span>
            </h1>

            <p class="text-slate-500 mt-2 text-lg max-w-2xl">
                Pantau terus tumbuh kembang buah hati dan kesehatan ibu secara real-time.
            </p>
        </div>

        {{-- =========================
            SECTION GRAFIK
        ========================== --}}
        @if ($balitas->count() > 0 || $ibuHamils->count() > 0)

            <div class="mb-14 opacity-0 translate-y-10" id="grafik-section">

                <div class="flex items-center gap-3 mb-6">
                    <div class="h-10 w-1.5 bg-gradient-to-b from-posyanduu to-posyanduDark rounded-full"></div>

                    <h2 class="text-2xl font-bold text-slate-800">
                        Grafik Perkembangan
                    </h2>
                </div>

                <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">

                    {{-- Grafik Berat Balita --}}
                    @if ($balitas->count() > 0)
                        <div
                            class="bg-white/80 backdrop-blur-xl rounded-[2rem] p-6 shadow-lg border border-white/50">

                            <div class="flex items-center gap-3 mb-6">
                                <div
                                    class="w-12 h-12 rounded-2xl bg-gradient-to-br from-cyan-400 to-blue-500 flex items-center justify-center text-white">
                                    <i class="fas fa-weight"></i>
                                </div>

                                <div>
                                    <h3 class="font-bold text-slate-800 text-lg">
                                        Grafik Berat Badan Balita
                                    </h3>

                                    <p class="text-sm text-slate-500">
                                        Perkembangan berat badan balita
                                    </p>
                                </div>
                            </div>

                            <div class="h-[320px]">
                                <canvas id="beratBalitaChart"></canvas>
                            </div>
                        </div>

                        {{-- Grafik Tinggi Balita --}}
                        <div
                            class="bg-white/80 backdrop-blur-xl rounded-[2rem] p-6 shadow-lg border border-white/50">

                            <div class="flex items-center gap-3 mb-6">
                                <div
                                    class="w-12 h-12 rounded-2xl bg-gradient-to-br from-emerald-400 to-teal-500 flex items-center justify-center text-white">
                                    <i class="fas fa-ruler-vertical"></i>
                                </div>

                                <div>
                                    <h3 class="font-bold text-slate-800 text-lg">
                                        Grafik Tinggi Badan Balita
                                    </h3>

                                    <p class="text-sm text-slate-500">
                                        Perkembangan tinggi badan balita
                                    </p>
                                </div>
                            </div>

                            <div class="h-[320px]">
                                <canvas id="tinggiBalitaChart"></canvas>
                            </div>
                        </div>
                    @endif

                    {{-- Grafik Ibu Hamil --}}
                    @if ($ibuHamils->count() > 0)
                        <div
                            class="bg-white/80 backdrop-blur-xl rounded-[2rem] p-6 shadow-lg border border-white/50 xl:col-span-2">

                            <div class="flex items-center gap-3 mb-6">
                                <div
                                    class="w-12 h-12 rounded-2xl bg-gradient-to-br from-pink-400 to-rose-500 flex items-center justify-center text-white">
                                    <i class="fas fa-female"></i>
                                </div>

                                <div>
                                    <h3 class="font-bold text-slate-800 text-lg">
                                        Grafik Kenaikan Berat Badan Ibu Hamil
                                    </h3>

                                    <p class="text-sm text-slate-500">
                                        Perkembangan berat badan ibu hamil
                                    </p>
                                </div>
                            </div>

                            <div class="h-[350px]">
                                <canvas id="ibuHamilChart"></canvas>
                            </div>
                        </div>
                    @endif

                </div>
            </div>

        @endif

        {{-- SECTION BALITA --}}
        @if ($balitas->count() > 0)
            <div class="mb-12">
                <div class="flex items-center gap-3 mb-6 opacity-0 translate-x-10" id="title-balita">
                    <div class="h-10 w-1.5 bg-gradient-to-b from-teal-400 to-blue-500 rounded-full"></div>

                    <h2 class="text-2xl font-bold text-slate-800">
                        Data Balita
                    </h2>

                    <span
                        class="bg-blue-100 text-blue-600 text-xs font-bold px-3 py-1 rounded-full border border-blue-200">
                        {{ $balitas->count() }} Terdaftar
                    </span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6" id="grid-balita">

                    @foreach ($balitas as $balita)

                        <div
                            class="card-item relative group bg-white/80 backdrop-blur-xl rounded-[2rem] p-6 shadow-lg border border-white/50 hover:border-blue-300 transition-all duration-300">

                            <div
                                class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-bl from-blue-100/50 to-transparent rounded-bl-[100%] rounded-tr-[2rem] transition-all group-hover:scale-110">
                            </div>

                            <div class="relative z-10">

                                <div class="flex items-start justify-between mb-4">
                                    <div class="flex items-center gap-4">

                                        <div
                                            class="w-14 h-14 rounded-2xl bg-gradient-to-br from-cyan-400 to-blue-500 flex items-center justify-center text-white shadow-lg shadow-blue-500/30 group-hover:rotate-12 transition-transform duration-300">
                                            <i class="fas fa-baby text-2xl"></i>
                                        </div>

                                        <div>
                                            <h3 class="text-lg font-bold text-slate-800 leading-tight">
                                                {{ $balita->nama_balita }}
                                            </h3>

                                            <p
                                                class="text-xs font-mono text-slate-500 bg-slate-100 px-2 py-0.5 rounded-md inline-block mt-1">
                                                {{ $balita->nik }}
                                            </p>
                                        </div>

                                    </div>
                                </div>

                                <div class="space-y-3 bg-slate-50/80 rounded-xl p-4 mb-4 border border-slate-100">

                                    <div class="flex justify-between items-center text-sm">
                                        <span class="text-slate-500">
                                            <i class="fas fa-user-friends mr-2 text-blue-300"></i>
                                            Orang Tua
                                        </span>

                                        <span class="font-semibold text-slate-700">
                                            {{ Str::limit($balita->nama_orang_tua, 15) }}
                                        </span>
                                    </div>

                                    <div class="h-px bg-slate-200"></div>

                                    @php
                                        $pemeriksaanTerakhir = $balita->pemeriksaans->first();
                                    @endphp

                                    <div class="flex justify-between items-start text-sm">

                                        <span class="text-slate-500">
                                            <i class="fas fa-calendar-check mr-2 text-blue-300"></i>
                                            Terakhir
                                        </span>

                                        <div class="text-right">
                                            @if ($pemeriksaanTerakhir)
                                                <span class="block font-bold text-teal-600">
                                                    {{ \Carbon\Carbon::parse($pemeriksaanTerakhir->tanggal)->format('d M Y') }}
                                                </span>
                                            @else
                                                <span class="block text-slate-400 italic text-xs">
                                                    Belum diperiksa
                                                </span>
                                            @endif
                                        </div>

                                    </div>

                                </div>

                                <a href="{{ route('laporan.pdf', ['tipe' => 'balita', 'id' => $balita->id]) }}"
                                    class="w-full inline-flex justify-center items-center py-3 rounded-xl bg-white border-2 border-slate-100 text-slate-600 font-semibold text-sm hover:bg-blue-50 hover:border-blue-200 hover:text-blue-600 transition-all duration-300 group-hover:shadow-md">

                                    <i
                                        class="fas fa-file-pdf mr-2 text-lg text-red-400 group-hover:scale-125 transition-transform"></i>

                                    Download Riwayat
                                </a>

                            </div>

                        </div>

                    @endforeach

                </div>
            </div>
        @endif

        {{-- SECTION IBU HAMIL --}}
        @if ($ibuHamils->count() > 0)
            <div class="mb-12">

                <div class="flex items-center gap-3 mb-6 opacity-0 translate-x-10" id="title-ibu">

                    <div class="h-10 w-1.5 bg-gradient-to-b from-pink-400 to-rose-500 rounded-full"></div>

                    <h2 class="text-2xl font-bold text-slate-800">
                        Data Ibu Hamil
                    </h2>

                    <span
                        class="bg-pink-100 text-pink-600 text-xs font-bold px-3 py-1 rounded-full border border-pink-200">
                        {{ $ibuHamils->count() }} Terdaftar
                    </span>

                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6" id="grid-ibu">

                    @foreach ($ibuHamils as $ibu)

                        <div
                            class="card-item relative group bg-white/80 backdrop-blur-xl rounded-[2rem] p-6 shadow-lg border border-white/50 hover:border-pink-300 transition-all duration-300">

                            <div
                                class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-bl from-pink-100/50 to-transparent rounded-bl-[100%] rounded-tr-[2rem] transition-all group-hover:scale-110">
                            </div>

                            <div class="relative z-10">

                                <div class="flex items-start justify-between mb-4">

                                    <div class="flex items-center gap-4">

                                        <div
                                            class="w-14 h-14 rounded-2xl bg-gradient-to-br from-pink-400 to-rose-500 flex items-center justify-center text-white shadow-lg shadow-pink-500/30 group-hover:rotate-12 transition-transform duration-300">
                                            <i class="fas fa-female text-2xl"></i>
                                        </div>

                                        <div>
                                            <h3 class="text-lg font-bold text-slate-800 leading-tight">
                                                {{ $ibu->nama_ibu_hamil }}
                                            </h3>

                                            <p
                                                class="text-xs font-mono text-slate-500 bg-slate-100 px-2 py-0.5 rounded-md inline-block mt-1">
                                                {{ $ibu->nik_ibu_hamil }}
                                            </p>
                                        </div>

                                    </div>

                                </div>

                                <div class="space-y-3 bg-slate-50/80 rounded-xl p-4 mb-4 border border-slate-100">

                                    <div class="flex justify-between items-center text-sm">

                                        <span class="text-slate-500">
                                            <i class="fas fa-user-tie mr-2 text-pink-300"></i>
                                            Suami
                                        </span>

                                        <span class="font-semibold text-slate-700">
                                            {{ Str::limit($ibu->nama_suami, 15) }}
                                        </span>

                                    </div>

                                    <div class="h-px bg-slate-200"></div>

                                    @php
                                        $pemeriksaanTerakhir = $ibu->pemeriksaans->first();
                                    @endphp

                                    <div class="flex justify-between items-start text-sm">

                                        <span class="text-slate-500">
                                            <i class="fas fa-stethoscope mr-2 text-pink-300"></i>
                                            Cek Terakhir
                                        </span>

                                        <div class="text-right">

                                            @if ($pemeriksaanTerakhir)
                                                <span class="block font-bold text-pink-600">
                                                    {{ \Carbon\Carbon::parse($pemeriksaanTerakhir->tanggal)->format('d M Y') }}
                                                </span>
                                            @else
                                                <span class="block text-slate-400 italic text-xs">
                                                    Belum diperiksa
                                                </span>
                                            @endif

                                        </div>

                                    </div>

                                </div>

                                <a href="{{ route('laporan.pdf', ['tipe' => 'ibu', 'id' => $ibu->id]) }}"
                                    class="w-full inline-flex justify-center items-center py-3 rounded-xl bg-white border-2 border-slate-100 text-slate-600 font-semibold text-sm hover:bg-pink-50 hover:border-pink-200 hover:text-pink-600 transition-all duration-300 group-hover:shadow-md">

                                    <i
                                        class="fas fa-file-pdf mr-2 text-lg text-red-400 group-hover:scale-125 transition-transform"></i>

                                    Download Riwayat
                                </a>

                            </div>

                        </div>

                    @endforeach

                </div>
            </div>
        @endif

        {{-- EMPTY --}}
        @if ($balitas->count() === 0 && $ibuHamils->count() === 0)

            <div class="py-16 text-center bg-white/60 rounded-3xl border-2 border-dashed border-slate-200">

                <div class="w-24 h-24 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-folder-open text-4xl text-slate-400"></i>
                </div>

                <p class="text-slate-500 font-medium">
                    Belum ada data untuk ditampilkan.
                </p>

            </div>

        @endif

    </main>

    <style>
        @keyframes blob {
            0% {
                transform: translate(0, 0) scale(1);
            }

            33% {
                transform: translate(30px, -50px) scale(1.1);
            }

            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }

            100% {
                transform: translate(0, 0) scale(1);
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

    {{-- CHART JS --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    {{-- GSAP --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", () => {

            // =========================
            // GSAP
            // =========================
            const tl = gsap.timeline({
                defaults: {
                    ease: "elastic.out(1, 0.75)",
                    duration: 1.2
                }
            });

            tl.to("#headerBox", {
                y: 0,
                opacity: 1,
                ease: "power3.out",
                duration: 1
            });

            if (document.querySelector("#grafik-section")) {
                tl.to("#grafik-section", {
                    y: 0,
                    opacity: 1,
                    duration: 1,
                    ease: "power3.out"
                }, "-=0.5");
            }

            if (document.querySelector("#title-balita"))
                tl.to("#title-balita", {
                    x: 0,
                    opacity: 1,
                    duration: 0.8,
                    ease: "power2.out"
                }, "-=0.5");

            if (document.querySelectorAll("#grid-balita .card-item").length > 0)
                tl.from("#grid-balita .card-item", {
                    y: 50,
                    opacity: 0,
                    scale: 0.8,
                    stagger: 0.1,
                    clearProps: "all"
                }, "-=0.4");

            if (document.querySelector("#title-ibu"))
                tl.to("#title-ibu", {
                    x: 0,
                    opacity: 1,
                    duration: 0.8,
                    ease: "power2.out"
                }, "-=0.5");

            if (document.querySelectorAll("#grid-ibu .card-item").length > 0)
                tl.from("#grid-ibu .card-item", {
                    y: 50,
                    opacity: 0,
                    scale: 0.8,
                    stagger: 0.1,
                    clearProps: "all"
                }, "-=0.6");

            const cards = document.querySelectorAll('.card-item');

            cards.forEach(card => {

                card.addEventListener('mousemove', e => {

                    const rect = card.getBoundingClientRect();

                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;

                    gsap.to(card, {
                        duration: 0.5,
                        rotationY: (x - rect.width / 2) / 20,
                        rotationX: (rect.height / 2 - y) / 20,
                        ease: "power2.out",
                        transformPerspective: 1000
                    });

                });

                card.addEventListener('mouseleave', () => {

                    gsap.to(card, {
                        duration: 0.5,
                        rotationY: 0,
                        rotationX: 0,
                        ease: "power2.out"
                    });

                });

            });

            // =========================
            // DATA BALITA
            // =========================
            const balitaLabels = [
                @foreach ($balitas as $balita)
                    @foreach ($balita->pemeriksaans as $periksa)
                        "{{ \Carbon\Carbon::parse($periksa->tanggal)->format('d M') }}",
                    @endforeach
                @endforeach
            ];

            const beratBalitaData = [
                @foreach ($balitas as $balita)
                    @foreach ($balita->pemeriksaans as $periksa)
                        {{ $periksa->berat_badan_balita ?? 0 }},
                    @endforeach
                @endforeach
            ];

            const tinggiBalitaData = [
                @foreach ($balitas as $balita)
                    @foreach ($balita->pemeriksaans as $periksa)
                        {{ $periksa->tinggi_badan ?? 0 }},
                    @endforeach
                @endforeach
            ];

            // =========================
            // DATA IBU HAMIL
            // =========================
            const ibuLabels = [
                @foreach ($ibuHamils as $ibu)
                    @foreach ($ibu->pemeriksaans as $periksa)
                        "{{ \Carbon\Carbon::parse($periksa->tanggal)->format('d M') }}",
                    @endforeach
                @endforeach
            ];

            const ibuBeratData = [
                @foreach ($ibuHamils as $ibu)
                    @foreach ($ibu->pemeriksaans as $periksa)
                        {{ $periksa->berat_badan_ibu ?? 0 }},
                    @endforeach
                @endforeach
            ];

            // =========================
            // GRAFIK BERAT BALITA
            // =========================
            const beratBalitaChart = document.getElementById('beratBalitaChart');

            if (beratBalitaChart) {

                new Chart(beratBalitaChart, {
                    type: 'line',
                    data: {
                        labels: balitaLabels,
                        datasets: [{
                            label: 'Berat Badan (Kg)',
                            data: beratBalitaData,
                            borderColor: '#0ea5e9',
                            backgroundColor: 'rgba(14,165,233,0.2)',
                            tension: 0.4,
                            fill: true,
                            pointRadius: 5,
                            pointHoverRadius: 7
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false
                    }
                });

            }

            // =========================
            // GRAFIK TINGGI BALITA
            // =========================
            const tinggiBalitaChart = document.getElementById('tinggiBalitaChart');

            if (tinggiBalitaChart) {

                new Chart(tinggiBalitaChart, {
                    type: 'line',
                    data: {
                        labels: balitaLabels,
                        datasets: [{
                            label: 'Tinggi Badan (Cm)',
                            data: tinggiBalitaData,
                            borderColor: '#10b981',
                            backgroundColor: 'rgba(16,185,129,0.2)',
                            tension: 0.4,
                            fill: true,
                            pointRadius: 5,
                            pointHoverRadius: 7
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false
                    }
                });

            }

            // =========================
            // GRAFIK IBU HAMIL
            // =========================
            const ibuChart = document.getElementById('ibuHamilChart');

            if (ibuChart) {

                new Chart(ibuChart, {
                    type: 'line',
                    data: {
                        labels: ibuLabels,
                        datasets: [{
                            label: 'Berat Badan Ibu (Kg)',
                            data: ibuBeratData,
                            borderColor: '#ec4899',
                            backgroundColor: 'rgba(236,72,153,0.2)',
                            tension: 0.4,
                            fill: true,
                            pointRadius: 5,
                            pointHoverRadius: 7
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false
                    }
                });

            }

        });
    </script>

</x-app-main>
