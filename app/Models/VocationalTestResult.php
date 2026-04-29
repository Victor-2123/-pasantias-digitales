<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VocationalTestResult extends Model
{
    protected $fillable = [
        'user_id',
        'dominant_area',
        'dominant_name',
        'score_a',
        'score_b',
        'score_c',
        'score_d',
        'careers_suggested',
    ];

    protected $casts = [
        'careers_suggested' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Human-friendly label for the dominant area color.
     */
    public function getColorAttribute(): string
    {
        return match ($this->dominant_area) {
            'A' => 'blue',
            'B' => 'emerald',
            'C' => 'amber',
            'D' => 'violet',
            default => 'blue',
        };
    }

    /**
     * Emoji icon for the dominant area.
     */
    public function getIconAttribute(): string
    {
        return match ($this->dominant_area) {
            'A' => '⚙️',
            'B' => '🩺',
            'C' => '💼',
            'D' => '🎨',
            default => '🎓',
        };
    }
}
