<x-app-main title="Tambah Artikel">
    <!-- Load GSAP -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>

    <div class="p-6 md:p-8 min-h-screen">

        <!-- Header Section -->
        <div class="gsap-header opacity-0 -translate-y-5 mb-8">
            <a href="{{ route('kader.artikel.index') }}"
                class="inline-flex items-center text-gray-500 hover:text-posyanduu mb-4 transition-colors text-sm font-medium">
                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar
            </a>
            <h2 class="text-3xl font-extrabold text-gray-800 flex items-center gap-3">
                <span class="w-10 h-10 rounded-xl bg-posyanduu/10 text-posyanduu flex items-center justify-center">
                    <i class="fas fa-plus-circle"></i>
                </span>
                Buat Artikel Baru
            </h2>
            <p class="text-gray-500 mt-1 text-sm ml-14">Tambahkan informasi terkini dan edukasi untuk pengguna.</p>
        </div>

        <!-- Form Card -->
        <div
            class="gsap-form opacity-0 translate-y-5 bg-white p-6 md:p-8 rounded-2xl shadow-xl shadow-gray-200/50 border border-gray-100 max-w-4xl mx-auto relative overflow-hidden">

            <!-- Hiasan Background -->
            <div
                class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-bl from-posyanduu/5 to-transparent rounded-bl-full pointer-events-none">
            </div>

            <form action="{{ route('kader.artikel.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Judul -->
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Judul Artikel</label>
                    <input type="text" name="judul" value="{{ old('judul') }}"
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-posyanduu/50 focus:border-posyanduu transition-all placeholder-gray-400"
                        placeholder="Masukkan judul artikel yang menarik..." required>
                </div>

                <!-- Grid Kategori & Penulis -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Kategori -->
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Kategori</label>
                        <div class="relative">
                            <select name="kategori"
                                class="w-full border border-gray-300 rounded-xl px-4 py-3 appearance-none focus:outline-none focus:ring-2 focus:ring-posyanduu/50 focus:border-posyanduu transition-all bg-white cursor-pointer">
                                <option value="Balita">Balita</option>
                                <option value="Ibu Hamil">Ibu Hamil</option>
                            </select>
                            <div
                                class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-gray-500">
                                <i class="fas fa-chevron-down text-xs"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Penulis -->
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Penulis</label>
                        <div class="relative">
                            <input type="text" name="penulis" value="{{ old('penulis') }}"
                                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-posyanduu/50 focus:border-posyanduu transition-all"
                                placeholder="Cth: Bidan Desa" required>
                            <div
                                class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400">
                                <i class="far fa-user"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Gambar Utama (Custom File Input) -->
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Gambar Utama</label>
                    <div class="flex flex-col items-center justify-center w-full">
                        <label for="dropzone-file"
                            class="flex flex-col items-center justify-center w-full h-40 border-2 border-gray-300 border-dashed rounded-xl cursor-pointer bg-gray-50 hover:bg-gray-100 hover:border-posyanduu transition-all group relative overflow-hidden">

                            <!-- Konten Default -->
                            <div
                                class="flex flex-col items-center justify-center pt-5 pb-6 text-gray-500 group-hover:text-posyanduu z-10">
                                <i class="fas fa-cloud-upload-alt text-3xl mb-3"></i>
                                <p class="text-sm mb-1"><span class="font-semibold">Klik untuk upload</span></p>
                                <p class="text-xs text-gray-400">PNG, JPG, JPEG (MAX. 2MB)</p>
                            </div>

                            <!-- Input File Asli (Hidden) -->
                            <input id="dropzone-file" type="file" name="gambar" class="hidden" required
                                onchange="previewImage(this)" accept="image/*" />

                            <!-- Image Preview Overlay -->
                            <img id="preview-img"
                                class="hidden absolute inset-0 w-full h-full object-cover opacity-50 group-hover:opacity-40 transition-opacity" />
                        </label>
                    </div>
                    <!-- Status Text Preview -->
                    <p id="file-name" class="text-xs text-green-600 mt-2 font-medium hidden items-center">
                        <i class="fas fa-check-circle mr-1"></i> Gambar dipilih
                    </p>

                    @error('gambar')
                        <p class="text-red-500 text-xs mt-1 font-medium">
                            <i class="fas fa-exclamation-circle mr-1"></i> {{ 'max 2mb' }}
                        </p>
                    @enderror
                </div>

                <!-- Isi Artikel -->
                <div class="mb-8">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Isi Artikel</label>
                    <textarea name="isi" rows="12"
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-posyanduu/50 focus:border-posyanduu transition-all placeholder-gray-400"
                        placeholder="Tulis konten artikel di sini..." required>{{ old('isi') }}</textarea>

                    @error('isi')
                        <p class="text-red-500 text-xs mt-1 font-medium">
                            <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-100">
                    <a href="{{ route('kader.artikel.index') }}"
                        class="px-6 py-2.5 rounded-xl text-gray-600 font-medium hover:bg-gray-100 transition-colors">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-8 py-2.5 rounded-xl bg-posyanduu text-white font-bold shadow-lg shadow-teal-500/30 hover:bg-teal-600 hover:shadow-teal-500/50 transform hover:-translate-y-0.5 transition-all duration-200 flex items-center gap-2">
                        <i class="fas fa-save"></i>
                        Simpan Artikel
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Script for Animation & Image Preview -->
    <script>
        // GSAP Animation
        document.addEventListener("DOMContentLoaded", () => {
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
                .to(".gsap-form", {
                    y: 0,
                    opacity: 1,
                    duration: 0.8
                }, "-=0.6");
        });

        // Image Preview Logic
        function previewImage(input) {
            const previewImg = document.getElementById('preview-img');
            const fileNameText = document.getElementById('file-name');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    previewImg.classList.remove('hidden');
                    fileNameText.classList.remove('hidden');
                    fileNameText.innerHTML = `<i class="fas fa-check-circle mr-1"></i> ${input.files[0].name}`;
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</x-app-main>
