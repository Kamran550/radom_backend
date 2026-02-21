<?php

use Illuminate\Support\Facades\Route;


Route::domain('admin.must.edu.pl')->group(function () {
    require base_path('routes/admin.php');
});


Route::domain('teacher.must.edu.pl')->group(function () {
    require base_path('routes/teacher.php');
});


Route::domain('student.must.edu.pl')->group(function () {
    require base_path('routes/student.php');
});


Route::domain('validate.must.edu.pl')->group(function () {
    require base_path(path: 'routes/verify.php');
});