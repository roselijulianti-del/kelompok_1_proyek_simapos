<x-app>
    <x-slot:title>{{ $title }}</x-slot:title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- GSAP --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

    <div class="min-h-screen w-full bg-slate-50 flex items-center justify-center p-4 relative overflow-hidden">

        {{-- Background Decorations --}}
        <div class="fixed top-[-10%] left-[-10%] w-96 h-96 bg-blue-100 rounded-full blur-3xl opacity-60 -z-10"></div>
        <div class="fixed bottom-[-10%] right-[-10%] w-96 h-96 bg-teal-100 rounded-full blur-3xl opacity-60 -z-10"></div>

        <div id="login-card"
            class="flex w-full max-w-5xl bg-white rounded-3xl shadow-2xl overflow-hidden opacity-0 translate-y-10">

            <!-- Sisi Kiri -->
            <div class="w-full lg:w-1/2 p-8 md:p-12 lg:p-16 flex flex-col justify-center">

                {{-- Header --}}
                <div class="gsap-item text-center lg:text-left mb-10">
                    <div
                        class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-teal-100 text-teal-600 mb-4 shadow-sm">
                        <i class="fas fa-heart-pulse text-2xl"></i>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-800">Selamat Datang</h2>
                    <p class="mt-2 text-gray-500">Silakan masuk untuk mengelola data Posyandu.</p>
                </div>

                {{-- FORM LOGIN --}}
                <form action="{{ route('login') }}" method="POST" class="space-y-6">
                    @csrf

                    {{-- Email --}}
                    <div class="gsap-item group">
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-400 group-focus-within:text-teal-500"></i>
                            </div>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                                autocomplete="email" placeholder="nama@email.com"
                                class="w-full pl-11 pr-4 py-3.5 bg-gray-50 border  rounded-xl 
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

                    {{-- Password --}}
                    <div class="gsap-item group">
                        <div class="flex items-center justify-between mb-2">
                            <label for="password" class="block text-sm font-semibold text-gray-700">Kata Sandi</label>
                            <a href="{{ route('password.request') }}"
                                class="text-xs font-semibold text-teal-600 hover:text-teal-800">Lupa kata sandi?</a>
                        </div>

                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400 group-focus-within:text-teal-500"></i>
                            </div>

                            <input id="password" type="password" name="password" required placeholder="••••••••"
                                class="w-full pl-11 pr-11 py-3.5 bg-gray-50 border  rounded-xl 
                                       text-gray-900 placeholder-gray-400 focus:bg-white 
                                       focus:outline-none focus:ring-2 focus:ring-teal-500/20 
                                       focus:border-teal-500 transition-all 
                                       @error('password') border-red-500 ring-red-200 @enderror">

                            {{-- Toggle Password --}}
                            <button type="button" onclick="togglePassword()"
                                class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-gray-600">
                                <i class="fas fa-eye" id="eyeIcon"></i>
                            </button>
                        </div>

                        @error('password')
                            <p class="mt-1 text-xs text-red-600 flex items-center gap-1">
                                <i class="fas fa-info-circle"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Tombol Login --}}
                    <div class="gsap-item pt-2">
                        <button type="submit"
                            class="w-full rounded-xl bg-gradient-to-r from-teal-500 to-emerald-600 
                                   hover:from-teal-600 hover:to-emerald-700 text-white font-bold 
                                   py-3.5 px-4 shadow-lg shadow-teal-500/30 transform 
                                   transition-all hover:-translate-y-0.5 active:scale-95">
                            <span>Masuk Sekarang</span>
                            <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </div>

                    {{-- Link Register --}}
                    <div class="gsap-item text-center mt-6">
                        <p class="text-sm text-gray-600">
                            Belum punya akun?
                            <a href="{{ route('register') }}" class="font-bold text-teal-600 hover:text-teal-800">
                                Daftar disini
                            </a>
                        </p>
                    </div>
                </form>
            </div>

            {{-- Sisi Kanan --}}
            <div class="hidden lg:flex lg:w-1/2 relative bg-gray-100">
                <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('/img/posyandu.png')">
                </div>
                <div class="absolute inset-0 bg-gradient-to-br from-teal-900/80 to-blue-900/60 mix-blend-multiply">
                </div>
                <div class="absolute bottom-0 left-0 w-full p-12 text-white z-10">
                    <div class="gsap-image-text translate-y-10 opacity-0">
                        <h3 class="text-3xl font-bold mb-2">Sistem Informasi Posyandu</h3>
                        <p class="text-teal-100 text-lg opacity-90">
                            Memudahkan pemantauan kesehatan ibu dan anak serta pengelolaan jadwal kegiatan secara
                            digital.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- GSAP --}}
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            gsap.timeline({
                    defaults: {
                        ease: "power3.out"
                    }
                })
                .to("#login-card", {
                    duration: 1,
                    opacity: 1,
                    y: 0
                })
                .from(".gsap-item", {
                    duration: .6,
                    y: 20,
                    opacity: 0,
                    stagger: .1
                }, "-=.5")
                .to(".gsap-image-text", {
                    duration: .8,
                    y: 0,
                    opacity: 1
                }, "-=.5");
        });

        function togglePassword() {
            const input = document.getElementById('password');
            const icon = document.getElementById('eyeIcon');
            const show = input.type === 'password';
            input.type = show ? 'text' : 'password';
            icon.classList.toggle('fa-eye', !show);
            icon.classList.toggle('fa-eye-slash', show);
        }
    </script>

    {{-- SweetAlert --}}
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#10b981',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan!',
                text: '{{ session('error') }}',
                confirmButtonColor: '#ef4444',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            });
        </script>
    @endif

</x-app>
