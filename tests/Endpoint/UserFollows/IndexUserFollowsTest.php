<?php

namespace Tests\Endpoint\UserFollows;

use Illuminate\Testing\TestResponse;
use Tests\TestCase;
use Tests\Traits\GuestAccessForbidden;

class IndexUserFollowsTest extends TestCase
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

    public function submitRequest(): TestResponse
    {
        return $this->getJson('/api/user-follows');
    }
}
