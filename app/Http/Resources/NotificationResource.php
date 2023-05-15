<?php

namespace App\Http\Resources;

use App\Types\NotificationTypes;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    public function toArray(Request $request): array|\JsonSerializable|Arrayable
    {
        return [
            'id' => $this->id,
            'type' => NotificationTypes::toString($this->type),
            'user' => $this->user(),
            'causedBy' => $this->causedBy(),
            'tweet' => $this->tweet(),
            'viewed' => $this->viewed,
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

    private function causedBy(): UserResource|array
    {
        return $this->resource->relationLoaded('causedBy')
            ? UserResource::make($this->causedBy)
            : ['id' => $this->caused_by];
    }

    private function tweet(): TweetResource|array
    {
        return $this->resource->relationLoaded('tweet')
            ? TweetResource::make($this->tweet)
            : ['id' => $this->tweet_id];
    }
}
