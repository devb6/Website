<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BalitaController;
use App\Http\Controllers\IbuHamilController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\RoleAccessController;

// Auth Routes (Public)
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Protected Routes
Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return redirect()->route('dashboard');
    });

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Balita Routes
    Route::resource('balita', BalitaController::class);

    // Ibu Hamil Routes
    Route::resource('ibu-hamil', IbuHamilController::class);

    // Jadwal Routes
    Route::resource('jadwal', JadwalController::class);

    // Laporan Routes
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/balita', [LaporanController::class, 'balita'])->name('laporan.balita');
    Route::get('/laporan/ibu-hamil', [LaporanController::class, 'ibuHamil'])->name('laporan.ibu-hamil');

    // Admin Routes - Hanya Admin
    Route::middleware(['auth'])->group(function () {
        Route::prefix('admin')->name('admin.')->group(function () {
            Route::resource('role-access', RoleAccessController::class);
        });
    });
});

