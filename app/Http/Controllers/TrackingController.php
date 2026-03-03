<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrackingController extends Controller
{
    /**
     * Menampilkan daftar tracking pesanan
     */
    public function index()
    {
        return view('tracking.tracking_user');
    }

    /**
     * Menampilkan detail tracking pesanan
     */
    public function detail($id)
    {
        return view('tracking.detail_user', ['id' => $id]);
    }
}