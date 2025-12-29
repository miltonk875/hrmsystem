<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\PasswordController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
    Route::get('forgot-password', [PasswordController::class, 'create'])->name('password.request');
    Route::post('forgot-password', [PasswordController::class, 'store'])->name('password.email');
    Route::get('otp-verification', [PasswordController::class, 'otp'])->name('otp.verify');
    Route::post('resend-otp', [PasswordController::class, 'resend'])->name('resend.otp');
    Route::post('verify-otp', [PasswordController::class, 'verify'])->name('verify.otp');
    Route::get('reset-password', [PasswordController::class, 'reset'])->name('password.reset');
    Route::post('password-update', [PasswordController::class, 'update'])->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
