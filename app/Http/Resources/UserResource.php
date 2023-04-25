<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array|\JsonSerializable|Arrayable
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'handle' => $this->handle,
            'tweets' => TweetResource::collection(
                $this->whenLoaded('tweets')
            ),
            'tweetCount' => $this->tweets_count,
            'profile' => ProfileResource::make(
                $this->whenLoaded('profile')
            ),
            'followers' => UserResource::collection(
                $this->whenLoaded('followers')
            ),
            'followerCount' => $this->followers_count,
            'following' => UserResource::collection(
                $this->whenLoaded('following')
            ),
            'followingCount' => $this->following_count,
            'avatar' => ImageResource::make($this->whenLoaded('avatar')),
            'banner' => ImageResource::make($this->whenLoaded('banner')),
            'dates' => [
                'created' => $this->created_at,
                'deleted' => $this->deleted_at,
            ],
        ];
    }
}
