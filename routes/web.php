<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MuridController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('auth.login');
});

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/password', [ProfileController::class, 'editPassword'])->name('profile.password');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');

    // Resource Routes
    Route::resource('murids', MuridController::class);
    Route::resource('gurus', GuruController::class);
    Route::resource('schedules', ScheduleController::class);
    
    // New resource routes for subjects and rooms
    Route::resource('subjects', SubjectController::class);
    Route::resource('rooms', RoomController::class);
    Route::resource('kelas', KelasController::class);

    Route::get('schedules/{schedule}/manage-students', [ScheduleController::class, 'manageStudents'])->name('schedules.manage-students');
    Route::put('schedules/{schedule}/update-students', [ScheduleController::class, 'updateStudents'])->name('schedules.update-students');
    
    // Kehadiran - akses berbeda berdasarkan role
    Route::get('attendances', [AttendanceController::class, 'index'])->name('attendances.index');
    Route::get('attendances/create', [AttendanceController::class, 'create'])->name('attendances.create');
    Route::post('attendances', [AttendanceController::class, 'store'])->name('attendances.store');
    Route::get('attendances/report', [AttendanceController::class, 'report'])->name('attendances.report');

    // Route khusus role tetap dipertahankan untuk fungsionalitas spesifik role
    // Super Admin Routes
    Route::middleware('role:super admin')->prefix('admin')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');
    });

    // Tata Usaha Routes
    Route::middleware('role:tata usaha')->prefix('tata-usaha')->group(function () {
        Route::get('/dashboard', function () {
            return view('tata-usaha.dashboard');
        })->name('tata-usaha.dashboard');
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
});
