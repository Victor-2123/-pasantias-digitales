<?php

namespace App\Http\Controllers;

use App\Models\LearningPath;
use App\Models\TaskSubmission;
use Illuminate\Support\Facades\Auth;

class LearningPathController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $paths = LearningPath::with('challenges.submissions')->get()
            ->map(function ($path) use ($user) {
                $total    = $path->challenges->count();
                $approved = $path->challenges->flatMap->submissions
                    ->where('user_id', $user->id)
                    ->where('status', 'approved')
                    ->count();

                $path->total_challenges   = $total;
                $path->approved_count     = $approved;
                $path->progress_pct       = $total > 0 ? round(($approved / $total) * 100) : 0;
                $path->is_complete        = $total > 0 && $approved >= $total;

                return $path;
            });

        return view('learning-paths.index', compact('paths'));
    }
}
