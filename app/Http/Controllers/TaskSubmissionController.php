<?php

namespace App\Http\Controllers;

use App\Models\Challenge;
use App\Models\TaskSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class TaskSubmissionController extends Controller
{
    /**
     * Store a new task submission with secure file upload.
     */
    public function store(Request $request, Challenge $challenge)
    {
        $request->validate([
            'file' => 'required|file|mimes:pdf,jpg,jpeg,png,zip|max:20480', // 20MB max
        ]);

        $file = $request->file('file');
        $originalName = $file->getClientOriginalName();
        
        // Save to "local" disk (storage/app) for security - NOT publicly accessible
        $path = $file->store('submissions', 'local');

        $submission = TaskSubmission::create([
            'user_id'       => auth()->id(),
            'challenge_id'  => $challenge->id,
            'file_path'     => $path,
            'original_name' => $originalName,
            'status'        => 'pending',
        ]);

        // Notify mentors
        try {
            $mentors = \App\Models\User::where('user_type', 'maestro')->get();
            \Illuminate\Support\Facades\Notification::send($mentors, new \App\Notifications\TaskSubmittedNotification($submission));
        } catch (\Exception $e) {
            // Silently fail if notification system is not fully ready
        }

        return back()->with('success', '¡Evidencia enviada correctamente!');
    }

    /**
     * Securely download the submission attachment.
     */
    public function download(TaskSubmission $submission)
    {
        // Authorization: Only mentors or the student who submitted it
        if (auth()->user()->user_type !== 'maestro' && 
            auth()->user()->user_type !== 'administrador' && 
            auth()->id() !== $submission->user_id) {
            abort(403, 'No tienes permiso para descargar este archivo.');
        }

        if (!Storage::disk('local')->exists($submission->file_path)) {
            abort(404, 'El archivo no existe en el servidor.');
        }

        return Storage::disk('local')->download(
            $submission->file_path, 
            $submission->original_name
        );
    }
}
