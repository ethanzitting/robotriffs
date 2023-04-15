<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TweetResource extends JsonResource
{
    public function toArray(Request $request): array|\JsonSerializable|Arrayable
    {
        return [
            'id' => $this->id,
            'content' => $this->content,
            'image' => ImageResource::make($this->whenLoaded('image')),
            'user' => $this->user(),
            'parent' => $this->parent(),
            'likes' => LikeResource::collection($this->whenLoaded('likes')),
            'children' => TweetResource::collection($this->whenLoaded('children')),
            'dates' => [
                'created' => $this->created_at,
                'updated' => $this->updated_at,
            ],
        ];
    }

    private function user(): UserResource|array
    {
        return $this->resource->relationLoaded('user')
            ? UserResource::make($this->user)
            : ['id' => $this->user_id];
    }

    private function parent(): TweetResource|array
    {
        return $this->resource->relationLoaded('parent')
            ? TweetResource::make($this->parent)
            : ['id' => $this->parent_id];
    }
}
