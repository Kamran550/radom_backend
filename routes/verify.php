<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Verify\Verify;

Route::name('verify.')->group(function () {
    Route::get('/{verificationCode?}', Verify::class)->name('index');
});