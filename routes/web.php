<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ArticleController;

// Halaman utama
Route::get('/', [MainController::class, 'index'])->name('home');

// Dashboard
Route::get('/dashboard', [MainController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index');
    Route::resource('artikel', ArticleController::class)->names('admin.artikel');
});

// Main Pages
Route::controller(MainController::class)->group(function () {
    Route::get('/index', 'index')->name('main.index');
    Route::get('/trip', 'trip')->name('main.trip');
    Route::get('/tutorial', 'tutorial')->name('main.tutorial');
    Route::get('/about', 'about')->name('main.about');

    // Untuk halaman daftar artikel di pengunjung
    Route::get('/artikel', 'artikel')->name('main.artikel');
});

// Auth Google
Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
Route::get('/login', fn () => redirect('/auth/google'))->name('login');

require __DIR__.'/auth.php';
