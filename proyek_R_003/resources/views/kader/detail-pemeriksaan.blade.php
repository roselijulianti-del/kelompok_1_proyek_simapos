<x-app-main title="Detail Pemeriksaan">
    <!-- Load GSAP & FontAwesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <main class="ml-2 md:ml-2 min-h-screen pb-10">

        <!-- Header Section -->
        <div
            class="gsap-header opacity-0 translate-y-5 mb-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-3">
                    <span class="bg-indigo-100 text-indigo-600 p-2 rounded-lg shadow-sm">
                        <i class="fas fa-file-medical-alt"></i>
                    </span>
                    Detail Hasil Pemeriksaan
                </h1>
                <p class="text-gray-500 mt-1 text-sm md:text-base ml-1">
                    Informasi lengkap hasil pemeriksaan kesehatan peserta.
                </p>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('pemeriksaan.index') }}"
                    class="group bg-white border border-gray-200 hover:bg-gray-50 hover:border-gray-300 transition-all duration-300 text-gray-600 px-5 py-2.5 rounded-xl flex items-center shadow-sm hover:shadow-md">
                    <i class="fas fa-arrow-left mr-2 group-hover:-translate-x-1 transition-transform"></i>
                    <span>Kembali ke Daftar</span>
                </a>
            </div>
        </div>

        <!-- Main Card -->
        <div
            class="gsap-card opacity-0 translate-y-10 bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">

            <!-- Banner Status -->
            <div
                class="px-6 py-4 border-b border-gray-100 flex flex-col md:flex-row justify-between items-start md:items-center bg-gray-50/50">
                <div class="flex items-center gap-3 mb-2 md:mb-0">
                    <div class="text-sm text-gray-500 font-medium">
                        <i class="far fa-calendar-alt mr-1"></i>
                        {{ \Carbon\Carbon::parse($pemeriksaan->tanggal)->format('d F Y') }}
                    </div>
                    <span class="text-gray-300">|</span>
                    <div class="text-sm text-gray-500 font-medium">
                        <i class="far fa-clock mr-1"></i>
                        {{ \Carbon\Carbon::parse($pemeriksaan->tanggal)->format('H:i') }} WIB
                    </div>
                </div>
                <div>
                    @if ($pemeriksaan->balita)
                        <span
                            class="px-3 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-700 border border-blue-200">
                            <i class="fas fa-baby mr-1"></i> Pasien Balita
                        </span>
                    @elseif($pemeriksaan->ibu_hamil)
                        <span
                            class="px-3 py-1 rounded-full text-xs font-bold bg-pink-100 text-pink-700 border border-pink-200">
                            <i class="fas fa-female mr-1"></i> Pasien Ibu Hamil
                        </span>
                    @endif
                </div>
            </div>

            <div class="p-6 md:p-8 space-y-8">

                {{-- KONTEN BALITA --}}
                @if ($pemeriksaan->balita)
                    <!-- Identitas Peserta -->
                    <div class="gsap-item opacity-0 translate-y-5">
                        <h3 class="text-gray-800 font-bold mb-4 flex items-center text-sm uppercase tracking-wide">
                            <i class="fas fa-id-card mr-2 text-blue-500"></i> Identitas Peserta
                        </h3>
                        <div
                            class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm grid grid-cols-1 md:grid-cols-2 gap-6 relative overflow-hidden">
                            <div
                                class="absolute top-0 right-0 w-24 h-24 bg-blue-50 rounded-bl-full -mr-4 -mt-4 opacity-50">
                            </div>

                            <div>
                                <label class="text-xs text-gray-500 font-semibold uppercase mb-1 block">Nama
                                    Lengkap</label>
                                <p class="text-lg font-bold text-gray-800">{{ $pemeriksaan->balita->nama_balita }}</p>
                            </div>
                            <div>
                                <label class="text-xs text-gray-500 font-semibold uppercase mb-1 block">NIK</label>
                                <p
                                    class="text-lg font-mono font-medium text-gray-700 bg-gray-50 inline-block px-2 rounded">
                                    {{ $pemeriksaan->balita->nik }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Hasil Ukur -->
                    <div class="gsap-item opacity-0 translate-y-5">
                        <h3 class="text-gray-800 font-bold mb-4 flex items-center text-sm uppercase tracking-wide">
                            <i class="fas fa-ruler-combined mr-2 text-blue-500"></i> Hasil Pengukuran
                        </h3>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <!-- Berat -->
                            <div
                                class="bg-blue-50 border border-blue-100 rounded-xl p-5 flex flex-col items-center justify-center text-center hover:shadow-md transition-all">
                                <div
                                    class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-blue-500 shadow-sm mb-3">
                                    <i class="fas fa-weight"></i>
                                </div>
                                <span class="text-sm text-blue-600 font-semibold">Berat Badan</span>
                                <span class="text-2xl font-bold text-gray-800 mt-1">
                                    {{ $pemeriksaan->berat_badan_balita }} <span
                                        class="text-sm font-normal text-gray-500">kg</span>
                                </span>
                            </div>

                            <!-- Tinggi -->
                            <div
                                class="bg-indigo-50 border border-indigo-100 rounded-xl p-5 flex flex-col items-center justify-center text-center hover:shadow-md transition-all">
                                <div
                                    class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-indigo-500 shadow-sm mb-3">
                                    <i class="fas fa-ruler-vertical"></i>
                                </div>
                                <span class="text-sm text-indigo-600 font-semibold">Tinggi Badan</span>
                                <span class="text-2xl font-bold text-gray-800 mt-1">
                                    {{ $pemeriksaan->tinggi_badan }} <span
                                        class="text-sm font-normal text-gray-500">cm</span>
                                </span>
                            </div>

                            <!-- Status Gizi -->
                            @php
                                $statusColor = 'bg-gray-50 border-gray-200 text-gray-800';
                                $iconColor = 'text-gray-500';
                                if ($pemeriksaan->status_gizi == 'Gizi Baik') {
                                    $statusColor = 'bg-green-50 border-green-200 text-green-700';
                                    $iconColor = 'text-green-500';
                                } elseif (
                                    $pemeriksaan->status_gizi == 'Gizi Buruk' ||
                                    $pemeriksaan->status_gizi == 'Stunting'
                                ) {
                                    $statusColor = 'bg-red-50 border-red-200 text-red-700';
                                    $iconColor = 'text-red-500';
                                }
                            @endphp
                            <div
                                class="{{ $statusColor }} border rounded-xl p-5 flex flex-col items-center justify-center text-center hover:shadow-md transition-all">
                                <div
                                    class="w-10 h-10 bg-white rounded-full flex items-center justify-center {{ $iconColor }} shadow-sm mb-3">
                                    <i class="fas fa-notes-medical"></i>
                                </div>
                                <span class="text-sm font-semibold opacity-80">Status Gizi</span>
                                <span class="text-xl font-bold mt-1 uppercase">
                                    {{ $pemeriksaan->status_gizi }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- KONTEN IBU HAMIL --}}
                @if ($pemeriksaan->ibu_hamil)
                    <!-- Identitas Peserta -->
                    <div class="gsap-item opacity-0 translate-y-5">
                        <h3 class="text-gray-800 font-bold mb-4 flex items-center text-sm uppercase tracking-wide">
                            <i class="fas fa-id-card mr-2 text-pink-500"></i> Identitas Peserta
                        </h3>
                        <div
                            class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm grid grid-cols-1 md:grid-cols-2 gap-6 relative overflow-hidden">
                            <div
                                class="absolute top-0 right-0 w-24 h-24 bg-pink-50 rounded-bl-full -mr-4 -mt-4 opacity-50">
                            </div>

                            <div>
                                <label class="text-xs text-gray-500 font-semibold uppercase mb-1 block">Nama Ibu</label>
                                <p class="text-lg font-bold text-gray-800">
                                    {{ $pemeriksaan->ibu_hamil->nama_ibu_hamil }}</p>
                            </div>
                            <div>
                                <label class="text-xs text-gray-500 font-semibold uppercase mb-1 block">NIK</label>
                                <p
                                    class="text-lg font-mono font-medium text-gray-700 bg-gray-50 inline-block px-2 rounded">
                                    {{ $pemeriksaan->ibu_hamil->nik_ibu_hamil }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Hasil Pemeriksaan -->
                    <div class="gsap-item opacity-0 translate-y-5">
                        <h3 class="text-gray-800 font-bold mb-4 flex items-center text-sm uppercase tracking-wide">
                            <i class="fas fa-notes-medical mr-2 text-pink-500"></i> Hasil Pemeriksaan
                        </h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

                            <!-- Berat Badan -->
                            <div
                                class="bg-pink-50 border border-pink-100 rounded-xl p-4 flex flex-col items-center justify-center text-center">
                                <span class="text-xs font-bold text-pink-500 uppercase mb-1">Berat Badan</span>
                                <span class="text-xl font-bold text-gray-800">{{ $pemeriksaan->berat_badan_ibu }}
                                    <small class="text-sm font-normal text-gray-500">kg</small></span>
                            </div>

                            <!-- Usia Kehamilan -->
                            <div
                                class="bg-purple-50 border border-purple-100 rounded-xl p-4 flex flex-col items-center justify-center text-center">
                                <span class="text-xs font-bold text-purple-500 uppercase mb-1">Usia Kehamilan</span>
                                <span class="text-xl font-bold text-gray-800">{{ $pemeriksaan->usia_kehamilan }} <small
                                        class="text-sm font-normal text-gray-500">minggu</small></span>
                            </div>

                            <!-- Tensi -->
                            @php
                                $sistolik = $pemeriksaan->tekanan_sistolik;
                                $diastolik = $pemeriksaan->tekanan_diastolik;
                                $isHigh = $sistolik > 140 || $diastolik > 90;
                            @endphp
                            <div
                                class="bg-gray-50 border border-gray-200 rounded-xl p-4 flex flex-col items-center justify-center text-center">
                                <span class="text-xs font-bold text-gray-500 uppercase mb-1">Tekanan Darah</span>
                                <span class="text-xl font-bold {{ $isHigh ? 'text-red-600' : 'text-gray-800' }}">
                                    {{ $sistolik }}/{{ $diastolik }}
                                </span>
                                <span class="text-[10px] text-gray-400">mmHg</span>
                            </div>

                            <!-- Status -->
                            @php
                                $statusClass = 'bg-gray-50 text-gray-700 border-gray-200';
                                if ($pemeriksaan->status_ibu == 'Kondisi Baik') {
                                    $statusClass = 'bg-green-50 text-green-700 border-green-200';
                                } elseif ($pemeriksaan->status_ibu == 'Anemia') {
                                    $statusClass = 'bg-red-50 text-red-700 border-red-200';
                                }
                            @endphp
                            <div
                                class="{{ $statusClass }} border rounded-xl p-4 flex flex-col items-center justify-center text-center">
                                <span class="text-xs font-bold opacity-70 uppercase mb-1">Status</span>
                                <span class="text-lg font-bold uppercase">{{ $pemeriksaan->status_ibu }}</span>
                            </div>

                        </div>
                    </div>
                @endif

            </div>

            <!-- Footer Action -->
            <div class="bg-gray-50 p-4 border-t border-gray-100 flex justify-end">
                <a href="{{ route('pemeriksaan.edit', $pemeriksaan->id) }}"
                    class="inline-flex items-center px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium rounded-lg transition-colors shadow-sm hover:shadow">
                    <i class="fas fa-edit mr-2"></i> Edit Data
                </a>
            </div>

        </div>
    </main>

    <!-- Script Animation -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const tl = gsap.timeline({
                defaults: {
                    ease: "power2.out"
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
                    duration: 0.8
                }, "-=0.6")
                .to(".gsap-item", {
                    y: 0,
                    opacity: 1,
                    duration: 0.6,
                    stagger: 0.15
                }, "-=0.4");
        });
    </script>
</x-app-main>
