<?php

namespace App\Http\Controllers;

use App\Models\TaskSubmission;
use App\Models\Challenge;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Redirect based on role if they hit the generic dashboard route
        if ($user->user_type === 'maestro') {
            return redirect()->route('dashboard.mentor');
        }

        if ($user->user_type === 'administrador') {
            return redirect()->route('admin.dashboard');
        }

        // Student Dashboard logic
        $pendingChallenges = Challenge::with('career')
            ->whereDoesntHave('submissions', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->orderBy('created_at', 'desc')->get();

        $vocationalResult = $user->vocationalTestResult;

        return view('dashboard', compact('pendingChallenges', 'vocationalResult'));
    }

    public function courses()
    {
        $user = auth()->user();

        if ($user->user_type === 'maestro') {
            $challenge = Challenge::where('mentor_id', $user->id)->first() ?? Challenge::first();
            $students = User::where('user_type', 'estudiante')
                ->with(['taskSubmissions' => function ($q) use ($challenge) {
                    if ($challenge) {
                        $q->where('challenge_id', $challenge->id);
                    }
                }])->get();
            return view('courses.index', compact('students', 'challenge'));
        }

        // Student Dashboard logic: Get all challenges that the user has NOT submitted yet
        $pendingChallenges = Challenge::with('career')
            ->whereDoesntHave('submissions', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->orderBy('created_at', 'desc')->get();

        return view('courses.index', compact('pendingChallenges'));
    }
}
