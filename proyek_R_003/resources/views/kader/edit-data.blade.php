<x-app-main title="Edit Data Peserta">
    <main class="min-h-screen w-full bg-slate-50/50 p-4 md:p-6 lg:p-8">

        <div class="mb-6 gsap-back opacity-0 -translate-x-5">
            <a href="{{ url()->previous() }}"
                class="inline-flex items-center text-sm text-slate-500 hover:text-blue-600 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Daftar
            </a>
        </div>

        <div
            class="gsap-card opacity-0 translate-y-10 bg-white rounded-2xl shadow-lg border border-slate-100 overflow-hidden w-full">

            <div class="relative bg-gradient-to-r bg-posyanduu px-6 py-8 md:px-10">
                <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 rounded-full bg-white opacity-10 blur-xl">
                </div>
                <div class="absolute bottom-0 left-0 -mb-4 -ml-4 w-24 h-24 rounded-full bg-white opacity-10 blur-xl">
                </div>

                <div class="relative flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <div class="gsap-header-item opacity-0 translate-y-3 flex items-center gap-3 mb-2">
                            <span
                                class="bg-white/20 backdrop-blur-sm text-white text-xs font-semibold px-2.5 py-0.5 rounded border border-white/10">
                                {{ strtoupper(str_replace('_', ' ', $kategori)) }}
                            </span>
                        </div>
                        <h1
                            class="gsap-header-item opacity-0 translate-y-3 text-3xl font-bold text-white tracking-tight">
                            Edit Data Peserta
                        </h1>
                        <p
                            class="gsap-header-item opacity-0 translate-y-3 text-blue-50 mt-2 text-sm md:text-base max-w-2xl">
                            Silakan perbarui data di bawah ini. Pastikan seluruh informasi valid sebelum menyimpan
                            perubahan.
                        </p>
                    </div>

                    <div class="hidden md:block opacity-90 gsap-header-icon scale-75">
                        <div class="bg-white/10 backdrop-blur-md p-3 rounded-xl border border-white/20 shadow-inner">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                @if ($kategori === 'balita')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                @elseif($kategori === 'ibu_hamil')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                @endif
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-6 md:p-10 bg-white">
                <form action="{{ route('peserta.update', ['kategori' => $kategori, 'id' => $data->id]) }}"
                    method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="kategori" value="{{ $kategori }}">

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-8 gap-y-6">

                        @if ($kategori === 'balita')
                            <div class="col-span-1 lg:col-span-2 gsap-input opacity-0 translate-y-5">
                                <label for="nik" class="block text-sm font-semibold text-slate-700 mb-2">Nomor
                                    Induk Kependudukan (NIK)</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0c0 .883.393 1.627 1 2.18" />
                                        </svg>
                                    </div>
                                    <input type="text" id="nik" name="nik" value="{{ $data->nik }}"
                                        class="pl-10 w-full rounded-lg border-slate-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all shadow-sm py-2.5"
                                        placeholder="16 digit NIK" required>
                                </div>
                            </div>

                            <div class="gsap-input opacity-0 translate-y-5">
                                <label for="nama_balita" class="block text-sm font-semibold text-slate-700 mb-2">Nama
                                    Lengkap Balita</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                    <input type="text" id="nama_balita" name="nama_balita"
                                        value="{{ $data->nama_balita }}"
                                        class="pl-10 w-full rounded-lg border-slate-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all shadow-sm py-2.5"
                                        placeholder="Nama sesuai akta" required>
                                </div>
                            </div>

                            <div class="gsap-input opacity-0 translate-y-5">
                                <label for="jenis_kelamin" class="block text-sm font-semibold text-slate-700 mb-2">Jenis
                                    Kelamin</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4v16m8-8H4" />
                                        </svg>
                                    </div>
                                    <select id="jenis_kelamin" name="jenis_kelamin"
                                        class="pl-10 w-full rounded-lg border-slate-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all shadow-sm py-2.5"
                                        required>
                                        <option value="Laki-laki"
                                            {{ $data->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                                        </option>
                                        <option value="Perempuan"
                                            {{ $data->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div
                                class="grid grid-cols-2 gap-4 col-span-1 lg:col-span-2 p-4 bg-slate-50 rounded-xl border border-slate-200 gsap-input opacity-0 translate-y-5">
                                <div>
                                    <label for="usia_tahun"
                                        class="block text-xs font-bold text-slate-500 uppercase mb-1">Usia
                                        (Tahun)</label>
                                    <input type="number" id="usia_tahun" name="usia_tahun"
                                        value="{{ $data->usia_tahun }}"
                                        class="w-full rounded-lg border-slate-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm"
                                        min="0" max="5" required>
                                </div>
                                <div>
                                    <label for="usia_bulan"
                                        class="block text-xs font-bold text-slate-500 uppercase mb-1">Usia
                                        (Bulan)</label>
                                    <input type="number" id="usia_bulan" name="usia_bulan"
                                        value="{{ $data->usia_bulan }}"
                                        class="w-full rounded-lg border-slate-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm"
                                        min="0" max="12">
                                </div>
                            </div>

                            <div class="col-span-1 lg:col-span-2 gsap-input opacity-0 translate-y-5">
                                <label for="nama_orang_tua"
                                    class="block text-sm font-semibold text-slate-700 mb-2">Nama Orang Tua</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                    </div>
                                    <input type="text" id="nama_orang_tua" name="nama_orang_tua"
                                        value="{{ $data->nama_orang_tua }}"
                                        class="pl-10 w-full rounded-lg border-slate-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all shadow-sm py-2.5"
                                        placeholder="Nama Ibu/Ayah" required>
                                </div>
                            </div>

                            <div class="col-span-1 lg:col-span-2 gsap-input opacity-0 translate-y-5">
                                <label for="alamat" class="block text-sm font-semibold text-slate-700 mb-2">Alamat
                                    Lengkap</label>
                                <div class="relative">
                                    <textarea id="alamat" name="alamat" rows="3"
                                        class="w-full rounded-lg border-slate-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all shadow-sm"
                                        placeholder="Jalan, RT/RW, Desa..." required>{{ $data->alamat }}</textarea>
                                </div>
                            </div>
                        @elseif($kategori === 'ibu_hamil')
                            <div class="col-span-1 lg:col-span-2 gsap-input opacity-0 translate-y-5">
                                <label for="nik_ibu_hamil" class="block text-sm font-semibold text-slate-700 mb-2">NIK
                                    Ibu Hamil</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0c0 .883.393 1.627 1 2.18" />
                                        </svg>
                                    </div>
                                    <input type="text" id="nik_ibu_hamil" name="nik_ibu_hamil"
                                        value="{{ $data->nik_ibu_hamil }}"
                                        class="pl-10 w-full rounded-lg border-slate-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all shadow-sm py-2.5"
                                        placeholder="Masukkan NIK" required>
                                </div>
                            </div>

                            <div class="gsap-input opacity-0 translate-y-5">
                                <label for="nama_ibu_hamil"
                                    class="block text-sm font-semibold text-slate-700 mb-2">Nama Ibu Hamil</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                    <input type="text" id="nama_ibu_hamil" name="nama_ibu_hamil"
                                        value="{{ $data->nama_ibu_hamil }}"
                                        class="pl-10 w-full rounded-lg border-slate-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all shadow-sm py-2.5"
                                        placeholder="Nama Lengkap" required>
                                </div>
                            </div>

                            <div class="gsap-input opacity-0 translate-y-5">
                                <label for="umur" class="block text-sm font-semibold text-slate-700 mb-2">Umur
                                    (Tahun)</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <input type="number" id="umur" name="umur" value="{{ $data->umur }}"
                                        class="pl-10 w-full rounded-lg border-slate-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all shadow-sm py-2.5"
                                        min="15" max="50" required>
                                </div>
                            </div>

                            <div class="col-span-1 lg:col-span-2 gsap-input opacity-0 translate-y-5">
                                <label for="nama_suami" class="block text-sm font-semibold text-slate-700 mb-2">Nama
                                    Suami</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                    <input type="text" id="nama_suami" name="nama_suami"
                                        value="{{ $data->nama_suami }}"
                                        class="pl-10 w-full rounded-lg border-slate-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all shadow-sm py-2.5"
                                        placeholder="Nama Suami" required>
                                </div>
                            </div>

                            <div class="col-span-1 lg:col-span-2 gsap-input opacity-0 translate-y-5">
                                <label for="alamat_ibu_hamil"
                                    class="block text-sm font-semibold text-slate-700 mb-2">Alamat Lengkap</label>
                                <textarea id="alamat_ibu_hamil" name="alamat_ibu_hamil" rows="3"
                                    class="w-full rounded-lg border-slate-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all shadow-sm"
                                    placeholder="Jalan, RT/RW..." required>{{ $data->alamat_ibu_hamil }}</textarea>
                            </div>
                        @endif
                    </div>

                    <div class="col-span-1 lg:col-span-2 gsap-input opacity-0 translate-y-5 mb-6">
                        <label for="user_id" class="block text-sm font-semibold text-slate-700 mb-2">
                            Akun Pemilik (Pengguna) <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-user-tag text-slate-400"></i>
                            </div>
                            <select name="user_id" id="user_id"
                                class="pl-10 w-full rounded-lg border-slate-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all shadow-sm py-2.5 bg-white appearance-none"
                                required>
                                <option value="" disabled>-- Tautkan ke Akun Pengguna --</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}"
                                        {{ old('user_id', $data->user_id) == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }} ({{ $user->email }})
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <i class="fas fa-chevron-down text-slate-400 text-xs"></i>
                            </div>
                        </div>
                    </div>

                    <div
                        class="mt-8 pt-6 border-t border-slate-100 flex flex-col-reverse sm:flex-row justify-end gap-3 gsap-input opacity-0 translate-y-5">
                        <a href="{{ url()->previous() }}"
                            class="inline-flex justify-center items-center px-6 py-3 border border-slate-300 shadow-sm text-sm font-medium rounded-lg text-slate-700 bg-white hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-500 transition-all">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Batal
                        </a>
                        <button type="submit"
                            class="inline-flex justify-center items-center px-6 py-3 border border-transparent shadow-md text-sm font-medium rounded-lg text-white bg-gradient-to-r bg-posyanduu hover:brightness-90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all transform hover:-translate-y-0.5">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4">
                                </path>
                            </svg>
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const tl = gsap.timeline({
                defaults: {
                    ease: "power3.out",
                    duration: 0.8
                }
            });

            tl.to(".gsap-back", {
                    opacity: 1,
                    x: 0,
                    duration: 0.5
                })
                .to(".gsap-card", {
                    opacity: 1,
                    y: 0,
                    duration: 0.6
                }, "-=0.3")
                .to([".gsap-header-item", ".gsap-header-icon"], {
                    opacity: 1,
                    y: 0,
                    scale: 1,
                    stagger: 0.1,
                    duration: 0.5
                }, "-=0.2")
                .to(".gsap-input", {
                    opacity: 1,
                    y: 0,
                    stagger: 0.05,
                    duration: 0.5
                }, "-=0.3");
        });
    </script>
</x-app-main>
