<?php

namespace Database\Factories;

use App\Models\Facebook;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class FacebookFactory extends Factory
{
    protected $model = Facebook::class;

    public function definition()
    {
        return [
            'fb_comments' => $this->faker->numberBetween(0, 1000000),
            'fb_reac' => $this->faker->numberBetween(0, 10000000),
            'fb_shares' => $this->faker->numberBetween(0, 1000000),
        ];
    }
}
