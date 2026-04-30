<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Challenge extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'career_id',
        'mentor_id',
        'difficulty',
        'expires_at',
        'company_id',
        'learning_path_id',
        'order',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
    ];

    public function career(): BelongsTo
    {
        return $this->belongsTo(Career::class);
    }

    public function mentor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function learningPath(): BelongsTo
    {
        return $this->belongsTo(LearningPath::class);
    }

    public function submissions(): HasMany
    {
        return $this->hasMany(TaskSubmission::class);
    }
}
