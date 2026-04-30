<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\LearningPath;
use Illuminate\Http\Request;

class PublicPortfolioController extends Controller
{
    public function index()
    {
        $students = User::where('user_type', 'estudiante')
            ->where('is_public', true)
            ->where('is_profile_complete', true)
            ->paginate(12);

        return view('portfolio.index', compact('students'));
    }

    public function show($username)
    {
        $user = User::where('username', $username)
            ->where('is_public', true)
            ->firstOrFail();

        $vocationalResult = $user->vocationalTestResult;
        
        // A path is completed if ALL its challenges have an approved submission from this user
        $completedPaths = LearningPath::with('challenges.submissions')->get()->filter(function($path) use ($user) {
            $total = $path->challenges->count();
            if ($total === 0) return false;
            
            $approvedCount = $path->challenges->filter(function($challenge) use ($user) {
                return $challenge->submissions->where('user_id', $user->id)->where('status', 'approved')->isNotEmpty();
            })->count();

            return $total === $approvedCount;
        });

        return view('portfolio.show', compact('user', 'vocationalResult', 'completedPaths'));
    }
}
