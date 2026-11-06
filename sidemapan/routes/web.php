<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;

// Marketplace
use App\Http\Controllers\Pembeli\MarketplaceController;

// Dashboard
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Umkm\DashboardController as UmkmDashboardController;
use App\Http\Controllers\Pembeli\DashboardController as PembeliDashboardController;

// Admin
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProdukController;
use App\Http\Controllers\Admin\VerifikasiUmkmController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\LaporanPenjualanController as AdminLaporanPenjualanController;
use App\Http\Controllers\Admin\AspirasiController as AdminAspirasiController;

// UMKM
use App\Http\Controllers\Umkm\ProductController as UmkmProdukController;
use App\Http\Controllers\Umkm\OrderController as UmkmOrderController;
use App\Http\Controllers\Umkm\LaporanPenjualanController as UmkmLaporanPenjualanController;

// Pembeli
use App\Http\Controllers\Pembeli\CartController;
use App\Http\Controllers\Pembeli\CheckoutController;
use App\Http\Controllers\Pembeli\OrderController as PembeliOrderController;
use App\Http\Controllers\Pembeli\AspirasiController as PembeliAspirasiController;
use App\Http\Controllers\Pembeli\DashboardController;

/*
|--------------------------------------------------------------------------
| Halaman Utama
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

/*
|--------------------------------------------------------------------------
| Dashboard Admin
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');
    });


/*
|--------------------------------------------------------------------------
| Dashboard UMKM
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:umkm'])
    ->prefix('umkm')
    ->name('umkm.')
    ->group(function () {
        Route::get('/dashboard', [UmkmDashboardController::class, 'index'])
            ->name('dashboard');
    });


/*
|--------------------------------------------------------------------------
| Dashboard Pembeli
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:pembeli'])
    ->prefix('pembeli')
    ->name('pembeli.')
    ->group(function () {
        Route::get('/dashboard', [PembeliDashboardController::class, 'index'])
            ->name('dashboard');
    });


/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Kategori
        |--------------------------------------------------------------------------
        */

        Route::resource('kategori', CategoryController::class)
            ->except(['show']);


        /*
        |--------------------------------------------------------------------------
        | Produk
        |--------------------------------------------------------------------------
        */

        Route::resource(
    'produk',
    \App\Http\Controllers\Admin\ProductController::class
)
    ->parameters([
        'produk' => 'product',
    ])
    ->names('products');


        /*
        |--------------------------------------------------------------------------
        | Verifikasi UMKM
        |--------------------------------------------------------------------------
        */

        Route::get('/verifikasi-umkm', [VerifikasiUmkmController::class, 'index'])
            ->name('verifikasi.index');

        Route::get('/verifikasi-umkm/{umkm}', [VerifikasiUmkmController::class, 'show'])
            ->name('verifikasi.show');

        Route::put('/verifikasi-umkm/{umkm}/setujui', [VerifikasiUmkmController::class, 'setujui'])
            ->name('verifikasi.setujui');

        Route::put('/verifikasi-umkm/{umkm}/tolak', [VerifikasiUmkmController::class, 'tolak'])
            ->name('verifikasi.tolak');


        /*
        |--------------------------------------------------------------------------
        | Pesanan
        |--------------------------------------------------------------------------
        */

        Route::get('/pesanan', [AdminOrderController::class, 'index'])
            ->name('orders.index');

        Route::get('/pesanan/{order}', [AdminOrderController::class, 'show'])
            ->name('orders.show');

        Route::put('/pesanan/{order}/status', [AdminOrderController::class, 'updateStatus'])
            ->name('orders.updateStatus');


        /*
        |--------------------------------------------------------------------------
        | Laporan Penjualan
        |--------------------------------------------------------------------------
        */

        Route::get('/laporan-penjualan', [AdminLaporanPenjualanController::class, 'index'])
            ->name('laporan.index');


        /*
        |--------------------------------------------------------------------------
        | Aspirasi dan Pengaduan
        |--------------------------------------------------------------------------
        */

        Route::get('/aspirasi', [AdminAspirasiController::class, 'index'])
            ->name('aspirasi.index');

        Route::get('/aspirasi/{aspirasi}', [AdminAspirasiController::class, 'show'])
            ->name('aspirasi.show');

        Route::put('/aspirasi/{aspirasi}', [AdminAspirasiController::class, 'update'])
            ->name('aspirasi.update');
    });


