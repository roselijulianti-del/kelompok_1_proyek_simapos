<x-app>
    <x-slot:title>{{ $title }}</x-slot:title>

    {{-- Libraries --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div class="min-h-screen w-full bg-slate-50 flex items-center justify-center p-4 relative overflow-hidden">

        {{-- Background Decorations --}}
        <div class="fixed top-[-10%] left-[-10%] w-96 h-96 bg-blue-100 rounded-full blur-3xl opacity-60 -z-10"></div>
        <div class="fixed bottom-[-10%] right-[-10%] w-96 h-96 bg-teal-100 rounded-full blur-3xl opacity-60 -z-10"></div>

        <div id="register-card"
            class="flex w-full max-w-5xl bg-white rounded-3xl shadow-2xl overflow-hidden opacity-0 translate-y-10">

            <!-- Sisi Kiri (Form) -->
            <div class="w-full lg:w-1/2 p-8 md:p-12 flex flex-col justify-center">

                {{-- Header --}}
                <div class="gsap-item text-center lg:text-left mb-8">
                    <div
                        class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-teal-100 text-teal-600 mb-4 shadow-sm">
                        <i class="fas fa-user-plus text-2xl"></i>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-800">Buat Akun Baru</h2>
                    <p class="mt-2 text-gray-500">Lengkapi data diri Anda untuk bergabung.</p>
                </div>

                <form action="{{ route('register') }}" method="POST" class="space-y-5">
                    @csrf

                    {{-- Nama Lengkap --}}
                    <div class="gsap-item group">
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Nama
                            Lengkap</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i
                                    class="fas fa-user text-gray-400 group-focus-within:text-teal-500 transition-colors"></i>
                            </div>
                            <input id="name" type="text" name="name" value="{{ old('name') }}" required
                                placeholder="Masukkan nama lengkap"
                                class="w-full pl-11 pr-4 py-3 bg-gray-50 border  rounded-xl 
                                       text-gray-900 placeholder-gray-400 focus:bg-white 
                                       focus:outline-none focus:ring-2 focus:ring-teal-500/20 
                                       focus:border-teal-500 transition-all 
                                       @error('name') border-red-500 ring-red-200 @enderror">
                        </div>
                        @error('name')
                            <p class="mt-1 text-xs text-red-600 flex items-center gap-1">
                                <i class="fas fa-info-circle"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="gsap-item group">
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Alamat
                            Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i
                                    class="fas fa-envelope text-gray-400 group-focus-within:text-teal-500 transition-colors"></i>
                            </div>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                                placeholder="nama@email.com"
                                class="w-full pl-11 pr-4 py-3 bg-gray-50 border  rounded-xl 
                                       text-gray-900 placeholder-gray-400 focus:bg-white 
                                       focus:outline-none focus:ring-2 focus:ring-teal-500/20 
                                       focus:border-teal-500 transition-all 
                                       @error('email') border-red-500 ring-red-200 @enderror">
                        </div>
                        @error('email')
                            <p class="mt-1 text-xs text-red-600 flex items-center gap-1">
                                <i class="fas fa-info-circle"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Role / Peran --}}
                    {{-- <div class="gsap-item group">
                        <label for="role" class="block text-sm font-semibold text-gray-700 mb-2">Daftar
                            Sebagai</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i
                                    class="fas fa-user-tag text-gray-400 group-focus-within:text-teal-500 transition-colors"></i>
                            </div>

                            <select id="role" name="role" required
                                class="appearance-none w-full pl-11 pr-10 py-3 bg-gray-50 border  rounded-xl 
                                       text-gray-900 focus:bg-white focus:outline-none focus:ring-2 
                                       focus:ring-teal-500/20 focus:border-teal-500 transition-all cursor-pointer
                                       @error('role') border-red-500 ring-red-200 @enderror">
                                <option value="" disabled selected>Pilih peran Anda</option>
                                <option value="kader" {{ old('role') == 'kader' ? 'selected' : '' }}>Kader Posyandu
                                </option>
                                <option value="pengguna" {{ old('role') == 'pengguna' ? 'selected' : '' }}>Pengguna Umum
                                    (Ibu/Warga)</option>
                            </select>

                            <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                                <i class="fas fa-chevron-down text-gray-400 text-xs"></i>
                            </div>
                        </div>
                        @error('role')
                            <p class="mt-1 text-xs text-red-600 flex items-center gap-1">
                                <i class="fas fa-info-circle"></i> {{ $message }}
                            </p>
                        @enderror
                    </div> --}}

                    {{-- Grid untuk Password --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                        {{-- Password --}}
                        <div class="gsap-item group">
                            <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Kata
                                Sandi</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i
                                        class="fas fa-lock text-gray-400 group-focus-within:text-teal-500 transition-colors"></i>
                                </div>
                                <input id="password" type="password" name="password" required
                                    placeholder="Min. 8 karakter"
                                    class="w-full pl-11 pr-10 py-3 bg-gray-50 border  rounded-xl 
                                           text-gray-900 placeholder-gray-400 focus:bg-white 
                                           focus:outline-none focus:ring-2 focus:ring-teal-500/20 
                                           focus:border-teal-500 transition-all 
                                           @error('password') border-red-500 ring-red-200 @enderror">
                                <button type="button" onclick="toggleInput('password', 'iconPass')"
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none cursor-pointer">
                                    <i class="fas fa-eye" id="iconPass"></i>
                                </button>
                            </div>
                            @error('password')
                                <p class="mt-1 text-xs text-red-600 flex items-center gap-1">
                                    <i class="fas fa-info-circle"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Konfirmasi Password --}}
                        <div class="gsap-item group">
                            <label for="password_confirmation"
                                class="block text-sm font-semibold text-gray-700 mb-2">Ulangi Sandi</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i
                                        class="fas fa-shield-alt text-gray-400 group-focus-within:text-teal-500 transition-colors"></i>
                                </div>
                                <input id="password_confirmation" type="password" name="password_confirmation" required
                                    placeholder="Ulangi sandi"
                                    class="w-full pl-11 pr-10 py-3 bg-gray-50 border  rounded-xl 
                                           text-gray-900 placeholder-gray-400 focus:bg-white 
                                           focus:outline-none focus:ring-2 focus:ring-teal-500/20 
                                           focus:border-teal-500 transition-all 
                                           @error('password_confirmation') border-red-500 ring-red-200 @enderror">
                                <button type="button" onclick="toggleInput('password_confirmation', 'iconConfirm')"
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none cursor-pointer">
                                    <i class="fas fa-eye" id="iconConfirm"></i>
                                </button>
                            </div>
                        </div>

                    </div>

                    {{-- Tombol Daftar --}}
                    <div class="gsap-item pt-4">
                        <button type="submit"
                            class="w-full rounded-xl bg-gradient-to-r from-teal-500 to-emerald-600 
                                   hover:from-teal-600 hover:to-emerald-700 text-white font-bold 
                                   py-3.5 px-4 shadow-lg shadow-teal-500/30 transform 
                                   transition-all hover:-translate-y-0.5 active:scale-95 flex justify-center items-center gap-2">
                            <span>Buat Akun Sekarang</span>
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>

                    {{-- Link ke Login --}}
                    <div class="gsap-item text-center mt-6">
                        <p class="text-sm text-gray-600">
                            Sudah punya akun?
                            <a href="{{ route('login') }}"
                                class="font-bold text-teal-600 hover:text-teal-800 transition-colors">
                                Masuk disini
                            </a>
                        </p>
                    </div>
                </form>
            </div>

            <!-- Sisi Kanan (Gambar) -->
            <div class="hidden lg:flex lg:w-1/2 relative bg-gray-100">
                <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('/img/posyandu.png')">
                </div>
                <div class="absolute inset-0 bg-gradient-to-br from-teal-900/80 to-blue-900/60 mix-blend-multiply">
                </div>
                <div class="absolute bottom-0 left-0 w-full p-12 text-white z-10">
                    <div class="gsap-image-text translate-y-10 opacity-0">
                        <h3 class="text-3xl font-bold mb-2">Bergabunglah Bersama Kami</h3>
                        <p class="text-teal-100 text-lg opacity-90 leading-relaxed">
                            Daftarkan diri Anda untuk akses mudah ke layanan kesehatan dan pemantauan tumbuh kembang
                            anak.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- SCRIPTS --}}
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // GSAP Animations
            const tl = gsap.timeline({
                defaults: {
                    ease: "power3.out"
                }
            });

            tl.to("#register-card", {
                    duration: 1,
                    opacity: 1,
                    y: 0
                })
                .from(".gsap-item", {
                    duration: 0.6,
                    y: 20,
                    opacity: 0,
                    stagger: 0.08
                }, "-=0.5")
                .to(".gsap-image-text", {
                    duration: 0.8,
                    y: 0,
                    opacity: 1
                }, "-=0.5");
        });

        // Function Toggle Password yang bisa dipakai untuk 2 input berbeda
        function toggleInput(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            const show = input.type === 'password';

            input.type = show ? 'text' : 'password';

            if (show) {
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>

    {{-- SweetAlert Logic --}}
    @if (session('success'))
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                Swal.fire({
                    icon: 'success',
                    title: 'Akun Berhasil Dibuat!',
                    text: "{{ session('success') }}",
                    confirmButtonColor: '#10b981',
                    confirmButtonText: 'Lanjut Login',
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                    hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                });
            });
        </script>
    @endif

</x-app>
