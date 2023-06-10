<?php

namespace App\Services;

use App\Models\Image;
use Illuminate\Support\Facades\Auth;

class ImageService extends BaseService
{
    public function saveImage($file, string $extension): Image
    {
        $image = Image::make();
        $image->user_id = Auth::user()->id;
        $image->type = 'avatar';
        $image->save();

        $image->fresh();
        $image->file_name = $image->id.'.'.$extension;
        $image->save();

        $file->storeAs('public/tweets', $image->file_name);

        return $image;
    }
}
