<x-app-main :title="'Dashboard'">
    {{-- Load Library --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <main class="ml-2 md:ml-2 relative min-h-screen bg-gray-50/50 pb-10">

        <div class="gsap-header opacity-0 translate-y-5 mb-8 pt-4">
            <h1 class="text-3xl font-extrabold text-gray-800 tracking-tight">Dashboard Overview</h1>

            <div class="flex items-center text-gray-500 mt-1">
                <span class="w-2 h-2 rounded-full bg-green-500 mr-2 animate-pulse"></span>

                <p>
                    Halo
                    <span class="text-indigo-600 font-semibold">
                        {{ Auth::user()->name }}
                    </span>,
                    selamat datang kembali!
                </p>
            </div>
        </div>

        {{-- CARD --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">

            {{-- Total Balita --}}
            <div
                class="gsap-card opacity-0 translate-y-10 bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group cursor-default relative overflow-hidden">

                <div
                    class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity transform group-hover:scale-110 duration-500">
                    <i class="fas fa-baby text-8xl text-blue-500"></i>
                </div>

                <div class="flex items-center relative z-10">

                    <div class="rounded-2xl bg-blue-50 p-4 group-hover:bg-blue-500 transition-colors duration-300">
                        <i
                            class="fas fa-baby text-3xl text-blue-500 group-hover:text-white transition-colors duration-300"></i>
                    </div>

                    <div class="ml-5">
                        <p class="text-gray-500 text-sm font-medium uppercase tracking-wider">
                            Total Balita
                        </p>

                        <h3 class="text-4xl font-bold text-gray-800 counter-anim"
                            data-target="{{ $totalBalita }}">
                            0
                        </h3>
                    </div>
                </div>
            </div>

            {{-- Total Ibu Hamil --}}
            <div
                class="gsap-card opacity-0 translate-y-10 bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group cursor-default relative overflow-hidden">

                <div
                    class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity transform group-hover:scale-110 duration-500">
                    <i class="fas fa-female text-8xl text-pink-500"></i>
                </div>

                <div class="flex items-center relative z-10">

                    <div class="rounded-2xl bg-pink-50 p-4 group-hover:bg-pink-500 transition-colors duration-300">
                        <i
                            class="fas fa-female text-3xl text-pink-500 group-hover:text-white transition-colors duration-300"></i>
                    </div>

                    <div class="ml-5">
                        <p class="text-gray-500 text-sm font-medium uppercase tracking-wider">
                            Ibu Hamil
                        </p>

                        <h3 class="text-4xl font-bold text-gray-800 counter-anim"
                            data-target="{{ $totalIbuHamil }}">
                            0
                        </h3>
                    </div>
                </div>
            </div>
        </div>

        {{-- DATA CHART --}}
        <div id="chart-data"
            data-gizi='@json([$totalGiziBaik, $totalGiziBuruk, $totalStunting])'
            data-pemeriksaan='@json($pemeriksaanBulanan)'
            data-balita='@json($balitaBulanan)'
            data-ibu='@json($ibuHamilBulanan)'
            data-kehadiran='@json([$totalHadir, $totalTidakHadir])'>
        </div>

        {{-- CHART --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">

            {{-- Status Gizi --}}
            <div class="gsap-chart opacity-0 scale-95 bg-white rounded-2xl p-6 shadow-md border-b-4 border-blue-500">

                <div class="flex justify-between items-center mb-6 border-b border-gray-100 pb-2">
                    <h2 class="text-lg font-bold text-gray-800 flex items-center">
                        <i class="fas fa-chart-pie mr-2 text-blue-500"></i>
                        Status Gizi Balita
                    </h2>
                </div>

                <div class="h-64 relative">
                    <canvas id="giziChart"></canvas>
                </div>
            </div>

            {{-- Pemeriksaan Bulanan --}}
            <div class="gsap-chart opacity-0 scale-95 bg-white rounded-2xl p-6 shadow-md border-b-4 border-green-500">

                <div class="flex justify-between items-center mb-6 border-b border-gray-100 pb-2">
                    <h2 class="text-lg font-bold text-gray-800 flex items-center">
                        <i class="fas fa-chart-bar mr-2 text-green-500"></i>
                        Jumlah Pemeriksaan per Bulan
                    </h2>
                </div>

                <div class="h-64 relative">
                    <canvas id="pemeriksaanChart"></canvas>
                </div>
            </div>

            {{-- Kehadiran Posyandu --}}
            <div class="gsap-chart opacity-0 scale-95 bg-white rounded-2xl p-6 shadow-md border-b-4 border-indigo-500">

                <div class="flex justify-between items-center mb-6 border-b border-gray-100 pb-2">
                    <h2 class="text-lg font-bold text-gray-800 flex items-center">
                        <i class="fas fa-users mr-2 text-indigo-500"></i>
                        Kehadiran Posyandu
                    </h2>
                </div>

                <div class="h-64 relative">
                    <canvas id="kehadiranChart"></canvas>
                </div>
            </div>

            {{-- Registrasi --}}
            <div class="gsap-chart opacity-0 scale-95 bg-white rounded-2xl p-6 shadow-md border-b-4 border-pink-500">

                <div class="flex justify-between items-center mb-6 border-b border-gray-100 pb-2">
                    <h2 class="text-lg font-bold text-gray-800 flex items-center">
                        <i class="fas fa-chart-column mr-2 text-pink-500"></i>
                        Balita & Ibu Hamil Terdaftar
                    </h2>
                </div>

                <div class="h-64 relative">
                    <canvas id="registrasiChart"></canvas>
                </div>
            </div>
        </div>

        {{-- Jadwal --}}
        <div class="gsap-schedule opacity-0 translate-y-10 bg-white rounded-2xl p-6 shadow-lg border border-gray-100">

            <div class="flex justify-between items-center mb-6">

                <h2 class="text-xl font-bold text-gray-800 flex items-center">
                    <i class="far fa-calendar-alt mr-3 text-indigo-500"></i>
                    Jadwal Mendatang
                </h2>

                <span
                    class="text-xs font-semibold bg-indigo-50 text-indigo-600 px-3 py-1 rounded-full border border-indigo-100">
                    Terbaru
                </span>
            </div>

            <div class="space-y-4">

                @forelse ($jadwals as $jadwal)
                    <div
                        class="group relative flex items-center p-4 bg-white border border-gray-100 rounded-xl hover:border-indigo-300 hover:shadow-md transition-all duration-300">

                        <div
                            class="bg-gradient-to-br from-indigo-500 to-purple-600 text-white rounded-xl w-14 h-14 flex flex-col items-center justify-center shadow-lg shadow-indigo-200 group-hover:scale-105 transition-transform">

                            <span class="font-bold text-xl leading-none">
                                {{ \Carbon\Carbon::parse($jadwal->waktu_mulai)->format('d') }}
                            </span>

                            <span class="text-[10px] uppercase font-medium opacity-80 mt-1">
                                {{ \Carbon\Carbon::parse($jadwal->waktu_mulai)->format('M') }}
                            </span>
                        </div>

                        <div class="ml-5 flex-1 pr-4">

                            <h3 class="font-bold text-gray-800 text-lg group-hover:text-indigo-600 transition-colors">
                                {{ $jadwal->keterangan }}
                            </h3>

                            <div
                                class="flex flex-col sm:flex-row sm:items-center text-sm text-gray-500 mt-1 gap-y-1 sm:gap-x-4">

                                <span class="flex items-center">
                                    <i class="far fa-clock mr-1.5 text-indigo-400"></i>

                                    {{ \Carbon\Carbon::parse($jadwal->waktu_mulai)->format('H:i') }}
                                    -

                                    {{ \Carbon\Carbon::parse($jadwal->waktu_selesai)->format('H:i') }}
                                    WIB
                                </span>

                                <span class="hidden sm:inline text-gray-300">|</span>

                                <span class="flex items-center">
                                    <i class="fas fa-map-marker-alt mr-1.5 text-red-400"></i>
                                    {{ $jadwal->lokasi }}
                                </span>
                            </div>
                        </div>

                        <div class="absolute right-4 top-1/2 transform -translate-y-1/2 sm:static sm:transform-none">

                            <a href="{{ route('jadwal.show', $jadwal->slug) }}"
                                class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-gray-50 text-gray-400 hover:bg-indigo-600 hover:text-white transition-all duration-300 shadow-sm hover:shadow-indigo-300 group-hover:translate-x-1">

                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </div>
                    </div>
                @empty
                    <div
                        class="flex flex-col items-center justify-center py-12 text-center bg-gray-50 rounded-xl border-2 border-dashed border-gray-200">

                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                            <i class="fa-solid fa-calendar-xmark text-3xl text-gray-400"></i>
                        </div>

                        <p class="text-lg font-medium text-gray-600">
                            Belum ada jadwal posyandu.
                        </p>

                        <p class="text-sm text-gray-400 mt-1">
                            Jadwal kegiatan akan muncul di sini setelah ditambahkan.
                        </p>
                    </div>
                @endforelse
            </div>
        </div>

    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // GSAP
            const tl = gsap.timeline({
                defaults: {
                    ease: "power3.out"
                }
            });

            tl.to(".gsap-header", {
                    y: 0,
                    opacity: 1,
                    duration: 0.8
                })
                .to(".gsap-card", {
                    y: 0,
                    opacity: 1,
                    duration: 0.8,
                    stagger: 0.2
                }, "-=0.5")
                .to(".gsap-chart", {
                    scale: 1,
                    opacity: 1,
                    duration: 0.6,
                    stagger: 0.2
                }, "-=0.3")
                .to(".gsap-schedule", {
                    y: 0,
                    opacity: 1,
                    duration: 0.8,
                    onComplete: initCharts
                }, "-=0.3");

            // Counter
            gsap.utils.toArray(".counter-anim").forEach(counter => {

                const target = parseInt(counter.getAttribute('data-target'));

                gsap.to(counter, {
                    innerHTML: target,
                    duration: 2,
                    snap: {
                        innerHTML: 1
                    },
                    ease: "power1.inOut"
                });
            });

            function initCharts() {

                // DATA
                const dataDiv = document.getElementById('chart-data');

                const giziData = JSON.parse(dataDiv.dataset.gizi);
                const pemeriksaanData = JSON.parse(dataDiv.dataset.pemeriksaan);
                const balitaData = JSON.parse(dataDiv.dataset.balita);
                const ibuData = JSON.parse(dataDiv.dataset.ibu);
                const kehadiranData = JSON.parse(dataDiv.dataset.kehadiran);

                const bulan = [
                    'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun',
                    'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'
                ];

                // Mapping data otomatis ke bulan
                const balitaBulanan = Array(12).fill(0);
                const ibuBulanan = Array(12).fill(0);

                balitaData.forEach(item => {
                    balitaBulanan[item.bulan - 1] = item.total;
                });

                ibuData.forEach(item => {
                    ibuBulanan[item.bulan - 1] = item.total;
                });

                // GIZI CHART
                const giziChart = new Chart(document.getElementById('giziChart'), {
                    type: 'pie',
                    data: {
                        labels: ['Gizi Baik', 'Gizi Buruk', 'Stunting'],
                        datasets: [{
                            data: giziData,
                            backgroundColor: ['#10B981', '#EF4444', '#F59E0B'],
                            borderWidth: 0
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        animation: false,
                        layout: {
                            padding: 10
                        },
                        plugins: {
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }
                });

                setTimeout(() => {
                    giziChart.resize();
                }, 500);

                // PEMERIKSAAN BULANAN
                new Chart(document.getElementById('pemeriksaanChart'), {
                    type: 'bar',
                    data: {
                        labels: pemeriksaanData.map(item => bulan[item.bulan - 1]),
                        datasets: [{
                            label: 'Jumlah Pemeriksaan',
                            data: pemeriksaanData.map(item => item.total),
                            backgroundColor: '#22C55E',
                            borderRadius: 10
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false
                    }
                });

                // KEHADIRAN POSYANDU
                new Chart(document.getElementById('kehadiranChart'), {
                    type: 'bar',
                    data: {
                        labels: ['Hadir', 'Tidak Hadir'],
                        datasets: [{
                            label: 'Kehadiran',
                            data: kehadiranData,
                            backgroundColor: ['#6366F1', '#EF4444'],
                            borderRadius: 10
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false
                    }
                });

                // BALITA & IBU HAMIL
                new Chart(document.getElementById('registrasiChart'), {
                    type: 'bar',
                    data: {
                        labels: bulan,
                        datasets: [{
                                label: 'Balita',
                                data: balitaBulanan,
                                backgroundColor: '#3B82F6',
                                borderRadius: 10
                            },
                            {
                                label: 'Ibu Hamil',
                                data: ibuBulanan,
                                backgroundColor: '#EC4899',
                                borderRadius: 10
                            }
                        ]
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
