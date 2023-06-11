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
        return function (
            JsonResource $resource,
            bool $hasWrapKey = true,
            string $wrapKey = 'data'
        ) {
            $payload = [
                $this->jsonResourceToArray($resource),
            ];

            if ($hasWrapKey) {
                $payload = [
                    $wrapKey => $payload,
                ];
            }

            $this->assertJson($payload);

            return $this;
        };
    }


    /**
     * Assert that the response contains the structure of the JsonResponse.
     */
    public function assertResourceCollection(): \Closure
    {
        return function (JsonResource $resource)
        {
            $this->assertJson([
                'data' => $this->jsonResourceToArray($resource),
            ]);

            return $this;
        };
    }



    /**
     * Assert that the response contains the structure of the JsonResponse
     * single response.
     */
    public function assertSingleJsonResource(): \Closure
    {
        return function (
            JsonResource $resource,
            bool $hasWrapKey = true,
            string $wrapKey = 'data'
        ) {
            $payload = $this->jsonResourceToArray($resource);

            if ($hasWrapKey) {
                $payload = [
                    $wrapKey => $payload,
                ];
            }

            $this->assertJson($payload);

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
