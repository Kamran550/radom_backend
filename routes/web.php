<?php

use Illuminate\Support\Facades\Route;


Route::domain('admin.radomuniversity.pl')->group(function () {
    require base_path('routes/admin.php');
});


Route::domain('teacher.admin.radomuniversity.pl')->group(function () {
    require base_path('routes/teacher.php');
});


Route::domain('student.admin.radomuniversity.pl')->group(function () {
    require base_path('routes/student.php');
});


Route::domain('validate.admin.radomuniversity.pl')->group(function () {
    require base_path(path: 'routes/verify.php');
});