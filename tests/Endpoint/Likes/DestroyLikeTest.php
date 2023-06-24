<?php

namespace Tests\Endpoint\Likes;

use App\Models\Like;
use Illuminate\Support\Facades\Auth;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;
use Tests\Traits\GuestAccessForbidden;

class DestroyLikeTest extends TestCase
{
    use GuestAccessForbidden;

    private Like $like;

    protected function setUp(): void
    {
        parent::setUp();

        $this->like = Like::factory()
            ->create();
    }

    public function testDestroysResource()
    {
        $this->authenticate();

        $this->like->user_id = Auth::user()->id;
        $this->like->save();

        $this->submitRequest()
            ->assertNoContent();

        $this->assertDatabaseMissing('tweet_likes', [
            'id' => $this->like->id,
        ]);
    }

    public function submitRequest(): TestResponse
    {
        return $this->deleteJson('/api/likes/1?tweet='.$this->like->tweet_id);
    }
}
