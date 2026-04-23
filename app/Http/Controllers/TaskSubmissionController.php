<?php

namespace App\Http\Controllers;

use App\Models\Challenge;
use App\Models\TaskSubmission;
use Illuminate\Http\Request;

class TaskSubmissionController extends Controller
{
    public function store(Request $request, Challenge $challenge)
    {
        $request->validate([
            'file' => 'required|file|mimes:pdf,docx|max:10240', // 10MB max
        ]);

        $file = $request->file('file');
        
        $originalName = $file->getClientOriginalName();
        // Save the file on the "public" disk in the "submissions" directory
        $path = $file->store('submissions', 'public');

        TaskSubmission::create([
            'user_id' => auth()->id(),
            'challenge_id' => $challenge->id,
            'file_path' => $path,
            'original_name' => $originalName,
        ]);

        // In a real application we would flash a message, but since views are forbidden:
        // the frontend will just receive a redirect back for now.
        return back()->with('success', 'Tarea entregada exitosamente.');
    }
}
