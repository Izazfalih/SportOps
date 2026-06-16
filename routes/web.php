<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('login');
    })->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.post');

    Route::get('/register', function () {
        return view('register');
    })->name('register');

    Route::post('/register', [AuthController::class, 'register'])
        ->name('register.post');
});

Route::middleware('auth')->group(function () {

    Route::get('/home', function () {
        return view('home');
    })->name('home');

    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    Route::get('/booking', [\App\Http\Controllers\BookingController::class, 'create'])->name('booking');
    Route::post('/booking', [\App\Http\Controllers\BookingController::class, 'store'])->name('booking.store');

    Route::get('/bookings', [\App\Http\Controllers\BookingController::class, 'index'])->name('bookings');

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    // ────────────── Admin Routes ──────────────
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', fn () => view('admin.dashboard'))->name('dashboard');
        Route::get('/courts', fn () => view('admin.courts'))->name('courts');
        Route::get('/bookings', fn () => view('admin.bookings'))->name('bookings');
        Route::get('/users', fn () => view('admin.users'))->name('users');
        Route::get('/reports', fn () => view('admin.reports'))->name('reports');
        Route::get('/settings', fn () => view('admin.settings'))->name('settings');
    });

    // ────────────── Staff Routes ──────────────
    Route::middleware('staff')->prefix('staff')->name('staff.')->group(function () {
        Route::get('/dashboard', fn () => view('staff.dashboard'))->name('dashboard');
        Route::get('/schedule', fn () => view('staff.schedule'))->name('schedule');
        Route::get('/checkin', fn () => view('staff.checkin'))->name('checkin');
        Route::get('/offline-booking', fn () => view('staff.offline-booking'))->name('offline-booking');
        Route::get('/settlement', fn () => view('staff.settlement'))->name('settlement');
    });
});
