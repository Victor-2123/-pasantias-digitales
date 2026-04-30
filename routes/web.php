<?php

use App\Http\Controllers\CareerController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\LearningPathController;
use App\Http\Controllers\MentorReviewController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskSubmissionController;
use App\Http\Controllers\TestVocacionalController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// ── Career routes (public) ─────────────────────────────────────────────
Route::get('/careers', [CareerController::class, 'index'])->name('careers.index');
Route::get('/careers/{slug}', [CareerController::class, 'show'])->name('careers.show');

// ── Companies / Allies (public) ────────────────────────────────────────
Route::get('/empresas', [CompanyController::class, 'index'])->name('companies.index');
Route::get('/empresas/{company:slug}', [CompanyController::class, 'show'])->name('companies.show');

// ── Vocational Test (public) ───────────────────────────────────────────
Route::get('/test-vocacional', [TestVocacionalController::class, 'index'])->name('vocacional.test');

/*
|--------------------------------------------------------------------------
| Auth + Verified routes
|--------------------------------------------------------------------------
*/

// Start registration flow for a specific user type (estudiante/maestro)
Route::get('/register/prepare/{type}', [App\Http\Controllers\Auth\RegisteredUserController::class, 'prepare'])
    ->where('type', 'estudiante|maestro')
    ->name('register.prepare');

Route::post('/register/prepare', [App\Http\Controllers\Auth\RegisteredUserController::class, 'prepareStore'])
    ->name('register.prepare.store');

Route::middleware(['auth', 'verified'])->group(function () {

    // ── Dashboard ──────────────────────────────────────────────────────
    Route::get('/dashboard', function () {
        $hasSubmittedChallenge = \App\Models\TaskSubmission::where('user_id', auth()->id())
            ->where('challenge_id', 1)
            ->exists();

        $vocationalResult = auth()->user()->vocationalTestResult;

        return view('dashboard', compact('hasSubmittedChallenge', 'vocationalResult'));
    })->name('dashboard');

    // ── Mis Cursos ─────────────────────────────────────────────────────
    Route::get('/mis-cursos', function () {
        if (auth()->user()->user_type === 'maestro') {
            $challenge = \App\Models\Challenge::where('mentor_id', auth()->id())->first() ?? \App\Models\Challenge::first();
            $students = \App\Models\User::where('user_type', 'estudiante')
                ->with(['taskSubmissions' => function ($q) use ($challenge) {
                    if ($challenge) {
                        $q->where('challenge_id', $challenge->id);
                    }
                }])->get();
            return view('courses.index', compact('students', 'challenge'));
        }

        $hasSubmittedChallenge = \App\Models\TaskSubmission::where('user_id', auth()->id())
            ->where('challenge_id', 1)
            ->exists();

        return view('courses.index', compact('hasSubmittedChallenge'));
    })->middleware('auth')->name('courses.index');

    // ── Mentor dashboard ───────────────────────────────────────────────
    Route::get('/dashboard/mentor', [MentorReviewController::class, 'index'])->name('dashboard.mentor');

    // ── Task Submissions ───────────────────────────────────────────────
    Route::post('/challenges/{challenge}/submit', [TaskSubmissionController::class, 'store'])->name('challenges.submit');
    Route::patch('/submissions/{submission}/review', [MentorReviewController::class, 'review'])->name('submissions.review');

    // ── Comments (discussion thread on a submission) ────────────────────
    Route::post('/submissions/{submission}/comments', [CommentController::class, 'store'])->name('submissions.comments.store');

    // ── Vocational Test Save (JSON, authenticated only) ────────────────
    Route::post('/test-vocacional/save', [TestVocacionalController::class, 'save'])->name('vocacional.save');

    // ── Learning Paths (Obj 7 – Gamification) ─────────────────────────
    Route::get('/mi-ruta', [LearningPathController::class, 'index'])->name('learning-paths.index');

    // ── PDF Certificates (Obj 8) ───────────────────────────────────────
    Route::get('/certificado/vocacional', [CertificateController::class, 'vocacional'])->name('certificates.vocacional');
    Route::get('/certificado/pasantia', [CertificateController::class, 'pasantia'])->name('certificates.pasantia');

    // ── Profile ────────────────────────────────────────────────────────
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ── Gestión de Usuarios (Admin only – enforced inside controller) ──
    Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
    Route::patch('/usuarios/{user}/role', [UsuarioController::class, 'changeRole'])->name('usuarios.changeRole');
    Route::patch('/usuarios/{user}/suspend', [UsuarioController::class, 'toggleSuspend'])->name('usuarios.toggleSuspend');
});

require __DIR__ . '/auth.php';
