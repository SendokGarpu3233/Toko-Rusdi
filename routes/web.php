<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;

// Route Autentikasi (Login & Logout)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth');

// Semua route aplikasi dilindungi middleware auth (wajib login)
Route::middleware('auth')->group(function () {
    // Route Beranda / Dashboard
    Route::get('/', [BerandaController::class, 'getBeranda']);

    // Route About & Contact
    Route::get('/about', [AboutController::class, 'getAbout']);
    Route::get('/about/{id}', function () {
        return view('pages.detail');
    });
    Route::get('/contact', [ContactController::class, 'getContact']);

    // Route Produk
    Route::get('/produk', [ProdukController::class, 'index']);
    Route::get('/produk/create', [ProdukController::class, 'create']);
    Route::post('/produk', [ProdukController::class, 'store']);

    // Route Sampah Produk (khusus Super Admin)
    Route::get('/produk/trash', [ProdukController::class, 'trash']);
    Route::put('/produk/{id}/restore', [ProdukController::class, 'restore']);
    Route::delete('/produk/{id}/force-delete', [ProdukController::class, 'forceDelete']);

    Route::get('/produk/{id_produk}', [ProdukController::class, 'show']);
    Route::get('/produk/{id}/edit', [ProdukController::class, 'edit']);
    Route::put('/produk/{id}', [ProdukController::class, 'update']);
    Route::delete('/produk/{id}', [ProdukController::class, 'destroy']);

    // Route Kategori & Sampah Kategori
    Route::put('/Kategori/{id}/restore', [KategoriController::class, 'restore']);
    Route::delete('/Kategori/{id}/force-delete', [KategoriController::class, 'forceDelete']);
    Route::resource('Kategori', KategoriController::class);

    // Route Profil
    Route::get('/profil', [ProfileController::class, 'edit']);
    Route::put('/profil', [ProfileController::class, 'update']);
});
