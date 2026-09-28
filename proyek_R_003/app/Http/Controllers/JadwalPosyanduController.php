<?php

namespace App\Http\Controllers;

use App\Models\JadwalPosyandu;
use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\AppNotification;
use Carbon\Carbon;

class JadwalPosyanduController extends Controller
{
    public function show($slug)
    {
        $jadwal = JadwalPosyandu::where('slug', $slug)->firstOrFail();
        return view('kader.jadwal.show', compact('jadwal'));
    }

    /**
     * Form tambah jadwal baru.
     */
    public function create()
    {
        return view('kader.jadwal.create');
    }

    /**
     * Simpan jadwal baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'keterangan' => 'required|string|max:255|',
            'lokasi' => 'required|string|max:255',
            'waktu_mulai' => 'required|date',
            'waktu_selesai' => 'required|date|after:waktu_mulai',
        ]);

        $jadwal = JadwalPosyandu::create($request->all());
        $users = User::all();

        foreach ($users as $user) {
            $user->notify(new AppNotification([
                'title' => 'Jadwal Baru',
                'message' => 'Jadwal posyandu baru telah tersedia',
                'type' => 'jadwal'
            ]));
        }
        return redirect()->back();

        JadwalPosyandu::create($validated);
        return redirect()->route('pemeriksaan.index', ['tab' => 'jadwal'])->with('success', 'Jadwal berhasil ditambahkan!');
    }

    /**
     * Form edit jadwal.
     */
    public function edit($id)
    {
        $jadwal = JadwalPosyandu::findOrFail($id);
        return view('kader.jadwal.edit', compact('jadwal'));
    }

    /**
     * Update jadwal.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'keterangan' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'waktu_mulai' => 'required|date',
            'waktu_selesai' => 'required|date|after:waktu_mulai',
        ]);

        $jadwal = JadwalPosyandu::findOrFail($id);
        $jadwal->update([
            'keterangan' => $request->keterangan,
            'lokasi' => $request->lokasi,
            'waktu_mulai' => Carbon::parse($request->waktu_mulai),
            'waktu_selesai' => Carbon::parse($request->waktu_selesai),
        ]);

        return redirect()->route('pemeriksaan.index', ['tab' => 'jadwal'])->with('success', 'Jadwal berhasil diperbarui!');
    }

    /**
     * Hapus jadwal.
     */
    public function destroy($id)
    {
        $jadwal = JadwalPosyandu::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('pemeriksaan.index', ['tab' => 'jadwal'])->with('success', 'Jadwal berhasil dihapus!');
    }
}
