<?php

namespace Tests\Endpoint\UserFollows;

use App\Models\User;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;
use Tests\Traits\GuestAccessForbidden;

class DeleteUserFollowsTest extends TestCase
{
    use GuestAccessForbidden;

    private User $user;


    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()
            ->hasFollowing()
            ->create();
    }

    public function testDestroysResource()
    {
        $this->authenticateFor($this->user);

        $this->submitRequest()
            ->assertStatus(204);

        $this->assertDatabaseMissing('follows', [
            'followed_id' => $this->user->following->first()->id,
            'follower_id' => $this->user->id,
        ]);
    }

    public function submitRequest(): TestResponse
    {
        return $this->deleteJson('/api/user-follows/1?followed='.$this->user->following->first()->id);
    }
}
