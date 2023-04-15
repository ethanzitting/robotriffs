<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LikeResource extends JsonResource
{
    public function toArray(Request $request): array|\JsonSerializable|Arrayable
    {
        return [
            'id' => $this->id,
            'user' => $this->user(),
            'tweet' => $this->tweet(),
            'dates' => [
                'created' => $this->created_at,
                'deleted' => $this->deleted_at,
            ]
        ];
    }

    private function user(): UserResource|array
    {
        return $this->resource->relationLoaded('user')
            ? UserResource::make($this->user)
            : ['id' => $this->user_id];
    }

    private function tweet(): TweetResource|array
    {
        return $this->resource->relationLoaded('tweet')
            ? TweetResource::make($this->tweet)
            : ['id' => $this->tweet_id];
    }
}
