<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\DashboardController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/produk', [ProdukController::class, 'list'])->name('produk.index');
Route::get('/produk/{slug}', [ProdukController::class, 'detail'])->name('produk.detail');

Route::get('/artikel', [ArtikelController::class, 'list'])->name('artikels.index');
Route::get('/artikel/{slug}', [ArtikelController::class, 'detail'])->name('artikel.detail');

Route::get('/welcome', function () {
    return view('welcome');
});

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Admin routes dengan middleware yang benar
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Resource Routes
    Route::resource('artikels', ArtikelController::class);
    Route::delete('produk/gambar/{id}', [ProdukController::class, 'deleteImage'])->name('produk.delete-image');
    Route::resource('produk', ProdukController::class);
    Route::resource('users', \App\Http\Controllers\UserController::class);
    Route::resource('testimoni', \App\Http\Controllers\TestimoniController::class);
    Route::get('activity-logs', [\App\Http\Controllers\Admin\ActivityLogController::class, 'index'])->name('activity-logs.index');
});