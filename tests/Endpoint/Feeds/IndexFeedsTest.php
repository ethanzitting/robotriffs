<?php

namespace Tests\Endpoint\Feeds;

use App\Http\Resources\TweetResource;
use App\Models\Tweet;
use App\Services\TweetService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;
use Tests\Traits\GuestAccessForbidden;
use Tests\Traits\UserAccessPermitted;

class IndexFeedsTest extends TestCase
{
    use GuestAccessForbidden;
    use UserAccessPermitted;

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

    public function submitRequest(): TestResponse
    {
        return $this->getJson('/api/feeds');
    }
}
