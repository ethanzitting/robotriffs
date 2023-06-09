<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
    use HasFactory;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function causedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'caused_by', 'id');
    }

    public function tweet(): BelongsTo
    {
        return $this->belongsTo(Tweet::class);
    }
}
