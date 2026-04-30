<?php
 
namespace App\Notifications;
 
use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
 
class CommentRepliedNotification extends Notification
{
    use Queueable;
 
    protected $comment;
 
    /**
     * Create a new notification instance.
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
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
            'comment_id'    => $this->comment->id,
            'submission_id' => $this->comment->task_submission_id,
            'comment_body'  => $this->comment->body,
            'author_name'   => $this->comment->user->name,
            'message'       => "{$this->comment->user->name} comentó en una entrega.",
            'url'           => route('dashboard'), // Should ideally link to the specific submission/comment
        ];
    }
}
