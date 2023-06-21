<?php

namespace Tests\Endpoint\UserFollows;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;
use Tests\Traits\GuestAccessForbidden;

class DeleteUserFollowsTest extends TestCase
{
    use GuestAccessForbidden;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()
            ->hasFollowers()
            ->create();

        $this->follow = DB::table('follows')
            ->where('follower_id', $user->followers->first()->id)
            ->where('followed_id', $user->id)
            ->first();
    }

    public function testDestroysResource()
    {
        $this->authenticate();

        $this->submitRequest($this->follow->followed_id)
            ->assertStatus(204);

        $this->assertDatabaseMissing('follows', $this->follow->toArray());
    }

    public function submitRequest(?int $followedId = null): TestResponse
    {
        return $this->deleteJson('/api/user-follows?followed='.$followedId);
    }
}
