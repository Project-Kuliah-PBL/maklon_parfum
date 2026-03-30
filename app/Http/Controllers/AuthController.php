<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Tampilkan halaman login.
     * Jika sudah login, redirect ke dashboard sesuai role.
     */
    public function showLoginForm()
    {
        if (Auth::check()) {
            return $this->redirectByRole();
        }
        return view('auth.login');
    }

    /**
     * Tampilkan halaman register.
     * Jika sudah login, redirect ke dashboard.
     */
    public function showRegisterForm()
    {
        if (Auth::check()) {
            return $this->redirectByRole();
        }
        return view('auth.halaman_register');
    }

    /**
     * Proses login
     */
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            return $this->redirectByRole();
        }

        return back()->withErrors([
            'email' => 'Email atau password salah',
        ])->withInput();
    }

    /**
     * Proses register
     */
    public function register(Request $request)
    {
        $request->validate([
            'name'       => 'required',
            'username'   => 'required|unique:users',
            'email'      => 'required|email|unique:users',
            'nama_brand' => 'required',
            'no_telp'    => 'required',
            'password'   => 'required|min:6|confirmed',
        ], [
            'name.required'       => 'Nama pemilik wajib diisi.',
            'username.required'   => 'Username tidak boleh kosong.',
            'username.unique'     => 'Username ini sudah digunakan.',
            'email.required'      => 'Alamat email wajib diisi.',
            'email.email'         => 'Format email tidak valid.',
            'email.unique'        => 'Email ini sudah terdaftar.',
            'nama_brand.required' => 'Nama brand wajib diisi.',
            'no_telp.required'    => 'Nomor telepon wajib diisi.',
            'password.required'   => 'Password wajib diisi.',
            'password.min'        => 'Password minimal harus 6 karakter.',
            'password.confirmed'  => 'Konfirmasi password tidak cocok.',
        ]);

        User::create([
            'name'       => $request->name,
            'username'   => $request->username,
            'email'      => $request->email,
            'nama_brand' => $request->nama_brand,
            'no_telp'    => $request->no_telp,
            'role'       => 'customer',
            'password'   => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    /**
     * Proses logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }

    /**
     * Redirect berdasarkan role user yang sedang login
     */
    private function redirectByRole()
    {
        $role = Auth::user()->role;

        if ($role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('dashboard');
    }
}
