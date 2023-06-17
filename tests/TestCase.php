<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tests\Traits\AuthenticatesUser;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use RefreshDatabase;
    use AuthenticatesUser;

    protected function resourcesToArray(string $resourceClass, $data)
    {
        return json_decode($resourceClass::collection($data)->toJson(), true);
    }
}
