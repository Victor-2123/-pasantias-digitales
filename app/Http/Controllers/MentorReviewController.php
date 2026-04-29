<?php

namespace App\Http\Controllers;

use App\Models\TaskSubmission;
use Illuminate\Http\Request;

class MentorReviewController extends Controller
{
    /**
     * List all pending (and recent) task submissions for the mentor's review panel.
     */
    public function index()
    {
        // Only mentors may access this
        abort_unless(auth()->user()->user_type === 'maestro', 403, 'Acceso denegado.');

        $pending = TaskSubmission::with(['user', 'challenge'])
            ->where('status', 'pending')
            ->latest()
            ->get();

        $reviewed = TaskSubmission::with(['user', 'challenge'])
            ->whereIn('status', ['approved', 'rejected'])
            ->where('reviewed_by', auth()->id())
            ->latest('reviewed_at')
            ->limit(20)
            ->get();

        return view('dashboard.mentor', compact('pending', 'reviewed'));
    }

    /**
     * Submit a grade/feedback for a task submission.
     */
    public function review(Request $request, TaskSubmission $submission)
    {
        abort_unless(auth()->user()->user_type === 'maestro', 403);

        $validated = $request->validate([
            'status'   => 'required|in:approved,rejected',
            'score'    => 'nullable|integer|min:0|max:100',
            'feedback' => 'nullable|string|max:2000',
        ]);

        $submission->update([
            'status'      => $validated['status'],
            'score'       => $validated['score'] ?? null,
            'feedback'    => $validated['feedback'] ?? null,
            'reviewed_by' => auth()->id(),
            'reviewed_at' => now(),
        ]);

        return back()->with('success', 'Calificación guardada exitosamente.');
    }
}
