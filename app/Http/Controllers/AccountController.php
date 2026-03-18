<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AccountController extends Controller
{
    public function settings()
    {       
        return view('user.account.settings_user');
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|max:255|unique:users,email,' . $user->id,
            'no_telp'    => 'nullable|string|max:20',
            'nama_brand' => 'nullable|string|max:255',
        ], [
            'name.required'  => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email'    => 'Format email tidak valid.',
            'email.unique'   => 'Email sudah digunakan akun lain.',
        ]);

        $user->update([
            'name'       => $request->name,
            'email'      => $request->email,
            'no_telp'    => $request->no_telp,
            'nama_brand' => $request->nama_brand,
        ]);

        return redirect()->route('account.settings', ['tab' => 'profil'])
            ->with('success', 'Profil berhasil diperbarui.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password'         => ['required', 'confirmed', Password::min(8)],
        ], [
            'current_password.required' => 'Password saat ini wajib diisi.',
            'password.required'         => 'Password baru wajib diisi.',
            'password.confirmed'        => 'Konfirmasi password tidak cocok.',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()
                ->withErrors(['current_password' => 'Password saat ini salah.'])
                ->withInput(['tab' => 'keamanan']);
        }

        $user->update(['password' => Hash::make($request->password)]);

        return redirect()->route('account.settings', ['tab' => 'keamanan'])
            ->with('success', 'Password berhasil diperbarui.');
    }
}
