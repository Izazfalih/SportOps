<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
     return view('home');
})->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('user.login');
    })->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.post');

    Route::get('/register', function () {
        return view('user.register');
    })->name('register');

    Route::post('/register', [AuthController::class, 'register'])
        ->name('register.post');
});

Route::middleware('auth')->group(function () {

    // user.home route removed to allow route('home') to resolve to the landing page

    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    Route::get('/booking', [\App\Http\Controllers\BookingController::class, 'create'])->name('booking');
    Route::post('/booking', [\App\Http\Controllers\BookingController::class, 'store'])->name('booking.store');

    Route::get('/bookings', [\App\Http\Controllers\BookingController::class, 'index'])->name('bookings');

    Route::post('/reviews', [\App\Http\Controllers\ReviewController::class, 'store'])->name('reviews.store');

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    // ────────────── Admin Routes ──────────────
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/courts', [\App\Http\Controllers\AdminFieldController::class, 'index'])->name('courts.index');
        Route::post('/courts', [\App\Http\Controllers\AdminFieldController::class, 'store'])->name('courts.store');
        Route::put('/courts/{id}', [\App\Http\Controllers\AdminFieldController::class, 'update'])->name('courts.update');
        Route::patch('/courts/{id}/toggle-status', [\App\Http\Controllers\AdminFieldController::class, 'toggleStatus'])->name('courts.toggle-status');
        Route::delete('/courts/{id}', [\App\Http\Controllers\AdminFieldController::class, 'destroy'])->name('courts.destroy');
        Route::get('/bookings', [\App\Http\Controllers\AdminBookingController::class, 'index'])->name('bookings');
        Route::get('/users', [App\Http\Controllers\AdminUserController::class, 'index'])->name('users');
        Route::post('/users', [App\Http\Controllers\AdminUserController::class, 'store'])->name('users.store');
        Route::put('/users/{id}', [App\Http\Controllers\AdminUserController::class, 'update'])->name('users.update');
        Route::post('/users/{id}/toggle', [App\Http\Controllers\AdminUserController::class, 'toggleStatus'])->name('users.toggle');
        Route::get('/reports', [App\Http\Controllers\AdminReportController::class, 'index'])->name('reports');
        Route::get('/reports/export', [App\Http\Controllers\AdminReportController::class, 'exportCsv'])->name('reports.export');
        Route::get('/settings', [App\Http\Controllers\AdminSettingController::class, 'index'])->name('settings');
        Route::post('/settings', [App\Http\Controllers\AdminSettingController::class, 'update'])->name('settings.update');
    });

    // ────────────── Staff Routes ──────────────
    Route::middleware('staff')->prefix('staff')->name('staff.')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\StaffController::class, 'dashboard'])->name('dashboard');
        Route::get('/schedule', [\App\Http\Controllers\StaffController::class, 'schedule'])->name('schedule');
        Route::get('/verification', [\App\Http\Controllers\StaffController::class, 'verification'])->name('verification');
        Route::post('/verification/{id}', [\App\Http\Controllers\StaffController::class, 'processVerification'])->name('verification.process');
        Route::get('/offline-booking', [\App\Http\Controllers\StaffController::class, 'offlineBooking'])->name('offline-booking');
        Route::post('/offline-booking', [\App\Http\Controllers\StaffController::class, 'storeOfflineBooking'])->name('offline-booking.store');
        Route::get('/settlement', [\App\Http\Controllers\StaffController::class, 'settlement'])->name('settlement');
        Route::post('/settlement/{booking}', [\App\Http\Controllers\StaffController::class, 'storeSettlement'])->name('settlement.store');
    });
});
