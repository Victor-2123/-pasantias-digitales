<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\LearningPath;
use App\Models\VocationalTestResult;
use Illuminate\Http\Request;

class PublicPortfolioController extends Controller
{
    /**
     * List all public portfolios.
     */
    public function index()
    {
        $students = User::where('user_type', 'estudiante')
            ->where('is_public', true)
            ->whereNotNull('username')
            ->orderBy('name')
            ->paginate(12);

        return view('portfolio.index', compact('students'));
    }

    /**
     * Display the public portfolio of a student.
     */
    public function show(string $username)
    {
        $user = User::where('username', $username)->firstOrFail();

        // Security check: If the profile is not public, only the owner can see it
        if (!$user->is_public && auth()->id() !== $user->id) {
            abort(403, 'Este perfil es privado.');
        }

        // Load vocational result
        $vocationalResult = $user->vocationalTestResult;

        // Load completed learning paths (Badges)
        // A path is completed if all its challenges have an approved submission by the user
        $learningPaths = LearningPath::with('challenges')->get();
        $completedPaths = [];

        foreach ($learningPaths as $path) {
            $totalChallenges = $path->challenges->count();
            if ($totalChallenges === 0) continue;

            $approvedSubmissions = $user->taskSubmissions()
                ->whereIn('challenge_id', $path->challenges->pluck('id'))
                ->where('status', 'approved')
                ->count();

            if ($approvedSubmissions === $totalChallenges) {
                $completedPaths[] = $path;
            }
        }

        return view('portfolio.show', compact('user', 'vocationalResult', 'completedPaths'));
    }
}
