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
    $hasSubmittedChallenge = \App\Models\TaskSubmission::where('user_id', auth()->id())
        ->where('challenge_id', 1)
        ->exists();

    return view('dashboard', compact('hasSubmittedChallenge'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/mis-cursos', function () {
    $hasSubmittedChallenge = \App\Models\TaskSubmission::where('user_id', auth()->id())
        ->where('challenge_id', 1)
        ->exists();

    return view('courses.index', compact('hasSubmittedChallenge'));
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
    Route::post('/challenges/{challenge}/submit', [\App\Http\Controllers\TaskSubmissionController::class, 'store'])->name('challenges.submit');

    Route::get('/usuarios', function () {
        $users = \App\Models\User::orderBy('created_at', 'desc')->get();
        return view('usuarios.index', compact('users'));
    })->name('usuarios.index');
});

require __DIR__.'/auth.php';
