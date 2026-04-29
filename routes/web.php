<?php

use Illuminate\Support\Facades\Route;


Route::domain('admin.radomuniversity.pl')->group(function () {
    require base_path('routes/admin.php');
});


Route::domain('teacher.radomuniversity.pl')->group(function () {
    require base_path('routes/teacher.php');
});


Route::domain('student.radomuniversity.pl')->group(function () {
    require base_path('routes/student.php');
});


Route::domain('verify.radomuniversity.pl')->group(function () {
    require base_path(path: 'routes/verify.php');
});