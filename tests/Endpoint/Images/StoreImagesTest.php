<?php

namespace Tests\Endpoint\Images;

use App\Http\Resources\ImageResource;
use App\Models\Image;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Testing\TestResponse;
use Tests\AuthenticatesUser;
use Tests\TestCase;

class StoreImagesTest extends TestCase
{
    use AuthenticatesUser;

    private array $payload;
    private UploadedFile $image;

    protected function setUp(): void
    {
        parent::setUp();

        $this->image = UploadedFile::fake()->image('avatar.jpg');

        $this->payload['image'] = $this->image;
    }

    public function guestAccessForbidden(): void
    {
        $this->storeImage()
            ->assertUnauthorized();
    }

    public function testAResourceIsReturned()
    {
        $this->authenticate();

        $res = $this->storeImage()
            ->assertCreated();

        $image = Image::findOrFail($res->json()['data']['id']);

        $res->assertSingleJsonResource(ImageResource::make($image));
    }

    public function testResponseSchema()
    {
        $this->authenticate();

        $res = $this->storeImage()
            ->assertCreated();

        $image = Image::findOrFail($res->json()['data']['id']);

        $res->assertJson([
                'data' => [
                    'id' => $image->id,
                    'user' => [
                        'id' => Auth::user()->id,
                    ],
                    'tweet' => [
                        'id' => null,
                    ],
                    'url' => 'http://localhost/storage/tweets/'.$image->id.'.jpg',
                    'alt' => null,
                    'dates' => [
                        'created' => Carbon::now()->floorSecond()->toISOString(),
                        'updated' => Carbon::now()->floorSecond()->toISOString(),
                    ],
                ],
            ]);
    }

    public function testAnImageIsUploaded()
    {
        Storage::fake();

        $this->authenticate();

        $response = $this->storeImage()
            ->assertCreated();

        $image = Image::findOrFail($response->json()['data']['id']);

        Storage::assertExists(ImageResource::make($image)->url);
    }


    public function storeImage(): TestResponse
    {
        return $this->postJson('/api/images', $this->payload);
    }
}
