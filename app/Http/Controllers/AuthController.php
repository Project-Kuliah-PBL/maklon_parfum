<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    /**
     * Menampilkan halaman login
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Menampilkan halaman register
     */
    public function showRegisterForm()
    {
        return view('auth.halaman_register');
    }

    /**
     * Proses login
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email','password');

        if(Auth::attempt($credentials)){

            $request->session()->regenerate();

            $user = Auth::user();

            // redirect berdasarkan role
            if($user->role === 'admin'){
                return redirect()->route('admin.dashboard');
            }

            if($user->role === 'customer'){
                return redirect()->route('user.dashboard');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password salah'
        ])->withInput();
    }

public function register(Request $request)
{
    $request->validate([
        'name' => 'required',
        'username' => 'required|unique:users',
        'email' => 'required|email|unique:users',
        'nama_brand' => 'required',
        'no_telp' => 'required',
        'password' => 'required|min:6|confirmed'
    ], [
        'name.required' => 'Nama pemilik wajib diisi.',
        'username.required' => 'Username tidak boleh kosong.',
        'username.unique' => 'Username ini sudah digunakan.',
        'email.required' => 'Alamat email wajib diisi.',
        'email.email' => 'Format email tidak valid.',
        'email.unique' => 'Email ini sudah terdaftar.',
        'nama_brand.required' => 'Nama brand wajib diisi.',
        'no_telp.required' => 'Nomor telepon wajib diisi.',
        'password.required' => 'Password wajib diisi.',
        'password.min' => 'Password minimal harus 6 karakter.',
        'password.confirmed' => 'Konfirmasi password tidak cocok.',
    ]);

    User::create([
        'name' => $request->name,
        'username' => $request->username,
        'email' => $request->email,
        'nama_brand' => $request->nama_brand,
        'no_telp' => $request->no_telp,
        'role' => 'customer',
        'password' => Hash::make($request->password)
    ]);

    return redirect()->route('login')->with('success', 'Register berhasil');
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
}