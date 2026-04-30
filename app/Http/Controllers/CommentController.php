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

        $submission->comments()->create([
            'user_id' => auth()->id(),
            'body'    => $request->body,
        ]);

        return back()->with('success', 'Comentario enviado.');
    }
}
