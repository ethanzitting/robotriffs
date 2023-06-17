<?php

namespace Tests\Endpoint\Users;

use App\Http\Resources\NotificationResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;
use Tests\Traits\GuestAccessForbidden;

class GetUserTests extends TestCase
{
    use GuestAccessForbidden;

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()
            ->hasAvatar()
            ->hasBanner()
            ->hasNotifications()
            ->hasFollowers()
            ->hasFollowing()
            ->create()
            ->load([
                'avatar',
                'banner',
                'notifications',
                'followers',
                'following',
            ]);
    }

    public function testReturnsResources()
    {
        $this->authenticate();

        $this->submitRequest()
            ->assertOk()
            ->assertJsonResource(UserResource::make($this->user));
    }

    public function testResponseSchema()
    {
        $this->authenticate();

        $this->submitRequest()
            ->assertOk()
            ->assertJson([
                'data' => [
                    'id' => $this->user->id,
                    'name' => $this->user->name,
                    'handle' => $this->user->handle,
                    'tweetCount' => null,
                    'followers' => $this->resourcesToArray(UserResource::class, $this->user->followers),
                    'followerCount' => null,
                    'following' => $this->resourcesToArray(UserResource::class, $this->user->following),
                    'notifications' => $this->resourcesToArray(NotificationResource::class, $this->user->notifications),
                    'followingCount' => null,
                    'avatar' => null,
                    'banner' => null,
                    'dates' => [
                        'created' => Carbon::now()->floorSeconds()->toISOString(),
                        'deleted' => null,
                    ],
                ],
            ]);
    }

    public function submitRequest(): TestResponse
    {
        return $this->getJson('/api/users/'.$this->user->id);
    }
}
