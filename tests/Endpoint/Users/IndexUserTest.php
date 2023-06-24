<?php

namespace Tests\Endpoint\Users;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;
use Tests\Traits\GuestAccessForbidden;

class IndexUserTest extends TestCase
{
    use GuestAccessForbidden;

    protected function setUp(): void
    {
        parent::setUp();

        $this->users = User::factory(2)->create();
    }

    public function testReturnsResources()
    {
        $this->authenticate();

        $this->submitRequest()
            ->assertOk()
            ->assertJsonResource(UserResource::collection([...$this->users, Auth::user()]));
    }

    public function testResponseSchema()
    {
        $this->authenticate();

        $now = Carbon::now()->floorSeconds()->toISOString();

        $this->submitRequest()
            ->assertOk()
            ->assertJson([
                'data' => [
                    [
                        'id' => $this->users[0]->id,
                        'name' => $this->users[0]->name,
                        'handle' => $this->users[0]->handle,
                        'tweetCount' => null,
                        'followerCount' => null,
                        'followingCount' => null,
                        'dates' => [
                            'created' => $now,
                            'deleted' => null,
                        ],
                    ],
                    [
                        'id' => $this->users[1]->id,
                        'name' => $this->users[1]->name,
                        'handle' => $this->users[1]->handle,
                        'tweetCount' => null,
                        'followerCount' => null,
                        'followingCount' => null,
                        'dates' => [
                            'created' => $now,
                            'deleted' => null,
                        ],
                    ],
                    [
                        'id' => Auth::user()->id,
                        'name' => Auth::user()->name,
                        'handle' => Auth::user()->handle,
                        'tweetCount' => null,
                        'followerCount' => null,
                        'followingCount' => null,
                        'dates' => [
                            'created' => $now,
                            'deleted' => null,
                        ],
                    ],
                ],
            ]);
    }

    protected function submitRequest(): TestResponse
    {
        return $this->getJson('api/users');
    }
}
