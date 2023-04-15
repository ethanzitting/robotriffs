<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user' => $this->user(),
            'bio' => $this->bio,
        ];
    }

    private function user(): UserResource|array
    {
        return $this->resource->relationLoaded('user')
            ? UserResource::make($this->user)
            : ['id' => $this->user_id];
    }
}
