<x-app-main title="Data Peserta">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>

    <main class="ml-2 md:ml-2 min-h-screen pb-10">

        <div
            class="gsap-header opacity-0 translate-y-5 mb-6 flex flex-col md:flex-row md:justify-between md:items-center gap-3">
            <div>
                <h1 class="text-lg md:text-2xl font-bold text-gray-800 flex items-center gap-2">
                    <i class="fas fa-users text-posyanduu text-xl"></i>
                    Data Balita & Ibu Hamil
                </h1>
                <p class="text-gray-600 text-xs md:text-sm">
                    Kelola data balita dan ibu hamil di posyandu
                </p>
            </div>

            <div class="flex justify-start md:justify-end">
                <a href="{{ route('peserta.create') }}"
                    class="gsap-add opacity-0 bg-button hover:bg-buttonhover text-white text-xs md:text-base px-3 py-2 md:px-4 md:py-2 rounded-lg flex items-center gap-2 transition-all duration-200 shadow-sm hover:shadow-md">
                    <i class="fas fa-plus-circle text-sm"></i> Tambah Data
                </a>
            </div>
        </div>

        {{-- SweetAlert --}}
        @if (session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    confirmButtonColor: '#70b2b2',
                });
            </script>
        @endif

        {{-- AREA UTAMA: Logic Tab & Animasi Transisi --}}
        <div x-data="{
            activeTab: new URLSearchParams(window.location.search).get('tab') || 'balita'
        }">

            <div class="gsap-tabs opacity-0 translate-y-5 bg-white rounded-xl shadow-md mb-6">
                <div class="border-b border-gray-200">
                    <nav class="flex -mb-px">
                        <button @click="activeTab = 'balita'"
                            :class="activeTab === 'balita' ? 'border-blue-600 text-blue-600' :
                                'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                            class="py-4 px-6 text-center border-b-2 font-medium text-sm whitespace-nowrap flex items-center gap-2 transition-colors duration-200 outline-none">
                            <i class="fas fa-baby"
                                :class="activeTab === 'balita' ? 'text-blue-500' : 'text-gray-400'"></i>
                            Data Balita
                        </button>

                        <button @click="activeTab = 'ibu_hamil'"
                            :class="activeTab === 'ibu_hamil' ? 'border-pink-500 text-pink-500' :
                                'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                            class="py-4 px-6 text-center border-b-2 font-medium text-sm whitespace-nowrap flex items-center gap-2 transition-colors duration-200 outline-none">
                            <i class="fas fa-female"
                                :class="activeTab === 'ibu_hamil' ? 'text-pink-500' : 'text-gray-400'"></i>
                            Data Ibu Hamil
                        </button>
                    </nav>
                </div>
            </div>

            <div x-show="activeTab === 'balita'" x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
                style="display: none;">
                <div class="gsap-card opacity-0 translate-y-8 bg-white rounded-xl p-4 md:p-6 shadow-md">
                    <div class="overflow-x-auto rounded-xl border border-gray-200 shadow-sm">
                        <table class="w-full text-sm">
                            <thead class="bg-posyanduu border-b">
                                <tr class="text-left border-b text-gray-600 whitespace-nowrap">
                                    <th class="py-3 px-3 text-xs"><i class="fas fa-id-card mr-1 text-gray-600"></i> NIK
                                    </th>
                                    <th class="py-3 px-3 text-xs"><i class="fas fa-user mr-1 text-gray-600"></i> Nama
                                    </th>
                                    <th class="py-3 px-3 text-xs"><i
                                            class="fas fa-hourglass-half mr-1 text-gray-600"></i> Usia</th>
                                    <th class="py-3 px-3 text-xs"><i class="fas fa-venus-mars mr-1 text-gray-600"></i>
                                        JK</th>
                                    <th class="py-3 px-3 text-xs"><i
                                            class="fas fa-map-marker-alt mr-1 text-gray-600"></i> Alamat</th>
                                    <th class="py-3 px-3 text-xs"><i class="fas fa-users mr-1 text-gray-600"></i> Orang
                                        Tua</th>
                                    <th class="py-3 px-3 text-xs text-center"><i
                                            class="fas fa-cog mr-1 text-gray-600"></i> Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y border-b text-gray-800">
                                @forelse($balitas as $balita)
                                    <tr
                                        class="row-item opacity-0 translate-y-4 hover:bg-gray-50 transition-all whitespace-nowrap">
                                        <td class="py-3 px-3 border">{{ $balita->nik }}</td>
                                        <td class="py-3 px-3 font-medium border">{{ $balita->nama_balita }}</td>
                                        <td class="py-3 px-3 border">{{ $balita->usia_tahun }} th •
                                            {{ $balita->usia_bulan }} bln</td>
                                        <td class="py-3 px-3 border">{{ $balita->jenis_kelamin }}</td>
                                        <td class="py-3 px-3 max-w-xs truncate border" title="{{ $balita->alamat }}">
                                            {{ Str::limit($balita->alamat, 30) }}</td>
                                        <td class="py-3 px-3 border">{{ $balita->nama_orang_tua }}</td>
                                        <td class="py-3 px-3 text-center">
                                            <div class="flex items-center justify-center space-x-3">
                                                <a href="{{ route('peserta.edit', ['kategori' => 'balita', 'id' => $balita->id]) }}"
                                                    class="text-yellow-500 hover:text-yellow-600"><i
                                                        class="fas fa-edit text-sm"></i></a>
                                                <form
                                                    action="{{ route('peserta.destroy', ['kategori' => 'balita', 'id' => $balita->id]) }}"
                                                    method="POST" class="delete-form inline-block">
                                                    @csrf @method('DELETE')
                                                    <button type="button"
                                                        class="btn-delete text-red-500 hover:text-red-600"><i
                                                            class="fas fa-trash text-sm"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="py-6 text-center text-gray-500">Tidak ada data balita
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-6 text-sm text-gray-600 flex justify-between items-center">
                        Menampilkan {{ $balitas->lastItem() ?? 0 }} dari {{ $balitas->total() }} data balita
                        <div class="pagination flex space-x-2 opacity-0 translate-y-4">
                            {{ $balitas->appends(['tab' => 'balita'])->links() }}</div>
                    </div>
                </div>
            </div>

            <div x-show="activeTab === 'ibu_hamil'" x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
                style="display: none;">
                <div class="gsap-card opacity-0 translate-y-8 bg-white rounded-xl p-4 md:p-6 shadow-md">
                    <div class="overflow-x-auto rounded-xl border border-gray-200 shadow-sm">
                        <table class="w-full text-sm">
                            <thead class="bg-posyanduu border-b">
                                <tr class="text-left border-b text-gray-600 whitespace-nowrap">
                                    <th class="py-3 px-3 text-xs"><i class="fas fa-id-card mr-1 text-gray-600"></i> NIK
                                    </th>
                                    <th class="py-3 px-3 text-xs"><i class="fas fa-female mr-1 text-gray-600"></i> Nama
                                        Ibu</th>
                                    <th class="py-3 px-3 text-xs"><i class="fas fa-male mr-1 text-gray-600"></i> Nama
                                        Suami</th>
                                    <th class="py-3 px-3 text-xs"><i
                                            class="fas fa-hourglass-half mr-1 text-gray-600"></i> Umur</th>
                                    <th class="py-3 px-3 text-xs"><i
                                            class="fas fa-map-marker-alt mr-1 text-gray-600"></i> Alamat</th>
                                    <th class="py-3 px-3 text-xs text-center"><i
                                            class="fas fa-cog mr-1 text-gray-600"></i> Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y text-gray-800">
                                @forelse ($ibu_hamils as $ibu)
                                    <tr
                                        class="row-item opacity-0 translate-y-4 hover:bg-gray-50 transition-all whitespace-nowrap">
                                        <td class="py-3 px-3 border">{{ $ibu->nik_ibu_hamil }}</td>
                                        <td class="py-3 px-3 font-medium border">{{ $ibu->nama_ibu_hamil }}</td>
                                        <td class="py-3 px-3 border">{{ $ibu->nama_suami }}</td>
                                        <td class="py-3 px-3 border">{{ $ibu->umur }} tahun</td>
                                        <td class="py-3 px-3 max-w-xs truncate border"
                                            title="{{ $ibu->alamat_ibu_hamil }}">
                                            {{ Str::limit($ibu->alamat_ibu_hamil, 30) }}
                                        </td>
                                        <td class="py-3 px-3 text-center border">
                                            <div class="flex items-center justify-center space-x-3">
                                                <a href="{{ route('peserta.edit', ['kategori' => 'ibu_hamil', 'id' => $ibu->id]) }}"
                                                    class="text-yellow-500 hover:text-yellow-600">
                                                    <i class="fas fa-edit text-sm"></i>
                                                </a>
                                                <form
                                                    action="{{ route('peserta.destroy', ['kategori' => 'ibu_hamil', 'id' => $ibu->id]) }}"
                                                    method="POST" class="delete-form inline-block">
                                                    @csrf @method('DELETE')
                                                    <button type="button"
                                                        class="btn-delete text-red-500 hover:text-red-600">
                                                        <i class="fas fa-trash text-sm"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="py-6 text-center text-gray-500">Tidak ada data ibu
                                            hamil</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-6 text-sm text-gray-600 flex justify-between items-center">
                        Menampilkan {{ $ibu_hamils->lastItem() ?? 0 }} dari {{ $ibu_hamils->total() }} data ibu hamil
                        <div class="pagination flex space-x-2 opacity-0 translate-y-4">
                            {{ $ibu_hamils->appends(['tab' => 'ibu_hamil'])->links() }}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>

    {{-- Script Delete --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.body.addEventListener('click', function(event) {
                const btn = event.target.closest('.btn-delete');
                if (btn) {
                    event.preventDefault();
                    const form = btn.closest('.delete-form');
                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Data ini akan dihapus permanen!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                }
            });
        });
    </script>

    {{-- GSAP Animation Sequence --}}
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
                .to(".gsap-card", {
                    opacity: 1,
                    y: 0,
                    duration: 0.6,
                    stagger: 0.15
                }, "-=0.3")
                .to(".row-item", {
                    opacity: 1,
                    y: 0,
                    duration: 0.5,
                    stagger: 0.05
                }, "-=0.4")
                .to(".pagination", {
                    opacity: 1,
                    y: 0,
                    duration: 0.6
                }, "-=0.5");
        });
    </script>
</x-app-main>
