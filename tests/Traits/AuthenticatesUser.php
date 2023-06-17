<?php

namespace Tests\Traits;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Laravel\Sanctum\Sanctum;

trait AuthenticatesUser
{
    public function createUser(): User
    {
        return User::factory()
            ->create();
    }

    public function authenticateFor(Authenticatable $user): void
    {
        Sanctum::actingAs($user);
    }

    public function authenticate(): void
    {
        $this->authenticateFor($this->createUser());
    }
}
