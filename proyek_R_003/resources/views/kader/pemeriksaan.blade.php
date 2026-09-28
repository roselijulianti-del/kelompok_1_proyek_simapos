<x-app-main title="Pemeriksaan & Jadwal">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>

    <main class="ml-2 md:ml-2 min-h-screen pb-10">

        <div class="gsap-header opacity-0 translate-y-5 mb-6 flex flex-row justify-between items-center gap-3">
            <div>
                <h1 class="text-lg md:text-2xl font-bold text-gray-800 flex items-center gap-2 whitespace-nowrap">
                    <i class="fas fa-heartbeat text-posyanduu text-xl"></i>
                    <span>Pemeriksaan</span>
                </h1>
                <p class="text-gray-600 text-xs md:text-sm hidden md:block">
                    Kelola data pemeriksaan kesehatan
                </p>
            </div>

            <div class="flex-shrink-0">
                <a href="{{ route('pemeriksaan.create') }}"
                    class="gsap-add opacity-0 bg-button hover:bg-buttonhover text-white text-xs md:text-sm px-3 py-2 md:px-4 md:py-2 rounded-lg flex items-center gap-2 transition-all duration-200 shadow-sm hover:shadow-md whitespace-nowrap">
                    <i class="fas fa-plus-circle"></i>
                    <span class="hidden md:inline">Pemeriksaan Baru</span>
                    <span class="md:hidden">Baru</span> </a>
            </div>
        </div>

        <div x-data="{
            activeTab: new URLSearchParams(window.location.search).get('tab') || 'pemeriksaan',
            deleteConfirmation(event) {
                event.preventDefault();
                const form = event.target.closest('form');
                Swal.fire({
                    title: 'Anda yakin?',
                    text: 'Data ini akan dihapus secara permanen!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#e74c3c',
                    cancelButtonColor: '#6e7881',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            }
        }" x-init="@if(session('success'))
        Swal.fire({ icon: 'success', title: 'Berhasil!', text: '{{ session('success') }}', confirmButtonColor: '#70b2b2' });
        @endif
        @if(session('error'))
        Swal.fire({ icon: 'error', title: 'Gagal!', text: '{{ session('error') }}', confirmButtonColor: '#e74c3c' });
        @endif">

            <div class="gsap-tabs opacity-0 translate-y-5 bg-white rounded-xl shadow-md mb-6 overflow-hidden">
                <div class="border-b border-gray-200 overflow-x-auto">
                    <nav class="flex -mb-px flex-nowrap min-w-full">
                        <button @click="activeTab = 'pemeriksaan'"
                            :class="activeTab === 'pemeriksaan' ? 'border-b-2 border-posyanduu text-posyanduu font-bold' :
                                'text-gray-500 hover:text-gray-700 border-transparent'"
                            class="py-4 px-6 text-center text-sm font-medium transition-colors flex items-center gap-2 outline-none focus:outline-none whitespace-nowrap flex-1 justify-center">
                            <i class="fas fa-notes-medical"
                                :class="activeTab === 'pemeriksaan' ? 'text-posyanduu' : 'text-gray-400'"></i>
                            Data Pemeriksaan
                        </button>

                        <button @click="activeTab = 'jadwal'"
                            :class="activeTab === 'jadwal' ? 'border-b-2 border-posyanduu text-posyanduu font-bold' :
                                'text-gray-500 hover:text-gray-700 border-transparent'"
                            class="py-4 px-6 text-center text-sm font-medium transition-colors flex items-center gap-2 outline-none focus:outline-none whitespace-nowrap flex-1 justify-center">
                            <i class="fas fa-calendar-alt"
                                :class="activeTab === 'jadwal' ? 'text-posyanduu' : 'text-gray-400'"></i>
                            Jadwal Posyandu
                        </button>
                    </nav>
                </div>
            </div>

            <div
                class="gsap-content opacity-0 translate-y-8 bg-white rounded-xl p-4 md:p-6 shadow-md min-h-[400px] relative">

                <div x-show="activeTab === 'pemeriksaan'"
                    x-transition:enter="transition ease-out duration-300 delay-200"
                    x-transition:enter-start="opacity-0 translate-y-2"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 translate-y-2">

                    <div class="overflow-x-auto rounded-xl border border-gray-200 shadow-sm">
                        <table class="w-full text-sm text-left text-gray-700">
                            <thead class="bg-posyanduu">
                                <tr class="text-left border-b text-gray-600">
                                    <th class="py-3 px-3 text-xs font-semibold uppercase whitespace-nowrap">
                                        <i class="far fa-clock mr-1 text-gray-600"></i> Waktu
                                    </th>
                                    <th class="py-3 px-3 text-xs font-semibold uppercase whitespace-nowrap">
                                        <i class="fas fa-tag mr-1 text-gray-600"></i> Jenis
                                    </th>
                                    <th class="py-3 px-3 text-xs font-semibold uppercase whitespace-nowrap">
                                        <i class="fas fa-user mr-1 text-gray-600"></i> Nama Pasien
                                    </th>
                                    <th class="py-3 px-3 text-xs font-semibold uppercase whitespace-nowrap">
                                        <i class="fas fa-heartbeat mr-1 text-gray-600"></i> Status
                                    </th>
                                    <th class="py-3 px-3 text-xs font-semibold uppercase text-center whitespace-nowrap">
                                        <i class="fas fa-cog mr-1 text-gray-600"></i> Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y text-gray-800">
                                @forelse($pemeriksaans as $p)
                                    <tr class="hover:bg-gray-50 transition duration-150">
                                        <td class="py-3 px-3 whitespace-nowrap">
                                            <div class="flex flex-col">
                                                <span
                                                    class="font-bold">{{ \Carbon\Carbon::parse($p->tanggal)->format('d M Y') }}</span>
                                                <span
                                                    class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($p->tanggal)->format('H:i') }}
                                                    WIB</span>
                                            </div>
                                        </td>
                                        <td class="py-3 px-3 whitespace-nowrap">
                                            <div class="flex items-center gap-2">
                                                @if ($p->tipe === 'balita')
                                                    <span class="text-blue-500 bg-blue-50 p-1 rounded"><i
                                                            class="fas fa-baby"></i></span>
                                                    <span>Balita</span>
                                                @else
                                                    <span class="text-pink-500 bg-pink-50 p-1 rounded"><i
                                                            class="fas fa-female"></i></span>
                                                    <span>Ibu Hamil</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="py-3 px-3 whitespace-nowrap font-medium">
                                            {{ $p->tipe === 'balita' ? $p->balita->nama_balita : $p->ibu_hamil->nama_ibu_hamil }}
                                        </td>
                                        <td class="py-3 px-3 whitespace-nowrap">
                                            @if ($p->tipe === 'balita')
                                                @php
                                                    $color = match ($p->status_gizi) {
                                                        'Gizi Baik' => 'text-green-600 bg-green-100',
                                                        'Gizi Buruk' => 'text-orange-600 bg-orange-100',
                                                        default => 'text-red-600 bg-red-100',
                                                    };
                                                @endphp
                                                <span
                                                    class="px-2 py-1 text-xs rounded-full font-medium {{ $color }}">
                                                    {{ $p->status_gizi }}
                                                </span>
                                            @else
                                                <span
                                                    class="px-2 py-1 text-xs rounded-full font-medium {{ $p->status_ibu === 'Kondisi Baik' ? 'text-green-600 bg-green-100' : 'text-red-600 bg-red-100' }}">
                                                    {{ $p->status_ibu }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="py-3 px-3 text-center">
                                            <div class="flex items-center justify-center gap-3">
                                                <a href="{{ route('pemeriksaan.show', $p->id) }}"
                                                    class="text-blue-500 hover:text-blue-700" title="Lihat">
                                                    <i class="fas fa-eye text-sm"></i>
                                                </a>
                                                <a href="{{ route('pemeriksaan.edit', $p->id) }}"
                                                    class="text-yellow-500 hover:text-yellow-600" title="Edit">
                                                    <i class="fas fa-edit text-sm"></i>
                                                </a>
                                                <form action="{{ route('pemeriksaan.destroy', $p->id) }}"
                                                    method="POST" class="inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" @click.prevent="deleteConfirmation"
                                                        class="text-red-500 hover:text-red-600" title="Hapus">
                                                        <i class="fas fa-trash text-sm"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="py-8 text-center text-gray-500">
                                            <div class="flex flex-col items-center">
                                                <i class="fas fa-clipboard-list text-3xl mb-2 text-gray-300"></i>
                                                <span>Belum ada data pemeriksaan</span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div x-show="activeTab === 'jadwal'" style="display: none;"
                    x-transition:enter="transition ease-out duration-300 delay-200"
                    x-transition:enter-start="opacity-0 translate-y-2"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 translate-y-2">

                    <div class="flex justify-between items-center mb-4 pb-2 border-b border-gray-100">
                        <h3 class="text-sm font-bold text-gray-700 uppercase tracking-wide">Daftar Kegiatan</h3>
                        <a href="{{ route('jadwal.create') }}"
                            class="text-xs font-medium text-posyanduu hover:text-posyanduDark flex items-center gap-1 whitespace-nowrap">
                            <i class="fas fa-plus"></i> Tambah Jadwal
                        </a>
                    </div>

                    <div class="grid grid-cols-1 gap-3">
                        @forelse ($jadwals as $jadwal)
                            <div
                                class="group border border-gray-200 rounded-lg p-3 hover:shadow-md transition-all duration-200 flex items-center gap-3 bg-white">
                                <div
                                    class="flex-shrink-0 w-12 h-12 bg-blue-50 rounded-lg flex flex-col items-center justify-center text-posyanduu border border-blue-100">
                                    <span
                                        class="text-[10px] uppercase font-bold">{{ \Carbon\Carbon::parse($jadwal->waktu_mulai)->format('M') }}</span>
                                    <span
                                        class="text-lg font-bold leading-none">{{ \Carbon\Carbon::parse($jadwal->waktu_mulai)->format('d') }}</span>
                                </div>

                                <div class="flex-1 min-w-0">
                                    <h4
                                        class="text-sm font-bold text-gray-800 truncate group-hover:text-posyanduu transition-colors">
                                        {{ $jadwal->keterangan }}
                                    </h4>
                                    <div class="flex flex-wrap items-center gap-3 mt-1 text-xs text-gray-500">
                                        <span class="flex items-center gap-1 whitespace-nowrap">
                                            <i class="far fa-clock text-gray-400"></i>
                                            {{ \Carbon\Carbon::parse($jadwal->waktu_mulai)->format('H:i') }} -
                                            {{ \Carbon\Carbon::parse($jadwal->waktu_selesai)->format('H:i') }}
                                        </span>
                                        <span class="hidden md:inline text-gray-300">|</span>
                                        <span class="flex items-center gap-1 whitespace-nowrap truncate max-w-[150px]">
                                            <i class="fas fa-map-marker-alt text-gray-400"></i>
                                            {{ $jadwal->lokasi }}
                                        </span>
                                    </div>
                                </div>

                                <div
                                    class="flex items-center gap-2 opacity-100 md:opacity-0 md:group-hover:opacity-100 transition-opacity">
                                    <a href="{{ route('jadwal.edit', $jadwal->id) }}"
                                        class="text-gray-400 hover:text-yellow-500 transition-colors">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('jadwal.destroy', $jadwal->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" @click.prevent="deleteConfirmation"
                                            class="text-gray-400 hover:text-red-500 transition-colors">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8 border border-dashed border-gray-200 rounded-lg">
                                <i class="far fa-calendar-times text-2xl text-gray-300 mb-2"></i>
                                <p class="text-sm text-gray-500">Belum ada jadwal kegiatan.</p>
                            </div>
                        @endforelse
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
                    duration: 0.7
                })
                .to(".gsap-add", {
                    opacity: 1,
                    y: 0,
                    duration: 0.6
                }, "-=0.5")
                .to(".gsap-tabs", {
                    opacity: 1,
                    y: 0,
                    duration: 0.6
                }, "-=0.4")
                .to(".gsap-content", {
                    opacity: 1,
                    y: 0,
                    duration: 0.6
                }, "-=0.3");
        });
    </script>

</x-app-main>
