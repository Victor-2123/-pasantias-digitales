<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\TaskSubmission;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, TaskSubmission $submission)
    {
        $request->validate(['body' => 'required|string|max:2000']);

        $comment = $submission->comments()->create([
            'user_id' => auth()->id(),
            'body'    => $request->body,
        ]);

        // 1. Notify the owner of the submission (if it's not the commenter themselves)
        if ($submission->user_id !== auth()->id()) {
            $submission->user->notify(new \App\Notifications\CommentRepliedNotification($comment));
        }

        // 2. Notify all other people who have already commented on this submission
        $otherCommenters = $submission->comments()
            ->where('user_id', '!=', auth()->id())
            ->where('user_id', '!=', $submission->user_id)
            ->pluck('user_id')
            ->unique();

        foreach ($otherCommenters as $userId) {
            \App\Models\User::find($userId)->notify(new \App\Notifications\CommentRepliedNotification($comment));
        }

        return back()->with('success', 'Comentario enviado.');
    }
}
