<?php

namespace Tests\Endpoint\Likes;

use App\Http\Resources\LikeResource;
use App\Models\Like;
use App\Models\Tweet;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class StoreLikeTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->payload = [
            'tweet' => Tweet::factory()->create()->id,
        ];
    }

    public function testGuestAccessForbidden()
    {
        $this->storeLike()
            ->assertUnauthorized();
    }

    public function testCreatesAResource()
    {
        $this->authenticate();

        $this->storeLike()
            ->assertCreated();

        $this->assertDatabaseHas('tweet_likes', [
            'tweet_id' => $this->payload['tweet'],
        ]);
    }

    public function testReturnsResource()
    {
        $this->authenticate();

        $res = $this->storeLike()
            ->assertCreated();

        $like = Like::findOrFail($res->json()['data']['id']);

        $res->assertSingleJsonResource(LikeResource::make($like));
    }

    public function testResponseSchema()
    {
        $this->authenticate();

        $res = $this->storeLike()
            ->assertCreated();

        $like = Like::findOrFail($res->json()['data']['id']);

        $res->assertJson([
            'data' => [
                'id' => $like->id,
                'user' => [
                    'id' => Auth::user()->id,
                ],
                'tweet' => [
                    'id' => $this->payload['tweet'],
                ],
                'dates' => [
                    'created' => Carbon::now()->floorSeconds()->toISOString(),
                    'updated' => Carbon::now()->floorSeconds()->toISOString(),
                ],
            ],
        ]);
    }

    private function storeLike(): TestResponse
    {
        return $this->postJson('/api/likes', $this->payload);
    }
}
