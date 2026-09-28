<x-app-main title="Edit Pemeriksaan">
    <!-- Load GSAP & FontAwesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <main class="ml-2 md:ml-2 min-h-screen pb-10">

        <!-- Header Section -->
        <div
            class="gsap-header opacity-0 translate-y-5 mb-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-3">
                    <span class="bg-yellow-100 text-yellow-600 p-2 rounded-lg shadow-sm">
                        <i class="fas fa-edit"></i>
                    </span>
                    Edit Data Pemeriksaan
                </h1>
                <p class="text-gray-500 mt-1 text-sm md:text-base ml-1">
                    Perbarui data hasil pemeriksaan kesehatan peserta.
                </p>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('pemeriksaan.index') }}"
                    class="group bg-white border border-gray-200 hover:bg-gray-50 hover:border-gray-300 transition-all duration-300 text-gray-600 px-5 py-2.5 rounded-xl flex items-center shadow-sm hover:shadow-md">
                    <i class="fas fa-arrow-left mr-2 group-hover:-translate-x-1 transition-transform"></i>
                    <span>Kembali</span>
                </a>
            </div>
        </div>

        <!-- Main Form Card -->
        <div
            class="gsap-card opacity-0 translate-y-10 bg-white rounded-2xl shadow-xl border border-gray-100 p-6 md:p-8">

            <form action="{{ route('pemeriksaan.update', $pemeriksaan->id) }}" method="POST" class="space-y-8">
                @csrf
                @method('PUT')

                <!-- SECTION 1: WAKTU PEMERIKSAAN -->
                <div class="bg-blue-50/50 p-6 rounded-xl border border-blue-100">
                    <h3 class="text-blue-800 font-bold flex items-center border-b border-blue-200 pb-2 mb-4">
                        <i class="far fa-clock mr-2"></i> Waktu Pemeriksaan
                    </h3>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Tanggal & Jam <span class="text-red-500">*</span>
                        </label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i
                                    class="fas fa-calendar-alt text-gray-400 group-focus-within:text-blue-500 transition-colors"></i>
                            </div>
                            <input type="datetime-local" name="tanggal"
                                value="{{ old('tanggal', $pemeriksaan->tanggal) }}"
                                class="w-full pl-10 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 transition-all"
                                required>
                        </div>
                    </div>
                </div>

                <!-- SECTION 2: KONDISIONAL (BALITA / IBU HAMIL) -->

                {{-- FORM EDIT BALITA --}}
                @if ($pemeriksaan->balita)
                    <div class="bg-green-50/50 p-6 rounded-xl border border-green-100 space-y-6">
                        <div class="flex justify-between items-center border-b border-green-200 pb-2">
                            <h3 class="text-green-800 font-bold flex items-center">
                                <i class="fas fa-baby mr-2"></i> Data Pemeriksaan Balita
                            </h3>
                            <span class="text-xs font-bold bg-green-200 text-green-800 px-2 py-1 rounded">
                                {{ $pemeriksaan->balita->nama_balita }}
                            </span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <!-- Berat Badan -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Berat Badan (kg)</label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i
                                            class="fas fa-weight text-gray-400 group-focus-within:text-green-500 transition-colors"></i>
                                    </div>
                                    <input type="number" step="0.1" min="0" name="berat_badan_balita"
                                        value="{{ old('berat_badan_balita', $pemeriksaan->berat_badan_balita) }}"
                                        class="w-full pl-10 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-200 focus:border-green-500 transition-all">
                                </div>
                            </div>

                            <!-- Tinggi Badan -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Tinggi Badan (cm)</label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i
                                            class="fas fa-ruler-vertical text-gray-400 group-focus-within:text-green-500 transition-colors"></i>
                                    </div>
                                    <input type="number" step="0.1" min="0" name="tinggi_badan"
                                        value="{{ old('tinggi_badan', $pemeriksaan->tinggi_badan) }}"
                                        class="w-full pl-10 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-200 focus:border-green-500 transition-all">
                                </div>
                            </div>

                            <!-- Status Gizi -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Status Gizi</label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i
                                            class="fas fa-notes-medical text-gray-400 group-focus-within:text-green-500 transition-colors"></i>
                                    </div>
                                    <select name="status_gizi"
                                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-200 focus:border-green-500 transition-all appearance-none bg-white cursor-pointer">
                                        <option value="Gizi Baik"
                                            {{ old('status_gizi', $pemeriksaan->status_gizi) == 'Gizi Baik' ? 'selected' : '' }}>
                                            Gizi Baik</option>
                                        <option value="Gizi Buruk"
                                            {{ old('status_gizi', $pemeriksaan->status_gizi) == 'Gizi Buruk' ? 'selected' : '' }}>
                                            Gizi Buruk</option>
                                        <option value="Stunting"
                                            {{ old('status_gizi', $pemeriksaan->status_gizi) == 'Stunting' ? 'selected' : '' }}>
                                            Stunting</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <i class="fas fa-chevron-down text-gray-400 text-xs"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- FORM EDIT IBU HAMIL --}}
                @if ($pemeriksaan->ibu_hamil)
                    <div class="bg-pink-50/50 p-6 rounded-xl border border-pink-100 space-y-6">
                        <div class="flex justify-between items-center border-b border-pink-200 pb-2">
                            <h3 class="text-pink-800 font-bold flex items-center">
                                <i class="fas fa-female mr-2"></i> Data Pemeriksaan Ibu Hamil
                            </h3>
                            <span class="text-xs font-bold bg-pink-200 text-pink-800 px-2 py-1 rounded">
                                {{ $pemeriksaan->ibu_hamil->nama_ibu_hamil }}
                            </span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Berat Badan -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Berat Badan (kg)</label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i
                                            class="fas fa-weight text-gray-400 group-focus-within:text-pink-500 transition-colors"></i>
                                    </div>
                                    <input type="number" step="0.1" min="0" name="berat_badan_ibu"
                                        value="{{ old('berat_badan_ibu', $pemeriksaan->berat_badan_ibu) }}"
                                        class="w-full pl-10 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-200 focus:border-pink-500 transition-all">
                                </div>
                            </div>

                            <!-- Usia Kehamilan -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Usia Kehamilan
                                    (minggu)</label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i
                                            class="fas fa-hourglass-half text-gray-400 group-focus-within:text-pink-500 transition-colors"></i>
                                    </div>
                                    <input type="number" name="usia_kehamilan"
                                        value="{{ old('usia_kehamilan', $pemeriksaan->usia_kehamilan) }}"
                                        class="w-full pl-10 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-200 focus:border-pink-500 transition-all">
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Tekanan Darah -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Tekanan Darah
                                    (mmHg)</label>
                                <div class="flex items-center gap-2">
                                    <div class="relative flex-1 group">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i
                                                class="fas fa-heartbeat text-gray-400 group-focus-within:text-pink-500 transition-colors"></i>
                                        </div>
                                        <input type="number" name="tekanan_sistolik" step="1" min="0"
                                            value="{{ old('tekanan_sistolik', $pemeriksaan->tekanan_sistolik) }}"
                                            class="w-full pl-10 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-200 focus:border-pink-500 transition-all"
                                            placeholder="Sistol">
                                    </div>
                                    <span class="text-gray-400">/</span>
                                    <div class="relative flex-1 group">
                                        <input type="number" name="tekanan_diastolik" step="1" min="0"
                                            value="{{ old('tekanan_diastolik', $pemeriksaan->tekanan_diastolik) }}"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-200 focus:border-pink-500 transition-all"
                                            placeholder="Diastol">
                                    </div>
                                </div>
                            </div>

                            <!-- Status Kesehatan -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Status Kesehatan</label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i
                                            class="fas fa-stethoscope text-gray-400 group-focus-within:text-pink-500 transition-colors"></i>
                                    </div>
                                    <select name="status_ibu"
                                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-200 focus:border-pink-500 transition-all appearance-none bg-white cursor-pointer">
                                        <option value="Kondisi Baik"
                                            {{ old('status_ibu', $pemeriksaan->status_ibu) == 'Kondisi Baik' ? 'selected' : '' }}>
                                            Kondisi Baik</option>
                                        <option value="Anemia"
                                            {{ old('status_ibu', $pemeriksaan->status_ibu) == 'Anemia' ? 'selected' : '' }}>
                                            Anemia</option>
                                        <option value="Resiko Tinggi"
                                            {{ old('status_ibu', $pemeriksaan->status_ibu) == 'Resiko Tinggi' ? 'selected' : '' }}>
                                            Resiko Tinggi</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <i class="fas fa-chevron-down text-gray-400 text-xs"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Tombol Aksi -->
                <div class="pt-8 border-t flex flex-col sm:flex-row gap-4 justify-end mt-12">
                    <a href="{{ route('pemeriksaan.index') }}"
                        class="px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-xl hover:bg-gray-50 transition duration-300 text-center shadow-sm">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-8 py-3 bg-button hover:bg-buttonhover  transition-all duration-300 text-white font-bold rounded-xl flex items-center justify-center shadow-lg hover:shadow-blue-500/30 transform hover:-translate-y-1">
                        <i class="fas fa-save mr-2"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
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
                }, "-=0.6");
        });
    </script>
</x-app-main>
