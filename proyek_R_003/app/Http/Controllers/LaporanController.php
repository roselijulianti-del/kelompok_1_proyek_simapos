<?php

namespace App\Http\Controllers;

use App\Models\Balita;
use App\Models\IbuHamil;
use App\Models\Pemeriksaan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function index()
    {

        return view('kader.laporan.index');
    }

    public function search(Request $request)
    {
        $q = $request->get('q');

        $balita = Balita::where('nama_balita', 'like', "%$q%")
            ->orWhere('nik', 'like', "%$q%")
            ->get(['id', 'nik', 'nama_balita as nama'])
            ->map(function ($b) {
                // cek pemeriksaan terakhir
                $pemeriksaan = Pemeriksaan::where('balita_id', $b->id)->latest()->first();
                $b->status_pemeriksaan = $pemeriksaan ? 'Sudah diperiksa' : 'Belum terperiksa';
                return $b;
            });


        $ibu = IbuHamil::where('nama_ibu_hamil', 'like', "%$q%")
            ->orWhere('nik_ibu_hamil', 'like', "%$q%")
            ->get(['id', 'nik_ibu_hamil as nik', 'nama_ibu_hamil as nama'])
            ->map(function ($i) {
                // cek pemeriksaan terakhir
                $pemeriksaan = Pemeriksaan::where('ibu_hamil_id', $i->id)->latest()->first();
                $i->status_pemeriksaan = $pemeriksaan ? 'Sudah diperiksa' : 'Belum terperiksa';
                return $i;
            });

        return response()->json([
            'balita' => $balita,
            'ibu' => $ibu
        ]);
    }

    // 📋 Detail berdasarkan tipe (balita / ibu)
    public function show($tipe, $id)
    {
        if ($tipe === 'balita') {
            $data = Balita::findOrFail($id);
            // sangat penting
            // if ($user = Auth::user() && $user->role === 'pengguna' && $data->user_id !== $user->id()) 
            if (auth()->user()->role === 'pengguna' && $data->user_id !== auth()->id()) {
                abort(403, 'Anda tidak memiliki akses ke data ini.');
            }

            $pemeriksaan = Pemeriksaan::where('balita_id', $id)->latest()->first();
            return response()->json([
                'data' => [
                    'nama' => $data->nama_balita,
                    'nik' => $data->nik,
                    'jenis_kelamin' => $data->jenis_kelamin,
                    'tanggal_lahir' => $data->usia_tahun . ' tahun ' . $data->usia_bulan . ' bulan',
                    'nama_orang_tua' => $data->nama_orang_tua,
                    'alamat' => $data->alamat,
                ],
                'pemeriksaan' => $pemeriksaan ? [
                    'tanggal' => $pemeriksaan->tanggal,
                    'berat_badan' => $pemeriksaan->berat_badan_balita,
                    'tinggi_badan' => $pemeriksaan->tinggi_badan,
                    'status_gizi' => $pemeriksaan->status_gizi,
                ] : null
            ]);
        }

        if ($tipe === 'ibu') {
            $data = IbuHamil::findOrFail($id);
            // penting untuk progres validasi 
            if (auth()->user()->role === 'pengguna' && $data->user_id !== auth()->id()) {
                abort(403, 'Anda tidak memiliki akses ke data ini.');
            }

            $pemeriksaan = Pemeriksaan::where('ibu_hamil_id', $id)->latest()->first();
            return response()->json([
                'data' => [
                    'nama' => $data->nama_ibu_hamil,
                    'nik' => $data->nik_ibu_hamil,
                    'nama_suami' => $data->nama_suami,
                    'umur' => $data->umur,
                    'alamat' => $data->alamat_ibu_hamil,
                ],
                'pemeriksaan' => $pemeriksaan ? [
                    'tanggal' => $pemeriksaan->tanggal,
                    'berat_badan' => $pemeriksaan->berat_badan_ibu,
                    'tekanan_darah' => $pemeriksaan->tekanan_sistolik . '/' . $pemeriksaan->tekanan_diastolik,
                    'usia_kehamilan' => $pemeriksaan->usia_kehamilan,
                    'status_ibu' => $pemeriksaan->status_ibu,
                ] : null
            ]);
        }

        return response()->json(['error' => 'Tipe tidak dikenali'], 400);
    }

    public function exportPdf($tipe, $id)
    {
        // HAPUS ATAU KOMENTAR BARIS INI
        // $user = Auth::user(); 

        // Siapkan variabel petugas kosong dulu untuk jaga-jaga
        $petugas = null;

        if ($tipe === 'balita') {
            $data = Balita::findOrFail($id);
            $pemeriksaan = Pemeriksaan::with('user')->where('balita_id', $id)->latest()->first();
            // Jika ada pemeriksaan, ambil nama usernya. Jika tidak, kosong/null.
            $petugas = $pemeriksaan ? $pemeriksaan->user : null;

            // Kirim $petugas ke view, bukan $user login
            $pdf = Pdf::loadView('pdf.balita', compact('data', 'pemeriksaan', 'petugas'));

        } elseif ($tipe === 'ibu') {
            $data = IbuHamil::findOrFail($id);

            $pemeriksaan = Pemeriksaan::with('user')->where('ibu_hamil_id', $id)->latest()->first();

            $petugas = $pemeriksaan ? $pemeriksaan->user : null;

            $pdf = Pdf::loadView('pdf.ibu', compact('data', 'pemeriksaan', 'petugas'));

        } else {
            abort(404);
        }

        return $pdf->download("laporan-$tipe-$id.pdf");
    }
}
