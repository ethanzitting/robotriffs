<?php

namespace Tests\Endpoint\Tweets;

use Tests\TestCase;
use Tests\Traits\GuestAccessForbidden;

class PostTweetTest extends TestCase
{
    use GuestAccessForbidden;

    protected array $payload;

    protected function setUp(): void
    {
        parent::setUp();

        $this->payload = [];
    }

    public function testReturnsResources()
    {
        $this->fail();
    }

    public function testResponseSchema()
    {
        $this->fail();
    }

    protected function submitRequest()
    {
        return $this->postJson('/api/tweets', $this->payload);
    }
}
