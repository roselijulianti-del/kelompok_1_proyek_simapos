<x-app>
    <x-slot:title>Lupa Kata Sandi</x-slot:title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

    <div class="min-h-screen w-full bg-slate-50 flex items-center justify-center p-4 relative overflow-hidden">

        {{-- Background Decorations --}}
        <div class="fixed top-[-10%] left-[-10%] w-96 h-96 bg-blue-100 rounded-full blur-3xl opacity-60 -z-10"></div>
        <div class="fixed bottom-[-10%] right-[-10%] w-96 h-96 bg-teal-100 rounded-full blur-3xl opacity-60 -z-10"></div>

        <div id="forgot-card"
            class="flex w-full max-w-5xl bg-white rounded-3xl shadow-2xl overflow-hidden opacity-0 translate-y-10">

            <div class="w-full lg:w-1/2 p-8 md:p-12 lg:p-16 flex flex-col justify-center">

                {{-- Header --}}
                <div class="gsap-item text-center lg:text-left mb-10">
                    <div
                        class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-teal-100 text-teal-600 mb-4 shadow-sm">
                        <i class="fas fa-key text-2xl"></i>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-800">Lupa Kata Sandi?</h2>
                    <p class="mt-2 text-gray-500">Jangan khawatir. Masukkan email Anda dan kami akan mengirimkan link
                        reset.</p>
                </div>

                {{-- FORM --}}
                <form action="{{ route('password.email') }}" method="POST" class="space-y-6">
                    @csrf

                    {{-- Email --}}
                    <div class="gsap-item group">
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-400 group-focus-within:text-teal-500"></i>
                            </div>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                                autofocus placeholder="nama@email.com"
                                class="w-full pl-11 pr-4 py-3.5 bg-gray-50 border rounded-xl 
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

                    {{-- Tombol Kirim --}}
                    <div class="gsap-item pt-2">
                        <button type="submit"
                            class="w-full rounded-xl bg-gradient-to-r from-teal-500 to-emerald-600 
                                   hover:from-teal-600 hover:to-emerald-700 text-white font-bold 
                                   py-3.5 px-4 shadow-lg shadow-teal-500/30 transform 
                                   transition-all hover:-translate-y-0.5 active:scale-95">
                            <span>Kirim Link Reset</span>
                            <i class="fas fa-paper-plane ml-2"></i>
                        </button>
                    </div>

                    {{-- Link Kembali ke Login --}}
                    <div class="gsap-item text-center mt-6">
                        <a href="{{ route('login') }}"
                            class="inline-flex items-center text-sm font-semibold text-gray-500 hover:text-teal-600 transition-colors">
                            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Login
                        </a>
                    </div>
                </form>
            </div>

            {{-- Sisi Kanan (Gambar - Sama seperti Login agar konsisten) --}}
            <div class="hidden lg:flex lg:w-1/2 relative bg-gray-100">
                <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('/img/posyandu.png')">
                </div>
                <div class="absolute inset-0 bg-gradient-to-br from-teal-900/80 to-blue-900/60 mix-blend-multiply">
                </div>
                <div class="absolute bottom-0 left-0 w-full p-12 text-white z-10">
                    <div class="gsap-image-text translate-y-10 opacity-0">
                        <h3 class="text-3xl font-bold mb-2">Keamanan Data</h3>
                        <p class="text-teal-100 text-lg opacity-90">
                            Kami menjaga keamanan data kesehatan ibu dan anak dengan standar privasi terbaik.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- Script Animasi & Alert --}}
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            gsap.timeline({
                    defaults: {
                        ease: "power3.out"
                    }
                })
                .to("#forgot-card", {
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
    </script>

    @if (session('status') || session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Email Terkirim!',
                text: '{{ session('status') ?? session('success') }}',
                confirmButtonColor: '#10b981'
            });
        </script>
    @endif

    @if (session('error') || $errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '{{ session('error') ?? 'Cek kembali email anda.' }}',
                confirmButtonColor: '#ef4444'
            });
        </script>
    @endif
</x-app>
