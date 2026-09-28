<x-app-main title="Data Pengguna">
    <main class="ml-2 md:ml-2">

        <!-- Header -->
        <div id="headerFade" class="mb-6 flex flex-col md:flex-row md:justify-between md:items-center gap-3 opacity-0">
            <div>
                <h1 class="text-lg md:text-2xl font-bold text-gray-800 flex items-center gap-2">
                    <i class="fas fa-users text-posyanduu"></i>
                    Data Pengguna
                </h1>
                <p class="text-gray-600 text-xs md:text-sm">
                    Daftar seluruh pengguna yang terdaftar dalam sistem
                </p>
            </div>

            <div class="flex justify-start md:justify-end">
                <a href="{{ route('admin.pengguna.create') }}"
                    class="bg-button hover:bg-buttonhover transition-colors duration-200
                    text-white text-xs md:text-base px-3 py-2 md:px-4 md:py-2 rounded-lg flex items-center gap-2">
                    <i class="fas fa-user-plus"></i> Tambah Pengguna
                </a>
            </div>
        </div>

        <!-- Alert -->
        @if (session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses!',
                    text: '{{ session('success') }}',
                    confirmButtonColor: '#70b2b2',
                });
            </script>
        @endif

        <!-- Card -->
        <div id="cardFade" class="bg-white rounded-xl p-4 md:p-6 shadow-md opacity-0 translate-y-3">
            <div class="overflow-x-auto rounded-xl border border-gray-200 shadow-sm">

                <table class="w-full text-sm">
                    <thead class="bg-gray-50">
                        <tr class="text-left border-b text-gray-600 bg-posyanduu">
                            <th class="py-3 px-3 whitespace-nowrap text-xs">
                                <i class="fas fa-user mr-1 text-gray-600"></i> Nama
                            </th>
                            <th class="py-3 px-3 whitespace-nowrap text-xs">
                                <i class="fas fa-envelope mr-1 text-gray-600"></i> Email
                            </th>
                            <th class="py-3 px-3 whitespace-nowrap text-xs">
                                <i class="fas fa-baby mr-1 text-gray-600"></i> Jumlah Balita
                            </th>
                            <th class="py-3 px-3 whitespace-nowrap text-xs">
                                <i class="fas fa-female mr-1 text-gray-600"></i> Jumlah Ibu Hamil
                            </th>
                            <th class="py-3 px-3 whitespace-nowrap text-xs text-center">
                                <i class="fas fa-cog mr-1 text-gray-600"></i> Aksi
                            </th>
                        </tr>
                    </thead>

                    <tbody id="rowContainer" class="divide-y text-gray-800">
                        @forelse ($penggunas as $user)
                            <tr class="hover:bg-gray-50 opacity-0 tableRow">
                                <td class="py-3 px-3 whitespace-nowrap">{{ $user->name }}</td>
                                <td class="py-3 px-3 whitespace-nowrap">{{ $user->email }}</td>
                                <td class="py-3 px-3 whitespace-nowrap">{{ $user->balitas_count }}</td>
                                <td class="py-3 px-3 whitespace-nowrap">{{ $user->ibu_hamils_count }}</td>

                                <td class="py-3 px-3 whitespace-nowrap text-center">
                                    <div class="flex items-center justify-center space-x-3">

                                        <!-- Edit -->
                                        <a href="{{ route('users.edit', $user->id) }}"
                                            class="text-yellow-500 hover:text-yellow-600 transition transform hover:scale-110">
                                            <i class="fas fa-edit text-sm"></i>
                                        </a>

                                        <!-- Delete -->
                                        <form method="POST" action="{{ route('admin.pengguna.destroy', $user->id) }}"
                                            class="delete-button inline-block transform hover:scale-110 transition">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="text-red-500 hover:text-red-600">
                                                <i class="fas fa-trash text-sm"></i>
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-6 text-center text-gray-500 text-sm">
                                    Belum ada pengguna terdaftar
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>

            <!-- Pagination -->
            <div class="mt-6 flex flex-col md:flex-row justify-between items-center">
                <p class="text-sm text-gray-600 mb-4 md:mb-0">
                    Menampilkan {{ $penggunas->lastItem() ?? 0 }} dari {{ $penggunas->total() }} pengguna
                </p>

                <div class="flex space-x-2">
                    {{ $penggunas->links('pagination::tailwind') }}
                </div>
            </div>

        </div>

    </main>
</x-app-main>

<!-- GSAP -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', () => {

        // Fade in header
        gsap.to("#headerFade", {
            opacity: 1,
            y: 0,
            duration: 0.8,
            ease: "power2.out"
        });

        // Fade in card
        gsap.to("#cardFade", {
            opacity: 1,
            y: 0,
            duration: 0.8,
            ease: "power2.out",
            delay: 0.2
        });

        // Animate table rows
        gsap.to(".tableRow", {
            opacity: 1,
            y: 0,
            duration: 0.5,
            stagger: 0.1,
            ease: "power2.out",
            delay: 0.35
        });

        // SweetAlert Delete
        const deleteButtons = document.querySelectorAll('.delete-button');

        deleteButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();
                const form = e.target.closest('form');

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: 'Pengguna akan dihapus permanen!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#70b2b2',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) form.submit();
                });
            });
        });
    });
</script>
