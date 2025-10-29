<?php

use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;

Route::name('courses.')->group(function () {
    Route::get('/', [CourseController::class, 'index'])->name('index');
    Route::get('/create', [CourseController::class, 'create'])->name('create');
    Route::post('/store', [CourseController::class, 'store'])->name('store');
    Route::get('/module/view/{course}', [CourseController::class, 'module_view'])->name('module.view');
});
