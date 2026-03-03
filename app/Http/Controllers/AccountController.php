<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Menampilkan halaman pengaturan akun
     */
    public function settings()
    {
        return view('account.settings_user');
    }

    /**
     * Update profile user
     */
    public function updateProfile(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
        ]);

        // Logic update profile akan diisi nanti
        return redirect()->route('account.settings')->with('success', 'Profile berhasil diperbarui');
    }

    /**
     * Update password user
     */
    public function updatePassword(Request $request)
    {
        // Validasi input
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        // Logic update password akan diisi nanti
        return redirect()->route('account.settings')->with('success', 'Password berhasil diperbarui');
    }
}