<?php

namespace App\Notifications;

use App\Models\TaskSubmission;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class TaskSubmittedNotification extends Notification
{
    use Queueable;

    protected $submission;

    /**
     * Create a new notification instance.
     */
    public function __construct(TaskSubmission $submission)
    {
        $this->submission = $submission;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'submission_id' => $this->submission->id,
            'student_name'  => $this->submission->user->name,
            'challenge_title' => $this->submission->challenge->title,
            'message'       => "El estudiante {$this->submission->user->name} ha enviado una tarea para '{$this->submission->challenge->title}'.",
            'url'           => route('dashboard.mentor'),
        ];
    }
}
