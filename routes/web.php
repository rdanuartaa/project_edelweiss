<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PackageScheduleController;
use App\Http\Controllers\FacilityController;
use Illuminate\Support\Facades\Route;
// Halaman utama
Route::get('/', [MainController::class, 'index'])->name('home');

// Dashboard
Route::get('/dashboard', [MainController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Profile Routes
Route::middleware('auth')->group(function () {
});

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::resource('users', UserController::class)->except(['create', 'edit', 'show']); // kalau tidak pakai create/edit/show
    Route::put('/users/{user}/update-role', [UserController::class, 'updateRole'])->name('users.updateRole');
    Route::resource('packages', PackageController::class);
    Route::resource('facilities', FacilityController::class);
    Route::resource('package-schedules', PackageScheduleController::class);
    Route::get('package-schedules/{package_id}/{month}', [PackageScheduleController::class, 'show'])->name('package-schedules.show');
    Route::delete('package-schedules/{package_id}/{month}', [PackageScheduleController::class, 'destroyMonth'])->name('package-schedules.destroyMonth');
    Route::put('package-schedules/update-quota/{schedule}', [PackageScheduleController::class, 'updateQuota'])->name('package-schedules.updateQuota');
    Route::delete('package-schedules/delete-day/{schedule}', [PackageScheduleController::class, 'deleteDay'])->name('package-schedules.deleteDay');
    Route::post('/articles/gemini/generate', [ArticleController::class, 'generateArticleFromGemini'])->name('articles.gemini.generate');
    Route::get('/articles/show', [ArticleController::class, 'show'])->name('articles.show.latest');
    Route::resource('articles', ArticleController::class);
    Route::resource('tags', TagController::class);
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
