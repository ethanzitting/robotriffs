<?php

namespace Tests\Endpoint\Likes;

use App\Models\Like;
use Illuminate\Support\Facades\Auth;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class DestroyLikeTest extends TestCase
{
    private Like $like;
    protected function setUp(): void
    {
        parent::setUp();

        $this->like = Like::factory()
            ->create();
    }

    public function testGuestAccessForbidden()
    {
        $this->destroyLike()
            ->assertUnauthorized();
    }

    public function testDestroysResource()
    {
        $this->authenticate();

        $this->like->user_id = Auth::user()->id;
        $this->like->save();

        $this->destroyLike()
            ->assertNoContent();

        $this->assertDatabaseMissing('tweet_likes', [
            'id' => $this->like->id,
        ]);
    }

    public function destroyLike(): TestResponse
    {
        return $this->deleteJson('/api/likes/1?tweet='.$this->like->tweet_id);
    }
}
