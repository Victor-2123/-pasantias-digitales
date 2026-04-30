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
use App\Http\Controllers\ChallengeController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\PublicPortfolioController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/u/{username}', [PublicPortfolioController::class, 'show'])->name('portfolio.show');
Route::get('/portafolios', [PublicPortfolioController::class, 'index'])->name('portfolio.index');

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

// ── Onboarding (Step-by-Step Profile) ─────────────────────────────────
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/onboarding', [App\Http\Controllers\OnboardingController::class, 'index'])->name('onboarding.index');
    Route::post('/onboarding', [App\Http\Controllers\OnboardingController::class, 'store'])->name('onboarding.store');
});

Route::middleware(['auth', 'verified', 'check.profile'])->group(function () {

    // ── Dashboard ──────────────────────────────────────────────────────
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    // ── Mis Cursos ─────────────────────────────────────────────────────
    Route::get('/mis-cursos', [\App\Http\Controllers\DashboardController::class, 'courses'])->name('courses.index');

    // ── Mentor dashboard ───────────────────────────────────────────────
    Route::get('/dashboard/mentor', [MentorReviewController::class, 'index'])->name('dashboard.mentor');

    // ── Challenge Management (Obj 13) ──────────────────────────────────
    Route::get('/mis-retos/gestionar', [ChallengeController::class, 'index'])->name('challenges.manage');
    Route::get('/mis-retos/crear', [ChallengeController::class, 'create'])->name('challenges.create');
    Route::post('/mis-retos', [ChallengeController::class, 'store'])->name('challenges.store');
    Route::get('/mis-retos/{challenge}/editar', [ChallengeController::class, 'edit'])->name('challenges.edit');
    Route::put('/mis-retos/{challenge}', [ChallengeController::class, 'update'])->name('challenges.update');
    Route::delete('/mis-retos/{challenge}', [ChallengeController::class, 'destroy'])->name('challenges.destroy');

    // ── Task Submissions ───────────────────────────────────────────────
    Route::post('/challenges/{challenge}/submit', [TaskSubmissionController::class, 'store'])->name('challenges.submit');
    Route::get('/submissions/{submission}/download', [TaskSubmissionController::class, 'download'])->name('submissions.download');
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

    // ── Notifications ──────────────────────────────────────────────────
    Route::post('/notifications/mark-all-as-read', [App\Http\Controllers\NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');
    Route::get('/notifications/{id}/read', [App\Http\Controllers\NotificationController::class, 'read'])->name('notifications.read');

    // ── Profile ────────────────────────────────────────────────────────
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.show');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ── Admin Analytics (Obj 12) ───────────────────────────────────────
    Route::get('/admin/dashboard', [App\Http\Controllers\AdminDashboardController::class, 'index'])
        ->name('admin.dashboard');

    // ── Admin Content Management (Obj 13) ──────────────────────────────
    Route::get('/admin/carreras', [CareerController::class, 'manage'])->name('careers.manage');
    Route::get('/admin/carreras/crear', [CareerController::class, 'create'])->name('careers.create');
    Route::post('/admin/carreras', [CareerController::class, 'store'])->name('careers.store');
    Route::get('/admin/carreras/{career}/editar', [CareerController::class, 'edit'])->name('careers.edit');
    Route::put('/admin/carreras/{career}', [CareerController::class, 'update'])->name('careers.update');
    Route::delete('/admin/carreras/{career}', [CareerController::class, 'destroy'])->name('careers.destroy');

    Route::get('/admin/empresas', [CompanyController::class, 'manage'])->name('companies.manage');
    Route::get('/admin/empresas/crear', [CompanyController::class, 'create'])->name('companies.create');
    Route::post('/admin/empresas', [CompanyController::class, 'store'])->name('companies.store');
    Route::get('/admin/empresas/{company}/editar', [CompanyController::class, 'edit'])->name('companies.edit');
    Route::put('/admin/empresas/{company}', [CompanyController::class, 'update'])->name('companies.update');
    Route::delete('/admin/empresas/{company}', [CompanyController::class, 'destroy'])->name('companies.destroy');

    // ── Gestión de Usuarios (Admin only – enforced inside controller) ──
    Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
    Route::patch('/usuarios/{user}/role', [UsuarioController::class, 'changeRole'])->name('usuarios.changeRole');
    Route::patch('/usuarios/{user}/suspend', [UsuarioController::class, 'toggleSuspend'])->name('usuarios.toggleSuspend');
});

require __DIR__ . '/auth.php';
