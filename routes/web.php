<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TemplateSkController;
use App\Http\Controllers\JabatanController;

// Rute Publik (Tidak perlu login)
Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);

// Rute yang WAJIB Login (Dilindungi Middleware)
Route::middleware('auth')->group(function () {
    
    // Rute Logout
    Route::post('/logout', [AuthController::class, 'logout']);

    // --- DASHBOARD ADMIN ---
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    });

    // --- MANAJEMEN USER (Menggunakan Controller) ---
    Route::get('/manajemen-user', [UserController::class, 'index']);
    Route::get('/tambah-user', [UserController::class, 'create']);
    Route::post('/tambah-user', [UserController::class, 'store']);
    Route::get('/edit-user/{id}', [UserController::class, 'edit']);
    Route::put('/edit-user/{id}', [UserController::class, 'update']);
    Route::delete('/hapus-user/{id}', [UserController::class, 'destroy']);

    // --- DATA MASTER (Sementara View Langsung) ---
    Route::get('/data-teknis', function () { return view('admin.data-teknis'); });
    Route::get('/tambah-teknis', function () { return view('admin.tambah-teknis'); });
    
    Route::get('/data-kpa', function () { return view('admin.data-kpa'); });
    Route::get('/tambah-kpa', function () { return view('admin.tambah-kpa'); });
    
    Route::get('/data-pegawai', function () { return view('admin.data-pegawai'); });
    Route::get('/tambah-pegawai', function () { return view('admin.tambah-pegawai'); });
    
    Route::get('/data-jenis-sk', function () { return view('admin.data-jenis-sk'); });
    Route::get('/tambah-jenis-sk', function () { return view('admin.tambah-jenis-sk'); });
    Route::get('/edit-jenis-sk', function () { return view('admin.edit-jenis-sk'); });
    
    // --- MANAJEMEN DATA JABATAN ---
    Route::get('/data-jabatan', [JabatanController::class, 'index']);
    Route::get('/tambah-jabatan', [JabatanController::class, 'create']);
    Route::post('/tambah-jabatan', [JabatanController::class, 'store']);
    Route::get('/edit-jabatan/{id}', [JabatanController::class, 'edit']);
    Route::put('/edit-jabatan/{id}', [JabatanController::class, 'update']);
    Route::delete('/hapus-jabatan/{id}', [JabatanController::class, 'destroy']);

    // --- DAFTAR TEMPLATE ---
    Route::get('/daftar-template', [TemplateSkController::class, 'index']);
    Route::get('/upload-template', [TemplateSkController::class, 'create']);
    Route::post('/upload-template', [TemplateSkController::class, 'store']);
    
    // Rute Edit Template Baru
    Route::get('/edit-template/{id}', [TemplateSkController::class, 'edit']);
    Route::put('/edit-template/{id}', [TemplateSkController::class, 'update']);
    
    Route::delete('/hapus-template/{id}', [TemplateSkController::class, 'destroy']);

    // --- ARSIP / MONITORING ---
    Route::get('/arsip', function () { return view('admin.arsip'); });

    // --- HALAMAN USER (PEGAWAI) ---
    Route::get('user/dashboard', function () { return view('user.dashboard'); });
    Route::get('user/buat-sk', function () { return view('user.buat-sk'); });
});