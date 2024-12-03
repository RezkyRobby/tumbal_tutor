<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    // Mengedit Profil Sendiri (User Biasa)
    public function editProfile()
    {
        $user = auth()->user(); // Ambil pengguna yang login
        return view('profile.edit', compact('user'));
    }

    // Memperbarui Profil Sendiri
    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update($request->only('username', 'email'));

        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully.');
    }

    // Mengedit Pengguna Lain (Admin)
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    // Memperbarui Data Pengguna Lain (Admin)
    public function update(Request $request, User $user)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|string|in:student,teacher',
        ]);

        $user->update($request->only('username', 'email', 'role'));

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
