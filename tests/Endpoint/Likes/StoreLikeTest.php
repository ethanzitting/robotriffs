<?php

namespace Tests\Endpoint\Likes;

use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class StoreLikeTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->payload = [

        ];
    }

    public function testGuestAccessForbidden()
    {
        $this->storeLike()
            ->assertUnauthorized();
    }

    public function testCreatesAResource()
    {
        $this->fail();
    }

    public function testReturnsResources()
    {
        $this->authenticate();

        $this->fail();
    }

    public function testResponseSchema()
    {
        $this->authenticate();

        $this->fail();
    }

    private function storeLike(): TestResponse
    {
        return $this->postJson('/api/tweets', $this->payload);
    }
}
