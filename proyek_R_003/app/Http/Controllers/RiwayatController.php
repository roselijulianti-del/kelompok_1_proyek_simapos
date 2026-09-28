<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Ambil semua balita milik user ini
        $balitas = $user->balitas()->with([
            'pemeriksaans' => function ($q) {
                $q->latest();
            }
        ])->get();

        // Ambil Ibu Hamil + Urutkan pemeriksaan dari yang terbaru
        $ibuHamils = $user->ibu_hamils()->with([
            'pemeriksaans' => function ($q) {
                $q->latest();
            }
        ])->get();
        // Kalau belum ada relasi pemeriksaan di model Balita, kita bisa nanti benahin.
        return view('pengguna.riwayat.index', compact('balitas', 'ibuHamils'));
    }
}
