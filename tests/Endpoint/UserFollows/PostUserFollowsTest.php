<?php

namespace Tests\Endpoint\UserFollows;

use Illuminate\Testing\TestResponse;
use Tests\TestCase;
use Tests\Traits\GuestAccessForbidden;

class PostUserFollowsTest extends TestCase
{
    use GuestAccessForbidden;

    public function testReturnsResources()
    {
        $this->fail();
    }

    public function testResponseSchema()
    {
        $this->fail();
    }

    protected function submitRequest(): TestResponse
    {
        return $this->postJson('/api/user-follows');
    }
}
