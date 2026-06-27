<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Menampilkan halaman tabel user
    public function index()
    {
        $users = User::latest()->get(); // Mengambil semua data user dari terbaru
        return view('admin.manajemen-user', compact('users')); 
        // Pastikan nama view disesuaikan dengan struktur folder kamu
    }

    // Menampilkan form tambah user
    public function create()
    {
        return view('admin.tambah-user'); // Sesuaikan dengan nama file blade kamu
    }

    // Proses menyimpan user baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6',
            'email' => 'required|email|unique:users',
            'role' => 'required',
            'status' => 'required'
        ]);

        User::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => Hash::make($request->password), // Enkripsi password
            'email' => $request->email,
            'role' => $request->role,
            'status' => $request->status,
        ]);

        return redirect('manajemen-user')->with('success', 'User berhasil ditambahkan!');
    }

    // Menampilkan form edit user dengan data lama
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.edit-user', compact('user')); // Sesuaikan dengan nama file blade kamu
    }

    // Proses update data user ke database
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required',
            'status' => 'required'
        ]);

        $user = User::findOrFail($id);
        $user->nama = $request->nama;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->status = $request->status;

        // Hanya update password jika form password diisi
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect('manajemen-user')->with('success', 'Data user berhasil diperbarui!');
    }

    // Proses hapus user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect('admin.manajemen-user')->with('success', 'User berhasil dihapus!');
    }
}