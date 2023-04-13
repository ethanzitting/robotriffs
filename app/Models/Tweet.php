<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tweet extends Model
{
    use HasFactory;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Tweet::class);
    }

    public function children(): HasMany
    {
        return $this->hasMany(Tweet::class, 'parent_id');
    }

    public function image()
    {
        return $this->hasOne(Image::class);
    }
}
