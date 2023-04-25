<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'handle',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class);
    }

    public function tweets(): HasMany
    {
        return $this->hasMany(Tweet::class);
    }

    public function followers(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'follows',
            'followed_id',
            'follower_id'
        );
    }

    public function following(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'follows',
            'follower_id',
            'followed_id'
        );
    }

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }

    public function avatar(): HasOne
    {
        return $this->images()
            ->one()
            ->ofMany(
                ['created_at' => 'max'],
                fn ($query) => $query->where('type', 'avatar')
            );
    }

    public function banner(): HasOne
    {
        return $this->images()
            ->one()
            ->ofMany(
                ['created_at' => 'max'],
                fn ($query) => $query->where('type', 'banner')
            );
    }
}
