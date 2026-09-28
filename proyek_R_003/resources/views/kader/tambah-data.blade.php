<x-app-main title="Tambah Data Peserta">

    <main class="ml-2 md:ml-2 relative overflow-hidden">
        <!-- Header Section -->
        <div class="mb-8 flex flex-col md:flex-row justify-between items-start md:items-center gsap-header opacity-0">
            <div class="mb-4 md:mb-0">
                <h1 class="font-extrabold text-gray-800 text-2xl flex items-center gap-3">
                    <span class="bg-blue-100 text-posyanduu p-2 rounded-lg shadow-sm">
                        <i class="fas fa-user-plus text-xl"></i>
                    </span>
                    Tambah Data Peserta
                </h1>
                <p class="text-gray-500 mt-1 text-sm md:text-base ml-1">
                    Silakan lengkapi formulir di bawah ini dengan data yang valid.
                </p>
            </div>
            <div class="flex space-x-2">
                <a href="{{ url('/data') }}"
                    class="group bg-white border border-gray-200 hover:bg-gray-50 hover:border-gray-300 transition-all duration-300 text-gray-600 px-5 py-2.5 rounded-xl flex items-center shadow-sm hover:shadow-md">
                    <i class="fas fa-arrow-left mr-2 group-hover:-translate-x-1 transition-transform"></i>
                    <span>Kembali</span>
                </a>
            </div>
        </div>

        <!-- Card Form -->
        <div
            class="bg-white rounded-2xl shadow-xl border border-gray-100 p-6 md:p-10 gsap-card opacity-0 translate-y-10">
            <form action="{{ route('peserta.store') }}" method="POST" class="space-y-8" id="mainForm">
                @csrf
                <!-- Input Hidden untuk Logic JS jika diperlukan, tapi sebaiknya biarkan select handle -->
                <input type="hidden" id="kategori_hidden" name="kategori_hidden" value="{{ old('kategori') }}">

                <!-- Pilih Kategori -->
                <div class="relative bg-blue-50/50 p-6 rounded-xl border border-blue-100">
                    <label for="kategori" class="block text-sm font-bold text-gray-700 mb-3">
                        <i class="fas fa-shapes text-posyanduu mr-1"></i> Kategori Data <span
                            class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-filter text-gray-400"></i>
                        </div>
                        <select id="kategori" name="kategori"
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all duration-300 appearance-none bg-white"
                            required onchange="handleKategoriChange()">
                            <option value="" selected disabled>-- Pilih Kategori Peserta --</option>
                            <option value="balita" {{ old('kategori') == 'balita' ? 'selected' : '' }}>Data Balita
                            </option>
                            <option value="ibu_hamil" {{ old('kategori') == 'ibu_hamil' ? 'selected' : '' }}>Data Ibu
                                Hamil</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <i class="fas fa-chevron-down text-gray-400"></i>
                        </div>
                    </div>
                </div>

                <!-- Form Container -->
                <div class="relative min-h-[200px]">

                    <!-- Form Balita -->
                    <div id="form-balita" class="hidden absolute w-full top-0 left-0 transition-opacity duration-300">
                        <div class="bg-green-50/30 p-2 rounded-lg mb-6 border-l-4 border-green-400">
                            <h3 class="font-bold text-green-700 flex items-center"><i class="fas fa-baby mr-2"></i> Form
                                Data Balita</h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Kolom Kiri -->
                            <div class="space-y-6">
                                <!-- NIK -->
                                <div class="group">
                                    <label for="nik" class="block text-sm font-semibold text-gray-700 mb-2">
                                        NIK Balita <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i
                                                class="fas fa-id-card text-gray-400 group-focus-within:text-blue-500 transition-colors"></i>
                                        </div>
                                        <input type="text" id="nik" name="nik" value="{{ old('nik') }}"
                                            class="w-full pl-10 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 transition-all placeholder-gray-400"
                                            placeholder="16 Digit NIK Balita" minlength="16" maxlength="16">
                                    </div>
                                    @error('nik')
                                        <p class="text-red-500 text-sm mt-1 flex items-center"><i
                                                class="fas fa-exclamation-circle mr-1"></i> NIK sudah terpakai</p>
                                    @enderror
                                </div>

                                <!-- Nama Balita -->
                                <div class="group">
                                    <label for="nama_balita" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Nama Balita <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i
                                                class="fas fa-user text-gray-400 group-focus-within:text-blue-500 transition-colors"></i>
                                        </div>
                                        <input type="text" id="nama_balita" name="nama_balita"
                                            value="{{ old('nama_balita') }}"
                                            class="w-full pl-10 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 transition-all placeholder-gray-400"
                                            placeholder="Nama Lengkap Balita">
                                    </div>
                                </div>

                                <!-- Usia -->
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        Usia Saat Ini <span class="text-red-500">*</span>
                                    </label>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div class="relative group">
                                            <label for="usia_tahun"
                                                class="block text-xs font-bold text-gray-500 mb-1 uppercase tracking-wide">Tahun</label>
                                            <div class="relative">
                                                <div
                                                    class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                    <i
                                                        class="fas fa-calendar-check text-gray-400 group-focus-within:text-blue-500"></i>
                                                </div>
                                                <input type="number" id="usia_tahun" name="usia_tahun" min="0"
                                                    max="5" value="{{ old('usia_tahun') }}"
                                                    class="w-full pl-10 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 transition-all"
                                                    placeholder="0">
                                            </div>
                                        </div>
                                        <div class="relative group">
                                            <label for="usia_bulan"
                                                class="block text-xs font-bold text-gray-500 mb-1 uppercase tracking-wide">Bulan</label>
                                            <div class="relative">
                                                <div
                                                    class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                    <i
                                                        class="fas fa-calendar-day text-gray-400 group-focus-within:text-blue-500"></i>
                                                </div>
                                                <input type="number" id="usia_bulan" name="usia_bulan"
                                                    min="0" max="12" value="{{ old('usia_bulan') }}"
                                                    class="w-full pl-10 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 transition-all"
                                                    placeholder="0">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Kolom Kanan -->
                            <div class="space-y-6">
                                <!-- Jenis Kelamin -->
                                <div class="group">
                                    <label for="jenis_kelamin" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Jenis Kelamin <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i
                                                class="fas fa-venus-mars text-gray-400 group-focus-within:text-blue-500 transition-colors"></i>
                                        </div>
                                        <select id="jenis_kelamin" name="jenis_kelamin"
                                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 transition-all appearance-none bg-white">
                                            <option value="">Pilih Jenis Kelamin</option>
                                            <option value="Laki-laki"
                                                {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                                            </option>
                                            <option value="Perempuan"
                                                {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan
                                            </option>
                                        </select>
                                        <div
                                            class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                            <i class="fas fa-chevron-down text-gray-400 text-xs"></i>
                                        </div>
                                    </div>
                                </div>

                                <!-- Nama Orang Tua -->
                                <div class="group">
                                    <label for="nama_orang_tua"
                                        class="block text-sm font-semibold text-gray-700 mb-2">
                                        Nama Orang Tua <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i
                                                class="fas fa-users text-gray-400 group-focus-within:text-blue-500 transition-colors"></i>
                                        </div>
                                        <input type="text" id="nama_orang_tua" name="nama_orang_tua"
                                            value="{{ old('nama_orang_tua') }}"
                                            class="w-full pl-10 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 transition-all"
                                            placeholder="Nama Ayah / Ibu">
                                    </div>
                                </div>

                                <!-- Alamat -->
                                <div class="group">
                                    <label for="alamat" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Alamat Lengkap <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute top-3 left-3 pointer-events-none">
                                            <i
                                                class="fas fa-map-marker-alt text-gray-400 group-focus-within:text-blue-500 transition-colors"></i>
                                        </div>
                                        <textarea id="alamat" name="alamat" rows="3"
                                            class="w-full pl-10 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 transition-all placeholder-gray-400"
                                            placeholder="Nama Jalan, RT/RW, Dusun">{{ old('alamat') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pemilik User -->
                        <div class="mt-6 group border-t pt-6 border-dashed border-gray-200">
                            <label for="user_id_balita" class="block text-sm font-semibold text-gray-700 mb-2">
                                Akun Pemilik (Pengguna) <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-user-tag text-gray-400 group-focus-within:text-blue-500"></i>
                                </div>
                                <select name="user_id" id="user_id_balita"
                                    class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-200 focus:border-blue-500 transition-all appearance-none bg-white">
                                    <option value="" disabled selected>-- Tautkan ke Akun Pengguna --</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}"
                                            {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }} ({{ $user->email }})
                                        </option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <i class="fas fa-chevron-down text-gray-400 text-xs"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Ibu Hamil -->
                    <div id="form-ibu-hamil"
                        class="hidden absolute w-full top-0 left-0 transition-opacity duration-300">
                        <div class="bg-pink-50/30 p-2 rounded-lg mb-6 border-l-4 border-pink-400">
                            <h3 class="font-bold text-pink-700 flex items-center"><i class="fas fa-female mr-2"></i>
                                Form Data Ibu Hamil</h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Kolom Kiri -->
                            <div class="space-y-6">
                                <!-- NIK -->
                                <div class="group">
                                    <label for="nik_ibu_hamil" class="block text-sm font-semibold text-gray-700 mb-2">
                                        NIK Ibu Hamil <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i
                                                class="fas fa-id-card text-gray-400 group-focus-within:text-pink-500 transition-colors"></i>
                                        </div>
                                        <input type="text" id="nik_ibu_hamil" name="nik_ibu_hamil"
                                            value="{{ old('nik_ibu_hamil') }}"
                                            class="w-full pl-10 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-200 focus:border-pink-500 transition-all placeholder-gray-400"
                                            placeholder="16 Digit NIK" minlength="16" maxlength="16">
                                    </div>
                                    @error('nik_ibu_hamil')
                                        <p class="text-red-500 text-sm mt-1 flex items-center"><i
                                                class="fas fa-exclamation-circle mr-1"></i> NIK sudah terpakai</p>
                                    @enderror
                                </div>

                                <!-- Nama Ibu Hamil -->
                                <div class="group">
                                    <label for="nama_ibu_hamil"
                                        class="block text-sm font-semibold text-gray-700 mb-2">
                                        Nama Ibu Hamil <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i
                                                class="fas fa-user-nurse text-gray-400 group-focus-within:text-pink-500 transition-colors"></i>
                                        </div>
                                        <input type="text" id="nama_ibu_hamil" name="nama_ibu_hamil"
                                            value="{{ old('nama_ibu_hamil') }}"
                                            class="w-full pl-10 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-200 focus:border-pink-500 transition-all"
                                            placeholder="Nama Lengkap Ibu">
                                    </div>
                                </div>

                                <!-- Nama Suami -->
                                <div class="group">
                                    <label for="nama_suami" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Nama Suami <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i
                                                class="fas fa-male text-gray-400 group-focus-within:text-pink-500 transition-colors"></i>
                                        </div>
                                        <input type="text" id="nama_suami" name="nama_suami"
                                            value="{{ old('nama_suami') }}"
                                            class="w-full pl-10 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-200 focus:border-pink-500 transition-all"
                                            placeholder="Nama Suami">
                                    </div>
                                </div>
                            </div>

                            <!-- Kolom Kanan -->
                            <div class="space-y-6">
                                <!-- Umur -->
                                <div class="group">
                                    <label for="umur" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Umur (Tahun) <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i
                                                class="fas fa-hourglass-half text-gray-400 group-focus-within:text-pink-500 transition-colors"></i>
                                        </div>
                                        <input type="number" id="umur" name="umur" min="15"
                                            max="60" value="{{ old('umur') }}"
                                            class="w-full pl-10 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-200 focus:border-pink-500 transition-all"
                                            placeholder="Contoh: 25">
                                    </div>
                                </div>

                                <!-- Alamat -->
                                <div class="group">
                                    <label for="alamat_ibu_hamil"
                                        class="block text-sm font-semibold text-gray-700 mb-2">
                                        Alamat Lengkap <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute top-3 left-3 pointer-events-none">
                                            <i
                                                class="fas fa-map-marker-alt text-gray-400 group-focus-within:text-pink-500 transition-colors"></i>
                                        </div>
                                        <textarea id="alamat_ibu_hamil" name="alamat_ibu_hamil" rows="3"
                                            class="w-full pl-10 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-200 focus:border-pink-500 transition-all placeholder-gray-400"
                                            placeholder="Nama Jalan, RT/RW, Dusun">{{ old('alamat_ibu_hamil') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pemilik User -->
                        <div class="mt-6 group border-t pt-6 border-dashed border-gray-200">
                            <label for="user_id_ibu" class="block text-sm font-semibold text-gray-700 mb-2">
                                Akun Pemilik (Pengguna) <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-user-tag text-gray-400 group-focus-within:text-pink-500"></i>
                                </div>
                                <select name="user_id" id="user_id_ibu"
                                    class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-200 focus:border-pink-500 transition-all appearance-none bg-white">
                                    <option value="" disabled selected>-- Tautkan ke Akun Pengguna --</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}"
                                            {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }} ({{ $user->email }})
                                        </option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <i class="fas fa-chevron-down text-gray-400 text-xs"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="pt-8 border-t flex flex-col sm:flex-row gap-4 justify-end mt-12">
                    <a href="{{ url('/data') }}"
                        class="px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-xl hover:bg-gray-50 transition duration-300 text-center shadow-sm">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-8 py-3 bg-button hover:bg-buttonhover transition-all duration-300 text-white font-bold rounded-xl flex items-center justify-center shadow-lg hover:shadow-blue-500/30 transform hover:-translate-y-1">
                        <i class="fas fa-save mr-2"></i> Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </main>

    <!-- Script Animation Logic -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // 1. Initial Page Load Animation
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

            // 2. Form Switching Logic with GSAP
            const kategoriSelect = document.getElementById('kategori');
            const formBalita = document.getElementById('form-balita');
            const formIbuHamil = document.getElementById('form-ibu-hamil');

            // Perbaiki ID select user agar unik karena ada 2 form
            const userSelectBalita = document.getElementById('user_id_balita');
            const userSelectIbu = document.getElementById('user_id_ibu');

            // Handle disable/enable required attributes based on visibility
            function updateRequiredFields(activeForm) {
                const balitaInputs = formBalita.querySelectorAll('input, select, textarea');
                const ibuInputs = formIbuHamil.querySelectorAll('input, select, textarea');

                if (activeForm === 'balita') {
                    balitaInputs.forEach(el => el.setAttribute('required', 'required'));
                    ibuInputs.forEach(el => el.removeAttribute('required'));
                    // Karena user_id ada dua, pastikan name tetap benar saat submit
                    userSelectBalita.setAttribute('name', 'user_id');
                    userSelectIbu.removeAttribute('name');
                } else if (activeForm === 'ibu_hamil') {
                    ibuInputs.forEach(el => el.setAttribute('required', 'required'));
                    balitaInputs.forEach(el => el.removeAttribute('required'));
                    userSelectIbu.setAttribute('name', 'user_id');
                    userSelectBalita.removeAttribute('name');
                } else {
                    // Jika belum pilih, matikan required untuk mencegah error validasi HTML5
                    balitaInputs.forEach(el => el.removeAttribute('required'));
                    ibuInputs.forEach(el => el.removeAttribute('required'));
                }
            }

            // Function to animate switching
            window.handleKategoriChange = function() {
                const selectedValue = kategoriSelect.value;
                const containerHeight = document.querySelector('.relative.min-h-\\[200px\\]');

                if (selectedValue === 'balita') {
                    // Hide Ibu Hamil
                    if (!formIbuHamil.classList.contains('hidden')) {
                        gsap.to(formIbuHamil, {
                            opacity: 0,
                            y: -20,
                            duration: 0.3,
                            onComplete: () => {
                                formIbuHamil.classList.add('hidden');
                                showBalita();
                            }
                        });
                    } else {
                        showBalita();
                    }

                } else if (selectedValue === 'ibu_hamil') {
                    // Hide Balita
                    if (!formBalita.classList.contains('hidden')) {
                        gsap.to(formBalita, {
                            opacity: 0,
                            y: -20,
                            duration: 0.3,
                            onComplete: () => {
                                formBalita.classList.add('hidden');
                                showIbuHamil();
                            }
                        });
                    } else {
                        showIbuHamil();
                    }
                }
            };

            function showBalita() {
                formBalita.classList.remove('hidden');
                // Set relative positioning so it takes space
                formBalita.style.position = 'relative';
                formIbuHamil.style.position = 'absolute'; // Remove other from flow

                updateRequiredFields('balita');

                gsap.fromTo(formBalita, {
                    opacity: 0,
                    y: 20
                }, {
                    opacity: 1,
                    y: 0,
                    duration: 0.5,
                    ease: "back.out(1.7)"
                });
            }

            function showIbuHamil() {
                formIbuHamil.classList.remove('hidden');
                // Set relative positioning so it takes space
                formIbuHamil.style.position = 'relative';
                formBalita.style.position = 'absolute'; // Remove other from flow

                updateRequiredFields('ibu_hamil');

                gsap.fromTo(formIbuHamil, {
                    opacity: 0,
                    y: 20
                }, {
                    opacity: 1,
                    y: 0,
                    duration: 0.5,
                    ease: "back.out(1.7)"
                });
            }

            // Check old value on load (Laravel validation fail refresh)
            const oldValue = "{{ old('kategori') }}";
            if (oldValue) {
                kategoriSelect.value = oldValue;
                handleKategoriChange();
            } else {
                // Reset form inputs initial state
                updateRequiredFields(null);
            }
        });
    </script>
</x-app-main>
