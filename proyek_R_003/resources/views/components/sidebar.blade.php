<!-- SIDEBAR -->
<aside id="sidebar"
    class="fixed top-0 left-0 w-64 h-screen bg-posyanduDark text-white transform -translate-x-full md:translate-x-0 transition-transform duration-300 z-51">

    <!-- Header logo -->
    <div class="p-4 border-b border-white">
        <div class="flex items-center space-x-3">
            <img src="{{ asset('img/elsimil.png') }}" alt="logo Sipos" class="w-13 h-13 object-contain">
            <h1 class="text-xl font-bold text-white tracking-wider">SIPOS</h1>
        </div>
        <p class="text-white text-sm tracking-wide">Sistem Informasi Posyandu</p>
    </div>

    <!-- Profil pengguna -->
    <div class="p-4 flex items-center border-b border-white">
        <div class="rounded-full w-12 h-12 bg-posyanduu flex items-center justify-center">
            <span class="font-bold">
                {{ collect(explode(' ', Auth::user()->name))->map(fn($n) => strtoupper($n[0]))->join('') }}
            </span>
        </div>
        <div class="ml-3">
            <p class="font-medium">{{ Auth::user()->name }}</p>
            <p class="text-xs text-gray-300 capitalize">{{ Auth::user()->role }}</p>
        </div>
    </div>

    <!-- Navigasi -->
    <nav class="mt-4">
        @if (Auth::user()->role === 'kader')
            <!-- Menu untuk admin -->
            <a href="{{ url('/dashboard') }}"
                class="flex items-center p-3 border-l-4 
                {{ request()->is('dashboard') ? 'border-white bg-posyanduu text-white' : 'border-transparent text-gray-300 hover:bg-posyanduu hover:text-white' }}">
                <i class="fas fa-home w-5"></i>
                <span class="ml-3">Dashboard</span>
            </a>

            <a href="{{ url('/data') }}"
                class="flex items-center p-3 border-l-4 
                {{ request()->is('data') ? 'border-white bg-posyanduu text-white' : 'border-transparent text-gray-300 hover:bg-posyanduu hover:text-white' }}">
                <i class="fas fa-baby w-5"></i>
                <span class="ml-3">Data Peserta</span>
            </a>

            <a href="{{ url('/pemeriksaan') }}"
                class="flex items-center p-3 border-l-4 
                {{ request()->is('pemeriksaan') ? 'border-white bg-posyanduu text-white' : 'border-transparent text-gray-300 hover:bg-posyanduu hover:text-white' }}">
                <i class="fas fa-stethoscope w-5"></i>
                <span class="ml-3">Pemeriksaan</span>
            </a>

            <a href="{{ url('/laporan') }}"
                class="flex items-center p-3 border-l-4 
                {{ request()->is('laporan') ? 'border-white bg-posyanduu text-white' : 'border-transparent text-gray-300 hover:bg-posyanduu hover:text-white' }}">
                <i class="fas fa-file-alt w-5"></i>
                <span class="ml-3">Ekspor Laporan</span>
            </a>
            <a href="{{ url('/admin/pengguna') }}"
                class="flex items-center p-3 border-l-4 
                {{ request()->is('admin/pengguna') ? 'border-white bg-posyanduu text-white' : 'border-transparent text-gray-300 hover:bg-posyanduu hover:text-white' }}">
                <i class="fas fa-user-plus w-5"></i>
                <span class="ml-3">Manajemen Pengguna</span>
            </a>
            <a href="{{ url('kader/artikel') }}"
                class="flex items-center p-3 border-l-4 
                {{ request()->is('kader/artikel') ? 'border-white bg-posyanduu text-white' : 'border-transparent text-gray-300 hover:bg-posyanduu hover:text-white' }}">
                <i class="fa-solid fa-circle-info"></i>
                <span class="ml-3">Artikel</span>
            </a>
        @else
            <!-- Menu untuk pengguna -->
            <a href="{{ url('/jadwall') }}"
                class="flex items-center p-3 border-l-4 
                {{ request()->is('jadwall') ? 'border-white bg-posyanduu text-white' : 'border-transparent text-gray-300 hover:bg-posyanduu hover:text-white' }}">
                <i class="fa-solid fa-calendar-days"></i>
                <span class="ml-3">Jadwal Posyandu</span>
            </a>
            <a href="{{ url('/riwayat') }}"
                class="flex items-center p-3 border-l-4 
                {{ request()->is('riwayat') ? 'border-white bg-posyanduu text-white' : 'border-transparent text-gray-300 hover:bg-posyanduu hover:text-white' }}">
                <i class="fa-solid fa-chart-line"></i>
                <span class="ml-3">Riwayat Pemeriksaan</span>
            </a>
            <a href="{{ url('artikel') }}"
                class="flex items-center p-3 border-l-4 
                {{ request()->is('artikel') ? 'border-white bg-posyanduu text-white' : 'border-transparent text-gray-300 hover:bg-posyanduu hover:text-white' }}">
                <i class="fa-solid fa-circle-info"></i>
                <span class="ml-3">Artikel</span>
            </a>
        @endif
    </nav>

    <!-- Tombol logout -->
    <div class="absolute bottom-0 w-full p-4 border-t border-white">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="flex items-center w-full text-gray-300 hover:bg-posyanduu hover:text-white rounded p-3">
                <i class="fas fa-sign-out-alt w-5"></i>
                <span class="ml-3">Logout</span>
            </button>
        </form>
    </div>
</aside>

<!-- Overlay -->
<div id="overlay" class="fixed inset-0 bg-transparent bg-opacity-20 hidden z-30"></div>

<!-- HEADER (Tetap muncul untuk semua role) -->
<header class="fixed top-0 z-50 left-0 right-0 bg-gray-100 shadow flex justify-between items-center md:pl-64">
    <!-- Tombol hamburger -->
    <button id="menu-btn" class="md:hidden p-2 text-gray-600 cursor-pointer">
        <i class="fa-solid fa-bars fa-xl"></i>
    </button>

    <!-- Dropdown profil -->
    <div class="flex items-center space-x-2 ml-auto border-b border-white p-2 hover:bg-gray-50 transition rounded-lg">
        <div class="relative">
            <button id="profileDropdownBtn" class="flex items-center gap-2 focus:outline-none">
                <div class="rounded-full w-10 h-10 bg-posyanduu flex items-center justify-center">
                    <span class="font-bold text-white">
                        {{ collect(explode(' ', Auth::user()->name))->map(fn($n) => strtoupper($n[0]))->join('') }}
                    </span>
                </div>

                <div class="flex items-center space-x-1">
                    <svg class="w-4 h-4 text-gray-600 cursor-pointer" fill="none" stroke="currentColor"
                        stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
            </button>

            <!-- Dropdown menu -->
            <div id="profileDropdownMenu"
                class="opacity-0 scale-95 pointer-events-none absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg z-50 transform transition-all duration-200 ease-out">
                <a href="{{ url('/profile') }}"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full text-left block px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>
