<?php

namespace App\Notifications;

use App\Models\Challenge;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewChallengeNotification extends Notification
{
    use Queueable;

    protected $challenge;

    /**
     * Create a new notification instance.
     */
    public function __construct(Challenge $challenge)
    {
        $this->challenge = $challenge;
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
            'challenge_id'    => $this->challenge->id,
            'challenge_title' => $this->challenge->title,
            'message'         => "Se ha asignado un nuevo desafío: '{$this->challenge->title}'.",
            'url'             => route('courses.index'),
        ];
    }
}
