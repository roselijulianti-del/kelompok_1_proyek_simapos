<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Balita;
use App\Models\IbuHamil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesertaController extends Controller
{
    public function index()
    {
        if (Auth::user()->role === 'kader') {

            // ADMIN LIHAT SEMUA DATA
            $balitas = Balita::paginate(10);
            $ibu_hamils = IbuHamil::paginate(10);

            $totalBalita = Balita::count();
            $totalIbuHamil = IbuHamil::count();

        } else {

            // PENGGUNA LIHAT PUNYA SENDIRI
            $balitas = Balita::where('user_id', Auth::id())->paginate(5);
            $ibu_hamils = IbuHamil::where('user_id', Auth::id())->paginate(5);

            $totalBalita = $balitas->count();
            $totalIbuHamil = $ibu_hamils->count();
        }

        return view('kader.data-peserta', compact(
            'balitas',
            'ibu_hamils',
            'totalBalita',
            'totalIbuHamil'
        ));
    }

    public function create()
    {
        $users = User::where('role', 'pengguna')->get();
        return view('kader.tambah-data', compact('users'));
    }
    public function store(Request $request)
    {
        $kategori = $request->kategori;

        if ($kategori === 'balita') {
            $validated = $request->validate([
                'user_id' => 'required|exists:users,id',
                'nik' => 'required|string|max:20|unique:balitas',
                'nama_balita' => 'required|string|max:100',
                'usia_tahun' => 'required|integer|min:0',
                'usia_bulan' => 'nullable|integer|min:0|max:12',
                'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
                'alamat' => 'required|string|max:255',
                'nama_orang_tua' => 'required|string|max:100',

            ]);
            // $validated['user_id'] = Auth::id();
            Balita::create($validated);



        } elseif ($kategori === 'ibu_hamil') {
            $validated = $request->validate([
                'user_id' => 'required|exists:users,id',
                'nik_ibu_hamil' => 'required|string|max:20|unique:ibu_hamils',
                'nama_ibu_hamil' => 'required|string|max:100',
                'nama_suami' => 'required|string|max:100',
                'umur' => 'required|integer|min:15|max:60',
                'alamat_ibu_hamil' => 'required|string|max:255',
            ]);
            // $validated['user_id'] = Auth::id();
            IbuHamil::create($validated);
        } else {
            return redirect()->back()->with('error', 'Kategori tidak valid!');
        }

        if ($request->kategori === 'ibu_hamil') {
            return redirect()->route('view.data', ['tab' => 'ibu_hamil'])
                ->with('success', 'Data ibu hamil berhasil ditambahkan!');
        } elseif ($request->kategori === 'balita') {
            return redirect()->route('view.data')
                ->with('success', 'Data balita berhasil ditambahkan!');
        } else {
            return redirect()->back()->with('error', 'Kategori tidak valid!');
        }

    }

    public function edit($kategori, $id)
    {
        // Ambil daftar user dengan role 'pengguna' untuk dropdown
        $users = User::where('role', 'pengguna')->get(); //

        if ($kategori === 'balita') {
            $data = Balita::findOrFail($id);
        } elseif ($kategori === 'ibu_hamil') {
            $data = IbuHamil::findOrFail($id);
        } else {
            return redirect()->back()->with('error', 'Kategori tidak valid!');
        }

        // Kirim $users ke view
        return view('kader.edit-data', compact('data', 'kategori', 'users'));
    }

    public function update(Request $request, $kategori, $id)
    {
        $kategori = $request->kategori;
        if (!$kategori) {
            return redirect()->back()->with('error', 'Kategori tidak ditemukan!');
        }

        if ($kategori === 'balita') {
            $validated = $request->validate([
                'user_id' => 'required|exists:users,id', // Tambahkan validasi user_id
                'nik' => 'required|string|max:20|unique:balitas,nik,' . $id,
                'nama_balita' => 'required|string|max:100',
                'usia_tahun' => 'required|integer|min:0',
                'usia_bulan' => 'nullable|integer|min:0|max:12',
                'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
                'alamat' => 'required|string|max:255',
                'nama_orang_tua' => 'required|string|max:100',
            ]);

            $data = Balita::findOrFail($id);
            $data->update($validated);

        } elseif ($kategori === 'ibu_hamil') {
            $validated = $request->validate([
                'user_id' => 'required|exists:users,id', // Tambahkan validasi user_id
                'nik_ibu_hamil' => 'required|string|max:20|unique:ibu_hamils,nik_ibu_hamil,' . $id,
                'nama_ibu_hamil' => 'required|string|max:100',
                'nama_suami' => 'required|string|max:100',
                'umur' => 'required|integer|min:15|max:60',
                'alamat_ibu_hamil' => 'required|string|max:255',
            ]);

            $data = IbuHamil::findOrFail($id);
            $data->update($validated);
        } else {
            return redirect()->back()->with('error', 'Kategori tidak valid!');
        }

        return redirect()->route('view.data')->with('success', 'Data peserta berhasil diupdate.');
    }


    public function destroy($kategori, $id)
    {
        if ($kategori === 'ibu_hamil') {
            IbuHamil::findOrFail($id)->delete();
        } elseif ($kategori === 'balita') {
            Balita::findOrFail($id)->delete();
        }

        return redirect()->route('view.data')->with('success', 'Data peserta berhasil dihapus.');
    }
}
