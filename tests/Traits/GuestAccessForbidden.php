<?php

namespace Tests\Traits;

trait GuestAccessForbidden
{
    public function testGuestAccessForbidden()
    {
        $submissionMethod = $this->submissionMethod ?? 'submitRequest';

        $this->$submissionMethod()
            ->assertUnauthorized();
    }
}
