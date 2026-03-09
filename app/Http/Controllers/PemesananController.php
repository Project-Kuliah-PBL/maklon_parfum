<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PemesananController extends Controller
{
    /**
     * Menampilkan halaman pengajuan maklon
     */
    public function pengajuan()
    {
        return view('user.pemesanan.pengajuan_maklon');
    }

    /**
     * Menampilkan halaman pilih aroma
     */
    public function pilihAroma()
    {
        return view('user.pemesanan.piliharoma');
    }

    /**
     * Menampilkan halaman checkout
     */
    public function checkout()
    {
        return view('user.pemesanan.checkout');
    }

    /**
     * Proses penyimpanan pengajuan
     */
    public function store(Request $request)
    {
        // Logic untuk menyimpan pengajuan akan diisi nanti
        return redirect()->route('user.pemesanan.pilih-aroma')->with('success', 'Pengajuan berhasil disimpan');
    }

    /**
     * Proses checkout
     */
    public function processCheckout(Request $request)
    {
        // Logic untuk proses checkout akan diisi nanti
        return redirect()->route('user.tracking.index')->with('success', 'Pesanan berhasil diproses');
    }
}