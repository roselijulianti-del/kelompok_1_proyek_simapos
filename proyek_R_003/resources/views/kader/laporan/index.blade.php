<x-app-main title="Laporan Data">
    <!-- Load GSAP CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>

    <main x-data="laporanData" class="ml-2 md:ml-2 min-h-screen pb-10">

        <!-- Header Section -->
        <div
            class="gsap-header opacity-0 -translate-y-5 mb-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-2xl font-extrabold text-gray-800 flex items-center gap-3">
                    <span class="bg-red-100 text-red-600 p-2 rounded-lg shadow-sm">
                        <i class="fas fa-file-invoice"></i>
                    </span>
                    Ekspor & Laporan Data
                </h1>
                <p class="text-gray-500 mt-1 text-sm md:text-base ml-1">
                    Cari data peserta, lihat detail, ekspor ke PDF atau cetak laporan.
                </p>
            </div>
            <div class="flex-shrink-0">
                <a href="{{ url()->previous() }}"
                    class="group bg-white border border-gray-200 hover:bg-gray-50 hover:border-gray-300 transition-all duration-300 text-gray-600 px-5 py-2.5 rounded-xl flex items-center shadow-sm hover:shadow-md">
                    <i class="fas fa-arrow-left mr-2 group-hover:-translate-x-1 transition-transform"></i>
                    <span>Kembali</span>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

            <!-- LEFT COLUMN: PENCARIAN (4 Columns) -->
            <div class="lg:col-span-5 space-y-6">
                <div
                    class="gsap-card-left opacity-0 -translate-x-5 bg-white rounded-2xl shadow-xl border border-gray-100 p-6 h-full flex flex-col">
                    <h2 class="text-lg font-bold text-gray-800 mb-4 flex items-center border-b pb-3 border-gray-100">
                        <i class="fas fa-search mr-2 text-posyanduu"></i>
                        Cari Peserta
                    </h2>

                    <div class="mb-4 relative group">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i
                                class="fas fa-search text-gray-400 group-focus-within:text-posyanduu transition-colors"></i>
                        </div>
                        <input type="text" x-model="query" x-on:input.debounce.500ms="search()"
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-posyanduu focus:border-posyanduu transition-all bg-gray-50 focus:bg-white"
                            placeholder="Nama atau NIK..." />
                    </div>

                    <!-- Search Results List -->
                    <div
                        class="flex-1 overflow-y-auto max-h-[500px] pr-1 scrollbar-thin scrollbar-thumb-gray-200 scrollbar-track-transparent space-y-3">

                        <!-- Loading State -->
                        <div x-show="loading" class="text-center py-8 text-gray-400">
                            <i class="fas fa-spinner fa-spin text-2xl mb-2"></i>
                            <p class="text-sm">Sedang mencari data...</p>
                        </div>

                        <!-- Empty State -->
                        <div x-show="!loading && results.length === 0"
                            class="text-center py-8 text-gray-400 border-2 border-dashed border-gray-100 rounded-xl">
                            <i class="fas fa-user-slash text-2xl mb-2 opacity-50"></i>
                            <p class="text-sm" x-text="query ? 'Data tidak ditemukan.' : 'Silakan cari data.'"></p>
                        </div>

                        <!-- Result Items -->
                        <template x-for="item in results" :key="item.tipe + item.id">
                            <div @click="showDetail(item)"
                                class="p-4 rounded-xl cursor-pointer transition-all duration-200 border relative overflow-hidden group hover:shadow-md"
                                :class="{
                                    'bg-blue-50 border-blue-100 hover:border-blue-300': item.tipe === 'balita',
                                    'bg-pink-50 border-pink-100 hover:border-pink-300': item.tipe === 'ibu',
                                    'ring-2 ring-posyanduu ring-offset-1': selected?.id === item.id && selected
                                        ?.tipe === item.tipe
                                }">

                                <div class="flex items-start justify-between">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full flex items-center justify-center text-lg shadow-sm"
                                            :class="item.tipe === 'balita' ? 'bg-white text-blue-500' :
                                                'bg-white text-pink-500'">
                                            <i class="fas"
                                                :class="item.tipe === 'balita' ? 'fa-baby' : 'fa-female'"></i>
                                        </div>
                                        <div>
                                            <h3 class="font-bold text-gray-800 text-sm leading-tight"
                                                x-text="item.nama"></h3>
                                            <p class="text-xs text-gray-500 mt-0.5 flex items-center">
                                                <i class="far fa-id-card mr-1 text-[10px]"></i> <span
                                                    x-text="item.nik"></span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex flex-col items-end">
                                        <span class="text-[10px] font-bold px-2 py-0.5 rounded-full"
                                            :class="item.tipe === 'balita' ? 'bg-blue-200 text-blue-800' :
                                                'bg-pink-200 text-pink-800'"
                                            x-text="item.tipe === 'balita' ? 'Balita' : 'Ibu Hamil'">
                                        </span>
                                    </div>
                                </div>
                                <div class="mt-3 pt-2 border-t border-gray-200/50 flex justify-between items-center">
                                    <span class="text-xs font-medium"
                                        :class="item.status_pemeriksaan === 'Belum terperiksa' ?
                                            'text-red-500 flex items-center gap-1' :
                                            'text-green-600 flex items-center gap-1'">
                                        <i class="fas"
                                            :class="item.status_pemeriksaan === 'Belum terperiksa' ? 'fa-times-circle' :
                                                'fa-check-circle'"></i>
                                        <span x-text="item.status_pemeriksaan"></span>
                                    </span>
                                    <i
                                        class="fas fa-chevron-right text-gray-300 text-xs group-hover:translate-x-1 transition-transform"></i>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>

            <!-- RIGHT COLUMN: DETAIL & ACTION (8 Columns) -->
            <div class="lg:col-span-7 space-y-6">

                <!-- Card Detail -->
                <div
                    class="gsap-card-right opacity-0 translate-x-5 bg-white rounded-2xl shadow-xl border border-gray-100 p-6 min-h-[400px] relative overflow-hidden">

                    <!-- Decoration Background -->
                    <div
                        class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-bl from-gray-50 to-transparent rounded-bl-full pointer-events-none opacity-50">
                    </div>

                    <h2
                        class="text-lg font-bold text-gray-800 mb-6 flex items-center border-b pb-3 border-gray-100 relative z-10">
                        <i class="fas fa-file-medical-alt mr-2 text-posyanduu"></i>
                        Detail Informasi
                    </h2>

                    <!-- State: Belum Pilih Data -->
                    <div x-show="!selected" x-transition.opacity
                        class="flex flex-col items-center justify-center h-[300px] text-gray-400">
                        <div
                            class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mb-4 shadow-inner">
                            <i class="fas fa-folder-open text-3xl opacity-30"></i>
                        </div>
                        <p class="text-lg font-medium text-gray-600">Belum ada data dipilih</p>
                        <p class="text-sm text-gray-400 mt-1">Pilih peserta dari daftar di sebelah kiri untuk melihat
                            detail.</p>
                    </div>

                    <!-- State: Data Terpilih -->
                    <div x-show="selected && detail" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 translate-y-4"
                        x-transition:enter-end="opacity-100 translate-y-0" class="relative z-10 space-y-6">

                        <!-- Informasi Utama -->
                        <div class="bg-gray-50/80 backdrop-blur-sm rounded-xl p-5 border border-gray-200">
                            <h3 class="font-bold text-gray-800 mb-4 flex items-center text-sm uppercase tracking-wide">
                                <i class="fas fa-user-circle mr-2 text-gray-500"></i> Identitas Diri
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-8 text-sm">
                                <div>
                                    <p class="text-gray-500 text-xs mb-1">Nama Lengkap</p>
                                    <p class="font-bold text-gray-800 text-lg" x-text="detail?.nama"></p>
                                </div>
                                <div>
                                    <p class="text-gray-500 text-xs mb-1">Nomor Induk Kependudukan (NIK)</p>
                                    <p class="font-mono font-medium text-gray-800 bg-white px-2 py-1 rounded border border-gray-200 inline-block"
                                        x-text="detail?.nik"></p>
                                </div>

                                <template x-if="selected?.tipe === 'balita'">
                                    <div class="contents">
                                        <div>
                                            <p class="text-gray-500 text-xs mb-1">Jenis Kelamin</p>
                                            <p class="font-medium text-gray-800" x-text="detail?.jenis_kelamin"></p>
                                        </div>
                                        <div>
                                            <p class="text-gray-500 text-xs mb-1">Tanggal Lahir</p>
                                            <p class="font-medium text-gray-800 flex items-center">
                                                <i class="fas fa-birthday-cake text-pink-400 mr-2"></i>
                                                <span x-text="detail?.tanggal_lahir"></span>
                                            </p>
                                        </div>
                                    </div>
                                </template>

                                <template x-if="selected?.tipe === 'ibu'">
                                    <div class="contents">
                                        <div>
                                            <p class="text-gray-500 text-xs mb-1">Nama Suami</p>
                                            <p class="font-medium text-gray-800" x-text="detail?.nama_suami"></p>
                                        </div>
                                        <div>
                                            <p class="text-gray-500 text-xs mb-1">Umur</p>
                                            <p class="font-medium text-gray-800" x-text="detail?.umur + ' Tahun'"></p>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>

                        <!-- Pemeriksaan Terakhir -->
                        <div x-show="pemeriksaan" class="bg-blue-50/50 rounded-xl p-5 border border-blue-100">
                            <h3 class="font-bold text-blue-800 mb-4 flex items-center text-sm uppercase tracking-wide">
                                <i class="fas fa-stethoscope mr-2"></i> Pemeriksaan Terakhir
                            </h3>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                                <div class="bg-white p-3 rounded-lg shadow-sm border border-blue-100">
                                    <p class="text-gray-500 text-xs mb-1">Tanggal</p>
                                    <p class="font-bold text-gray-800" x-text="pemeriksaan?.tanggal"></p>
                                </div>
                                <div class="bg-white p-3 rounded-lg shadow-sm border border-blue-100">
                                    <p class="text-gray-500 text-xs mb-1">Berat Badan</p>
                                    <p class="font-bold text-gray-800"
                                        x-text="(pemeriksaan?.berat_badan || '-') + ' kg'"></p>
                                </div>

                                <template x-if="selected?.tipe === 'balita'">
                                    <div class="contents">
                                        <div class="bg-white p-3 rounded-lg shadow-sm border border-blue-100">
                                            <p class="text-gray-500 text-xs mb-1">Tinggi Badan</p>
                                            <p class="font-bold text-gray-800"
                                                x-text="(pemeriksaan?.tinggi_badan || '-') + ' cm'"></p>
                                        </div>
                                        <div class="bg-white p-3 rounded-lg shadow-sm border border-blue-100">
                                            <p class="text-gray-500 text-xs mb-1">Status Gizi</p>
                                            <span class="px-2 py-1 rounded text-xs font-bold"
                                                :class="{
                                                    'bg-green-100 text-green-700': pemeriksaan
                                                        ?.status_gizi === 'Gizi Baik',
                                                    'bg-orange-100 text-orange-700': pemeriksaan
                                                        ?.status_gizi === 'Gizi Buruk',
                                                    'bg-red-100 text-red-700': pemeriksaan?.status_gizi === 'Stunting'
                                                }"
                                                x-text="pemeriksaan?.status_gizi || '-'">
                                            </span>
                                        </div>
                                    </div>
                                </template>

                                <template x-if="selected?.tipe === 'ibu'">
                                    <div class="contents">
                                        <div class="bg-white p-3 rounded-lg shadow-sm border border-blue-100">
                                            <p class="text-gray-500 text-xs mb-1">Tensi Darah</p>
                                            <p class="font-bold text-gray-800"
                                                x-text="pemeriksaan?.tekanan_darah || '-'"></p>
                                        </div>
                                        <div class="bg-white p-3 rounded-lg shadow-sm border border-blue-100">
                                            <p class="text-gray-500 text-xs mb-1">Status</p>
                                            <span class="px-2 py-1 rounded text-xs font-bold"
                                                :class="{
                                                    'bg-green-100 text-green-700': pemeriksaan
                                                        ?.status_ibu === 'Kondisi Baik',
                                                    'bg-red-100 text-red-700': pemeriksaan?.status_ibu === 'Anemia'
                                                }"
                                                x-text="pemeriksaan?.status_ibu || '-'">
                                            </span>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>

                        <div x-show="!pemeriksaan"
                            class="bg-yellow-50 border border-yellow-200 rounded-xl p-4 text-center text-yellow-700 text-sm">
                            <i class="fas fa-exclamation-triangle mr-2"></i> Belum ada data pemeriksaan terbaru untuk
                            peserta ini.
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div
                    class="gsap-actions opacity-0 translate-y-5 bg-white rounded-2xl shadow-xl border border-gray-100 p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <button @click="exportPdf" :disabled="!selected"
                            class="group relative flex items-center justify-center py-4 px-6 rounded-xl font-bold text-white transition-all bg-red-500 hover:bg-red-600 shadow-lg hover:shadow-red-500/30 disabled:opacity-50 disabled:cursor-not-allowed disabled:shadow-none overflow-hidden">
                            <div
                                class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:animate-shimmer">
                            </div>
                            <i class="fas fa-file-pdf text-xl mr-3"></i>
                            <span>Unduh Laporan PDF</span>
                        </button>

                        <button @click="printData" :disabled="!selected"
                            class="group flex items-center justify-center py-4 px-6 rounded-xl font-bold text-white transition-all bg-emerald-500 hover:bg-emerald-600 shadow-lg hover:shadow-emerald-500/30 disabled:opacity-50 disabled:cursor-not-allowed disabled:shadow-none">
                            <i class="fas fa-print text-xl mr-3"></i>
                            <span>Cetak Data</span>
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <!-- Logic Script -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('laporanData', () => ({
                query: '',
                results: [],
                selected: null,
                detail: null,
                pemeriksaan: null,
                loading: false,

                // Animasi GSAP saat load
                init() {
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
                        .to(".gsap-card-left", {
                            x: 0,
                            opacity: 1,
                            duration: 0.6
                        }, "-=0.4")
                        .to(".gsap-card-right", {
                            x: 0,
                            opacity: 1,
                            duration: 0.6
                        }, "-=0.4")
                        .to(".gsap-actions", {
                            y: 0,
                            opacity: 1,
                            duration: 0.6
                        }, "-=0.4");
                },

                async search() {
                    if (!this.query.trim()) {
                        this.results = [];
                        return;
                    }
                    this.loading = true;
                    try {
                        const res = await fetch(
                            `/laporan/search?q=${encodeURIComponent(this.query)}`);
                        const data = await res.json();
                        this.results = [
                            ...(data.balita || []).map(b => ({
                                ...b,
                                tipe: 'balita'
                            })),
                            ...(data.ibu || []).map(i => ({
                                ...i,
                                tipe: 'ibu'
                            }))
                        ];
                    } catch (error) {
                        console.error("Search error:", error);
                        this.results = [];
                    } finally {
                        this.loading = false;
                    }
                },

                async showDetail(item) {
                    if (this.selected?.id === item.id && this.selected?.tipe === item.tipe) return;
                    this.selected = item;
                    this.detail = null;
                    this.pemeriksaan = null;

                    try {
                        const res = await fetch(`/laporan/${item.tipe}/${item.id}`);
                        const data = await res.json();
                        this.detail = data.data;
                        this.pemeriksaan = data.pemeriksaan;
                    } catch (error) {
                        console.error("Fetch detail error:", error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Gagal mengambil detail data.'
                        });
                    }
                },

                exportPdf() {
                    if (!this.selected) return;
                    const url = `/laporan/pdf/${this.selected.tipe}/${this.selected.id}`;
                    window.open(url, '_blank');
                },

                printData() {
                    if (!this.selected) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Pilih Data',
                            text: 'Silakan pilih data peserta terlebih dahulu.'
                        });
                        return;
                    }

                    // Style CSS untuk Cetak (Sederhana & Bersih)
                    const cssStyles = `
                        <style>
                            @media print { @page { size: A4; margin: 2cm; } }
                            body { font-family: sans-serif; color: #333; line-height: 1.5; }
                            .header { text-align: center; border-bottom: 2px solid #ddd; padding-bottom: 20px; margin-bottom: 30px; }
                            .header h1 { color: #2c3e50; margin: 0; font-size: 24px; }
                            .header p { color: #7f8c8d; margin: 5px 0 0; font-size: 14px; }
                            .section { margin-bottom: 25px; }
                            .section h2 { font-size: 16px; background: #f8f9fa; padding: 10px; border-left: 5px solid #3498db; margin-bottom: 15px; color: #2c3e50; }
                            table { width: 100%; border-collapse: collapse; font-size: 14px; }
                            table th, table td { padding: 12px 15px; border-bottom: 1px solid #eee; text-align: left; }
                            table th { width: 40%; font-weight: 600; color: #7f8c8d; background-color: #fff; }
                            table td { font-weight: 500; color: #2c3e50; }
                            .status-box { display: inline-block; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: bold; }
                            .footer { margin-top: 50px; text-align: right; font-size: 12px; color: #95a5a6; border-top: 1px solid #eee; padding-top: 10px; }
                        </style>
                    `;

                    // Generate HTML Content
                    let contentHtml = `
                        <div class="header">
                            <h1>Laporan Data Posyandu</h1>
                            <p>Data Peserta: ${this.selected.tipe === 'balita' ? 'Balita' : 'Ibu Hamil'}</p>
                        </div>
                    `;

                    // Data Diri
                    contentHtml += `<div class="section"><h2>Identitas Diri</h2><table>`;
                    contentHtml += `<tr><th>Nama Lengkap</th><td>${this.detail.nama || '-'}</td></tr>`;
                    contentHtml += `<tr><th>NIK</th><td>${this.detail.nik || '-'}</td></tr>`;

                    if (this.selected.tipe === 'balita') {
                        contentHtml +=
                            `<tr><th>Jenis Kelamin</th><td>${this.detail.jenis_kelamin || '-'}</td></tr>`;
                        contentHtml +=
                            `<tr><th>Tanggal Lahir</th><td>${this.detail.tanggal_lahir || '-'}</td></tr>`;
                    } else {
                        contentHtml +=
                            `<tr><th>Nama Suami</th><td>${this.detail.nama_suami || '-'}</td></tr>`;
                        contentHtml +=
                            `<tr><th>Umur</th><td>${this.detail.umur ? this.detail.umur + ' Tahun' : '-'}</td></tr>`;
                    }
                    contentHtml += `</table></div>`;

                    // Pemeriksaan
                    contentHtml += `<div class="section"><h2>Pemeriksaan Terakhir</h2>`;
                    if (this.pemeriksaan) {
                        contentHtml += `<table>`;
                        contentHtml +=
                            `<tr><th>Tanggal Pemeriksaan</th><td>${this.pemeriksaan.tanggal || '-'}</td></tr>`;
                        contentHtml +=
                            `<tr><th>Berat Badan</th><td>${this.pemeriksaan.berat_badan ? this.pemeriksaan.berat_badan + ' kg' : '-'}</td></tr>`;

                        if (this.selected.tipe === 'balita') {
                            contentHtml +=
                                `<tr><th>Tinggi Badan</th><td>${this.pemeriksaan.tinggi_badan ? this.pemeriksaan.tinggi_badan + ' cm' : '-'}</td></tr>`;
                            contentHtml +=
                                `<tr><th>Status Gizi</th><td><strong>${this.pemeriksaan.status_gizi || '-'}</strong></td></tr>`;
                        } else {
                            contentHtml +=
                                `<tr><th>Tekanan Darah</th><td>${this.pemeriksaan.tekanan_darah || '-'}</td></tr>`;
                            contentHtml +=
                                `<tr><th>Status Kesehatan</th><td><strong>${this.pemeriksaan.status_ibu || '-'}</strong></td></tr>`;
                        }
                        contentHtml += `</table>`;
                    } else {
                        contentHtml +=
                            `<p style="text-align:center; color:#999; font-style:italic;">Belum ada data pemeriksaan.</p>`;
                    }
                    contentHtml += `</div>`;

                    contentHtml +=
                        `<div class="footer">Dicetak pada: ${new Date().toLocaleString('id-ID')}</div>`;

                    // Print Window
                    const printWindow = window.open('', '_blank', 'width=800,height=600');
                    printWindow.document.write(
                        `<html><head><title>Cetak Laporan</title>${cssStyles}</head><body>${contentHtml}</body></html>`
                    );
                    printWindow.document.close();
                    printWindow.focus();
                    printWindow.onload = function() {
                        printWindow.print();
                        printWindow.close();
                    };
                }
            }));
        });
    </script>
</x-app-main>
