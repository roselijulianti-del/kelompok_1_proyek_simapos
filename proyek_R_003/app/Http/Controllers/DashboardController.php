<?php

namespace App\Http\Controllers;

use App\Models\Balita;

use App\Models\IbuHamil;
use App\Models\Pemeriksaan;
use App\Models\JadwalPosyandu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    // Dashboard untuk Kader
    public function kader()
    {
        // Cek driver database
        $driver = DB::connection()->getDriverName();

        // Format bulan untuk SQLite dan MySQL
        $monthFormat = $driver === 'sqlite'
            ? "strftime('%m', tanggal)"
            : "MONTH(tanggal)";

        $monthFormatCreatedAt = $driver === 'sqlite'
            ? "strftime('%m', created_at)"
            : "MONTH(created_at)";

        // Grafik Pemeriksaan per Bulan
        $pemeriksaanBulanan = Pemeriksaan::selectRaw("$monthFormat as bulan, COUNT(*) as total")
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        // Grafik Registrasi Balita per Bulan
        $balitaBulanan = Balita::selectRaw("$monthFormatCreatedAt as bulan, COUNT(*) as total")
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        // Grafik Registrasi Ibu Hamil per Bulan
        $ibuHamilBulanan = IbuHamil::selectRaw("$monthFormatCreatedAt as bulan, COUNT(*) as total")
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        // Statistik Kehadiran
        $totalHadir = Pemeriksaan::count();

        $totalTerdaftar = Balita::count() + IbuHamil::count();

        $totalTidakHadir = max($totalTerdaftar - $totalHadir, 0);

        return view("kader.dashboard", [
            "title" => "Dashboard Kader",
            "user" => Auth::user(),

            // Total Data
            "totalBalita" => Balita::count(),
            "totalIbuHamil" => IbuHamil::count(),

            // Statistik Gizi Balita
            "totalGiziBaik" => Pemeriksaan::where("status_gizi", "Gizi Baik")->count(),
            "totalGiziBuruk" => Pemeriksaan::where("status_gizi", "Gizi Buruk")->count(),
            "totalStunting" => Pemeriksaan::where("status_gizi", "Stunting")->count(),

            // Statistik Ibu Hamil
            "totalKondisiBaik" => Pemeriksaan::where("status_ibu", "Kondisi Baik")->count(),
            "totalKondisiAnemia" => Pemeriksaan::where("status_ibu", "Anemia")->count(),

            // Grafik Pemeriksaan per Bulan
            "pemeriksaanBulanan" => $pemeriksaanBulanan,

            // Grafik Registrasi
            "balitaBulanan" => $balitaBulanan,
            "ibuHamilBulanan" => $ibuHamilBulanan,

            // Kehadiran
            "totalHadir" => $totalHadir,
            "totalTidakHadir" => $totalTidakHadir,

            // Jadwal
            "jadwals" => JadwalPosyandu::all(),
        ]);
    }

    public function pengguna()
    {
        // Carikan data jadwal 
        $jadwals = JadwalPosyandu::all();
        return view("pengguna.jadwal", [
            "user" => Auth::user()
        ], compact('jadwals'));
    }
    public function show($slug)
    {
        $jadwal = JadwalPosyandu::where('slug', $slug)->firstOrFail();
        return view("pengguna.show", compact('jadwal'));
    }
}
