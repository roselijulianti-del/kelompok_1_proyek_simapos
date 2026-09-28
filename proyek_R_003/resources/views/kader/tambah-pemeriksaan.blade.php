<x-app-main title="Tambah Pemeriksaan">
    <!-- Load GSAP CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>

    <main class="ml-2 md:ml-2 min-h-screen pb-10">
        <!-- Header Section -->
        <div
            class="gsap-header opacity-0 translate-y-5 mb-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-3">
                    <span class="bg-blue-100 text-posyanduu p-2 rounded-lg shadow-sm">
                        <i class="fas fa-plus-circle"></i>
                    </span>
                    Tambah Pemeriksaan
                </h1>
                <p class="text-gray-500 mt-1 text-sm md:text-base ml-1">
                    Silakan isi formulir pemeriksaan kesehatan di bawah ini.
                </p>
            </div>
            <div class="flex space-x-2">
                <a href="{{ url('/pemeriksaan') }}"
                    class="group bg-white border border-gray-200 hover:bg-gray-50 hover:border-gray-300 transition-all duration-300 text-gray-600 px-5 py-2.5 rounded-xl flex items-center shadow-sm hover:shadow-md">
                    <i class="fas fa-arrow-left mr-2 group-hover:-translate-x-1 transition-transform"></i>
                    <span>Kembali</span>
                </a>
            </div>
        </div>

        <!-- Card Form -->
        <div
            class="gsap-card opacity-0 translate-y-10 bg-white rounded-2xl shadow-xl border border-gray-100 p-6 md:p-8">

            @if (session('success'))
                <div
                    class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-lg mb-6 flex items-center">
                    <i class="fas fa-check-circle mr-3 text-lg"></i>
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('pemeriksaan.store') }}" method="POST" class="space-y-8">
                @csrf

                <!-- SECTION 1: IDENTITAS & WAKTU -->
                <div class="bg-blue-50/50 p-6 rounded-xl border border-blue-100 space-y-6">
                    <h3 class="text-blue-800 font-bold flex items-center border-b border-blue-200 pb-2">
                        <i class="fas fa-user-clock mr-2"></i> Data Peserta & Waktu
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Pilih Tipe -->
                        <div>
                            <label for="tipe" class="block text-sm font-semibold text-gray-700 mb-2">
                                Tipe Peserta <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-users text-gray-400"></i>
                                </div>
                                <select name="tipe" id="tipe"
                                    class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 transition-all appearance-none bg-white cursor-pointer"
                                    required>
                                    <option value="">-- Pilih Tipe Peserta --</option>
                                    <option value="balita">Pemeriksaan Balita</option>
                                    <option value="ibu_hamil">Pemeriksaan Ibu Hamil</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <i class="fas fa-chevron-down text-gray-400 text-xs"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Tanggal Pemeriksaan -->
                        <div>
                            <label for="tanggal" class="block text-sm font-semibold text-gray-700 mb-2">
                                Tanggal & Jam <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-calendar-alt text-gray-400"></i>
                                </div>
                                <input type="datetime-local" name="tanggal"
                                    class="w-full pl-10 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 transition-all"
                                    required>
                            </div>
                        </div>
                    </div>

                    <!-- Cari Peserta -->
                    <div class="relative">
                        <label for="search-peserta" class="block text-sm font-semibold text-gray-700 mb-2">
                            Cari Peserta (Nama / NIK) <span class="text-red-500">*</span>
                        </label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i
                                    class="fas fa-search text-gray-400 group-focus-within:text-blue-500 transition-colors"></i>
                            </div>
                            <input type="text" id="search-peserta"
                                class="w-full pl-10 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 transition-all placeholder-gray-400"
                                placeholder="Ketik nama atau NIK peserta..." autocomplete="off">

                            <!-- Input ID Hidden -->
                            <input type="hidden" name="peserta_id" id="peserta_id">
                        </div>

                        <!-- Hasil Pencarian -->
                        <div id="search-results"
                            class="absolute z-50 w-full bg-white border border-gray-200 rounded-lg shadow-lg mt-1 max-h-60 overflow-y-auto hidden">
                            <!-- Hasil akan muncul di sini via JS -->
                        </div>
                    </div>
                </div>

                <!-- SECTION 2: INPUT DINAMIS -->
                <!-- Container relative agar animasi smooth -->
                <div class="relative min-h-[100px]">

                    <!-- INPUT BALITA -->
                    <div id="input-balita" class="hidden">
                        <div class="bg-green-50/50 p-6 rounded-xl border border-green-100 space-y-6">
                            <h3 class="text-green-800 font-bold flex items-center border-b border-green-200 pb-2">
                                <i class="fas fa-baby mr-2"></i> Hasil Pengukuran Balita
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <!-- Berat Badan -->
                                <div>
                                    <label for="berat_badan_balita"
                                        class="block text-sm font-semibold text-gray-700 mb-2">
                                        Berat Badan (kg)
                                    </label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-weight text-gray-400"></i>
                                        </div>
                                        <input type="number" step="0.1" min="0" name="berat_badan_balita"
                                            class="w-full pl-10 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-200 focus:border-green-500 transition-all"
                                            placeholder="0.0">
                                    </div>
                                </div>

                                <!-- Tinggi Badan -->
                                <div>
                                    <label for="tinggi_badan" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Tinggi Badan (cm)
                                    </label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-ruler-vertical text-gray-400"></i>
                                        </div>
                                        <input type="number" step="0.1" min="0" name="tinggi_badan"
                                            class="w-full pl-10 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-200 focus:border-green-500 transition-all"
                                            placeholder="0.0">
                                    </div>
                                </div>

                                <!-- Status Gizi -->
                                <div>
                                    <label for="status_gizi" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Status Gizi
                                    </label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-notes-medical text-gray-400"></i>
                                        </div>
                                        <select name="status_gizi"
                                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-200 focus:border-green-500 transition-all appearance-none bg-white">
                                            <option value="">-- Pilih Status --</option>
                                            <option value="Gizi Baik">Gizi Baik</option>
                                            <option value="Gizi Buruk">Gizi Buruk</option>
                                            <option value="Stunting">Stunting</option>
                                        </select>
                                        <div
                                            class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                            <i class="fas fa-chevron-down text-gray-400 text-xs"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- INPUT IBU HAMIL -->
                    <div id="input-ibu" class="hidden">
                        <div class="bg-pink-50/50 p-6 rounded-xl border border-pink-100 space-y-6">
                            <h3 class="text-pink-800 font-bold flex items-center border-b border-pink-200 pb-2">
                                <i class="fas fa-female mr-2"></i> Hasil Pemeriksaan Ibu Hamil
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Berat Badan -->
                                <div>
                                    <label for="berat_badan_ibu"
                                        class="block text-sm font-semibold text-gray-700 mb-2">
                                        Berat Badan (kg)
                                    </label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-weight text-gray-400"></i>
                                        </div>
                                        <input type="number" step="0.1" min="0" name="berat_badan_ibu"
                                            class="w-full pl-10 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-200 focus:border-pink-500 transition-all"
                                            placeholder="0.0">
                                    </div>
                                </div>

                                <!-- Usia Kehamilan -->
                                <div>
                                    <label for="usia_kehamilan"
                                        class="block text-sm font-semibold text-gray-700 mb-2">
                                        Usia Kehamilan (minggu)
                                    </label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-hourglass-half text-gray-400"></i>
                                        </div>
                                        <input type="number" name="usia_kehamilan"
                                            class="w-full pl-10 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-200 focus:border-pink-500 transition-all"
                                            placeholder="Contoh: 12">
                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Tekanan Darah -->
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        Tekanan Darah (mmHg)
                                    </label>
                                    <div class="flex items-center gap-2">
                                        <div class="relative flex-1">
                                            <div
                                                class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <i class="fas fa-heartbeat text-gray-400"></i>
                                            </div>
                                            <input type="number" name="tekanan_sistolik" step="1"
                                                min="0"
                                                class="w-full pl-10 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-200 focus:border-pink-500 transition-all"
                                                placeholder="Sistol (120)">
                                        </div>
                                        <span class="text-gray-400">/</span>
                                        <div class="relative flex-1">
                                            <input type="number" name="tekanan_diastolik" step="1"
                                                min="0"
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-200 focus:border-pink-500 transition-all"
                                                placeholder="Diastol (80)">
                                        </div>
                                    </div>
                                </div>

                                <!-- Status Ibu -->
                                <div>
                                    <label for="status_ibu" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Status Kesehatan
                                    </label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="fas fa-stethoscope text-gray-400"></i>
                                        </div>
                                        <select name="status_ibu"
                                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-200 focus:border-pink-500 transition-all appearance-none bg-white">
                                            <option value="">-- Pilih Status --</option>
                                            <option value="Kondisi Baik">Kondisi Baik</option>
                                            <option value="Anemia">Anemia</option>
                                            {{-- <option value="Resiko Tinggi">Resiko Tinggi</option> --}}
                                        </select>
                                        <div
                                            class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                            <i class="fas fa-chevron-down text-gray-400 text-xs"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="pt-8 border-t flex flex-col sm:flex-row gap-4 justify-end">
                    <a href="{{ url('/pemeriksaan') }}"
                        class="px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-xl hover:bg-gray-50 transition duration-300 text-center shadow-sm">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-8 py-3 bg-button hover:bg-buttonhover text-white font-bold rounded-xl flex items-center justify-center shadow-lg hover:shadow-blue-500/30 transform hover:-translate-y-1 transition-all">
                        <i class="fas fa-save mr-2"></i> Simpan Pemeriksaan
                    </button>
                </div>
            </form>
        </div>
    </main>

    <!-- Script Logic & Animation -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // 1. Initial Entry Animation
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
                }, "-=0.6");

            // 2. Logic Toggle Input dengan Animasi
            const tipe = document.getElementById('tipe');
            const inputBalita = document.getElementById('input-balita');
            const inputIbu = document.getElementById('input-ibu');

            tipe.addEventListener('change', function() {
                const val = this.value;

                // Fungsi helper untuk animasi masuk
                const animateIn = (element) => {
                    element.classList.remove('hidden');
                    gsap.fromTo(element, {
                            opacity: 0,
                            y: 10
                        }, {
                            opacity: 1,
                            y: 0,
                            duration: 0.4,
                            clearProps: "all"
                        } // clearProps biar responsive tidak terganggu
                    );
                };

                // Fungsi helper untuk animasi keluar
                const animateOut = (element, callback) => {
                    if (!element.classList.contains('hidden')) {
                        gsap.to(element, {
                            opacity: 0,
                            y: -10,
                            duration: 0.3,
                            onComplete: () => {
                                element.classList.add('hidden');
                                if (callback) callback();
                            }
                        });
                    } else {
                        if (callback) callback();
                    }
                };

                if (val === 'balita') {
                    animateOut(inputIbu, () => {
                        animateIn(inputBalita);
                    });
                } else if (val === 'ibu_hamil') {
                    animateOut(inputBalita, () => {
                        animateIn(inputIbu);
                    });
                } else {
                    animateOut(inputBalita);
                    animateOut(inputIbu);
                }
            });

            // 3. AJAX Search Peserta
            const searchInput = document.getElementById('search-peserta');
            const resultsDiv = document.getElementById('search-results');
            const pesertaIdInput = document.getElementById('peserta_id');

            // Hide results when clicking outside
            document.addEventListener('click', function(e) {
                if (!searchInput.contains(e.target) && !resultsDiv.contains(e.target)) {
                    resultsDiv.classList.add('hidden');
                }
            });

            searchInput.addEventListener('keyup', function() {
                const query = this.value;
                if (query.length < 2) {
                    resultsDiv.innerHTML = '';
                    resultsDiv.classList.add('hidden');
                    return;
                }

                resultsDiv.classList.remove('hidden');
                resultsDiv.innerHTML =
                    '<div class="p-3 text-gray-500 text-sm text-center"><i class="fas fa-spinner fa-spin mr-2"></i>Mencari...</div>';

                fetch(`/pemeriksaan/search?q=${query}`)
                    .then(res => res.json())
                    .then(data => {
                        resultsDiv.innerHTML = '';

                        if (data.message || data.length === 0) {
                            resultsDiv.innerHTML =
                                `<div class="p-3 text-red-500 text-sm text-center">${data.message || 'Data tidak ditemukan'}</div>`;
                        } else {
                            data.forEach(item => {
                                const div = document.createElement('div');
                                div.className =
                                    'p-3 cursor-pointer hover:bg-blue-50 border-b last:border-0 border-gray-100 transition-colors flex flex-col';
                                div.innerHTML = `
                                    <span class="font-bold text-gray-800">${item.nama}</span>
                                    <span class="text-xs text-gray-500"><i class="far fa-id-card mr-1"></i> NIK: ${item.nik}</span>
                                `;
                                div.addEventListener('click', () => {
                                    pesertaIdInput.value = item.id;
                                    searchInput.value = item
                                        .nama; // Tampilkan nama saja di input
                                    resultsDiv.innerHTML = '';
                                    resultsDiv.classList.add('hidden');
                                });
                                resultsDiv.appendChild(div);
                            });
                        }
                    })
                    .catch(err => {
                        resultsDiv.innerHTML =
                            '<div class="p-3 text-red-500 text-sm text-center">Terjadi kesalahan.</div>';
                    });
            });
        });
    </script>
</x-app-main>
