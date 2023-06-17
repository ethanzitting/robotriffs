<?php

namespace Tests\Endpoint\Tweets;

use App\Http\Resources\ImageResource;
use App\Http\Resources\TweetResource;
use App\Models\Image;
use App\Models\Tweet;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;
use Tests\Traits\GuestAccessForbidden;

class PostTweetTest extends TestCase
{
    use GuestAccessForbidden;

    protected array $payload;

    protected function setUp(): void
    {
        parent::setUp();

        $this->payload = [
            'tweetContent' => 'test content',
        ];
    }

    public function testCreatesATweet()
    {
        $this->authenticate();

        $this->submitRequest()
            ->assertCreated();

        $tweetCreated = Tweet::where('user_id', Auth::user()->id)
            ->where('content', 'test content')
            ->exists();

        $this->assertTrue($tweetCreated);
    }

    public function testReturnsResources()
    {
        $this->authenticate();

        $res = $this->submitRequest()
            ->assertCreated();

        $tweet = Tweet::where('user_id', Auth::user()->id)
            ->where('content', 'test content')
            ->first();

        $res->assertJsonResource(TweetResource::make($tweet));
    }

    public function testResponseSchema()
    {
        $this->authenticate();

        $res = $this->submitRequest()
            ->assertCreated();

        $tweet = Tweet::where('user_id', Auth::user()->id)
            ->where('content', 'test content')
            ->first();

        $now = Carbon::now()->floorSeconds()->toISOString();

        $res->assertJson([
            'data' => [
                'id' => $tweet->id,
                'content' => $tweet->content,
                'user' => [
                    'id' => $tweet->user_id,
                ],
                'parent' => [
                    'id' => $tweet->parent_id,
                ],
                'likeCount' => null,
                'replyCount' => null,
                'dates' => [
                    'created' => $now,
                    'updated' => $now,
                ],
            ],
        ]);
    }

    public function testATweetMayBeAReply()
    {
        $this->authenticate();

        $parentTweet = Tweet::factory()->create();

        $this->payload['parentTweet'] = $parentTweet->id;

        $this->submitRequest()
            ->assertCreated()
            ->assertJsonFragment([
                'parent' => ['id' => $parentTweet->id],
            ]);

        $tweetCreated = Tweet::where('user_id', Auth::user()->id)
            ->where('content', 'test content')
            ->where('parent_id', $parentTweet->id)
            ->exists();

        $this->assertTrue($tweetCreated);
    }

    public function testATweetMayIncludeAnImage()
    {
        Storage::fake();

        $this->authenticate();

        $this->payload['image'] = UploadedFile::fake()->image('test.jpg');

        $response = $this->submitRequest()
            ->assertCreated();

        $image = Image::findOrFail($response->json()['data']['image']['id']);

        $now = Carbon::now()->floorSeconds()->toISOString();

        $this->assertEquals(
            [
                'id' => $image->id,
                'user' => [
                    'id' => $image->user_id,
                ],
                'tweet' => [
                    'id' => $image->tweet_id,
                ],
                'url' => "http://localhost:80/storage/tweets/$image->id.jpg",
                'alt' => $image->alt,
                'dates' => [
                    'created' => $now,
                    'updated' => $now,
                ],
            ],
            $response->json()['data']['image']
        );

        Storage::assertExists(ImageResource::make($image)->url);
    }

    protected function submitRequest(): TestResponse
    {
        return $this->postJson('/api/tweets', $this->payload);
    }
}
