<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserManageController;
use App\Http\Controllers\PemeriksaanController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\JadwalPosyanduController;


// register view
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// view login
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/', [AuthController::class, 'login']);

// logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// Password Reset Routes
// 1. Form minta link (Lupa Password)
Route::get('forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])
    ->name('password.request');

// 2. Kirim email linknya
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLink'])
    ->name('password.email');

// 3. Form ganti password (saat klik link dari email)
// PERHATIKAN: '{token}' di sini akan otomatis menangkap token dari URL email
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])
    ->name('password.reset');

// 4. Proses simpan password baru
Route::post('reset-password', [ForgotPasswordController::class, 'reset'])
    ->name('password.update');


// Route::get('forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('password.request');
// Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('password.email');

// Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
// Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');


Route::middleware(['auth', 'role:kader'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'kader'])->name('kader.dashboard');
});

Route::middleware(['auth', 'role:pengguna'])->group(function () {
    Route::get('/jadwall', [DashboardController::class, 'pengguna'])->name('pengguna.dashboard');
    Route::get('/jadwall/{slug}', [DashboardController::class, 'show'])->name('pengguna.show');
});

// Menampilkan Data Peserta yang Terdaftar ya
Route::get('/data', [PesertaController::class, 'index'])->name('view.data');

// Update data
Route::get('/peserta/edit/{kategori}/{id}', [PesertaController::class, 'edit'])->name('peserta.edit');
Route::put('/peserta/update/{kategori}/{id}', [PesertaController::class, 'update'])->name('peserta.update');


// form input data
Route::get('/data/tambah', [PesertaController::class, 'create'])->name('peserta.create');
Route::post('/data/store', [PesertaController::class, 'store'])->name('peserta.store');
Route::delete('/peserta/{kategori}/{id}', [PesertaController::class, 'destroy'])->name('peserta.destroy');

// view pemeriksaan
Route::get('/pemeriksaan', [PemeriksaanController::class, 'index'])->name('pemeriksaan.index');

Route::get('/pemeriksaan/create', [PemeriksaanController::class, 'create'])->name('pemeriksaan.create');
Route::post('/pemeriksaan/store', [PemeriksaanController::class, 'store'])->name('pemeriksaan.store');
Route::get('/pemeriksaan/search', [PemeriksaanController::class, 'searchPeserta'])->name('pemeriksaan.search');
Route::get('/pemeriksaan/show/{id}', [PemeriksaanController::class, 'show'])->name('pemeriksaan.show');


// Hapus pemeriksaan
Route::get('/pemeriksaan/{id}/edit', [PemeriksaanController::class, 'edit'])->name('pemeriksaan.edit');
Route::put('/pemeriksaan/{id}', [PemeriksaanController::class, 'update'])->name('pemeriksaan.update');
Route::delete('/pemeriksaan/{id}', [PemeriksaanController::class, 'destroy'])->name('pemeriksaan.destroy');

// jadwal
Route::get('/jadwal/create', [JadwalPosyanduController::class, 'create'])->name('jadwal.create');
Route::post('/jadwal', [JadwalPosyanduController::class, 'store'])->name('jadwal.store');
Route::get('/jadwal/{id}/edit', [JadwalPosyanduController::class, 'edit'])->name('jadwal.edit');
Route::put('/jadwal/{id}', [JadwalPosyanduController::class, 'update'])->name('jadwal.update');
Route::delete('/jadwal/{id}', [JadwalPosyanduController::class, 'destroy'])->name('jadwal.destroy');

Route::get('/jadwal/detail/{slug}', [JadwalPosyanduController::class, 'show'])->name('jadwal.show');

// Ekspor Laporan 
Route::controller(LaporanController::class)->group(function () {
    Route::get('/laporan', 'index')->name('laporan.index');
    Route::get('/laporan/search', 'search')->name('laporan.search')->withoutMiddleware('auth');
    Route::get('/laporan/{tipe}/{id}', 'show')->name('laporan.show');
});

// Ekspor PDF
Route::get('/laporan/pdf/{tipe}/{id}', [LaporanController::class, 'exportPdf'])
    ->middleware('auth')
    ->name('laporan.pdf');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

// Riwayat Pemeriksaan
Route::get('/riwayat', [RiwayatController::class, 'index'])
    ->middleware('auth')
    ->name('pengguna.riwayat');

Route::middleware(['auth', 'role:kader'])->group(function () {
    // view pengguna
    Route::get('/admin/pengguna', [UserManageController::class, 'index'])
        ->name('admin.pengguna.index');

    Route::get('/admin/pengguna/create', [UserManageController::class, 'create'])
        ->name('admin.pengguna.create');

    Route::post('/admin/pengguna/store', [UserManageController::class, 'store'])
        ->name('admin.pengguna.store');

    Route::get('/users/{id}/edit', [UserManageController::class, 'edit'])->name('users.edit');

    Route::put('/users/{id}', [UserManageController::class, 'update'])->name('users.update');

    Route::delete('/admin/pengguna/{id}', [UserManageController::class, 'destroy'])
        ->name('admin.pengguna.destroy');

});

// pengguna artikel
Route::get('/artikel', [ArtikelController::class, 'index'])->name('artikel.index');
Route::get('/artikel/baca/{id}', [ArtikelController::class, 'show'])->name('artikel.show');

// Route untuk Admin (Mengelola Artikel) -> Sebaiknya dibungkus middleware auth/admin
Route::prefix('kader')->name('kader.')->group(function () {
    Route::get('/artikel', [ArtikelController::class, 'adminIndex'])->name('artikel.index');
    Route::get('/artikel/create', [ArtikelController::class, 'create'])->name('artikel.create');
    Route::post('/artikel', [ArtikelController::class, 'store'])->name('artikel.store');
    Route::get('/artikel/{id}/edit', [ArtikelController::class, 'edit'])->name('artikel.edit');
    Route::put('/artikel/{id}', [ArtikelController::class, 'update'])->name('artikel.update');
    Route::delete('/artikel/{id}', [ArtikelController::class, 'destroy'])->name('artikel.destroy');
});


Route::get('/migrate', function () {
    Artisan::call('migrate', ['--force' => true]);
    return 'Migration success';
});