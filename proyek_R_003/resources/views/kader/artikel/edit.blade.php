<x-app-main title="Edit Artikel">
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
                    <i class="fas fa-edit"></i>
                </span>
                Edit Artikel
            </h2>
            <p class="text-gray-500 mt-1 text-sm ml-14">Perbarui informasi artikel agar tetap relevan.</p>
        </div>

        <!-- Form Card -->
        <div
            class="gsap-form opacity-0 translate-y-5 bg-white p-6 md:p-8 rounded-2xl shadow-xl shadow-gray-200/50 border border-gray-100 max-w-4xl mx-auto relative overflow-hidden">

            <!-- Hiasan Background -->
            <div
                class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-bl from-posyanduu/5 to-transparent rounded-bl-full pointer-events-none">
            </div>

            <form action="{{ route('kader.artikel.update', $artikel->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Judul -->
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Judul Artikel</label>
                    <input type="text" name="judul" value="{{ old('judul', $artikel->judul) }}"
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-posyanduu/50 focus:border-posyanduu transition-all placeholder-gray-400"
                        required>
                </div>

                <!-- Grid Kategori & Penulis -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Kategori -->
                    <div>
                        <label class="block text-gray-700 text-sm font-bold mb-2">Kategori</label>
                        <div class="relative">
                            <select name="kategori"
                                class="w-full border border-gray-300 rounded-xl px-4 py-3 appearance-none focus:outline-none focus:ring-2 focus:ring-posyanduu/50 focus:border-posyanduu transition-all bg-white cursor-pointer">
                                <option value="Balita" {{ $artikel->kategori == 'Balita' ? 'selected' : '' }}>Balita
                                </option>
                                <option value="Ibu Hamil" {{ $artikel->kategori == 'Ibu Hamil' ? 'selected' : '' }}>Ibu
                                    Hamil</option>
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
                            <input type="text" name="penulis" value="{{ old('penulis', $artikel->penulis) }}"
                                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-posyanduu/50 focus:border-posyanduu transition-all"
                                required>
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
                            class="flex flex-col items-center justify-center w-full h-48 border-2 border-gray-300 border-dashed rounded-xl cursor-pointer bg-gray-50 hover:bg-gray-100 hover:border-posyanduu transition-all group relative overflow-hidden">

                            <!-- Konten Default (Teks Upload) -->
                            <div
                                class="flex flex-col items-center justify-center pt-5 pb-6 text-gray-500 z-20 transition-opacity duration-300 bg-white/80 p-3 rounded-lg backdrop-blur-sm shadow-sm absolute">
                                <i class="fas fa-cloud-upload-alt text-3xl mb-2 text-posyanduu"></i>
                                <p class="text-sm mb-1 font-semibold text-gray-700">Klik untuk ganti gambar</p>
                                <p class="text-xs text-gray-500">Biarkan jika tidak ingin mengubah</p>
                            </div>

                            <!-- Input File Asli (Hidden) - Tidak Required di Edit -->
                            <input id="dropzone-file" type="file" name="gambar" class="hidden"
                                onchange="previewImage(this)" accept="image/*" />

                            <!-- Image Preview (Langsung Tampilkan Gambar Lama) -->
                            @if ($artikel->gambar)
                                <img id="preview-img" src="{{ asset('storage/' . $artikel->gambar) }}"
                                    class="absolute inset-0 w-full h-full object-cover opacity-60 group-hover:opacity-40 transition-opacity duration-300" />
                            @else
                                <img id="preview-img"
                                    class="hidden absolute inset-0 w-full h-full object-cover opacity-60 group-hover:opacity-40 transition-opacity" />
                            @endif
                        </label>
                    </div>
                    <!-- Status Text Preview -->
                    <p id="file-name" class="text-xs text-gray-500 mt-2 font-medium flex items-center">
                        <i class="fas fa-info-circle mr-1 text-posyanduu"></i> Gambar saat ini tersimpan. Upload baru
                        untuk mengganti.
                    </p>
                </div>

                <!-- Isi Artikel -->
                <div class="mb-8">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Isi Artikel</label>
                    <textarea name="isi" rows="12"
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-posyanduu/50 focus:border-posyanduu transition-all placeholder-gray-400"
                        required>{{ old('isi', $artikel->isi) }}</textarea>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-100">
                    <a href="{{ route('kader.artikel.index') }}"
                        class="px-6 py-2.5 rounded-xl text-gray-600 font-medium hover:bg-gray-100 transition-colors">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-8 py-2.5 rounded-xl bg-posyanduu text-white font-bold shadow-lg shadow-teal-500/30 hover:bg-teal-600 hover:shadow-teal-500/50 transform hover:-translate-y-0.5 transition-all duration-200 flex items-center gap-2">
                        <i class="fas fa-sync-alt"></i>
                        Update Artikel
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
                    // Saat preview gambar baru muncul, kita sesuaikan opacity agar jelas ini gambar baru
                    previewImg.classList.remove('opacity-60');
                    previewImg.classList.add('opacity-100');

                    fileNameText.innerHTML =
                        `<span class="text-green-600"><i class="fas fa-check-circle mr-1"></i> Gambar baru dipilih: ${input.files[0].name}</span>`;
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</x-app-main>
