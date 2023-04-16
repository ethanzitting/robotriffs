<?php

namespace Database\Factories;

use App\Models\Image;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Image::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'type' => $this->faker->word(),
            'alt_text' => $this->faker->word(),
        ];
    }

    public function avatar()
    {
        return $this->state(fn () => ['type' => 'avatar']);
    }

    public function banner()
    {
        return $this->state(fn () => ['type' => 'banner']);
    }
}
