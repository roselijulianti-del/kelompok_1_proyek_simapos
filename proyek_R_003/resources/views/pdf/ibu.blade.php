<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Laporan Data Ibu Hamil - {{ $data->nama_ibu_hamil }}</title>
    <style>
        @page {
            size: A4 portrait;
            margin: 0cm 0cm;
        }

        body {
            margin-top: 3cm;
            margin-left: 2cm;
            margin-right: 2cm;
            margin-bottom: 2cm;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #333;
            line-height: 1.5;
            font-size: 13px;
            background-color: #fff;
        }

        /* Elemen Dekoratif Header */
        .header-bg {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 10px;
            background-color: #0d9488;
            /* Teal-600 Tailwind */
        }

        header {
            position: fixed;
            top: 0.8cm;
            left: 2cm;
            right: 2cm;
            height: 2cm;
            border-bottom: 2px solid #0d9488;
            padding-bottom: 10px;
        }

        .header-content {
            width: 100%;
        }

        .logo-placeholder {
            width: 60px;
            height: 60px;
            float: left;
            margin-right: 15px;
            text-align: center;
            line-height: 60px;
        }

        .company-details h1 {
            margin: 0;
            font-size: 20px;
            text-transform: uppercase;
            color: #0d9488;
            letter-spacing: 1px;
        }

        .company-details p {
            margin: 2px 0;
            font-size: 11px;
            color: #666;
        }

        /* Judul Dokumen */
        .doc-title {
            text-align: center;
            margin-top: 10px;
            margin-bottom: 30px;
        }

        .doc-title h2 {
            font-size: 18px;
            font-weight: 700;
            text-decoration: underline;
            margin: 0;
        }

        .doc-title span {
            font-size: 12px;
            color: #666;
        }

        /* Styling Section */
        .section-header {
            background-color: #f0fdfa;
            /* Teal-50 */
            padding: 8px 15px;
            border-left: 5px solid #0d9488;
            margin-bottom: 15px;
            margin-top: 25px;
        }

        .section-header h3 {
            margin: 0;
            font-size: 14px;
            color: #134e4a;
            text-transform: uppercase;
        }

        /* Tabel Professional */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        td {
            padding: 8px 5px;
            vertical-align: top;
            border-bottom: 1px solid #eee;
        }

        tr:last-child td {
            border-bottom: none;
        }

        .label-col {
            width: 35%;
            font-weight: 600;
            color: #555;
        }

        .value-col {
            width: 65%;
            color: #000;
            font-weight: 500;
        }

        /* Status Badge */
        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
            background-color: #e6fffa;
            color: #0d9488;
            border: 1px solid #0d9488;
        }

        .no-data {
            padding: 20px;
            text-align: center;
            background: #f9fafb;
            color: #6b7280;
            border: 1px dashed #d1d5db;
            border-radius: 6px;
        }

        /* Footer */
        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 1cm;
            background-color: #f3f4f6;
            text-align: center;
            line-height: 1cm;
            font-size: 10px;
            color: #9ca3af;
            border-top: 1px solid #e5e7eb;
        }

        .signature-section {
            page-break-inside: avoid;
            margin-top: 50px;
            text-align: right;
        }

        .signature-box {
            display: inline-block;
            width: 200px;
            text-align: center;
        }

        .signature-name {
            margin-top: 60px;
            font-weight: bold;
            border-bottom: 1px solid #333;
            display: inline-block;
            min-width: 150px;
        }
    </style>
</head>

<body>

    <header>
        <div class="header-content">
            <div class="logo-placeholder">
                <img src="img/elsimil.png" class="logo-image" height="60" width="60" alt="Logo">
            </div>
            <div class="company-details">
                <h1>POSYANDU MAWAR 01</h1>
                <p>Jalan Raya Lohbener No. 123, Indramayu, Jawa Barat</p>
                <p>Email: info@posyandu.id | Telp: (0234) 123456</p>
            </div>
        </div>
    </header>

    <div class="doc-title">
        <h2>LAPORAN DATA IBU HAMIL</h2>
        <span>Dicetak pada: {{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}</span>
    </div>

    <div class="section-header">
        <h3>A. Informasi Data Diri</h3>
    </div>

    <table>
        <tr>
            <td class="label-col">Nama Lengkap</td>
            <td class="value-col">: {{ $data->nama_ibu_hamil ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label-col">NIK</td>
            <td class="value-col">: {{ $data->nik_ibu_hamil ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label-col">Nama Suami</td>
            <td class="value-col">: {{ $data->nama_suami ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label-col">Usia Saat Ini</td>
            <td class="value-col">: {{ $data->umur ? $data->umur . ' Tahun' : '-' }}</td>
        </tr>
        <tr>
            <td class="label-col">Alamat Domisili</td>
            <td class="value-col">: {{ $data->alamat_ibu_hamil ?? '-' }}</td>
        </tr>
    </table>

    <div class="section-header">
        <h3>B. Pemeriksaan Terakhir</h3>
    </div>

    @if ($pemeriksaan)
        <table>
            <tr>
                <td class="label-col">Tanggal Pemeriksaan</td>
                <td class="value-col">: {{ \Carbon\Carbon::parse($pemeriksaan->tanggal)->isoFormat('dddd, D MMMM Y') }}
                </td>
            </tr>
            <tr>
                <td class="label-col">Usia Kehamilan</td>
                <td class="value-col">:
                    {{ $pemeriksaan->usia_kehamilan ? $pemeriksaan->usia_kehamilan . ' Minggu' : '-' }}</td>
            </tr>
            <tr>
                <td class="label-col">Berat Badan Ibu</td>
                <td class="value-col">:
                    {{ $pemeriksaan->berat_badan_ibu ? $pemeriksaan->berat_badan_ibu . ' kg' : '-' }}</td>
            </tr>
            <tr>
                <td class="label-col">Tekanan Darah</td>
                <td class="value-col">
                    :
                    {{ $pemeriksaan->tekanan_sistolik && $pemeriksaan->tekanan_diastolik
                        ? $pemeriksaan->tekanan_sistolik . '/' . $pemeriksaan->tekanan_diastolik . ' mmHg'
                        : '-' }}
                </td>
            </tr>
            <tr>
                <td class="label-col">Lingkar Lengan (LILA)</td>
                <td class="value-col">: {{ $pemeriksaan->lingkar_lengan ? $pemeriksaan->lingkar_lengan . ' cm' : '-' }}
                </td>
            </tr>
            <tr>
                <td class="label-col">Status Kesehatan</td>
                <td class="value-col">
                    <span class="status-badge">{{ strtoupper($pemeriksaan->status_ibu ?? '-') }}</span>
                </td>
            </tr>
            {{-- <tr>
                <td class="label-col">Catatan</td>
                <td class="value-col" style="font-style: italic;">
                    : {{ $pemeriksaan->catatan ?? '-' }}
                </td>
            </tr> --}}
        </table>
    @else
        <div class="no-data">
            <strong>Belum ada data pemeriksaan terbaru.</strong><br>
            Silakan lakukan pemeriksaan di jadwal Posyandu berikutnya.
        </div>
    @endif

    <div class="signature-section">
        <div class="signature-box">
            <p>Lohbener, {{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}</p>
            <p>Petugas Posyandu,</p>

            <div class="signature-name">
                {{ strtoupper($petugas->name ?? 'Petugas Posyandu') }}
            </div>
        </div>
    </div>

    <footer>
        Dokumen ini digenerate secara otomatis oleh Sistem Informasi Posyandu.
    </footer>

</body>

</html>
