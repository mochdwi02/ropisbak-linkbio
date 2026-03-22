<?php

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\BioLinkController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\LinkBioController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LinkBioController::class, 'index'])->name('bio.home');
Route::get('/go/{bioLink}', [LinkBioController::class, 'go'])->name('bio.go');

Route::middleware('guest')->group(function () {
    Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login');
});

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/analytics', [DashboardController::class, 'analytics'])->name('analytics');

    Route::resource('links', BioLinkController::class)->except('show')->parameters([
        'links' => 'link',
    ]);

    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
});
