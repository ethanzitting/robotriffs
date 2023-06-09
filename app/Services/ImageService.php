<?php

namespace App\Services;

use App\Models\Image;
use Illuminate\Support\Facades\Auth;

class ImageService extends BaseService
{
    public function saveImage($file, string $extension, ?int $tweetId = null): Image
    {
        $image = Image::make();
        $image->user_id = Auth::user()->id;
        $image->tweet_id = $tweetId;
        $image->type = 'avatar';
        $image->save();

        $image->fresh();
        $image->file_name = $image->id.'.'.$extension;
        $image->save();

        $file->storeAs('public/tweets', $image->file_name);

        return $image;
    }
}
