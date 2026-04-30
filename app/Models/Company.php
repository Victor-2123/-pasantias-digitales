<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'logo', 'description', 'sector', 'website', 'color',
    ];

    public function challenges(): HasMany
    {
        return $this->hasMany(Challenge::class);
    }
}
