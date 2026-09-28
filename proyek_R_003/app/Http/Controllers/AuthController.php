<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register', [
            'title' => 'Register Page'
        ]);
    }

    // Proses register
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],

            'email' => [
                'required',
                'string',
                'email',
                'max:100',
                'unique:users,email',
                'regex:/^[A-Za-z0-9._%+-]+@gmail\.com$/',
            ],

            'password' => ['required', 'string', 'min:8', 'confirmed'],
            // 'role' => ['required', 'in:kader'],

        ], [
            'email.regex' => 'Domain tidak valid',
            'email.unique' => 'Email sudah digunakan.',
        ]);


        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            // 'role' => $validated['role'],
        ]);

        return redirect()
            ->route('login')
            ->with('success', 'Registrasi berhasil! Silakan login.');
    }

    public function showLogin()
    {
        return view('auth.login', [
            'title' => 'Login Page'
        ]);
    }

    // Proses login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Arahkan sesuai role
            if (Auth::user()->role === 'pengguna') {
                return redirect()->route('pengguna.dashboard');
            }
            return redirect()->route('kader.dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
