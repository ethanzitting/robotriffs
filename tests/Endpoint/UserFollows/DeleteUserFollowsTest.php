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

        $this->submitRequest()
            ->assertStatus(204);

        $this->assertDatabaseMissing('follows', $this->follow->toArray());
    }

    public function submitRequest(): TestResponse
    {
        return $this->deleteJson('/api/user-follows/'.$this->follow->followed_id);
    }
}