/*
|--------------------------------------------------------------------------
| UMKM
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:umkm'])
    ->prefix('umkm')
    ->name('umkm.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Produk
        |--------------------------------------------------------------------------
        */

        Route::resource('produk', UmkmProdukController::class)
    ->names('products');


        /*
        |--------------------------------------------------------------------------
        | Pesanan
        |--------------------------------------------------------------------------
        */

        Route::get('/pesanan', [UmkmOrderController::class, 'index'])
            ->name('orders.index');

        Route::get('/pesanan/{order}', [UmkmOrderController::class, 'show'])
            ->name('orders.show');

        Route::put('/pesanan/{order}/status', [UmkmOrderController::class, 'updateStatus'])
            ->name('orders.updateStatus');


        /*
        |--------------------------------------------------------------------------
        | Laporan Penjualan
        |--------------------------------------------------------------------------
        */

        Route::get('/laporan-penjualan', [UmkmLaporanPenjualanController::class, 'index'])
            ->name('laporan.index');
    });


/*
|--------------------------------------------------------------------------
| PEMBELI
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:pembeli'])
    ->prefix('pembeli')
    ->name('pembeli.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Marketplace
        |--------------------------------------------------------------------------
        */

        Route::get('/marketplace', [MarketplaceController::class, 'index'])
            ->name('marketplace.index');

        Route::get('/marketplace/{slug}', [MarketplaceController::class, 'show'])
            ->name('marketplace.show');

        /*
        |--------------------------------------------------------------------------
        | Keranjang
        |--------------------------------------------------------------------------
        */

        Route::get('/keranjang', [CartController::class, 'index'])
            ->name('cart.index');

        Route::post('/keranjang', [CartController::class, 'store'])
            ->name('cart.store');

        Route::patch('/keranjang/{cart}', [CartController::class, 'update'])
            ->name('cart.update');

        Route::delete('/keranjang/{cart}', [CartController::class, 'destroy'])
            ->name('cart.destroy');


        /*
        |--------------------------------------------------------------------------
        | Checkout
        |--------------------------------------------------------------------------
        */

        Route::get('/checkout', [CheckoutController::class, 'index'])
            ->name('checkout.index');

        Route::post('/checkout', [CheckoutController::class, 'store'])
            ->name('checkout.store');


        /*
        |--------------------------------------------------------------------------
        | Riwayat Pesanan
        |--------------------------------------------------------------------------
        */

        Route::get('/pesanan', [PembeliOrderController::class, 'index'])
            ->name('orders.index');

        Route::get('/pesanan/{order}', [PembeliOrderController::class, 'show'])
            ->name('orders.show');


        /*
        |--------------------------------------------------------------------------
        | Aspirasi dan Pengaduan
        |--------------------------------------------------------------------------
        */

        Route::get('/aspirasi', [PembeliAspirasiController::class, 'index'])
            ->name('aspirasi.index');

        Route::get('/aspirasi/create', [PembeliAspirasiController::class, 'create'])
            ->name('aspirasi.create');

        Route::post('/aspirasi', [PembeliAspirasiController::class, 'store'])
            ->name('aspirasi.store');

        Route::get('/aspirasi/{aspirasi}', [PembeliAspirasiController::class, 'show'])
            ->name('aspirasi.show');
    });


/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

//require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

// Login dan Register
Route::middleware('guest')->group(function () {

    // Login
    Route::get('/login', [LoginController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [LoginController::class, 'login'])
        ->name('login.process');

    // Register
    Route::get('/register', [RegisterController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [RegisterController::class, 'register'])
        ->name('register.process');

});

Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');
//require __DIR__.'/auth.php';