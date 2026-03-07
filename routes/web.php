<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AdminDashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/


/*
|--------------------------------------------------------------------------
| HALAMAN PUBLIK
|--------------------------------------------------------------------------
*/

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/layanan', [PageController::class, 'layanan'])->name('layanan');
Route::get('/layanan/{jenis}', [PageController::class, 'detailLayanan'])->name('detail.layanan');
Route::get('/tentang-kami', [PageController::class, 'tentangKami'])->name('tentang-kami');
Route::get('/kontak', [PageController::class, 'kontak'])->name('kontak');


/*
|--------------------------------------------------------------------------
| AUTENTIKASI
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| DASHBOARD USER
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

});


/*
|--------------------------------------------------------------------------
| PEMESANAN
|--------------------------------------------------------------------------
*/

Route::prefix('pemesanan')
->middleware(['auth'])
->name('pemesanan.')
->group(function () {

    Route::get('/pengajuan', [PemesananController::class, 'pengajuan'])->name('pengajuan');
    Route::post('/pengajuan', [PemesananController::class, 'store'])->name('store');

    Route::get('/pilih-aroma', [PemesananController::class, 'pilihAroma'])->name('pilih-aroma');

    Route::get('/checkout', [PemesananController::class, 'checkout'])->name('checkout');
    Route::post('/checkout/process', [PemesananController::class, 'processCheckout'])->name('checkout.process');

});


/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
->middleware(['auth'])
->name('admin.')
->group(function () {

    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('/pengajuan', [AdminDashboardController::class, 'pengajuan'])->name('pengajuan');

    Route::get('/produksi', [AdminDashboardController::class, 'produksi'])->name('produksi');

    Route::get('/komponen-produksi', [AdminDashboardController::class, 'komponenproduksi'])->name('komponen.produksi');

});


/*
|--------------------------------------------------------------------------
| ACCOUNT
|--------------------------------------------------------------------------
*/

Route::prefix('account')
->middleware(['auth'])
->name('account.')
->group(function () {

    Route::get('/', [AccountController::class, 'settings'])->name('settings');

    Route::put('/profile', [AccountController::class, 'updateProfile'])->name('update-profile');

    Route::put('/password', [AccountController::class, 'updatePassword'])->name('update-password');

});


/*
|--------------------------------------------------------------------------
| TRACKING
|--------------------------------------------------------------------------
*/

Route::prefix('tracking')->name('tracking.')->group(function () {

    Route::get('/', [TrackingController::class, 'index'])->name('index');

    Route::get('/{id}', [TrackingController::class, 'detail'])->name('detail');

});