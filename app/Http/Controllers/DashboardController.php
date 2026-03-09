<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard user
     */
    public function index()
    {
        return view('user.dashboard_user');
    }
}