<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Menampilkan halaman home
     */
    public function home()
    {
        return view('pages.home');
    }

    /**
     * Menampilkan halaman tentang kami
     */
    public function tentangKami()
    {
        return view('pages.tentang-kami');
    }

    /**
     * Menampilkan halaman layanan utama
     */
    public function layanan()
    {
        return view('pages.layanan');
    }

    /**
     * Menampilkan detail layanan berdasarkan jenis
     */
    public function detailLayanan($jenis)
    {
        return view('pages.detail-layanan', ['jenis' => $jenis]);
    }

    
}