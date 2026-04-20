<?php

use App\Http\Controllers\ProfileController;
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

// Role specific dashboards
Route::get('/dashboard/estudiante', function () {
    return view('dashboard-estudiante');
})->middleware(['auth', 'verified'])->name('dashboard.estudiante');

Route::get('/dashboard/maestro', function () {
    return view('dashboard-maestro');
})->middleware(['auth', 'verified'])->name('dashboard.maestro');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
