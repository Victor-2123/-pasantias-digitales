<?php

namespace App\Http\Controllers;

use App\Models\LearningPath;
use Illuminate\Http\Request;

class LearningPathController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        $paths = LearningPath::with(['challenges.submissions' => function($q) use ($userId) {
            $q->where('user_id', $userId);
        }])->orderBy('id')->get();

        foreach ($paths as $path) {
            $totalChallenges = $path->challenges->count();
            $approvedCount = $path->challenges->filter(function($challenge) use ($userId) {
                return $challenge->submissions->where('status', 'approved')->isNotEmpty();
            })->count();

            $path->total_challenges = $totalChallenges;
            $path->approved_count = $approvedCount;
            $path->progress_pct = $totalChallenges > 0 ? round(($approvedCount / $totalChallenges) * 100) : 0;
            $path->is_complete = ($totalChallenges > 0 && $approvedCount === $totalChallenges);
        }

        return view('learning-paths.index', compact('paths'));
    }
}
