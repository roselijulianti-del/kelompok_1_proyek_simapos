<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Balita;
use App\Models\IbuHamil;
use App\Models\Pemeriksaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $profiles = Auth::user();
        $totalBalita = Balita::get();
        $totalIbuHamil = IbuHamil::get();

        $totalPeserta = $totalBalita->count() + $totalIbuHamil->count();



        // Hitung Seluruh Pemeriksaa
        $pemeriksaans = Pemeriksaan::get();
        return view('profile.index', compact('profiles', 'pemeriksaans', 'totalPeserta'));
    }
}
