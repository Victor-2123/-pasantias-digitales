<?php

namespace App\Http\Controllers;

use App\Models\TaskSubmission;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MentorReviewController extends Controller
{
    public function index()
    {
        $pending = TaskSubmission::where('status', 'pending')
            ->with(['user', 'challenge'])
            ->orderBy('created_at', 'asc')
            ->get();

        $reviewed = TaskSubmission::whereIn('status', ['approved', 'rejected'])
            ->with(['user', 'challenge'])
            ->orderBy('reviewed_at', 'desc')
            ->take(20)
            ->get();

        return view('dashboard.mentor', compact('pending', 'reviewed'));
    }

    public function review(Request $request, TaskSubmission $submission)
    {
        $validated = $request->validate([
            'status' => 'required|in:approved,rejected',
            'score' => 'required|integer|min:0|max:100',
            'feedback' => 'required|string',
        ]);

        $submission->update([
            'status' => $validated['status'],
            'score' => $validated['score'],
            'feedback' => $validated['feedback'],
            'reviewed_by' => auth()->id(),
            'reviewed_at' => now(),
        ]);

        // Send notification if possible (skipping for now to avoid errors if not configured)
        // auth()->user()->notify(new ChallengeGradedNotification($submission));

        return redirect()->route('dashboard.mentor')->with('success', 'Calificación guardada correctamente.');
    }
}
