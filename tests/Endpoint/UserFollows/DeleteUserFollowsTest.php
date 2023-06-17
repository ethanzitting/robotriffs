<?php

namespace Tests\Endpoint\UserFollows;

use Illuminate\Testing\TestResponse;
use Tests\TestCase;
use Tests\Traits\GuestAccessForbidden;

class DeleteUserFollowsTest extends TestCase
{
    use GuestAccessForbidden;

    public function testDestroysResource()
    {
        $this->fail();
    }

    public function submitRequest(): TestResponse
    {
        return $this->deleteJson('/api/user-follows');
    }
}
