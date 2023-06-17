<?php

namespace Tests\Endpoint\Feeds;

use App\Http\Resources\TweetResource;
use App\Models\Tweet;
use App\Services\TweetService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;
use Tests\Traits\GuestAccessForbidden;

class IndexFeedsTest extends TestCase
{
    use GuestAccessForbidden;

    public function testReturnsAResourceCollection()
    {
        $this->authenticate();

        Tweet::factory(2)
            ->for(Auth::user())
            ->create();

        $tweets = TweetService::make()
            ->getFeedForUser(Auth::user());

        $this->getJson('/api/feeds?user='.Auth::user()->id)
            ->assertOk()
            ->assertJsonResource(TweetResource::collection($tweets));
    }

    public function submitRequest(): TestResponse
    {
        return $this->getJson('/api/feeds');
    }
}
