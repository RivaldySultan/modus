<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TemplateSkController;
use App\Http\Controllers\JabatanPesertaController;
use App\Http\Controllers\DataTeknisController;
use App\Http\Controllers\DataKpaController;
use App\Http\Controllers\DataPegawaiController;
use App\Http\Controllers\JenisSkController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\BuatSkController;
use App\Http\Controllers\ArsipController;
use App\Http\Controllers\KegiatanTeknisController;
use App\Http\Controllers\AdminDashboardController;

// Rute Publik (Tidak perlu login)
Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);

// Rute yang WAJIB Login (Dilindungi Middleware)
Route::middleware('auth')->group(function () {
    
    // Rute Logout
    Route::post('/logout', [AuthController::class, 'logout']);

    // --- DASHBOARD ADMIN ---
    Route::get('/dashboard', [AdminDashboardController::class, 'index']);

    // --- MANAJEMEN USER (Menggunakan Controller) ---
    Route::get('/manajemen-user', [UserController::class, 'index']);
    Route::get('/tambah-user', [UserController::class, 'create']);
    Route::post('/tambah-user', [UserController::class, 'store']);
    Route::get('/edit-user/{id}', [UserController::class, 'edit']);
    Route::put('/edit-user/{id}', [UserController::class, 'update']);
    Route::delete('/hapus-user/{id}', [UserController::class, 'destroy']);

    // --- MANAJEMEN DATA TEKNIS ---
    Route::get('/data-teknis', [DataTeknisController::class, 'index']);
    Route::get('/tambah-teknis', [DataTeknisController::class, 'create']);
    Route::post('/tambah-teknis', [DataTeknisController::class, 'store']);
    Route::get('/edit-teknis/{id}', [DataTeknisController::class, 'edit']);
    Route::put('/edit-teknis/{id}', [DataTeknisController::class, 'update']);
    Route::delete('/hapus-teknis/{id}', [DataTeknisController::class, 'destroy']);

    // --- MANAJEMEN DATA KPA & DIPA ---
    Route::get('/data-kpa', [DataKpaController::class, 'index']);
    Route::get('/tambah-kpa', [DataKpaController::class, 'create']);
    Route::post('/tambah-kpa', [DataKpaController::class, 'store']);
    Route::get('/edit-kpa/{id}', [DataKpaController::class, 'edit']);
    Route::put('/edit-kpa/{id}', [DataKpaController::class, 'update']);
    Route::delete('/hapus-kpa/{id}', [DataKpaController::class, 'destroy']);
   
    // --- MANAJEMEN DATA PEGAWAI ---
    Route::get('/data-pegawai', [DataPegawaiController::class, 'index']);
    Route::get('/tambah-pegawai', [DataPegawaiController::class, 'create']);
    Route::post('/tambah-pegawai', [DataPegawaiController::class, 'store']);
    Route::get('/edit-pegawai/{id}', [DataPegawaiController::class, 'edit']);
    Route::put('/edit-pegawai/{id}', [DataPegawaiController::class, 'update']);
    Route::delete('/hapus-pegawai/{id}', [DataPegawaiController::class, 'destroy']);

    // --- MANAJEMEN DATA JABATAN PESERTA ---
    Route::get('/data-jabatan', [JabatanPesertaController::class, 'index']);
    Route::get('/tambah-jabatan', [JabatanPesertaController::class, 'create']);
    Route::post('/tambah-jabatan', [JabatanPesertaController::class, 'store']);
    Route::get('/edit-jabatan/{id}', [JabatanPesertaController::class, 'edit']);
    Route::put('/edit-jabatan/{id}', [JabatanPesertaController::class, 'update']);
    Route::delete('/hapus-jabatan/{id}', [JabatanPesertaController::class, 'destroy']);
        
    // --- MANAJEMEN DATA JENIS SK ---
    Route::get('/data-jenis-sk', [JenisSkController::class, 'index']);
    Route::get('/tambah-jenis-sk', [JenisSkController::class, 'create']);
    Route::post('/tambah-jenis-sk', [JenisSkController::class, 'store']);
    Route::get('/edit-jenis-sk/{id}', [JenisSkController::class, 'edit']);
    Route::put('/edit-jenis-sk/{id}', [JenisSkController::class, 'update']);
    Route::delete('/hapus-jenis-sk/{id}', [JenisSkController::class, 'destroy']);
        
    // Rute untuk Data Kegiatan Teknis
    Route::get('/kegiatan-teknis', [KegiatanTeknisController::class, 'index']);
    Route::get('/tambah-kegiatan-teknis', [KegiatanTeknisController::class, 'create']);
    Route::post('/tambah-kegiatan-teknis', [KegiatanTeknisController::class, 'store']);
    Route::get('/edit-kegiatan-teknis/{id}', [KegiatanTeknisController::class, 'edit']);
    Route::put('/edit-kegiatan-teknis/{id}', [KegiatanTeknisController::class, 'update']);
    Route::delete('/hapus-kegiatan-teknis/{id}', [KegiatanTeknisController::class, 'destroy']);
    
    // --- DAFTAR TEMPLATE ---
    Route::get('/daftar-template', [TemplateSkController::class, 'index']);
    Route::get('/upload-template', [TemplateSkController::class, 'create']);
    Route::post('/upload-template', [TemplateSkController::class, 'store']);
    
    // Rute Edit Template Baru
    Route::get('/edit-template/{id}', [TemplateSkController::class, 'edit']);
    Route::put('/edit-template/{id}', [TemplateSkController::class, 'update']);
    
    Route::delete('/hapus-template/{id}', [TemplateSkController::class, 'destroy']);

    // --- ARSIP / MONITORING ---
    Route::get('/arsip', [ArsipController::class, 'index']);
    // --- AKSI MONITORING SK ---
    Route::post('/arsip/update-status/{id}', [ArsipController::class, 'updateStatus']);

    // --- HALAMAN USER (PEGAWAI) ---
    // (Tidak perlu dibungkus middleware auth lagi karena sudah berada di dalam grup auth utama)
    Route::get('/user/dashboard', [UserDashboardController::class, 'index']);
    Route::get('/user/buat-sk', [BuatSkController::class, 'create']); 
    Route::post('/user/buat-sk', [BuatSkController::class, 'store']); 

}); 