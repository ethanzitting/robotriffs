<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ImageResource;
use App\Services\ImageService;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function __construct(private ImageService $imageService)
    {
    }

    public function store(Request $request)
    {
        $image = $this->imageService->saveImage(
            $request->file('image'),
            $request->image->extension(),
        );

        return new ImageResource($image);
    }
}
