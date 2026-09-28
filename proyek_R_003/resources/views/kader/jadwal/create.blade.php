<x-app-main title="Tambah Jadwal">
    <!-- Load GSAP & FontAwesome CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <main class="ml-2 md:ml-2 min-h-screen pb-10">
        <!-- Header Section -->
        <div
            class="gsap-header opacity-0 translate-y-5 mb-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-3">
                    <span class="bg-blue-100 text-posyanduu p-2 rounded-lg shadow-sm">
                        <i class="fas fa-calendar-plus"></i>
                    </span>
                    Tambah Jadwal Posyandu
                </h1>
                <p class="text-gray-500 mt-1 text-sm md:text-base ml-1">
                    Atur jadwal kegiatan pemeriksaan dan lokasi pelaksanaan.
                </p>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('pemeriksaan.index', ['tab' => 'jadwal']) }}"
                    class="group bg-white border border-gray-200 hover:bg-gray-50 hover:border-gray-300 transition-all duration-300 text-gray-600 px-5 py-2.5 rounded-xl flex items-center shadow-sm hover:shadow-md">
                    <i class="fas fa-arrow-left mr-2 group-hover:-translate-x-1 transition-transform"></i>
                    <span>Kembali</span>
                </a>
            </div>
        </div>

        <!-- Card Form -->
        <div
            class="gsap-card opacity-0 translate-y-10 bg-white rounded-2xl shadow-xl border border-gray-100 p-6 md:p-8">
            <form action="{{ route('jadwal.store') }}" method="POST" class="space-y-6">
                @csrf

                <div class="bg-blue-50/50 p-6 rounded-xl border border-blue-100 space-y-6">
                    <h3 class="text-blue-800 font-bold flex items-center border-b border-blue-200 pb-2">
                        <i class="fas fa-info-circle mr-2"></i> Informasi Kegiatan
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Keterangan -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Jenis Kegiatan <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-clipboard-list text-gray-400"></i>
                                </div>
                                <select name="keterangan" required
                                    class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 transition-all appearance-none bg-white cursor-pointer">
                                    <option value="">-- Pilih Keterangan --</option>
                                    <option value="Pemeriksaan Balita"
                                        {{ old('keterangan') == 'Pemeriksaan Balita' ? 'selected' : '' }}>
                                        Pemeriksaan Balita
                                    </option>
                                    <option value="Pemeriksaan Ibu Hamil"
                                        {{ old('keterangan') == 'Pemeriksaan Ibu Hamil' ? 'selected' : '' }}>
                                        Pemeriksaan Ibu Hamil
                                    </option>
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <i class="fas fa-chevron-down text-gray-400 text-xs"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Lokasi -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Lokasi Kegiatan <span class="text-red-500">*</span>
                            </label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i
                                        class="fas fa-map-marker-alt text-gray-400 group-focus-within:text-red-400 transition-colors"></i>
                                </div>
                                <input type="text" name="lokasi" value="{{ old('lokasi') }}" required
                                    class="w-full pl-10 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 transition-all placeholder-gray-400"
                                    placeholder="Contoh: Posyandu Melati 1">
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Waktu Mulai -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Waktu Mulai <span class="text-red-500">*</span>
                            </label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="far fa-clock text-gray-400 group-focus-within:text-blue-500"></i>
                                </div>
                                <input type="datetime-local" name="waktu_mulai" value="{{ old('waktu_mulai') }}"
                                    required
                                    class="w-full pl-10 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 transition-all">
                            </div>
                        </div>

                        <!-- Waktu Selesai -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Waktu Selesai <span class="text-red-500">*</span>
                            </label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-hourglass-end text-gray-400 group-focus-within:text-blue-500"></i>
                                </div>
                                <input type="datetime-local" name="waktu_selesai" value="{{ old('waktu_selesai') }}"
                                    required
                                    class="w-full pl-10 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 transition-all">
                            </div>
                            @error('waktu_selesai')
                                <p class="text-red-500 text-sm mt-1 flex items-center gap-1 animate-pulse">
                                    <i class="fas fa-exclamation-circle"></i> Waktu selesai harus lebih besar dari waktu
                                    mulai!
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="pt-6 border-t flex flex-col sm:flex-row gap-4 justify-end">
                    <a href="{{ route('pemeriksaan.index') }}"
                        class="px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-xl hover:bg-gray-50 transition duration-300 text-center shadow-sm">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-8 py-3 bg-button hover:bg-buttonhover transition-all duration-300 text-white font-bold rounded-xl flex items-center justify-center shadow-lg hover:shadow-blue-500/30 transform hover:-translate-y-1">
                        <i class="fas fa-save mr-2"></i> Simpan Jadwal
                    </button>
                </div>
            </form>
        </div>
    </main>

    <!-- Script Animation Logic -->
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
