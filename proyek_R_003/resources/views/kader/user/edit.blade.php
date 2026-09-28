<x-app-main title="Edit Pengguna">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

    <main class="relative min-h-screen bg-slate-50 p-4 md:p-8 flex justify-center items-start pt-10">

        {{-- Background Elements --}}
        <div
            class="fixed top-0 left-0 w-full h-80 bg-gradient-to-r from-posyanduDark to-ed -z-10 rounded-b-[50px] shadow-lg">
        </div>
        <div class="fixed top-20 right-10 w-64 h-64 bg-white/10 rounded-full blur-3xl -z-10"></div>
        <div class="fixed top-40 left-20 w-40 h-40 bg-purple-500/20 rounded-full blur-2xl -z-10"></div>

        <div class="w-full max-w-4xl relative z-10">

            {{-- PERBAIKAN 1: Header Section (Agar sejajar & responsif) --}}
            <div
                class="gsap-header opacity-0 -translate-y-5 flex flex-row justify-between items-center gap-4 mb-6 text-white">
                <div class="min-w-0 flex-1">
                    <h1 class="text-xl md:text-2xl font-bold text-ed truncate">Edit Data Pengguna</h1>
                    <p class="text-ed text-xs md:text-sm opacity-90 truncate">Perbarui informasi dan hak akses pengguna.
                    </p>
                </div>
                {{-- Tombol Kembali (Opsional, jika di-uncomment akan otomatis rapi) --}}
                {{-- <a href="{{ route('admin.pengguna.index') }}"
                    class="group flex items-center bg-ed hover:bg-posyanduDark backdrop-blur-sm px-3 py-2 md:px-4 md:py-2 rounded-xl transition-all border border-white/20 whitespace-nowrap">
                    <i class="fas fa-arrow-left group-hover:-translate-x-1 transition-transform"></i>
                    <span class="ml-2 hidden md:inline">Kembali</span>
                </a> --}}
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- Left Column: Info Card --}}
                <div class="gsap-card opacity-0 -translate-x-5 lg:col-span-1">
                    <div
                        class="bg-white rounded-2xl shadow-xl shadow-indigo-100 p-6 text-center border border-gray-100 h-full relative overflow-hidden flex flex-col items-center">
                        <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-ed to-posyanduDark">
                        </div>

                        <div
                            class="w-24 h-24 mx-auto bg-gray-100 rounded-full flex items-center justify-center mb-4 border-4 border-white shadow-md relative flex-shrink-0">
                            <i class="fas fa-user text-4xl text-gray-400"></i>
                            <div class="absolute bottom-1 right-1 w-6 h-6 bg-ed border-2 border-white rounded-full animate-bounce"
                                title="Active"></div>
                        </div>

                        {{-- Tambahkan truncate agar nama panjang tidak merusak kartu --}}
                        <div class="w-full min-w-0">
                            <h3 class="text-lg font-bold text-gray-800 truncate" title="{{ $user->name }}">
                                {{ $user->name }}
                            </h3>
                            <p class="text-gray-500 text-sm mb-4 truncate" title="{{ $user->email }}">
                                {{ $user->email }}
                            </p>
                        </div>

                        <div class="bg-blue-50 rounded-xl p-3 mb-4 w-full">
                            <p class="text-xs text-blue-600 font-semibold uppercase tracking-wider">Role Saat Ini</p>
                            <p class="text-blue-800 font-bold text-lg">{{ ucfirst($user->role) }}</p>
                        </div>

                        <p class="text-xs text-gray-400 mt-auto pt-4 border-t border-gray-100 w-full">
                            Terdaftar: {{ $user->created_at->format('d M Y') }}<br>
                            Update: {{ $user->updated_at->diffForHumans() }}
                        </p>
                    </div>
                </div>

                {{-- Right Column: Form Input --}}
                <div class="gsap-card opacity-0 translate-x-5 lg:col-span-2">
                    <div class="bg-white rounded-2xl shadow-xl shadow-indigo-100 p-6 md:p-8 border border-gray-100">

                        <form action="{{ route('users.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="space-y-5 md:space-y-6">
                                {{-- Input Nama --}}
                                <div class="gsap-input group">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i
                                                class="fas fa-id-card text-gray-400 group-focus-within:text-blue-500 transition-colors"></i>
                                        </div>
                                        <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                            class="block w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all font-medium text-gray-800 text-sm md:text-base"
                                            placeholder="Masukkan nama user">
                                    </div>
                                    @error('name')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Grid Email & Role --}}
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-6">
                                    <div class="gsap-input group">
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat
                                            Email</label>
                                        <div class="relative">
                                            <div
                                                class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <i
                                                    class="fas fa-envelope text-gray-400 group-focus-within:text-blue-500 transition-colors"></i>
                                            </div>
                                            <input type="email" name="email"
                                                value="{{ old('email', $user->email) }}"
                                                class="block w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all font-medium text-gray-800 text-sm md:text-base"
                                                placeholder="email@contoh.com">
                                        </div>
                                        @error('email')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="gsap-input group">
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Role / Hak
                                            Akses</label>
                                        <div class="relative">
                                            <div
                                                class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <i
                                                    class="fas fa-user-tag text-gray-400 group-focus-within:text-blue-500 transition-colors"></i>
                                            </div>
                                            <select name="role"
                                                class="block w-full pl-10 pr-10 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all font-medium text-gray-800 appearance-none cursor-pointer text-sm md:text-base">
                                                <option value="pengguna"
                                                    {{ $user->role == 'pengguna' ? 'selected' : '' }}>Pengguna Biasa
                                                </option>
                                                <option value="kader" {{ $user->role == 'kader' ? 'selected' : '' }}>
                                                    Kader Posyandu</option>
                                            </select>
                                            <div
                                                class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                                <i class="fas fa-chevron-down text-gray-400"></i>
                                            </div>
                                        </div>
                                        @error('role')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="border-t border-gray-100 my-4"></div>

                                {{-- Input Password --}}
                                <div class="gsap-input group">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        Password Baru <span
                                            class="text-gray-400 font-normal text-xs ml-1">(Opsional)</span>
                                    </label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i
                                                class="fas fa-lock text-gray-400 group-focus-within:text-blue-500 transition-colors"></i>
                                        </div>
                                        <input type="password" name="password" id="passwordInput"
                                            class="block w-full pl-10 pr-10 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 outline-none transition-all font-medium text-gray-800 text-sm md:text-base"
                                            placeholder="Minimal 8 karakter">

                                        <button type="button" onclick="togglePassword()"
                                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none">
                                            <i class="fas fa-eye" id="eyeIcon"></i>
                                        </button>
                                    </div>
                                    @error('password')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- PERBAIKAN 2: Action Buttons (Dibuat sejajar tidak turun) --}}
                                <div class="gsap-input pt-4 flex flex-row items-center justify-end gap-3">
                                    <a href="{{ route('admin.pengguna.index') }}"
                                        class="px-4 py-2.5 md:px-6 rounded-xl border border-gray-300 text-gray-700 font-medium hover:bg-gray-50 transition-colors text-sm md:text-base whitespace-nowrap">
                                        Batal
                                    </a>
                                    <button type="submit"
                                        class="px-4 py-2.5 md:px-6 rounded-xl bg-gradient-to-r from-ed to-posyanduDark text-white font-medium shadow-lg shadow-blue-500/30 hover:shadow-ed hover:-translate-y-0.5 transition-all duration-300 cursor-pointer flex items-center justify-center text-sm md:text-base whitespace-nowrap">
                                        <i class="fas fa-save mr-2"></i>
                                        <span>Simpan</span>
                                        {{-- Sembunyikan 'Perubahan' di HP kecil agar muat --}}
                                        <span class="hidden sm:inline ml-1">Perubahan</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Animasi GSAP
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
                .to(".gsap-card", {
                    x: 0,
                    opacity: 1,
                    duration: 0.8,
                    stagger: 0.2
                }, "-=0.5")
                .from(".gsap-input", {
                    y: 20,
                    opacity: 0,
                    duration: 0.5,
                    stagger: 0.1
                }, "-=0.3");
        });

        // Script Toggle Password
        function togglePassword() {
            const input = document.getElementById('passwordInput');
            const icon = document.getElementById('eyeIcon');

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</x-app-main>
