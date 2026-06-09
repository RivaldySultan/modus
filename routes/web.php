<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/login', function () {
    return view('auth.login');
});

// --- DASHBOARD ---
Route::get('/dashboard', function () {
    return view('admin.dashboard');
});

// --- DAFTAR TEMPLATE ---
Route::get('/daftar-template', function () {
    return view('admin.daftar-template');
});
Route::get('/upload-template', function () {
    return view('admin.upload-template');
});
Route::get('/edit-template', function () {
    return view('admin.edit-template');
});

// --- DATA MASTER ---
Route::get('/data-teknis', function () {
    return view('admin.data-teknis');
});
Route::get('/tambah-teknis', function () {
    return view('admin.tambah-teknis');
});
Route::get('/data-kpa', function () {
    return view('admin.data-kpa');
});

Route::get('/tambah-kpa', function () {
    return view('admin.tambah-kpa');
});

Route::get('/data-pegawai', function () {
    return view('admin.data-pegawai');
});

Route::get('/tambah-pegawai', function () {
    return view('admin.tambah-pegawai');
});

Route::get('/data-jenis-sk', function () {
    return view('admin.data-jenis-sk');
});

Route::get('/tambah-jenis-sk', function () {
    return view('admin.tambah-jenis-sk');
});

Route::get('/edit-jenis-sk', function () {
    return view('admin.edit-jenis-sk'); 
});

Route::get('/data-jabatan', function () {
    return view('admin.data-jabatan');
});

Route::get('/manajemen-user', function () {
    return view('admin.manajemen-user');
});

Route::get('/tambah-user', function () {
    return view('admin.tambah-user');
});

Route::get('/edit-user', function () {
    return view('admin.edit-user');
});

Route::get('/arsip', function () {
    return view('admin.arsip');
});

Route::get('user/dashboard', function () {
    return view('user.dashboard');
});

Route::get('user/buat-sk', function () {
    return view('user.buat-sk');
});