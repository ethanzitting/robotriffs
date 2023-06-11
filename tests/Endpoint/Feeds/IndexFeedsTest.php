<?php

namespace Tests\Endpoint\Feeds;

use App\Http\Resources\TweetResource;
use App\Models\Tweet;
use App\Services\TweetService;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class IndexFeedsTest extends TestCase
{
    public function testGuestAccessDenied()
    {
        $this->getJson('/api/feeds')
            ->assertUnauthorized();
    }

    public function testReturnsAResourceCollection()
    {
        $this->authenticate();

        Tweet::factory(2)
            ->for(Auth::user())
            ->create();

        $tweets = TweetService::make()
            ->getFeedForUser(Auth::user());

        $res = $this->getJson('/api/feeds?user='.Auth::user()->id)
            ->assertOk()
            ->assertResourceCollection(TweetResource::collection($tweets));
    }
}
