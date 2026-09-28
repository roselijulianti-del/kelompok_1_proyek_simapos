<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArtikelController extends Controller
{
    // === BAGIAN PENGGUNA (TAMPILAN ESTETIK) ===
    public function index()
    {
        $heroArtikel = Artikel::latest()->first();

        $artikels = $heroArtikel
            ? Artikel::latest()
                ->where('id', '!=', $heroArtikel->id)
                ->paginate(6)
            : Artikel::paginate(6);

        return view('pengguna.artikel.index', compact('heroArtikel', 'artikels'));
    }

    // === BAGIAN ADMIN (CRUD TABEL) ===
    public function adminIndex()
    {
        $artikels = Artikel::latest()->paginate(10);
        return view('kader.artikel.index', compact('artikels'));
    }

    public function create()
    {
        return view('kader.artikel.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|max:255',
            'kategori' => 'required|in:Balita,Ibu Hamil',
            'penulis' => 'required',
            'isi' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Upload Gambar
        $imagePath = $request->file('gambar')->store('artikel-images', 'public');

        Artikel::create([
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'penulis' => $request->penulis,
            'isi' => $request->isi,
            'gambar' => $imagePath,
        ]);

        return redirect()->route('kader.artikel.index')->with('success', 'Artikel berhasil ditambahkan');
    }

    public function edit($id)
    {
        $artikel = Artikel::findOrFail($id);
        return view('kader.artikel.edit', compact('artikel'));
    }

    public function update(Request $request, $id)
    {
        $artikel = Artikel::findOrFail($id);

        $request->validate([
            'judul' => 'required|max:255',
            'kategori' => 'required|in:Balita,Ibu Hamil',
            'penulis' => 'required',
            'isi' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->except(['gambar']);

        // Cek jika ada gambar baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($artikel->gambar) {
                Storage::disk('public')->delete($artikel->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('artikel-images', 'public');
        }

        $artikel->update($data);

        return redirect()->route('kader.artikel.index')->with('success', 'Artikel berhasil diupdate');
    }

    public function destroy($id)
    {
        $artikel = Artikel::findOrFail($id);
        if ($artikel->gambar) {
            Storage::disk('public')->delete($artikel->gambar);
        }
        $artikel->delete();
        return redirect()->back()->with('success', 'Artikel dihapus');
    }

    public function show($id)
    {
        $artikel = Artikel::findOrFail($id);

        // Mengambil artikel lain untuk rekomendasi (Selain artikel yang sedang dibuka)
        $rekomendasi = Artikel::where('id', '!=', $id)
            ->latest()
            ->take(2)
            ->get();

        return view('pengguna.artikel.show', compact('artikel', 'rekomendasi'));
    }
}
