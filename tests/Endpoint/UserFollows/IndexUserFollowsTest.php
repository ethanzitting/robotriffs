<?php

namespace Tests\Endpoint\UserFollows;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;
use Tests\Traits\GuestAccessForbidden;

class IndexUserFollowsTest extends TestCase
{
    use GuestAccessForbidden;

    private User $followed;

    protected function setUp(): void
    {
        parent::setUp();

        $this->followed = User::factory()
            ->hasFollowers(3)
            ->create();
    }

    public function testReturnsResources()
    {
        $this->authenticate();

        $this->submitRequest()
            ->assertJsonResource(UserResource::collection($this->followed->followers));
    }

    public function submitRequest(): TestResponse
    {
        return $this->getJson('/api/user-follows?followed='.$this->followed->id);
    }
}
