<?php

namespace Tests\Endpoint\UserFollows;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;
use Tests\Traits\GuestAccessForbidden;

class PostUserFollowsTest extends TestCase
{
    use GuestAccessForbidden;

    private User $followed;
    private array $payload;

    protected function setUp(): void
    {
        parent::setUp();

        $this->followed = User::factory()->create();

        $this->payload = [
            'followed' => $this->followed->id
        ];
    }

    public function testCreatesAFollow()
    {
        $this->authenticate();

        $this->submitRequest();

        $this->assertDatabaseHas(
            'follows',
            [
                'followed_id' => $this->followed->id,
                'follower_id' => Auth::user()->id,
            ]
        );
    }

    public function testReturnsResources()
    {
        $this->authenticate();

        $this->submitRequest()
            ->assertJsonResource(new UserResource($this->followed));
    }

    protected function submitRequest(): TestResponse
    {
        return $this->postJson('/api/user-follows', $this->payload);
    }
}
