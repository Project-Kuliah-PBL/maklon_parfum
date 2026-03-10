<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\KomponenProduksiController;
use App\Http\Controllers\Admin\RiwayatPesananController;

/*
|--------------------------------------------------------------------------
| HALAMAN PUBLIK
|--------------------------------------------------------------------------
*/

Route::controller(PageController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/layanan', 'layanan')->name('layanan');
    Route::get('/layanan/{jenis}', 'detailLayanan')->name('detail.layanan');
    Route::get('/tentang-kami', 'tentangKami')->name('tentang-kami');
    Route::get('/kontak', 'kontak')->name('kontak');
});


/*
|--------------------------------------------------------------------------
| AUTH (Hanya untuk Guest)
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login');
    Route::get('/register', 'showRegisterForm')->name('register');
    Route::post('/register', 'register');
});


/*
|--------------------------------------------------------------------------
| LOGOUT
|--------------------------------------------------------------------------
*/

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


/*
|--------------------------------------------------------------------------
| CLIENT AREA
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:customer'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('pemesanan')->name('pemesanan.')->group(function () {
        Route::get('/pengajuan', [PemesananController::class, 'pengajuan'])->name('pengajuan');
        Route::post('/pengajuan', [PemesananController::class, 'store'])->name('store');
        Route::get('/pilih-aroma', [PemesananController::class, 'pilihAroma'])->name('pilih-aroma');
        Route::get('/checkout', [PemesananController::class, 'checkout'])->name('checkout');
        Route::post('/checkout/process', [PemesananController::class, 'processCheckout'])->name('checkout.process');
    });

    Route::prefix('tracking')->name('tracking.')->group(function () {
        Route::get('/', [TrackingController::class, 'index'])->name('index');
        Route::get('/{id}', [TrackingController::class, 'detail'])->name('detail');
    });

    Route::prefix('account')->name('account.')->group(function () {
        Route::get('/', [AccountController::class, 'settings'])->name('settings');
        Route::put('/profile', [AccountController::class, 'updateProfile'])->name('update-profile');
        Route::put('/password', [AccountController::class, 'updatePassword'])->name('update-password');
    });
});


/*
|--------------------------------------------------------------------------
| ADMIN PANEL
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->middleware(['auth', 'role:admin'])
    ->name('admin.')
    ->group(function () {

        /* -------------------------------------------------------
         | Dashboard
         * ----------------------------------------------------- */
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        /* -------------------------------------------------------
         | Pengajuan — list + setuju + tolak
         * ----------------------------------------------------- */
        Route::get('/pengajuan', [AdminDashboardController::class, 'pengajuan'])
            ->name('pengajuan');

        Route::post('/pengajuan/{id}/setuju', [AdminDashboardController::class, 'setujuPengajuan'])
            ->name('pengajuan.setuju');

        Route::post('/pengajuan/{id}/tolak', [AdminDashboardController::class, 'tolakPengajuan'])
            ->name('pengajuan.tolak');

        /* -------------------------------------------------------
         | Produksi — list + update progress
         * ----------------------------------------------------- */
        Route::get('/produksi', [AdminDashboardController::class, 'produksi'])
            ->name('produksi');

        Route::post('/produksi/{id}/update', [AdminDashboardController::class, 'updateProduksi'])
            ->name('produksi.update');

        /* -------------------------------------------------------
         | Komponen Produksi — halaman
         * ----------------------------------------------------- */
        Route::get('/komponen-produksi', [AdminDashboardController::class, 'komponenproduksi'])
            ->name('komponen.produksi');

        /* -------------------------------------------------------
         | CRUD AROMA
         * ----------------------------------------------------- */
        Route::post('/aroma', [KomponenProduksiController::class, 'storeAroma'])
            ->name('aroma.store');

        Route::put('/aroma/{id}', [KomponenProduksiController::class, 'updateAroma'])
            ->name('aroma.update');

        Route::delete('/aroma/{id}', [KomponenProduksiController::class, 'deleteAroma'])
            ->name('aroma.delete');

        /* -------------------------------------------------------
         | CRUD KEMASAN
         * ----------------------------------------------------- */
        Route::post('/kemasan', [KomponenProduksiController::class, 'storeKemasan'])
            ->name('kemasan.store');

        Route::put('/kemasan/{id}', [KomponenProduksiController::class, 'updateKemasan'])
            ->name('kemasan.update');

        Route::delete('/kemasan/{id}', [KomponenProduksiController::class, 'deleteKemasan'])
            ->name('kemasan.delete');

        /* -------------------------------------------------------
         | Riwayat Pesanan
         * ----------------------------------------------------- */
        Route::get('/riwayat-pesanan', [RiwayatPesananController::class, 'index'])
            ->name('riwayat.pesanan');

        Route::get('/riwayat-pesanan/search', [RiwayatPesananController::class, 'search'])
            ->name('riwayat.search');

        Route::get('/riwayat-pesanan/export/csv', [RiwayatPesananController::class, 'exportCsv'])
            ->name('riwayat.export.csv');

        Route::get('/riwayat-pesanan/export/pdf', [RiwayatPesananController::class, 'exportPdf'])
            ->name('riwayat.export.pdf');

        // ⚠️ Route dengan {id} harus PALING BAWAH agar tidak menimpa /export/csv, /search
        Route::get('/riwayat-pesanan/{id}', [RiwayatPesananController::class, 'show'])
            ->name('riwayat.show');
    });
