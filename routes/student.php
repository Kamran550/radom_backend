<?php

use App\Livewire\Student\Dashboard;
use App\Livewire\Student\Auth\Login;
use App\Livewire\Student\Profil;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Apply\Student as ApplyStudent;
use App\Livewire\Admin\Apply\Transfer as ApplyTransfer;


// Login route (without middleware)

// Protected routes (with student middleware)
Route::name('student.')->group(function () {
    Route::get('/login', Login::class)->name('login');

    Route::prefix('apply')->name('apply.')->group(function () {
        Route::get('/student', ApplyStudent::class)->name('student');
        Route::get('/transfer', ApplyTransfer::class)->name('transfer');
    });

    Route::middleware('student')->group(function () {
        Route::get('/', Dashboard::class)->name('dashboard');
        Route::get('/profile', Profil::class)->name('profile');
    });
});