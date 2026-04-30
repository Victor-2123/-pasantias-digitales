<?php

namespace App\Http\Controllers;

use App\Models\TaskSubmission;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, TaskSubmission $submission)
    {
        $validated = $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        $comment = new Comment();
        $comment->body = $validated['body'];
        $comment->user_id = auth()->id();
        $comment->task_submission_id = $submission->id;
        $comment->save();

        return redirect()->back()->with('success', 'Comentario enviado.');
    }
}
