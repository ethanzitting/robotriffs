<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $table = 'tweet_likes';

    public function user()
    {
        $this->belongsTo(User::class);
    }

    public function tweet()
    {
        $this->belongsTo(Tweet::class);
    }
}
