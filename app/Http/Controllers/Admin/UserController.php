<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User; // Pastikan model User diimport
use App\Models\Role; // Pastikan model Role diimport
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Untuk hashing password
use Illuminate\Validation\Rule; // Untuk validasi unique email
use Illuminate\Support\Facades\Auth; // <--- PASTIKAN INI ADA

class UserController extends Controller
{
    // Menampilkan daftar semua pengguna
    public function index()
    {
        $users = User::with('role')->latest()->paginate(10); // Ambil user dengan relasi role
        return view('admin.users.index', compact('users'));
    }

    // Menampilkan detail pengguna tertentu
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    // Menampilkan form untuk mengedit pengguna
    public function edit(User $user)
    {
        $roles = Role::all(); // Ambil semua peran
        return view('admin.users.edit', compact('user', 'roles'));
    }

    // Memperbarui data pengguna
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'role_id' => 'required|exists:roles,id',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $data = $request->except('password');
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil diperbarui.');
    }

    // Menghapus pengguna
    public function destroy(User $user)
    {
        // Pastikan admin tidak menghapus dirinya sendiri jika ada fitur pencegahan
        if (Auth::user()->id === $user->id) {
            return redirect()->route('admin.users.index')->with('error', 'Anda tidak bisa menghapus akun Anda sendiri.');
        }

        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil dihapus.');
    }
}