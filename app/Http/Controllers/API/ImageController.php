<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreImageRequest;
use App\Http\Resources\ImageResource;
use App\Services\ImageService;

class ImageController extends Controller
{
    public function __construct(private ImageService $imageService)
    {
    }

    public function store(StoreImageRequest $request): ImageResource
    {
        $image = $this->imageService->saveImage(
            $request->file('image'),
            $request->image->extension(),
        );

        return new ImageResource($image);
    }
}
