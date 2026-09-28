<?php

namespace App\Http\Controllers;

use App\Models\Balita;
use App\Models\IbuHamil;
use App\Models\Pemeriksaan;
use Illuminate\Http\Request;
use App\Models\JadwalPosyandu;
use Illuminate\Support\Facades\Auth;

class PemeriksaanController extends Controller
{
    public function index()
    {
        // ambil data jadwal
        $jadwals = JadwalPosyandu::all();
        $pemeriksaans = Pemeriksaan::all();
        return view('kader.pemeriksaan', compact('pemeriksaans', 'jadwals'));
    }
    public function create()
    {
        return view('kader.tambah-pemeriksaan');
    }

    public function searchPeserta(Request $request)
    {
        $query = $request->get('q');

        $balitas = Balita::where('nama_balita', 'like', "%$query%")
            ->orWhere('nik', 'like', "%$query%")
            ->get(['id', 'nik', 'nama_balita as nama']);

        $ibuhamils = IbuHamil::where('nama_ibu_hamil', 'like', "%$query%")
            ->orWhere('nik_ibu_hamil', 'like', "%$query%")
            ->get(['id', 'nik_ibu_hamil as nik', 'nama_ibu_hamil as nama']);

        $results = $balitas->concat($ibuhamils);

        if ($results->isEmpty()) {
            return response()->json(['message' => 'Data peserta belum terdaftar.']);
        }

        return response()->json($results);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tipe' => 'required|in:balita,ibu_hamil',
            'peserta_id' => 'required|integer',
            'tanggal' => 'required|date',
            'berat_badan_balita' => 'nullable|integer|min:0',
            'tinggi_badan' => 'nullable|integer|min:0',
            'status_gizi' => 'nullable|in:Gizi Baik,Gizi Buruk,Stunting',
            'berat_badan_ibu' => 'nullable|integer|min:0',
            'tekanan_sistolik' => 'nullable|integer|min:0|max:300',
            'tekanan_diastolik' => 'nullable|integer|min:0|max:200',
            'usia_kehamilan' => 'nullable|integer|min:0',
            'status_ibu' => 'nullable|in:Kondisi Baik,Anemia',
        ]);

        // Cek apakah sudah ada pemeriksaan untuk peserta ini
        if ($request->tipe === 'balita') {
            $cek = Pemeriksaan::where('balita_id', $request->peserta_id)->first();
        } else {
            $cek = Pemeriksaan::where('ibu_hamil_id', $request->peserta_id)->first();
        }

        if ($cek) {
            return redirect()->route('pemeriksaan.index')->with('error', 'Peserta ini sudah memiliki data pemeriksaan!');
            // return redirect()->route('pemeriksaan.index')->with('success', 'Data pemeriksaan berhasil ditambahkan.');

        }

        if ($validated['tipe'] === 'balita') {
            $validated['balita_id'] = $validated['peserta_id'];
            $validated['ibu_hamil_id'] = null;

            $validated['berat_badan_balita'] = $validated['berat_badan_balita'] ?? null;
            $validated['berat_badan_ibu'] = null;
        } else {
            $validated['ibu_hamil_id'] = $validated['peserta_id'];
            $validated['balita_id'] = null;

            $validated['berat_badan_ibu'] = $validated['berat_badan_ibu'] ?? null;
            $validated['berat_badan_balita'] = null;
        }

        unset($validated['peserta_id']);

        $validated['user_id'] = Auth::id();

        Pemeriksaan::create($validated);

        return redirect()->route('pemeriksaan.index')->with('success', 'Data pemeriksaan berhasil ditambahkan.');
    }

    // Tampilkan detail pemeriksaan
    public function show($id)
    {
        $pemeriksaan = Pemeriksaan::with(['balita', 'ibu_hamil'])->findOrFail($id);
        return view('kader.detail-pemeriksaan', compact('pemeriksaan'));
    }
    // Buatkan form edit 
    public function edit($id)
    {
        $pemeriksaan = Pemeriksaan::with(['balita', 'ibu_hamil'])->findOrFail($id);
        return view('kader.edit-pemeriksaan', compact('pemeriksaan'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'berat_badan_balita' => 'nullable|integer|min:0',
            'tinggi_badan' => 'nullable|integer|min:0',
            'status_gizi' => 'nullable|in:Gizi Baik,Gizi Buruk,Stunting',
            'berat_badan_ibu' => 'nullable|integer|min:0',
            'tekanan_sistolik' => 'nullable|integer|min:0|max:300',
            'tekanan_diastolik' => 'nullable|integer|min:0|max:200',
            'usia_kehamilan' => 'nullable|integer|min:0',
            'status_ibu' => 'nullable|in:Kondisi Baik,Anemia',
        ]);

        $pemeriksaan = Pemeriksaan::findOrFail($id);
        $pemeriksaan->update($validated);

        return redirect()->route('pemeriksaan.index')->with('success', 'Data pemeriksaan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pemeriksaan = Pemeriksaan::findOrFail($id);
        $pemeriksaan->delete();

        return redirect()->route('pemeriksaan.index')->with('success', 'Data pemeriksaan berhasil dihapus.');
    }
}
