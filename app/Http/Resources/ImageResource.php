<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ImageResource extends JsonResource
{
    public function toArray(Request $request): array|\JsonSerializable|Arrayable
    {
        return [
            'id' => $this->id,
            'user' => $this->user(),
            'tweet' => $this->tweet(),
            'url' => $this->file_name
                ? env('APP_URL').'/storage/tweets/'.$this->file_name
                : 'https://placehold.co/600x600',
            'alt' => $this->alt_text,
            'dates' => [
                'created' => $this->created_at,
                'updated' => $this->updated_at,
            ],
        ];
    }

    private function user(): UserResource|array
    {
        return $this->resource->relationLoaded('user')
            ? UserResource::make($this->user_id)
            : ['id' => $this->user_id];
    }

    private function tweet(): TweetResource|array
    {
        return $this->resource->relationLoaded('tweet')
            ? TweetResource::make($this->tweet_id)
            : ['id' => $this->tweet_id];
    }
}
