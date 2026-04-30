<?php

namespace App\Observers;

use App\Models\Challenge;
use App\Models\User;
use App\Notifications\NewChallengeNotification;
use Illuminate\Support\Facades\Notification;

class ChallengeObserver
{
    /**
     * Handle the Challenge "created" event.
     */
    public function created(Challenge $challenge): void
    {
        // Notify all students when a new challenge is created
        $students = User::where('user_type', 'estudiante')->get();
        
        Notification::send($students, new NewChallengeNotification($challenge));
    }
}
