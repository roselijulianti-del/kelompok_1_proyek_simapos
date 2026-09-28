<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserManageController extends Controller
{
    public function index()
    {
        $penggunas = User::where('role', 'pengguna')
            ->withCount('balitas')
            ->withCount('ibu_hamils')
            ->paginate(10);

        return view('kader.user.index', compact('penggunas'));
    }

    public function create()
    {
        return view('kader.user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'pengguna',
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.pengguna.index')->with('success', 'Pengguna berhasil didaftarkan.');
    }

    public function edit($id)
    {
        // buatkan view edit 
        $user = User::findOrFail($id);
        return view('kader.user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email'],
            'role' => 'required|in:admin,kader,pengguna',
            'password' => 'nullable|min:8',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            // 'password' => $request->password,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.pengguna.index')->with('success', 'Data pengguna berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->back()->with('success', 'Pengguna berhasil dihapus.');
    }
}
