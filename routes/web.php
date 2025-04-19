<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\ServiceTypeController;
use App\Http\Controllers\ServiceCardController;
use App\Http\Controllers\PhoneController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Change the root route to use HomeController
// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/services/{serviceCard}', [HomeController::class, 'showService'])->name('service.show');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Admin routes
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('banners', BannerController::class);
        Route::resource('service-types', ServiceTypeController::class);
        Route::resource('service-cards', ServiceCardController::class);
        Route::resource('phones', PhoneController::class);
    });
});

require __DIR__.'/auth.php';
