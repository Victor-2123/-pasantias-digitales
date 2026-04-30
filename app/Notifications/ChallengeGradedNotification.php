<?php
 
namespace App\Notifications;
 
use App\Models\TaskSubmission;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
 
class ChallengeGradedNotification extends Notification
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
        $statusLabel = $this->submission->status === 'approved' ? 'aprobado' : 'rechazado';
        
        return [
            'submission_id' => $this->submission->id,
            'challenge_id'  => $this->submission->challenge_id,
            'challenge_title' => $this->submission->challenge->title,
            'status'        => $this->submission->status,
            'score'         => $this->submission->score,
            'message'       => "Tu entrega del desafío '{$this->submission->challenge->title}' ha sido {$statusLabel}.",
            'url'           => route('dashboard'), // Or a more specific route if available
        ];
    }
}
