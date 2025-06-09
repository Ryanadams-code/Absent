<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard umum untuk semua role
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Route khusus role tetap dipertahankan untuk fungsionalitas spesifik role
    // Super Admin Routes
    Route::middleware('role:super admin')->prefix('admin')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');
    });

    // Guru Routes
    Route::middleware('role:guru')->prefix('guru')->group(function () {
        Route::get('/dashboard', function () {
            return view('guru.dashboard');
        })->name('guru.dashboard');
    });

    // Murid Routes
    Route::middleware('role:murid')->prefix('murid')->group(function () {
        Route::get('/dashboard', function () {
            return view('murid.dashboard');
        })->name('murid.dashboard');
    });

    // Tata Usaha Routes
    Route::middleware('role:tata usaha')->prefix('tata-usaha')->group(function () {
        Route::get('/dashboard', function () {
            return view('tata-usaha.dashboard');
        })->name('tata-usaha.dashboard');
    });
});
