<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
     * Proses login (akan diisi nanti)
     */
    public function login(Request $request)
    {
        // Logic login akan diisi nanti
        return redirect()->route('dashboard');
    }

    /**
     * Proses register (akan diisi nanti)
     */
    public function register(Request $request)
    {
        // Logic register akan diisi nanti
        return redirect()->route('home');
    }

    /**
     * Proses logout (akan diisi nanti)
     */
    public function logout(Request $request)
    {
        // Logic logout akan diisi nanti
        return redirect()->route('home');
    }
}