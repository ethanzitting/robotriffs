<?php

namespace App\Mixins;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Testing\TestResponse;

/**
 * @mixin TestResponse
 */
class TestResponseMacros
{
    /**
     * Assert that the response contains the structure of the JsonResponse.
     */
    public function assertJsonResource(): \Closure
    {
        return function (JsonResource $resource) {
            $payload = $this->jsonResourceToArray($resource);

            $this->assertJson(['data' => $payload]);

            return $this;
        };
    }

    protected function jsonResourceToArray(): \Closure
    {
        return function (JsonResource $resource) {
            return json_decode($resource->toJson(), true);
        };
    }
}
