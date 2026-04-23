<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestVocacionalController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Start registration flow for a specific user type (estudiante/maestro)
Route::get('/register/prepare/{type}', [App\Http\Controllers\Auth\RegisteredUserController::class, 'prepare'])
    ->where('type', 'estudiante|maestro')
    ->name('register.prepare');

Route::post('/register/prepare', [App\Http\Controllers\Auth\RegisteredUserController::class, 'prepareStore'])
    ->name('register.prepare.store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/mis-cursos', function () {
    return view('courses.index');
})->middleware(['auth', 'verified'])->name('courses.index');

// Role specific dashboards
Route::get('/dashboard/mentor', function () {
    return view('dashboard.mentor');
})->middleware(['auth', 'verified'])->name('dashboard.mentor');

// Career routes
Route::get('/careers', function () {
    return view('careers.index');
})->name('careers.index');

// Vocational Test
Route::get('/test-vocacional', [TestVocacionalController::class, 'index'])->name('vocacional.test');

Route::get('/careers/software-architecture', function () {
    return view('careers.show');
})->name('careers.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
